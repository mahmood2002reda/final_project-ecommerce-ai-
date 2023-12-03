<?php

use App\Http\Controllers\Back\BackHomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// {{-- Auth::guard('admin')->user()->name --}}
//Route::prefix('front')->name('front.')->group(function () {
  
   // Route::get('/', FrontController::class)->middleware('auth')->name('index');
    // Route::view('/login','front.auth.login');
    //  Route::view('/register','front.auth.register');
    //   Route::view('/forget-password','front.auth.forget-password');
   

//});




// require __DIR__.'/auth.php';


Route::prefix('back')->name('back.')->group(function () {
  
    Route::get('/', BackHomeController::class)->middleware('admin')->name('index');
    Route::get('/category',[ App\Http\Controllers\Admin\CategoryController::class,'index'])->middleware('admin');
    Route::get('/category/create',[ App\Http\Controllers\Admin\CategoryController::class,'create'])->middleware('admin');
    Route::post('/category',[ App\Http\Controllers\Admin\CategoryController::class,'store'])->middleware('admin');
    Route::get('/category/{category}/edit',[ App\Http\Controllers\Admin\CategoryController::class,'edit'])->middleware('admin');
    Route::put('/category/{category}',[ App\Http\Controllers\Admin\CategoryController::class,'update'])->middleware('admin');
   
    require __DIR__.'/adminAuth.php';
 
});

 


Route::get('/', function () {
    return view('start');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
