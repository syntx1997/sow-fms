<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farrowing;
use Illuminate\Support\Facades\Validator;

class FarrowingController extends Controller
{
    public function edit(Request $request) {
        $validator = Validator::make($request->all(), [
            ''
        ]);
    }
}
