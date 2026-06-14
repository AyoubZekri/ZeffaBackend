<?php

use App\Http\Controllers\SyncController;
use App\Http\Controllers\Auth\LogoutUserController;
use App\Http\Controllers\Auth\Password\NewPasswordController;
use App\Http\Controllers\Auth\Password\RessetpasswordController;
use App\Http\Controllers\Auth\Password\sendemaileController;
use App\Http\Controllers\Auth\Password\VerifyemailController;
use App\Http\Controllers\Auth\UpdateUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleAuth;


Route::post('/google-login', [GoogleAuth::class, 'GoogleLogin']);
Route::post('/user/login', [GoogleAuth::class, 'Login']);

Route::post('/User/sendCode', [sendemaileController::class, 'sendCode']);
Route::post('/User/verifyCode', [VerifyemailController::class, 'verifyCode']);
Route::post('/User/newpassword', [NewPasswordController::class, 'newpassword']);

Route::post('/User/create', [\App\Http\Controllers\Auth\RegisterController::class, "RegisterUser"]);
Route::post('/User/Login', [\App\Http\Controllers\Auth\LoginUserController::class, "login"]);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/User/logout', [LogoutUserController::class, 'logout']);
    Route::post('/User/update', [UpdateUserController::class, 'UpdateUser']);

    Route::post('/User/resetpassword', [RessetpasswordController::class, 'reset']);
    Route::get('/User/get', [\App\Http\Controllers\Auth\RegisterController::class, "getuser"]);

    Route::get('/logout', [GoogleAuth::class, 'logout']);
    Route::post('/user/update', [GoogleAuth::class, 'update']);
    Route::post('/user/delete', [GoogleAuth::class, 'destroy']);

    Route::get('/sync/{table}', [SyncController::class, 'getData']);
    Route::post('/sync/{table}', [SyncController::class, 'syncData']);
    Route::post('/sync/delete/{table}', [SyncController::class, 'syncDeleteData']);

});

