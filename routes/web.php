<?php

use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {

        Route::get('dashboard', [Admin\Users\AdminController::class, 'getIndexView'])->name('admin.dashboard');

        Route::get('create', [Admin\Users\AdminController::class, 'getCreateView'])->name('admin.admin.create');

        Route::post('store', [Admin\Users\AdminController::class, 'store'])->name('admin.admin.store');

        Route::get('edit/{id}', [Admin\Users\AdminController::class, 'getEditView'])->name('admin.admin.edit');

        Route::put('update/{id}', [Admin\Users\AdminController::class, 'update'])->name('admin.admin.update');

        Route::delete('destroy/{id}', [Admin\Users\AdminController::class, 'destroy'])->name('admin.admin.delete');

        Route::post('logout', [Admin\Auth\LoginController::class, 'logout'])->name('admin.logout');
    });

    Route::prefix('user')->group(function () {

        Route::get('create', [Admin\Users\UserController::class, 'getCreateView'])->name('admin.user.create');

        Route::post('store', [Admin\Users\UserController::class, 'store'])->name('admin.user.store');

        Route::get('edit/{id}', [Admin\Users\UserController::class, 'getEditView'])->name('admin.user.edit');

        Route::put('update/{id}', [Admin\Users\UserController::class, 'update'])->name('admin.user.update');

        Route::delete('destroy/{id}', [Admin\Users\UserController::class, 'destroy'])->name('admin.user.delete');

    });
});

Route::get('login', [Admin\Auth\LoginController::class, 'getLoginView'])->name('admin.auth.login');
Route::post('login', [Admin\Auth\LoginController::class, 'login'])->name('admin.login');
