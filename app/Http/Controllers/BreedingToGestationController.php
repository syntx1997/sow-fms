<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BGD1D30;
use App\Models\BGD31D70;
use App\Models\BGD71D100;
use Illuminate\Support\Facades\Validator;

class BreedingToGestationController extends Controller
{
    public function editBGD1D30(Request $request) {
        $validator = Validator::make($request->all(), [
            'pig_id' => 'required',
            'day' => 'required',
            'time' => 'required',
            'feed_amount' => 'required',
            'feed_type' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $bgd1d30 = BGD1D30::where('pig_id', $request->pig_id)->first();
        if ($bgd1d30) {
            $bgd1d30Data = BGD1D30::find($bgd1d30->id);
            $bgd1d30Data->update($request->all());
        } else {
            BGD1D30::create($request->all());
        }

        return response(['message' => 'Schedule set successfully!'], 201);
    }

    public function editBGD31D70(Request $request) {
        $validator = Validator::make($request->all(), [
            'pig_id' => 'required',
            'day' => 'required',
            'time' => 'required',
            'feed_amount' => 'required',
            'feed_type' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $bgd31d70 = BGD31D70::where('pig_id', $request->pig_id)->first();
        if ($bgd31d70) {
            $bgd31d70Data = BGD31D70::find($bgd31d70->id);
            $bgd31d70Data->update($request->all());
        } else {
            BGD31D70::create($request->all());
        }

        return response(['message' => 'Schedule set successfully!'], 201);
    }

    public function editBGD71D100(Request $request) {
        $validator = Validator::make($request->all(), [
            'pig_id' => 'required',
            'day' => 'required',
            'time' => 'required',
            'feed_amount' => 'required',
            'feed_type' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $bgd71d100 = BGD71D100::where('pig_id', $request->pig_id)->first();
        if ($bgd71d100) {
            $bgd71d100Data = BGD71D100::find($bgd71d100->id);
            $bgd71d100Data->update($request->all());
        } else {
            BGD71D100::create($request->all());
        }

        return response(['message' => 'Schedule set successfully!'], 201);
    }
}
