<?php

namespace App\Http\Controllers;

use App\Models\Assign;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    /*-- ----------- User Authentication -----------  --*/
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
            return response(['message' => 'Invalid email or password!'], 401);
        }

        if(auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
        }

        return response(['message' => 'Logged In!'], 201);
    }

    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response([
            'message' => 'You have been logged out!'
        ], 201);
    }

    /*-- ----------- User Management -----------  --*/
    public function getAllStaff() {
        $data = [];

        $staffs = User::where('role', 'Staff')->get();
        foreach ($staffs as $index => $staff) {
            $data[] = array_merge($staff->toArray(), [
                'number' => '<h6>'.($index + 1).'.</h6>',
                'staff' => $this->user($staff->avatar, $staff->name, $staff->email),
                'action' => editDeleteBtn('staff', $staff),
                'assigned' => Assign::where('user_id', $staff->id)->count(),
                'date' => Carbon::parse($staff->created_at)->format('m/d/Y'),
                'pigs' => Assign::where('user_id', $staff->id)->join('pigs', 'pigs.id', '=', 'assigns.pig_id')->get('pigs.*')
            ]);
        }

        return response(['data' => $data], 201);
    }

    public function addStaff(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);

        return response(['message' => 'New staff added successfully!'], 201);
    }

    public function deleteStaff(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $staff = User::find($request->id);
        $staff->delete();

        return response(['message' => 'Staff deleted successfully!'], 201);
    }

    public function updateStaff(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $staff = User::find($request->id);
        $staff->update($request->all());

        return response(['message' => 'Staff updated successfully!'], 201);
    }

    /*-- ----------- Check if Logged In -----------  --*/
    public function checkIfLoggedIn() {
        $loggedIn = false;
        if (Auth::check()) {
            $loggedIn = true;
        }

        return response(['logged_in' => $loggedIn]);
    }

    /*-- ----------- Generate Token -----------  --*/
    public function generateToken() {
        return response(['token' => csrf_token()], 201);
    }

    /*-- ----------- Private Functions -----------  --*/
    private function user($img, $name, $email) {
        $imgPath = asset('storage/users-avatar/' . $img);
        return <<<HERE
            <div class="media style-1">
                <img src="$imgPath" class="img-fluid mr-2" alt="{$name}'s Avatar">
                <div class="media-body">
                    <h6>$name</h6>
                    <span>[$email]</span>
                </div>
            </div>
        HERE;
    }
}
