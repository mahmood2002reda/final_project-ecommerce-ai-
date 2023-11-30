<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;

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


Route::prefix('user')->group(function () {

Route::prefix('products')->controller(ProductController::class)->group(function(){

    Route::get('/categories/{product}','category');
    Route::get('/','index');
    Route::get('search','search');

});
Route::prefix('profile')->controller(ProfileController::class)->group(function(){

    Route::post('create','create')->middleware('auth:sanctum');
    Route::get('show','show')->middleware('auth:sanctum');
    Route::post('update','update')->middleware('auth:sanctum');
    Route::delete('delete','delete')->middleware('auth:sanctum');





});

});
