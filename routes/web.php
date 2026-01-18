<?php

use App\Http\Controllers\MemberController;
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

Route::get('/families/create', [FamilyController::class, 'create'])
    ->middleware(['auth'])
    ->name('families.create');

Route::get('/families/{family_id}/edit', [FamilyController::class, 'edit'])
    ->middleware(['auth']);


Route::get('/members', [MemberController::class, 'index'])
    ->middleware(['auth'])
    ->name('members');

Route::get('/members/create', [MemberController::class, 'create'])
    ->middleware(['auth'])
    ->name('members.create');

Route::post('/members', [MemberController::class, 'store'])
    ->middleware(['auth']);

Route::get('/members/{member_id}/edit', [MemberController::class, 'edit'])
    ->middleware(['auth']);

Route::put('/members/{member_id}', [MemberController::class, 'update'])
    ->middleware(['auth']);

Route::delete('/members/{member_id}', [MemberController::class, 'destroy'])
    ->middleware(['auth']);


Route::get('/profile', [ProfileController::class, 'index'])
    ->middleware(['auth'])
    ->name('profile');

Route::get('/logout', [LogoutController::class, 'destroy'])
    ->middleware(['auth'])
    ->name('logout');
