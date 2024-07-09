<?php

use App\Http\Controllers\Back\BackHomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontController;
use App\Livewire\Admin\Brands\Index;
use App\Models\ProductDiscount;
use Carbon\Carbon;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AiModelController;

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
// {{-- Auth::guard('admin')->Admin()->name --}}
//Route::prefix('front')->name('front.')->group(function () {

   // Route::get('/', FrontController::class)->middleware('auth')->name('index');
    // Route::view('/login','front.auth.login');
    //  Route::view('/register','front.auth.register');
    //   Route::view('/forget-password','front.auth.forget-password');


//});




// require __DIR__.'/auth.php';.
// Route::group(['prefix' => 'api'], function () {
//     Route::get('/process_hd', [AiModelController::class, 'processHd']);
//     Route::post('/process_dc', [AiModelController::class, 'processDc']);
// });



Route::prefix('back')->name('back.')->group(function () {

    // Route::get('/', BackHomeController::class)->middleware('admin')->name('index');
    // Route::get('/category',[ App\Http\Controllers\Admin\CategoryController::class,'index'])->middleware('admin');
    // Route::get('/category/create',[ App\Http\Controllers\Admin\CategoryController::class,'create'])->middleware('admin');
    // Route::post('/category',[ App\Http\Controllers\Admin\CategoryController::class,'store'])->middleware('admin');
    // Route::get('/category/{category}/edit',[ App\Http\Controllers\Admin\CategoryController::class,'edit'])->middleware('admin');
    // Route::put('/category/{category}',[ App\Http\Controllers\Admin\CategoryController::class,'update'])->middleware('admin');
    // Route::get('/brands',App\Livewire\Admin\Brands\Index::class)->middleware('admin');
    // Route::get('/brands/{brand}/edit',[ App\Http\Controllers\Admin\BrandController::class,'edit'])->middleware('admin');
    // Route::put('/brands/{brand}',[ App\Http\Controllers\Admin\BrandController::class,'update'])->middleware('admin');


    Route::get('/', BackHomeController::class)->middleware('admin')->name('index');

    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->middleware('admin')->group(function(){

        Route::get('/category','index');
        Route::get('/category/create','create');
        Route::post('/category','store');
        Route::get('/category/{category}/edit','edit');
        Route::put('/category/{category}','update');
        Route::get('/category/{category}/delete','destroyCategory');
        Route::get('/category/{category}/create-subcategory', 'createSubcategory')->name('subcategory.create');
        Route::post('/category/{category}/store-subcategory', 'storeSubcategory')->name('subcategory.store');
        Route::get('/category/{category}/show-subcategory', 'Showsubcategory')->name('subcategory.show');
        Route::get('/category/{category}/delete-subcategory', 'Deletesubcategory');
        Route::get('/category/search', 'search')->name('category.search');

    });

    Route::controller(App\Http\Controllers\Admin\ProductController::class)->middleware('admin')->group(function(){

        Route::get('/product','index');
        Route::get('/product/create','create');
        Route::post('/product','store');
        Route::get('/product/{product}/edit','edit');
        Route::put('/product/{product}','update');
        Route::get('/product/{product_id}/delete','destroy');
        Route::get('/product-image/{product_image_id}/delete','destroyImage');
        Route::get('/product/search', 'search')->name('product.search');
        Route::post('/product-color/{prod_color_id}','updateProdColorQty');
        Route::get('/product-color/{prod_color_id}/delete','deleteProdColor');
        Route::post('/product-size/{prod_size_id}','updateProdSizeQty');
        Route::post('/product-extra/{prod_size_id}','updateProdExtraPrice');
        Route::get('/product-size/{prod_size_id}/delete','deleteProdSize');


    });


    Route::get('/brands',App\Livewire\Admin\Brands\Index::class)->middleware('admin');
    Route::get('/brands/{brand}/edit',[ App\Http\Controllers\Admin\BrandController::class,'edit'])->middleware('admin');
    Route::get('/brands/{brand}/delete',[ App\Http\Controllers\Admin\BrandController::class,'destroy'])->middleware('admin');
    Route::put('/brands/{brand}',[ App\Http\Controllers\Admin\BrandController::class,'update'])->middleware('admin');
    Route::get('/brands/search',[ App\Http\Controllers\Admin\BrandController::class,'search'])->name('brands.search')->middleware('admin');

    Route::controller(App\Http\Controllers\Admin\ColorController::class)->middleware('admin')->group(function(){

        Route::get('/colors','index');
        Route::get('/colors/create','create');
        Route::post('/colors','store');
        Route::get('/colors/{color}/edit','edit');
        Route::put('/colors/{color}','update');
         Route::get('/colors/{color_id}/delete','destroy');
        // Route::get('/product-image/{product_image_id}/delete','destroyImage');
        Route::get('/colors/search', 'search')->name('color.search');



    });

    Route::controller(App\Http\Controllers\Admin\SizeController::class)->middleware('admin')->group(function(){

        Route::get('/sizes','index');
        Route::get('/sizes/create','create');
        Route::post('/sizes','store');
        Route::get('/sizes/{size}/edit','edit');
        Route::put('/sizes/{size}','update');
         Route::get('/sizes/{size_id}/delete','destroy');
        // Route::get('/product-image/{product_image_id}/delete','destroyImage');
        Route::get('/sizes/search', 'search')->name('size.search');



    });
    Route::controller(App\Http\Controllers\Admin\OrderController::class)->middleware('admin')->group(function(){

        Route::get('/orders','index');
        Route::get('/orders/today','todayOrders');
        Route::get('/orders/thismonth','thisMonthOrders');
        Route::get('/orders/thisyear','thisYearOrders');
        Route::get('/orders/{orderId}','show');
        Route::put('/orders/{orderId}','updateOrderStatus');
        Route::put('/orders/{orderId}','updateOrderStatus');
        Route::get('/invoice/{orderId}/generate','generateInvoice');
        Route::get('/invoice/{orderId}','viewInvoice');




        // Route::get('/product-image/{product_image_id}/delete','destroyImage');
        // Route::get('/product/search', 'search')->name('product.search');



    });
    Route::controller(App\Http\Controllers\Admin\VendorController::class)->middleware('admin')->group(function(){

        Route::get('/vendor','index');
        Route::get('/vendor/create','create');
        Route::post('/vendor','store');
        Route::get('/vendor/{id}/brands', 'showBrands')->name('back.vendor.brands');
        Route::get('/vendor/{id}/delete-brand', 'deleteBrand');
        Route::get('/vendor/{vendor}/edit','edit');
        Route::put('/vendor/{vendor}','update')->name('vendor.update');
        Route::get('/vendor/{vendor_id}/delete','destroy');
        Route::get('/vendor/{vendor}/change-password', 'changePassword')->name('vendor.change-password');
        Route::put('/vendor/{vendor}/change-password', 'updatePassword')->name('vendor.update-password');
        Route::get('/vendor/search', 'search')->name('vendors.search');


    });

    Route::controller(App\Http\Controllers\Admin\UserController::class)->middleware('admin')->group(function(){

        Route::get('/users','index');
        Route::get('/users/create','create');
        Route::post('/users','store');
        Route::get('/users/{user}/edit','edit');
        Route::put('/users/{user}','update')->name('user.update');
        Route::get('/users/{user_id}/delete','destroy');
        // Route::get('/vendor/{vendor}/change-password', 'changePassword')->name('vendor.change-password');
        // Route::put('/vendor/{vendor}/change-password', 'updatePassword')->name('vendor.update-password');
        Route::get('/users/search', 'search')->name('users.search');


    });
    Route::controller(App\Http\Controllers\Admin\AdminController::class)->middleware('admin')->group(function(){

        Route::get('/Admins','index');
        Route::get('/Admins/create','create');
        Route::post('/Admins','store');
        Route::get('/Admins/{Admin}/edit','edit');
        Route::put('/Admins/{Admin}','update')->name('Admin.update');
        Route::get('/Admins/{Admin_id}/delete','destroy');
        Route::get('/vendor/{vendor}/change-password', 'changePassword')->name('vendor.change-password');
        Route::put('/vendor/{vendor}/change-password', 'updatePassword')->name('vendor.update-password');


    });

    Route::controller(App\Http\Controllers\Admin\ProfileController::class)->middleware('admin')->group(function(){

        Route::get('/profile','profile')->name('admin.profile');
        Route::get('profile/password/reset','edit')->name('admin.password.reset');
        Route::put('profile/reset/update','update')->name('admin.password.update');
        Route::get('profile/info/reset','edit_info')->name('admin.info.reset');
        Route::put('profile/info/update','update_info')->name('admin.info.update');
        Route::delete('profile/info/delete','destroy')->name('admin.info.delete');


    });
    Route::controller(App\Http\Controllers\Admin\SliderController::class)->middleware('admin')->group(function(){

        Route::get('/sliders','index');
        Route::get('/sliders/create','create');
        Route::post('/sliders','store');
        Route::get('/sliders/{slider}/edit','edit');
        Route::put('/sliders/{slider}','update');
        Route::get('/sliders/{slider}/delete','destroy');


    });
    Route::controller(App\Http\Controllers\Admin\SettingController::class)->middleware('admin')->group(function(){

        Route::get('/settings','index');
        Route::post('/settings','store');
        Route::get('/settings/{slider}/edit','edit');
        Route::put('/settings/{slider}','update');
        Route::get('/settings/{slider}/delete','destroy');


    });


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
