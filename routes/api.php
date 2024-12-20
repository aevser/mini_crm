<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1;

Route::prefix('v1')->group(function () {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::apiResource('project', V1\Project\ProjectController::class);

        Route::prefix('project')->group(function () {
            Route::apiResource('{project}/hosts', V1\Project\HostController::class)->only(['index', 'store', 'destroy']);

            Route::get('{project}/journal', [V1\Project\ProjectController::class, 'journal']);

            Route::post('{project}/toggle', [V1\Project\ProjectController::class, 'toggle']);

            Route::post('{project}/token', [V1\Project\ProjectTokenController::class, 'refreshToken'])->name('refresh.project.token');

        });

        Route::apiResource('lead', V1\Lead\LeadController::class)->only(['index', 'destroy']);

        Route::post('lead.add', [V1\Lead\LeadController::class, 'store']);


        Route::post('logout', [V1\AuthController::class, 'logout'])->name('user.logout');
    });

    Route::post('login', [V1\AuthController::class, 'login'])->name('user.login');
});


