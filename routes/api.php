<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1;

Route::apiResource('projects', V1\ProjectController::class);
Route::apiResource('hosts', V1\HostController::class)
    ->except('show', 'update');
Route::apiResource('leads', V1\LeadController::class)
    ->except('show', 'update');
