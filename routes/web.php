<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\StaffDashboardController;

use App\Http\Controllers\PigController;
use App\Http\Controllers\AssignController;

use App\Http\Controllers\LitterController;
use App\Http\Controllers\MatingController;
use App\Http\Controllers\FarrowingController;
use App\Http\Controllers\WeaningController;
use App\Http\Controllers\RemarkController;
use App\Http\Controllers\BreedingToGestationController;

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

    /* -- ---------- Pig ----------- -- */
    Route::prefix('/pig')->group(function () {
        Route::post('/add', [PigController::class, 'add']);
        Route::get('/get-all', [PigController::class, 'getAll']);
        Route::post('/delete', [PigController::class, 'delete']);
        Route::post('/edit', [PigController::class, 'edit']);
        Route::post('/assign-staff', [AssignController::class, 'add']);
    });

    /* -- ---------- Litter ----------- -- */
    Route::prefix('/litter')->group(function () {
        Route::post('/add', [LitterController::class, 'add']);
    });

    /* -- ---------- Mating ----------- -- */
    Route::prefix('/mating')->group(function () {
        Route::post('/add', [MatingController::class, 'add']);
        Route::post('/edit', [MatingController::class, 'edit']);
        Route::post('/delete', [MatingController::class, 'delete']);
    });

    /* -- ---------- Farrowing ----------- -- */
    Route::prefix('/farrowing')->group(function () {
        Route::post('/edit', [FarrowingController::class, 'edit']);
    });

    /* -- ---------- Weaning ----------- -- */
    Route::prefix('/weaning')->group(function () {
        Route::post('/edit', [WeaningController::class, 'edit']);
    });

    /* -- ---------- Remarks ----------- -- */
    Route::prefix('/remarks')->group(function () {
        Route::post('/edit', [RemarkController::class, 'edit']);
    });

    /* -- ---------- Breeding to Gestation ----------- -- */
    Route::prefix('/breeding-to-gestation')->group(function () {
        Route::post('/edit/d1-d30', [BreedingToGestationController::class, 'editBGD1D30']);
        Route::post('/edit/d31-d70', [BreedingToGestationController::class, 'editBGD31D70']);
        Route::post('/edit/d71-d100', [BreedingToGestationController::class, 'editBGD71D100']);
    });

});

/* -- ---------- Dashboards ----------- -- */
Route::middleware('auth')->prefix('/dashboard')->group(function () {

    /* -- ---------- Admin ----------- -- */
    Route::middleware('admin.only')->prefix('/admin')->group(function () {
        Route::get('/index', [AdminDashboardController::class, 'index']);
        Route::get('/user-management', [AdminDashboardController::class, 'userManagement']);
        Route::get('/pig-management', [AdminDashboardController::class, 'pigManagement']);
        Route::get('/view-activity/{sowId}', [AdminDashboardController::class, 'pigActivity']);
    });

    /* -- ---------- Staff ----------- -- */
    Route::middleware('staff.only')->prefix('/staff')->group(function () {
        Route::get('/index', [StaffDashboardController::class, 'index']);
    });

});


