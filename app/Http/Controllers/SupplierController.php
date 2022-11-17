<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function add(Request $request) {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required',
            'contact' => 'required'
        ]);

        if ($validation->fails()) {
            return response(['errors' => $validation->errors()], 401);
        }

        Supplier::create($request->all());

        return response(['message' => 'New supplier added successfully!']);
    }

    public function edit() {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'id' => 'required'
        ]);

        if ($validation->fails()) {
            return response(['errors' => $validation->errors()], 401);
        }

        $supplier = Supplier::find($request->id);
        $supplier->update($request->all());

        return response(['message' => 'Supplier updated successfully!']);
    }

    public function delete() {
        $validation = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validation->fails()) {
            return response(['errors' => $validation->errors()], 401);
        }

        $supplier = Supplier::find($request->id);
        $supplier->delete();

        return response(['message' => 'Supplier deleted successfully!']);
    }
}
