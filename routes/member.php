<?php

use App\Http\Controllers\Member\AnnouncementController as MemberAnnouncementController;
use App\Http\Controllers\Member\ChangePasswordController as MemberChangePasswordController;
use App\Http\Controllers\Member\EditProfileController as MemberEditProfileController;
use App\Http\Controllers\Member\GuideController as MemberGuideController;
use App\Http\Controllers\Member\HomeController as MemberHomeController;
use App\Http\Controllers\Member\ScriptController as MemberScriptController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:member', 'active', 'image-sanitize'])->prefix('member')->name('member.')->group(function () {
    Route::get('/', [MemberHomeController::class, 'index'])->name('dashboard');

    Route::get('edit-profile', [MemberEditProfileController::class, 'index'])->name('edit-profile');
    Route::put('edit-profile', [MemberEditProfileController::class, 'update'])->name('update-profile');

    Route::get('change-password', [MemberChangePasswordController::class, 'index'])->name('change-password');
    Route::put('change-password', [MemberChangePasswordController::class, 'update'])->name('update-password');

    Route::resource('scripts', MemberScriptController::class);
    Route::get('processed-scripts', [MemberScriptController::class, 'showProcessedScripts'])->name('processed-scripts');
    Route::get('done-scripts', [MemberScriptController::class, 'showDoneProcessedScripts'])->name('done-scripts');

    Route::resource('announcements', MemberAnnouncementController::class);
    Route::resource('guides', MemberGuideController::class);
});
