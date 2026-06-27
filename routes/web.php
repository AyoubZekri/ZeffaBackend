<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('dashboard.index');
})->name('dashboard.index');

Route::get('/users', [DashboardController::class, 'index'])->name('dashboard.users');
Route::post('/users/{id}/status', [DashboardController::class, 'updateStatus'])->name('admin.users.updateStatus');
Route::post('/users/{id}/expiration', [DashboardController::class, 'updateExpiration'])->name('admin.users.updateExpiration');

