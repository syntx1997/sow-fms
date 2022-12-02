<?php

namespace App\Helpers;
use App\Models\Farrowing;
use App\Models\Weaning;
use Carbon\Carbon;

class Breeding {

    public function farrowing($date, $litterNo) {
        $farrowing = Farrowing::where('litter_no', $litterNo)->first();
        if($farrowing) {
            $farrowingData = Farrowing::find($farrowing->id);
            return $farrowingData->update([
                'actual_date' => Carbon::parse($date)->addDay((21 + 114)),
                'status' => '',
                'weight' => 00.00,
                'dead' => 0,
                'alive' => 0,
                'sow' => ''
            ]);
        } else {
            return Farrowing::create([
                'litter_no' => $litterNo,
                'actual_date' => Carbon::parse($date)->addDay((21 + 114)),
                'status' => '',
                'weight' => 00.00,
                'dead' => 0,
                'alive' => 0,
                'sow' => ''
            ]);
        }
    }

    public function weaning($date, $litterNo) {
        $weaning = Weaning::where('litter_no', $litterNo)->first();
        if($weaning) {
            $weaningData = Weaning::find($weaning->id);
            return $weaningData->update([
                'date' => Carbon::parse($date)->addDay(28),
                'number' => 0,
                'weight' => 0
            ]);
        } else {
            return Weaning::create([
                'litter_no' => $litterNo,
                'date' => Carbon::parse($date)->addDay(28),
                'number' => 0,
                'weight' => 0
            ]);
        }
    }

}
