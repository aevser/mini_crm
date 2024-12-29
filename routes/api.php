<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1;

Route::prefix('v1')->group(function () {

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('logout', [V1\Auth\AuthController::class, 'logout'])->name('user.logout');
    });

    Route::post('login', [V1\Auth\AuthController::class, 'login'])->name('user.login');

});



