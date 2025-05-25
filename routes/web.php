<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\KategoriController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;

// Routes untuk guest (tidak perlu login)
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Routes yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    
    // Logout - semua role bisa akses
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard - semua role bisa akses (pendataan, pelayanan, pengarsipan)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.dashboard');
    Route::get('/chart-data', [DashboardController::class, 'getChartData'])->name('dashboard.chart');
    
    // Peminjaman - Admin Pendataan dan User Pelayanan (menggunakan view yang sama)
    Route::middleware([CheckRole::class . ':pendataan,pelayanan'])->group(function () {
        Route::resource('peminjaman', PeminjamanController::class);
        Route::get('/history', [PeminjamanController::class, 'history'])->name('history.index');
    });
    
    // Arsip - Admin Pendataan dan User Pengarsipan (menggunakan view yang sama)
    Route::middleware([CheckRole::class . ':pendataan,pengarsipan'])->group(function () {
        Route::resource('arsip', ArsipController::class);
    });
    
    // Kategori - HANYA Admin Pendataan
    Route::middleware([CheckRole::class . ':pendataan'])->group(function () {
        Route::resource('kategori', KategoriController::class);
    });
    
    // Users - HANYA Admin Pendataan
    Route::middleware([CheckRole::class . ':pendataan'])->group(function () {
        Route::resource('users', UserController::class)->parameters(['users' => 'NIP']);
        Route::put('/users/{NIP}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{NIP}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});