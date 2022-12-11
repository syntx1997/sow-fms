<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Observation;
use Illuminate\Support\Facades\Validator;

class ObservationController extends Controller
{
    public function add(Request $request) {
        $validation = Validator::make($request->all(), [
            'pig_no' => 'required',
            'treatment' => 'required',
            'feed_amount' => 'required',
            'feed_type' => 'required',
            'start_weight' => 'required',
            'end_weight' => 'required',
            'status' => 'required'
        ]);

        if ($validation->fails()) {
            return response(['errors' => $validation->errors()], 401);
        }

        Observation::create($request->all());

        return response(['message' => 'Pig moved to Under Observation.']);
    }

    public function edit(Request $request) {
        $validation = Validator::make($request->all(), [
            'pig_no' => 'required',
            'treatment' => 'required',
            'feed_amount' => 'required',
            'feed_type' => 'required',
            'start_weight' => 'required',
            'end_weight' => 'required',
            'status' => 'required',
            'id' => 'required'
        ]);

        if ($validation->fails()) {
            return response(['errors' => $validation->errors()], 401);
        }

        $observation = Observation::find($request->id);
        $observation->update($request->all());

        return response(['message' => 'Updated successfully!']);
    }

    public function delete(Request $request) {
        $validation = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validation->fails()) {
            return response(['errors' => $validation->errors()], 401);
        }

        $observation = Observation::find($request->id);
        $observation->delete();

        return response(['message' => 'Deleted successfully!']);
    }
}
