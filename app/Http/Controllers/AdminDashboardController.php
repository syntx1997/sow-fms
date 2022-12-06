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

    public function suppliers() {
        return view('pages.admin.suppliers', [
            'title' => 'Suppliers'
        ]);
    }

    /** -- ----- Pig Management ----- -- **/
    public function PGSow() {
        return view('pages.admin.pig-management.sow', [
            'title' => 'Pig Management: Sow',
            'js' => asset('js/pages/dashboard/admin/pig-management.js')
        ]);
    }

    public function PGBoar() {
        return view('pages.admin.pig-management.boar', [
            'title' => 'Pig Management: Boar',
            'js' => asset('js/pages/dashboard/admin/pig-management.js')
        ]);
    }

    public function PGPiglet() {
        return view('pages.admin.pig-management.piglet', [
            'title' => 'Pig Management: Piglet',
            'js' => asset('js/pages/dashboard/admin/pig-management.js')
        ]);
    }

    public function PGGilt() {
        return view('pages.admin.pig-management.gilt', [
            'title' => 'Pig Management: Gilt',
            'js' => asset('js/pages/dashboard/admin/pig-management.js')
        ]);
    }

    public function underObservation() {
        return view('pages.admin.pig-management.under-observation', [
            'title' => 'Under Observation',
            'js' => asset('js/pages/dashboard/admin/under-observation.js')
        ]);
    }
}
