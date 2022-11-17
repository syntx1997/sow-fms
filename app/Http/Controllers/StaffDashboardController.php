<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffDashboardController extends Controller
{
    public function index() {
        return view('pages.staff.index', [
            'title' => 'Staff Dashboard',
            'js' => asset('js/pages/staff/index.js')
        ]);
    }

    public function guide() {
        return view('pages.staff.guide', [
            'title' => 'Feeding/Medication Guide'
        ]);
    }

    public function pigsAssigned() {
        return view('pages.staff.pigs-assigned', [
            'title' => 'Pig(s) Assigned'
        ]);
    }
}
