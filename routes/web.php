<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelompokController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Kelompok Management
    Route::resource('kelompok', KelompokController::class);
    
    // Future routes for other resources will be added here
    // Route::resource('anggota', AnggotaController::class);
    // Route::resource('pinjaman', PinjamanController::class);
    // Route::resource('angsuran', AngsuranController::class);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';