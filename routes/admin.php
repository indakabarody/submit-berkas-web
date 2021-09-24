<?php

use App\Http\Controllers\Admin\AdminController as AdminAdminController;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\ChatController as AdminChatController;
use App\Http\Controllers\Admin\GuideController as AdminGuideController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\ScriptController as AdminScriptController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:admin', 'active', 'image-sanitize'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('dashboard');

    Route::resource('scripts', AdminScriptController::class);
    Route::get('all-scripts/export-excel', [AdminScriptController::class, 'exportExcelAllScripts'])->name('scripts.export-excel');

    Route::prefix('processed-scripts')->name('processed-scripts.')->group(function () {
        Route::get('/', [AdminScriptController::class, 'showProcessedScripts'])->name('index');
        Route::get('/export-excel', [AdminScriptController::class, 'exportExcelProcessedScripts'])->name('export-excel');
    });

    Route::prefix('done-processed-scripts')->name('done-processed-scripts.')->group(function () {
        Route::get('/', [AdminScriptController::class, 'showDoneProcessedScripts'])->name('index');
        Route::get('/export-excel', [AdminScriptController::class, 'exportExcelDoneProcessedScripts'])->name('export-excel');
    });

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

    Route::prefix('chats')->name('chats.')->group(function () {
        Route::get('/', [AdminChatController::class, 'showMembers'])->name('index');
        Route::get('/{member}', [AdminChatController::class, 'showInboxes'])->name('inbox');
        Route::get('/{member}/sent-messages', [AdminChatController::class, 'showSentMessages'])->name('sent-messages');
        Route::get('/{member}/create', [AdminChatController::class, 'create'])->name('create');
        Route::post('/{member}', [AdminChatController::class, 'store'])->name('store');
        Route::get('/{member}/{chat}', [AdminChatController::class, 'show'])->name('show');
        Route::get('/{member}/{chat}/reply', [AdminChatController::class, 'reply'])->name('reply');
    });
});
