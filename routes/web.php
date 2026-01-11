<?php

use App\Http\Controllers\CongregantController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::post('/login', [LoginController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/families', [FamilyController::class, 'index'])
    ->middleware(['auth'])
    ->name('families');

Route::get('/congregants', [CongregantController::class, 'index'])
    ->middleware(['auth'])
    ->name('congregants');

Route::get('/profile', [ProfileController::class, 'index'])
    ->middleware(['auth'])
    ->name('profile');

Route::get('/logout', [LogoutController::class, 'destroy'])
    ->middleware(['auth'])
    ->name('logout');
