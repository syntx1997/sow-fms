<?php

namespace App\Http\Controllers;

use App\Models\Mating;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Breeding;

class MatingController extends Controller
{
    protected $breeding;
    function __construct() {
        $this->breeding = new Breeding();
    }

    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'litter_no' => 'required',
            'date' => 'required',
            'boar' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $this->updateFarrowingWeaningSched($request->date, $request->litter_no);

        Mating::create($request->all());



        return response(['message' => 'New mating schedule added successfully!'], 201);
    }

    public function edit(Request $request) {
        $validator = Validator::make($request->all(), [
           'id' => 'required',
           'date' => 'required',
           'boar' => 'required',
            'litter_no' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $mating = Mating::find($request->id);
        $mating->update([
            'date' => $request->date,
            'boar' => $request->boar
        ]);

        $farrowing = $this->updateFarrowingWeaningSched($request->date, $request->litter_no);

        return response(['message' => 'Mating schedule edited successfully!', 'farrowing' => $farrowing], 201);
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

    /** -- ----- For Auto Update Farrowing and Weaning Schedule ----- --  **/
    private function updateFarrowingWeaningSched($date, $litterNo) {
        // Add Farrowing Schedule
        $farrowing = $this->breeding->farrowing(Carbon::parse($date), $litterNo);

        // Add Weaning Schedule
        $this->breeding->weaning(Carbon::parse($farrowing->date), $litterNo);

        return $farrowing;
    }
}
