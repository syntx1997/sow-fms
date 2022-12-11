<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function updateInformation(Request $request) {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'id' => 'required'
        ]);

        if ($validation->fails()) {
            return response(['errors' => $validation->errors()], 401);
        }

        if ($request->has('avatar')) {
            $avatarString = $request->file('avatar')->store('users-avatar', 'public');
            $avatar = trim($avatarString, 'users-avatar/');
        } else {
            $avatar = $request->avatar_name;
        }

        $user = User::find($request->id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'avatar' => $avatar
        ]);

        return response(['message' => 'Information Updated Successfully!', 'avatar' => $request->file('avatar')], 201);
    }

    public function updatePassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required',
            'retype_password' => 'required',
            'id' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $account = User::where('id', $request->id)->first();

        if(!Hash::check($request->current_password, $account->password)) {
            return response([
                'errors' => [
                    'current_password' => 'Incorrect Password!'
                ]
            ], 401);
        }

        if ($request->new_password !== $request->retype_password) {
            return response([
                'errors' => [
                    'new_password' => 'Password did\'nt matched!',
                    'retype_password' => 'Password did\'nt matched!'
                ]
            ], 401);
        }

        $user = User::find($request->id);
        $user->update(['password' => bcrypt($request->new_password)]);

        return response(['message' => 'Password Updated Successfully!']);
    }
}
