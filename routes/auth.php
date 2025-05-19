<?php


use Illuminate\Support\Facades\Route;

// routes/web.php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;

// —————— تسجيل دخول / تسجيل خروج ——————
Route::get('login', [AuthController::class, 'showLogin'])->middleware('guest')->name('login');
Route::post('login', [AuthController::class, 'login'])->middleware('guest');
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// —————— تسجيل مستخدم جديد ——————
Route::get('register', [AuthController::class, 'showRegister'])->middleware('guest')->name('register');
Route::post('register', [AuthController::class, 'register'])->middleware('guest');

// —————— إعادة تعيين كلمة المرور ——————
Route::get('password/forgot', [PasswordResetController::class, 'showLinkRequestForm'])
     ->middleware('guest')->name('password.request');
Route::post('password/forgot', [PasswordResetController::class, 'sendResetLinkEmail'])
     ->middleware('guest')->name('password.email');
Route::get('password/reset/{token}', [PasswordResetController::class, 'showResetForm'])
     ->middleware('guest')->name('password.reset');
Route::post('password/reset', [PasswordResetController::class, 'reset'])
     ->middleware('guest')->name('password.update');
