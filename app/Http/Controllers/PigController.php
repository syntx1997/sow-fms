<?php

namespace App\Http\Controllers;

use App\Models\Assign;
use Illuminate\Http\Request;
use App\Models\Pig;
use Illuminate\Support\Facades\Validator;

class PigController extends Controller
{
    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'breed' => 'required',
            'dateBorn' => 'required',
            'origin' => 'required',
            'dam' => 'required',
            'dateProcured' => 'required',
            'sire' => 'required',
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        if ($request->has('photo')) {
            $photo = $request->file('photo')->store('pigs-photo', 'public');
        } else {
            $photo = 'pigs-photo/no-img.png';
        }

        Pig::create([
            'pig_no' => $this->generatePigNo($request->type),
            'breed' => $request->breed,
            'date_born' => $request->dateBorn,
            'origin' => $request->origin,
            'dam' => $request->dam,
            'date_procured' => $request->dateProcured,
            'sire' => $request->sire,
            'type' => $request->type,
            'photo' => $photo
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

        $pig = Pig::find($request->id);

        if ($request->has('photo')) {
            $photo = $request->file('photo')->store('pigs-photo', 'public');
        } else {
            $photo = $pig->photo;
        }

        $pig->update([
            'breed' => $request->breed,
            'date_born' => $request->dateBorn,
            'origin' => $request->origin,
            'dam' => $request->dam,
            'date_procured' => $request->dateProcured,
            'sire' => $request->sire,
            'photo' => $photo
        ]);

        return response(['message' => 'Sow updated successfully'], 201);
    }

    public function getAll($type) {
        $data = [];

        $pigs = Pig::where('type', $type)->get();
        foreach ($pigs as $pig) {
            $data[] = array_merge($pig->toArray(), [
                'viewActivity' => viewActivitiesBtn('sow', $pig),
                'actions' => editDeleteBtn('pig', $pig)
            ]);
        }

        return response(['data' => $data], 201);
    }

    public function staffAssigned($staffId) {
        $data = [];

        $assigns = Assign::where('user_id', $staffId)->get();
        foreach ($assigns as $assign) {
            $pig = Pig::where('pig_id', $assign->pig_id)->first();
            $data = array_merge($pig->toArray());
        }

        return response(['data' => $data]);
    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $sow = Pig::find($request->id);
        $sow->delete();

        return response(['message' => 'Sow deleted successfully!']);
    }

    private function generatePigNo($type) {
        switch ($type) {
            case 'Sow':
                $prefix = 'SW';
                break;
            case 'Boar':
                $prefix = 'BR';
                break;
            case 'Piglet':
                $prefix = 'PL';
                break;
            case 'Gilt':
                $prefix = 'GL';
                break;
            default:
                $prefix = '';
                break;
        }

        return $prefix . str_pad((Pig::where('type', $type)->count() + 1), 3, '0', STR_PAD_LEFT);
    }
}
