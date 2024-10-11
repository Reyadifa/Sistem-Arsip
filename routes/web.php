<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\KategoriController;

// Rute untuk tampilan login
Route::get('/', function () {
    return view('login');
});

// Rute untuk login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Rute resource untuk arsip (CRUD)
Route::resource('arsip', ArsipController::class);

// Rute resource untuk user (CRUD)
Route::resource('users', UserController::class);
Route::resource('user', UserController::class);

Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::resource('kategori', KategoriController::class);

Route::post('/logout', [AuthController::class, 'destroy'])
    ->name('logout');
