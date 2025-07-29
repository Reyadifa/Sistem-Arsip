<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\KategoriController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UsahaController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::middleware(['auth'])->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.dashboard');
    Route::get('/chart-data', [DashboardController::class, 'getChartData'])->name('dashboard.chart');
    Route::get('/history/export-pdf', [PeminjamanController::class, 'exportPdf'])->name('history.exportPdf');
    Route::get('/arsip/trash', [ArsipController::class, 'trash'])->name('arsip.trash');
    Route::patch('/arsip/restore/{id}', [ArsipController::class, 'restore'])->name('arsip.restore');
    Route::delete('/arsip/{id}/force-delete', [ArsipController::class, 'forceDelete'])->name('arsip.forceDelete');
    Route::put('peminjaman/{id}/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');
    Route::get('/search', [UsahaController::class, 'search'])->name('usaha.search');
    
    Route::middleware([CheckRole::class . ':pendataan,pelayanan'])->group(function () {
        Route::resource('peminjaman', PeminjamanController::class);
        Route::get('/history', [PeminjamanController::class, 'history'])->name('history.index');
    });
    
    Route::middleware([CheckRole::class . ':pendataan,pengarsipan'])->group(function () {
        Route::resource('arsip', ArsipController::class);
    });
    
    Route::middleware([CheckRole::class . ':pendataan'])->group(function () {
        Route::resource('kategori', KategoriController::class);
    });
    
    Route::middleware([CheckRole::class . ':pendataan'])->group(function () {
        Route::resource('users', UserController::class)->parameters(['users' => 'NIP']);
        Route::put('/users/{NIP}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{NIP}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::resource('usahas', UsahaController::class);
    });
});