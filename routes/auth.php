<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController as AdminAuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController as AdminEmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController as AdminEmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController as AdminNewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController as AdminPasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController as AdminVerifyEmailController;
use App\Http\Controllers\Member\Auth\AuthenticatedSessionController as MemberAuthenticatedSessionController;
use App\Http\Controllers\Member\Auth\EmailVerificationNotificationController as MemberEmailVerificationNotificationController;
use App\Http\Controllers\Member\Auth\EmailVerificationPromptController as MemberEmailVerificationPromptController;
use App\Http\Controllers\Member\Auth\NewPasswordController as MemberNewPasswordController;
use App\Http\Controllers\Member\Auth\PasswordResetLinkController as MemberPasswordResetLinkController;
use App\Http\Controllers\Member\Auth\RegisteredUserController as MemberRegisteredUserController;
use App\Http\Controllers\Member\Auth\SocialAuthController as MemberSocialAuthController;
use App\Http\Controllers\Member\Auth\VerifyEmailController as MemberVerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

    Route::post('/login', [AdminAuthenticatedSessionController::class, 'store'])
        ->middleware('guest');

    Route::get('/forgot-password', [AdminPasswordResetLinkController::class, 'create'])
        ->middleware('guest')
        ->name('password.request');

    Route::post('/forgot-password', [AdminPasswordResetLinkController::class, 'store'])
        ->middleware('guest')
        ->name('password.email');

    Route::get('/reset-password/{token}', [AdminNewPasswordController::class, 'create'])
        ->middleware('guest')
        ->name('password.reset');

    Route::post('/reset-password', [AdminNewPasswordController::class, 'store'])
        ->middleware('guest')
        ->name('password.update');

    Route::get('/verify-email', [AdminEmailVerificationPromptController::class, '__invoke'])
        ->middleware('auth:admin')
        ->name('verification.notice');

    Route::get('/verify-email/{id}/{hash}', [AdminVerifyEmailController::class, '__invoke'])
        ->middleware(['auth:admin', 'signed', 'throttle:6,1', 'active', 'image-sanitize'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [AdminEmailVerificationNotificationController::class, 'store'])
        ->middleware(['auth:admin', 'throttle:6,1', 'active', 'image-sanitize'])
        ->name('verification.send');

    Route::post('/logout', [AdminAuthenticatedSessionController::class, 'destroy'])
        ->middleware(['auth:admin', 'active'])
        ->name('logout');
});

Route::prefix('member')->name('member.')->group(function () {
    Route::get('/register', [MemberRegisteredUserController::class, 'create'])
        ->middleware('guest')
        ->name('register');

    Route::post('/register', [MemberRegisteredUserController::class, 'store'])
        ->middleware('guest');

    Route::get('/login', [MemberAuthenticatedSessionController::class, 'create'])
        ->middleware('guest')
        ->name('login');

    Route::get('/login/{driver}', [MemberSocialAuthController::class, 'redirectToProvider'])
        ->middleware('guest')
        ->name('social-auth');

    Route::get('/login/{driver}/callback', [MemberSocialAuthController::class, 'handleProviderCallback'])
        ->middleware('guest')
        ->name('social-auth-callback');

    Route::post('/login/{driver}/callback', [MemberSocialAuthController::class, 'store'])
        ->middleware('guest');

    Route::post('/login', [MemberAuthenticatedSessionController::class, 'store'])
        ->middleware('guest');

    Route::get('/forgot-password', [MemberPasswordResetLinkController::class, 'create'])
        ->middleware('guest')
        ->name('password.request');

    Route::post('/forgot-password', [MemberPasswordResetLinkController::class, 'store'])
        ->middleware('guest')
        ->name('password.email');

    Route::get('/reset-password/{token}', [MemberNewPasswordController::class, 'create'])
        ->middleware('guest')
        ->name('password.reset');

    Route::post('/reset-password', [MemberNewPasswordController::class, 'store'])
        ->middleware('guest')
        ->name('password.update');

    Route::get('/verify-email', [MemberEmailVerificationPromptController::class, '__invoke'])
        ->middleware('auth:member')
        ->name('verification.notice');

    Route::get('/verify-email/{id}/{hash}', [MemberVerifyEmailController::class, '__invoke'])
        ->middleware(['auth:member', 'signed', 'throttle:6,1', 'active', 'image-sanitize'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [MemberEmailVerificationNotificationController::class, 'store'])
        ->middleware(['auth:member', 'throttle:6,1', 'active', 'image-sanitize'])
        ->name('verification.send');

    Route::post('/logout', [MemberAuthenticatedSessionController::class, 'destroy'])
        ->middleware(['auth:member', 'active'])
        ->name('logout');
});

Route::prefix('account-error')->group(function () {
    Route::get('deactivated', function () {
        return view('login_fails.account-deactivated');
    })->name('account-deactivated');
});
