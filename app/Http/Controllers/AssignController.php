<?php

namespace App\Http\Controllers;

use App\Models\Assign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssignController extends Controller
{
    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'sow_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        Assign::create($request->all());

        return response(['message' => 'Staff assigned successfully!'], 201);
    }
}
