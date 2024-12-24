<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ApplicationSetupController;

Route::group(['middleware' => ['role:super-admin|admin|staff|user']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class)->except('show');
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);

    Route::get('settings/organization', [ApplicationSetupController::class, 'organization'])->name('settings.organization');
});
