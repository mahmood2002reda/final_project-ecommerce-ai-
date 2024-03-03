<?php

use App\Http\Controllers\Api\AiModelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PayPalController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Auth\ForgetPasswordController;
use App\Http\Controllers\Api\Auth\EmailVerificationController;
use App\Http\Controllers\Api\cartController;
use App\Http\Controllers\Api\CheckoutController;

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
//4|fG59kC93zoOAVcGB9RY4Ap4kuu6Esh07pUSsvgAp82208fd9

Route::get('processHD', [AiModelController::class, 'processDc']);

Route::get('payment', [PayPalController::class, 'payment'])->middleware('auth:sanctum');
Route::get('cancel', [PayPalController::class, 'cancel']);
Route::get('payment/success', [PayPalController::class, 'success']);
;
Route::post('addToCart/{id}', [cartController::class, 'addToCart'])->middleware('auth:sanctum');
Route::post('cartUpdatequantity/{cartId}/{scope}', [cartController::class, 'cartItemDelet'])->middleware('auth:sanctum');

Route::post('cartItemDelet/{cartId}', [cartController::class, 'cartItemDelet'])->middleware('auth:sanctum');
Route::post('cart', [cartController::class, 'index'])->middleware('auth:sanctum');
Route::post('placeOrder', [CheckoutController::class, 'placeOrder'])->middleware('auth:sanctum');

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
    Route::get('bestSeller',[ProductController::class, 'bestSeller'])->middleware('auth:sanctum');
    Route::get('mostView',[ProductController::class, 'mostView'])->middleware('auth:sanctum');

    Route::get('search',[ProductController::class, 'search']);

    Route::get('{id}',[ProductController::class, 'show_details']);
    
    Route::get('viewer/{id}',[ProductController::class, 'show']);

    Route::get('/categories/{id}',[ProductController::class, 'category']);
   
    
    Route::prefix('Review')->middleware('auth:sanctum')->group(function(){
 Route::post('create/{prodctId}',[ReviewController::class, 'store']);
 Route::post('{ReviewId}/update/{prodctId}',[ReviewController::class, 'update']);
 Route::delete('{reviewId}/delete/{prodctId}', [ReviewController::class, 'destroy']);
});
Route::prefix('Wishlist')->middleware('auth:sanctum')->group(function(){
    Route::post('add/{prodctId}',[ProductController::class, 'addWishlist']);
    Route::post('mywishlist',[ProductController::class, 'myWishlist']);
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
