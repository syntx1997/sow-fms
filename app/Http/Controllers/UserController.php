<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
            return response(['message' => 'Invalid email or password1'], 401);
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
                'action' => $this->action('staff', $staff),
                'date' => Carbon::parse($staff->created_at)->format('m/d/Y')
            ]);
        }

        return response(['data' => $data], 201);
    }

    public function addStaff(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
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
            'email' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $staff = User::find($request->id);
        $staff->update($request->all());

        return response(['message' => 'Staff updated successfully!'], 201);
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

    private function action($btnName, $data) {
        $dataAttr = htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');
        return <<<HERE
            <div class="d-flex action-button">
                <button id="{$btnName}EditBtn" data-data="$dataAttr" class="btn btn-info btn-xs light px-2">
                    <svg width="20" height="20" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 3C17.2626 2.73735 17.5744 2.52901 17.9176 2.38687C18.2608 2.24473 18.6286 2.17157 19 2.17157C19.3714 2.17157 19.7392 2.24473 20.0824 2.38687C20.4256 2.52901 20.7374 2.73735 21 3C21.2626 3.26264 21.471 3.57444 21.6131 3.9176C21.7553 4.26077 21.8284 4.62856 21.8284 5C21.8284 5.37143 21.7553 5.73923 21.6131 6.08239C21.471 6.42555 21.2626 6.73735 21 7L7.5 20.5L2 22L3.5 16.5L17 3Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
                <button id="{$btnName}DeleteBtn" data-data="$dataAttr" class="ml-2 btn btn-xs px-2 light btn-danger">
                    <svg width="20" height="20" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 6H5H21" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>

                </>
            </div>
        HERE;

    }
}
