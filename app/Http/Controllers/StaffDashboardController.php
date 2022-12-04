<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pig;
use App\Models\Assign;

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
            'title' => 'Pig(s) Assigned',
            'js' => asset('js/pages/dashboard/staff/pigs-assigned.js')
        ]);
    }

    public function pigActivity($pigId) {
        $pig = Pig::where('id', $pigId)->first();
        $assign = Assign::where('pig_id', $pigId)->first();

        return view('pages.admin.pig-activity', [
            'title' => $pig->pig_no . '\'s Activity/Schedule',
            'js' => asset('js/pages/dashboard/admin/pig-activity.js'),
            'pig' => $pig,
            'assign' => $assign
        ]);
    }
}
