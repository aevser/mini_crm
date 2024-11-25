<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1;

Route::apiResource('projects', V1\ProjectController::class);
