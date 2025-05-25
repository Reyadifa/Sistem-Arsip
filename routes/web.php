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
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard - semua role bisa akses
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.dashboard');
    Route::get('/chart-data', [DashboardController::class, 'getChartData'])->name('dashboard.chart');
    
    // History - semua role bisa akses
    Route::get('/history', [PeminjamanController::class, 'history'])->name('history.index');
    
    // Peminjaman - semua role bisa akses
    Route::resource('peminjaman', PeminjamanController::class);
    
    // Arsip - semua role bisa akses  
    Route::resource('arsip', ArsipController::class);
    
    // Routes khusus untuk role Pendataan (role 1)
    Route::middleware([CheckRole::class . ':pendataan'])->group(function () {
        // Manajemen Kategori
        Route::resource('kategori', KategoriController::class);
        
        // Manajemen Users dengan parameter custom NIP
        Route::resource('users', UserController::class)->parameters([
            'users' => 'NIP',
        ]);
        
        // Route explicit untuk update dan delete dengan NIP
        Route::put('/users/{NIP}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{NIP}', [UserController::class, 'destroy'])->name('users.destroy');
    });
    
    // Routes khusus untuk role Pelayanan (role 2)
    Route::middleware([CheckRole::class . ':pelayanan'])->group(function () {
        // Tambahkan routes khusus pelayanan di sini
        // Contoh:
        // Route::get('/pelayanan-khusus', [SomeController::class, 'method']);
    });

    // Routes khusus untuk role Pengarsipan (role 3)
    Route::middleware([CheckRole::class . ':pengarsipan'])->group(function () {
        // Tambahkan routes khusus pengarsipan di sini
        // Contoh:
        // Route::get('/arsip-khusus', [SomeController::class, 'method']);
    });
    
    // Routes untuk multiple roles
    // Contoh: hanya pendataan dan pelayanan yang bisa akses
    Route::middleware([CheckRole::class . ':pendataan,pelayanan'])->group(function () {
        // Route::get('/laporan', [LaporanController::class, 'index']);
    });
});