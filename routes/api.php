<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1;

Route::post('login', [V1\AuthController::class, 'login'])->name('user.login');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('project', V1\Project\ProjectController::class);

    Route::post('logout', [V1\AuthController::class, 'logout'])->name('user.logout');
});



