<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ApplicationSetupController;
use App\Http\Controllers\Admin\NoteController;

Route::group(['middleware' => ['role:super-admin|admin|staff|user']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class)->except('show');
    Route::resource('users', UserController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('orders', OrderController::class);
    Route::get('orders/complete/{order}', [OrderController::class, 'complete'])->name('orders.complete');
    Route::get('orders/cancel/{order}', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::get('order/pdf/{order}', [OrderController::class, 'generatePdf'])->name('orders.pdf');
    Route::resource('notes', NoteController::class);
    Route::get('settings/organization', [ApplicationSetupController::class, 'index'])->name('applicationSetup.index');
    Route::post('settings/organization', [ApplicationSetupController::class, 'update'])->name('applicationSetup.update');
});
