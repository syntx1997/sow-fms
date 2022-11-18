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

        Mating::create($request->all());
        return response(['message' => 'New mating schedule added successfully!'], 201);
    }

    public function edit(Request $request) {
        $validator = Validator::make($request->all(), [
           'id' => 'required',
           'date' => 'required',
            'boar' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $mating = Mating::find($request->id);
        $mating->update([
            'date' => $request->date,
            'boar' => $request->boar
        ]);

        return response(['message' => 'Mating schedule edited successfully!'], 201);
    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $mating = Mating::find($request->id);
        $mating->delete();

        return response(['message' => 'Mating schedule deleted successfully!'], 201);
    }
}
