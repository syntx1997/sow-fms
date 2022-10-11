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
}
