<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1;

Route::prefix('v1')->group(function () {

    Route::middleware(['auth:sanctum'])->group(function () {

        Route::apiResource('project', V1\Project\ProjectController::class);

        Route::post('{project}/toggle', [V1\Project\ProjectController::class, 'toggle'])->name('project.toggle');

        Route::get('{project}/token', [V1\Project\TokenController::class, 'token'])->name('project.token');

        Route::post('{project}/refresh', [V1\Project\TokenController::class, 'refresh'])->name('project.token.refresh');

        Route::apiResource('{project}/host', V1\Project\HostController::class)->only(['store', 'destroy']);

        Route::delete('leads/{lead}', [V1\Lead\LeadController::class, 'destroy'])->name('lead.delete');

        Route::apiResource('{project}/classes', V1\Project\Classes\ClassController::class)->only(['store', 'update', 'destroy']);

        Route::post('{project}/{lead}/class/assign', [V1\Project\Classes\ClassController::class, 'assign'])->name('lead.assign');

        Route::post('logout', [V1\Auth\AuthController::class, 'logout'])->name('user.logout');
    });

    Route::post('lead.add', [V1\Lead\LeadController::class, 'store'])->name('lead.add');
    Route::post('login', [V1\Auth\AuthController::class, 'login'])->name('user.login');

});



