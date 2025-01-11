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
            Route::put('/users/{NIP}', [UserController::class, 'update'])->name('users.update');
            Route::resource('peminjaman', PeminjamanController::class);
            Route::get('/history', [PeminjamanController::class, 'history'])->name('history.index');
        });
        
        // Rute untuk user biasa
        Route::middleware(CheckRole::class . ':user')->group(function () {
            Route::resource('arsip', ArsipController::class)->only(['index', 'show']);
            Route::resource('peminjaman', PeminjamanController::class)->only(['index', 'show']);
            Route::get('/history', [PeminjamanController::class, 'history'])->name('history.index');
        });
    });
    
    