<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamController;

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

// Rute resource untuk kategori (CRUD)
Route::resource('kategori', KategoriController::class);

// Rute resource untuk peminjam (CRUD)
Route::resource('peminjam', PeminjamController::class);

// Rute untuk logout
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

// Rute untuk dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
