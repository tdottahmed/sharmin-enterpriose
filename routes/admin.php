<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserRoleController;

Route::group(['middleware' => ['role:super-admin|admin|staff|user']], function () {
    Route::resource('permissions', PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);

    Route::resource('roles', UserRoleController::class);
    Route::get('roles/{roleId}/delete', [UserRoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [UserRoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [UserRoleController::class, 'givePermissionToRole']);

    Route::resource('users', UserController::class);
    Route::get('users/{userId}/delete', [UserController::class, 'destroy']);
});
