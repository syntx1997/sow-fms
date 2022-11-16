<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weaning;
use Illuminate\Support\Facades\Validator;

class WeaningController extends Controller
{
    public function edit(Request $request) {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'number' => 'required',
            'weight' => 'required',
            'litter_no' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $weaning = Weaning::where('litter_no', $request->litter_no)->first();
        if($weaning) {
            $weaningData = Weaning::find($weaning->id);
            $weaningData->update($request->all());
        } else {
            Weaning::create($request->all());
        }

        return response(['message' => 'Weaning schedule updated successfully!'], 201);
    }
}
