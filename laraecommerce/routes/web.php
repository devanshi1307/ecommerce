<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class,'index']);
Route::get('/collections',[App\Http\Controllers\Frontend\FrontendController::class,'categories']);
Route::get('/collections/{category_slug}',[App\Http\Controllers\Frontend\FrontendController::class,'products']);
Route::get('/collections/{category_slug}/{product_slug}',[App\Http\Controllers\Frontend\FrontendController::class,'productView']);
Route::get('/new-arrivals',[App\Http\Controllers\Frontend\FrontendController::class,'newArrivals']);
Route::get('/search', [App\Http\Controllers\Frontend\FrontendController::class,'searchProducts']);
Route::get('/electronics',[App\Http\Controllers\Frontend\FrontendController::class,'electronics']);
Route::get('/stationary',[App\Http\Controllers\Frontend\FrontendController::class,'stationaryProducts']);
Route::get('/accessories',[App\Http\Controllers\Frontend\FrontendController::class,'accessories']);
Route::get('/homedecoration',[App\Http\Controllers\Frontend\FrontendController::class,'homeDecoration']);







Route::middleware(['auth'])->group(function() {

    Route::get('wishlist',[App\Http\Controllers\Frontend\WishlistController::class,'index']);
    Route::get('cart',[App\Http\Controllers\Frontend\CartController::class,'index']);
    Route::get('checkout',[App\Http\Controllers\Frontend\CheckOutController::class,'index']);
    Route::get('orders',[App\Http\Controllers\Frontend\OrderController::class,'index']);
    Route::get('orders/{orderId}',[App\Http\Controllers\Frontend\OrderController::class,'show']);

    Route::get('/profile',[App\Http\Controllers\Frontend\userProfile::class,'index']);
    Route::post('/profile',[App\Http\Controllers\Frontend\userProfile::class,'updateUserdetails']);
    
    

});

Route::get('thank-you', [App\Http\Controllers\Frontend\FrontendController::class,'thankyou']);




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function(){

    Route::controller(App\Http\Controllers\Admin\SliderController::class)->group(function(){
        Route::get('/sliders','index');
        Route::get('/sliders/create','create');
        Route::post('/sliders/create','store');
        Route::get('/sliders/{slider}/edit', 'edit');
        Route::put('sliders/{slider}', 'update');
        Route::get('sliders/{slider}/delete', 'destroy');
    });







    Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class, 'index']);


    //Category Routes
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function(){
    Route::get('/category','index');
    Route::get('/category/create','create');
    Route::post('/category','store');
    Route::get('/category/{category}/edit','edit');
    Route::put('/category/{category}','update');
    
});

 Route::get('/brands',App\Http\Livewire\Admin\Brand\Index::class);
 
});
Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function(){
    Route::get('admin/products','index');
    Route::get('admin/products/create','create');
    Route::post('/admin/products','store');
    Route::get('/admin/products/{product}/edit', 'edit');
    Route::put('/admin/products/{product}','update');
    Route::get('/admin/product-image/{product_image_id}/delete','destroyImage');
    Route::get('admin/products/{product_id}/delete', 'destroy');
    
    Route::post('admin/product-color/{prod_color_id}','updateProductColorQty');
    Route::get('/admin/product-color/{prod_color_id}/delete', 'deleteProdColor');



});
 
Route::controller(App\Http\Controllers\Admin\ColorController::class)->group(function(){
    Route::get('admin/colors','index');
    Route::get('admin/colors/create','create');
    Route::post('admin/colors/create','store');
    Route::get('admin/colors/{color}/edit','edit');
    Route::put('admin/colors/{colors_id}/','update');
    Route::get('admin/colors/{colors_id}/delete', 'destroy');

});

Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function(){
Route::get('admin/orders','index');
Route::get('admin/orders/{orderId}','show');
Route::put('admin/orders/{orderId}','updateOrderStatus');
Route::get('admin/invoice/{orderId}','viewInvoice');
Route::get('admin/invoice/{orderId}/generate','generateInvoice');
Route::get('admin/invoice/{orderId}/mail','mailInvoice');

});