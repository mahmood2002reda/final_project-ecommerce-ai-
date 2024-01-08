<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Auth\ForgetPasswordController;
use App\Http\Controllers\Api\Auth\EmailVerificationController;
use App\Http\Controllers\Api\ReviewController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(AuthController::class)->group(function(){

    Route::post('register','register');
    Route::post('login','login');
    Route::post('logout','logout')->middleware('auth:sanctum');
    Route::get('{provider}/login','redirectToProvider')->name('login');
    Route::get('{provider}/redirect','handleProviderCallback')->name('redirect');

});

Route::post('email-verification', [EmailVerificationController::class, 'email_verification'])->middleware('auth:sanctum');
Route::post('email-send', [EmailVerificationController::class, 'sendEmailVerification'])->middleware('auth:sanctum');
Route::post('password/forgot-password', [ForgetPasswordController::class, 'forgotPassword']);
Route::post('password/reset', [ResetPasswordController::class, 'passwordReset']);

Route::prefix('user')->group(function () {

Route::prefix('products')->group(function(){
    Route::get('{id}',[ProductController::class, 'show_details']);
    Route::get('viewer/{id}',[ProductController::class, 'show']);

    Route::get('/categories/{id}',[ProductController::class, 'category']);
   
    Route::get('search',[ProductController::class, 'search']);
    Route::prefix('Review')->middleware('auth:sanctum')->group(function(){
 Route::post('create/{prodctId}',[ReviewController::class, 'store']);
 Route::post('{ReviewId}/update/{prodctId}',[ReviewController::class, 'update']);
 Route::delete('{reviewId}/delete/{prodctId}', [ReviewController::class, 'destroy']);
});
});


Route::prefix('profile')->controller(ProfileController::class)->group(function(){

    Route::post('create','create')->middleware('auth:sanctum');
    Route::get('show','show')->middleware('auth:sanctum');
    Route::post('update','update')->middleware('auth:sanctum');
    Route::delete('delete','delete')->middleware('auth:sanctum');





});

});
