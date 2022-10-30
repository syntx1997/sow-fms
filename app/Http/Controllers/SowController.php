<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sow;
use Illuminate\Support\Facades\Validator;

class SowController extends Controller
{
    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'breed' => 'required',
            'dateBorn' => 'required',
            'origin' => 'required',
            'dam' => 'required',
            'dateProcured' => 'required',
            'sire' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        Sow::create([
            'sow_no' => 'SOW'.str_pad((Sow::count() + 1), 3, '0', STR_PAD_LEFT),
            'breed' => $request->breed,
            'date_born' => $request->dateBorn,
            'origin' => $request->origin,
            'dam' => $request->dam,
            'date_procured' => $request->dateProcured,
            'sire' => $request->sire
        ]);

        return response(['message' => 'New sow added successfully'], 201);
    }

    public function edit(Request $request) {
        $validator = Validator::make($request->all(), [
            'breed' => 'required',
            'dateBorn' => 'required',
            'origin' => 'required',
            'dam' => 'required',
            'dateProcured' => 'required',
            'sire' => 'required',
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $sow = Sow::find($request->id);
        $sow->update([
            'breed' => $request->breed,
            'date_born' => $request->dateBorn,
            'origin' => $request->origin,
            'dam' => $request->dam,
            'date_procured' => $request->dateProcured,
            'sire' => $request->sire
        ]);

        return response(['message' => 'Sow updated successfully'], 201);
    }

    public function getAll() {
        $data = [];

        $sows = Sow::all();
        foreach ($sows as $sow) {
            $data[] = array_merge($sow->toArray(), [
                'viewActivity' => viewActivitiesBtn('sow', $sow),
                'actions' => editDeleteBtn('sow', $sow)
            ]);
        }

        return response(['data' => $data], 201);
    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $sow = Sow::find($request->id);
        $sow->delete();

        return response(['message' => 'Sow deleted successfully!']);
    }
}
