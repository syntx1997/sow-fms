<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\StaffDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UserController::class, 'checkRole'])
    ->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])
    ->name('login')
    ->middleware('guest');

/* -- ---------- Web APIs [Func/Functions] ----------- -- */
Route::prefix('/func')->group(function () {

    /* -- ---------- Authentication ----------- -- */
    Route::prefix('/auth')->group(function (){
        Route::post('/login', [UserController::class, 'login']);
        Route::get('/logout', [UserController::class, 'logout']);
    });

    /* -- ---------- Users ----------- -- */
    Route::prefix('/user')->group(function () {
        Route::get('/get/staff/all', [UserController::class, 'getAllStaff']);
        Route::post('add/staff', [UserController::class, 'addStaff']);
        Route::post('delete/staff', [UserController::class, 'deleteStaff']);
        Route::post('update/staff', [UserController::class, 'updateStaff']);
    });

});

/* -- ---------- Dashboards ----------- -- */
Route::middleware('auth')->prefix('/dashboard')->group(function () {

    /* -- ---------- Admin ----------- -- */
    Route::middleware('admin.only')->prefix('/admin')->group(function () {
        Route::get('/index', [AdminDashboardController::class, 'index']);
        Route::get('/user-management', [AdminDashboardController::class, 'userManagement']);
    });

    /* -- ---------- Staff ----------- -- */
    Route::middleware('staff.only')->prefix('/staff')->group(function () {
        Route::get('/index', [StaffDashboardController::class, 'index']);
    });

});


