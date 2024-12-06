<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('project', V1\Project\ProjectController::class);

    Route::apiResource('host', V1\Project\HostController::class);
    Route::post('host/{host}/refresh', [V1\Project\HostController::class, 'refreshHostToken']);

    Route::apiResource('lead', V1\Lead\LeadController::class);

    // Company
    Route::prefix('company')->group(function () {
        Route::post('{lead}/add', [V1\Lead\Custom\Company\CompanyController::class, 'update'])->name('company.update');
        Route::post('{lead}/clear', [V1\Lead\Custom\Company\CompanyController::class, 'destroy'])->name('company.destroy');
    });

    // Nextcall
    Route::prefix('nextcall')->group(function () {
        Route::post('{lead}/add', [V1\Lead\Custom\NextDateCall\NextDateCallController::class, 'update'])->name('nextcall.update');
        Route::post('{lead}/clear', [V1\Lead\Custom\NextDateCall\NextDateCallController::class, 'destroy'])->name('nextcall.destroy');
    });

    // Comment
    Route::prefix('comment')->group(function () {
        Route::post('{lead}/add', [V1\Lead\Custom\Comment\CommentController::class, 'update'])->name('comment.update');
        Route::post('{lead}/clear', [V1\Lead\Custom\Comment\CommentController::class, 'destroy'])->name('comment.destroy');
    });

    // Region
    Route::prefix('region')->group(function () {
        Route::post('{lead}/add', [V1\Lead\Custom\Region\RegionController::class, 'update'])->name('region.update');
        Route::post('{lead}/clear', [V1\Lead\Custom\Region\RegionController::class, 'destroy'])->name('region.destroy');
    });


    Route::post('logout', [V1\AuthController::class, 'logout'])->name('user.logout');
});

Route::post('lead.add', [V1\Lead\LeadController::class, 'store'])->name('lead.add');
Route::post('login', [V1\AuthController::class, 'login'])->name('user.login');




