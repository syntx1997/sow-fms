<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{
    public function login() {
        return view('pages.auth.login', [
            'title' => 'Login',
            'js' => 'js/pages/login.js'
        ]);
    }
}
