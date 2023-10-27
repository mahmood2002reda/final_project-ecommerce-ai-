<?php

use App\Http\Controllers\VendorAuth\AuthenticatedSessionController;
use App\Http\Controllers\VendorAuth\ConfirmablePasswordController;
use App\Http\Controllers\VendorAuth\EmailVerificationNotificationController;
use App\Http\Controllers\VendorAuth\EmailVerificationPromptController;
use App\Http\Controllers\VendorAuth\NewPasswordController;
use App\Http\Controllers\VendorAuth\PasswordController;
use App\Http\Controllers\VendorAuth\PasswordResetLinkController;
use App\Http\Controllers\VendorAuth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorAuth\RegisteredVendorController;


Route::middleware('guest:vendor')->group(function () {

    Route::get('vendor/login', [AuthenticatedSessionController::class, 'create'])
                ->name('vendor.login');

    Route::post('vendor/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('vendor/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('vendor.password.request');

    Route::post('vendor/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('vendor.password.email');

    Route::get('vendor/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('vendor.password.reset');

    Route::post('vendor/reset-password', [NewPasswordController::class, 'store'])
                ->name('vendor.password.store');
    Route::get('vendor/register', [RegisteredVendorController::class, 'create'])->name('vendor.register'); 
    Route::post('vendor/register', [RegisteredVendorController::class, 'store']);          
});

Route::middleware('auth:vendor')->group(function () {
    Route::get('vendor/verify-email', EmailVerificationPromptController::class)
                ->name('vendor.verification.notice');

    Route::get('vendor/verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('vendor.verification.verify');

    Route::post('vendor/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('vendor.verification.send');

    Route::get('vendor/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('vendor.password.confirm');

    Route::post('vendor/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('vendor/password', [PasswordController::class, 'update'])->name('admin.password.update');

    Route::post('vendor/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('vendor.logout');
});
