<?php

use App\Http\Controllers\Admin\AdminController as AdminAdminController;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\GuideController as AdminGuideController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\ScriptController as AdminScriptController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:admin', 'active', 'image-sanitize'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('dashboard');

    Route::resource('scripts', AdminScriptController::class);
    Route::get('processed-scripts', [AdminScriptController::class, 'showProcessedScripts'])->name('processed-scripts');
    Route::get('done-scripts', [AdminScriptController::class, 'showDoneProcessedScripts'])->name('done-scripts');

    Route::resource('admins', AdminAdminController::class);
    Route::prefix('admins')->name('admins.')->group(function () {
        Route::get('{admin}/edit-password', [AdminAdminController::class, 'editPassword'])->name('edit-password');
        Route::put('{admin}/edit-password', [AdminAdminController::class, 'updatePassword'])->name('update-password');
    });

    Route::resource('members', AdminMemberController::class);
    Route::prefix('members')->name('members.')->group(function () {
        Route::get('{member}/edit-password', [AdminMemberController::class, 'editPassword'])->name('edit-password');
        Route::put('{member}/edit-password', [AdminMemberController::class, 'updatePassword'])->name('update-password');
    });

    Route::resource('announcements', AdminAnnouncementController::class);
    Route::resource('guides', AdminGuideController::class);
});
