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

    
        // Rute untuk admin
        Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
            Route::resource('arsip', ArsipController::class);        
            Route::resource('kategori', KategoriController::class);
            Route::resource('users', UserController::class)->parameters([
                'users' => 'NIP',
            ]);
            Route::resource('peminjaman', PeminjamanController::class);
        });
        
        // Rute untuk user biasa
        Route::middleware(CheckRole::class . ':user')->group(function () {
            Route::resource('arsip', ArsipController::class);
            Route::resource('peminjaman', PeminjamanController::class);
        });
    });
    
    