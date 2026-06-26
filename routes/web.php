<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin/dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/users/{id}/status', [DashboardController::class, 'updateStatus'])->name('admin.users.updateStatus');
    Route::post('/users/{id}/expiration', [DashboardController::class, 'updateExpiration'])->name('admin.users.updateExpiration');
});

