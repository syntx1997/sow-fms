<?php

namespace App\Http\Controllers;

use App\Models\Assign;
use App\Models\Pig;

class AdminDashboardController extends Controller
{
    public function index() {
        return view('pages.admin.index', [
            'title' => 'Admin Dashboard',
            'js' => asset('js/pages/dashboard/admin/index.js')
        ]);
    }

    public function userManagement() {
        return view('pages.admin.user-management', [
            'title' => 'User Management',
            'js' => asset('js/pages/dashboard/admin/user-management.js')
        ]);
    }

    public function pigManagement() {
        return view('pages.admin.pig-management', [
            'title' => 'Pig Management',
            'js' => asset('js/pages/dashboard/admin/pig-management.js')
        ]);
    }

    public function sowActivity($sowId) {
        $sow = Pig::where('id', $sowId)->first();
        $assign = Assign::where('sow_id', $sowId)->first();

        return view('pages.admin.sow-activity', [
            'title' => $sow->sow_no . '\'s Activity/Schedule',
            'js' => asset('js/pages/dashboard/admin/sow-activity.js'),
            'sow' => $sow,
            'assign' => $assign
        ]);
    }
}
