<?php

namespace App\Http\Controllers;

use App\Models\Litter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LitterController extends Controller
{
    public function add(Request $request) {
        $litter_no = 'L' . str_pad((Litter::all()->count() + 1), 3, 0, STR_PAD_LEFT);

        $validator = Validator::make($request->all(), [
            'sow_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        Litter::create([
            'litter_no' => $litter_no,
            'sow_id' => $request->sow_id
        ]);

        return response(['message' => 'New set generated!'], 201);
    }
}
