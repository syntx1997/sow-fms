<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function checkRole() {
        switch (auth()->user()->role) {
            case 'Administrator':
                return redirect('/dashboard/admin/index');
            case 'Staff':
                return redirect('/dashboard/staff/index');
            default:
                return;
        }
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $email = User::where('email', $request->email)->first();
        if(!$email || !Hash::check($request->password, $email->password)) {
            return response(['message' => 'Invalid email or password1'], 401);
        }

        if(auth()->attempt(['email' => $request->email, 'password' => bcrypt($request->password)])) {
            $request->session()->regenerate();
        }

        return response(['message' => 'Logged In!'], 201);
    }
}
