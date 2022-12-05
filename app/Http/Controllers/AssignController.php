<?php

namespace App\Http\Controllers;

use App\Models\Assign;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssignController extends Controller
{
    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'pig_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        Assign::create($request->all());

        $user = User::where('id', $request->user_id)->first();
        $sendSMS = SPSendSMS($user->phone, 'A new pig has been assigned to you. Kindly check it on your app or visit https://stracker-fms.com.');

        return response(['message' => 'Staff assigned successfully!', 'sms' => $sendSMS], 201);
    }
}
