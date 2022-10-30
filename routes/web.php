<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\StaffDashboardController;
use App\Http\Controllers\SowController;

Route::get('/', [UserController::class, 'checkRole'])
    ->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])
    ->name('login')
    ->middleware('guest');

/* -- ---------- Web APIs [Func/Functions] ----------- -- */
Route::prefix('/func')->group(function () {

    /* -- ---------- Authentication ----------- -- */
    Route::prefix('/auth')->group(function () {
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

    /* -- ---------- Sow ----------- -- */
    Route::prefix('/sow')->group(function () {
        Route::post('/add', [SowController::class, 'add']);
        Route::get('/get-all', [SowController::class, 'getAll']);
        Route::post('/delete', [SowController::class, 'delete']);
        Route::post('/edit', [SowController::class, 'edit']);
    });

});

/* -- ---------- Dashboards ----------- -- */
Route::middleware('auth')->prefix('/dashboard')->group(function () {

    /* -- ---------- Admin ----------- -- */
    Route::middleware('admin.only')->prefix('/admin')->group(function () {
        Route::get('/index', [AdminDashboardController::class, 'index']);
        Route::get('/user-management', [AdminDashboardController::class, 'userManagement']);
        Route::get('/sow-management', [AdminDashboardController::class, 'sowManagement']);
        Route::get('/view-activity/{sowId}', [AdminDashboardController::class, 'sowActivity']);
    });

    /* -- ---------- Staff ----------- -- */
    Route::middleware('staff.only')->prefix('/staff')->group(function () {
        Route::get('/index', [StaffDashboardController::class, 'index']);
    });

});


