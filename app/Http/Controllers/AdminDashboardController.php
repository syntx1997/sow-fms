<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function sowManagement() {
        return view('pages.admin.sow-management', [
            'title' => 'Sow Management',
            'js' => asset('js/pages/dashboard/admin/sow-management.js')
        ]);
    }
}
