<?php

namespace App\Http\Controllers;

use App\Models\Mating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatingController extends Controller
{
    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'litter_no' => 'required',
            'date' => 'required',
            'boar' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $countMating = Mating::where('litter_no', $request->litter_no)->count();

        if($countMating < 3) {
            Mating::create($request->all());
            return response(['message' => 'New mating schedule added successfully!'], 201);
        }

        return response(['message' => 'Maximum of three rows exceeded!'], 401);
    }
}
