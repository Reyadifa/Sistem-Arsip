<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\KategoriController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;

// Route untuk dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.dashboard');
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/chart-data', [DashboardController::class, 'getChartData']);


Route::middleware(['auth'])->group(function () {

    // Pendataan (role 1)
    Route::middleware(CheckRole::class . ':pendataan')->group(function () {
        Route::resource('arsip', ArsipController::class);        
        Route::resource('kategori', KategoriController::class);
        Route::resource('users', UserController::class)->parameters([
            'users' => 'NIP',
        ]);
        Route::put('/users/{NIP}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{NIP}', [UserController::class, 'destroy'])->name('users.destroy');

        Route::resource('peminjaman', PeminjamanController::class);
        Route::get('/history', [PeminjamanController::class, 'history'])->name('history.index');
    });
    
    // Pelayanan (role 2)
    Route::middleware(CheckRole::class . ':pelayanan')->group(function () {
        Route::resource('arsip', ArsipController::class)->only(['index', 'show']);
        Route::resource('peminjaman', PeminjamanController::class)->only(['index', 'show']);
        Route::get('/history', [PeminjamanController::class, 'history'])->name('history.index');
    });

    // Pengarsipan (role 3)
    Route::middleware(CheckRole::class . ':pengarsipan')->group(function () {
        Route::resource('arsip', ArsipController::class)->only(['index', 'show']);
        Route::get('/history', [PeminjamanController::class, 'history'])->name('history.index');
    });
});

    
    