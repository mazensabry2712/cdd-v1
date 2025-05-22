<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AamsController;
use App\Http\Controllers\BranchesController;
use App\Http\Controllers\PpmsController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\DevicebrandsController;
use App\Http\Controllers\HardDiskController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

Route::group(['middleware' => ['auth']], function() {
        Route::resource('/', DashboardController::class)
     ->names('dashboard');
    Route::resource('am', AamsController::class);
        Route::resource('pm', PpmsController::class);

    Route::resource( 'brands', BrandsController::class);

    Route::resource( 'devicebrands', DevicebrandsController::class);

    Route::resource( 'harddisks', HardDiskController::class);

    Route::get('/harddisks/{id}/download', [HarddiskController::class, 'download'])->name('harddisks.download');
Route::get('/harddisks/{id}/print', [HarddiskController::class, 'print'])->name('harddisks.print');

Route::resource('company', CompanyController::class);
Route::resource('branches', BranchesController::class);


    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);


       } );
require __DIR__ . '/auth.php';
