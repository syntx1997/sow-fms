<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Remark;
use Illuminate\Support\Facades\Validator;

class RemarkController extends Controller
{
    public function edit(Request $request) {
        $validation = Validator::make($request->all(), [
            'remarks' => 'required',
            'litter_no' => 'required'
        ]);

        if($validation->fails()) {
            return response(['errors' => $validation->errors()], 401);
        }

        $remarks = Remark::where('litter_no', $request->litter_no)->first();
        if($remarks) {
            $remarksData = Remark::find($remarks->id);
            $remarksData->update($request->all());
        } else {
            Remark::create($request->all());
        }

        return response(['message' => 'Remarks successfully updated!']);
    }
}
