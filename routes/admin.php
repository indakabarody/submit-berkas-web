<?php

use App\Http\Controllers\Admin\AdminController as AdminAdminController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:admin', 'active', 'image-sanitize'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('dashboard');

    Route::resource('admins', AdminAdminController::class);
    Route::prefix('admins')->name('admins.')->group(function () {
        Route::get('{admin}/edit-password', [AdminAdminController::class, 'editPassword'])->name('edit-password');
        Route::put('{admin}/edit-password', [AdminAdminController::class, 'updatePassword'])->name('update-password');
    });
});
