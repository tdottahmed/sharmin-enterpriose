<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/update-image', [ProfileController::class, 'updateImage'])->name('profile.update-image');
});

Route::get('/optimize', function () {
    Artisan::call('migrate --force');
    Artisan::call('optimize:clear');
    return redirect()->back()->with('success', 'Optimized successfully');
})->middleware('auth')->name('optimize');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/frontend.php';
