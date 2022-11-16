<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farrowing;
use Illuminate\Support\Facades\Validator;

class FarrowingController extends Controller
{
    public function edit(Request $request) {
        $validator = Validator::make($request->all(), [
            'actual_date' => 'required',
            'status' => 'required',
            'weight' => 'required',
            'alive' => 'required',
            'dead' => 'required',
            'litter_no' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $farrowing = Farrowing::where('litter_no', $request->litter_no)->first();
        if($farrowing) {
            $farrowingData = Farrowing::find($farrowing->id);
            $farrowingData->update($request->all());
        } else {
            Farrowing::create($request->all());
        }

        return response(['message' => 'Farrowing schedule updated successfully!'], 201);
    }
}
