<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\DeliveryCityController;
use App\Http\Controllers\ConfidentialityController;
use App\Http\Controllers\DeliveryCountryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function(){
    Route::post('register','register');
    Route::post('login','login');
    Route::get('get_auth_user_info','get_auth_user_info');
    Route::post('reset_password','reset_password');
    Route::post('forgot_password','forgot_password');
    Route::post('reset_info_admin','reset_info_admin');
});

Route::controller(ShopController::class)->group(function(){
    Route::post('edit_shop','edit_shop');
    Route::get('get_shop','get_shop');
});

Route::controller(ConfidentialityController::class)->group(function(){
    Route::post('edit_confidentiality','edit_confidentiality');
    Route::get('get_confidentiality','get_confidentiality');
});

Route::controller(ConditionController::class)->group(function(){
    Route::post('edit_condition','edit_condition');
    Route::get('get_condition','get_condition');
});

Route::controller(CategoryController::class)->group(function(){

    Route::post('save_category','save_category');
    Route::post('update_category/{id}','update_category');
    Route::get('get_categories','get_categories');
    Route::get('delete_category/{id}','delete_category');
    Route::get('get_category/{id}','get_category');
});


Route::controller(BannerController::class)->group(function(){

    Route::post('save_banner','save_banner');
    Route::post('update_banner/{id}','update_banner');
    Route::get('get_banners','get_banners');
    Route::get('delete_banner/{id}','delete_banner');
    Route::get('get_banner/{id}','get_banner');

});
Route::controller(ContactController::class)->group(function(){

    Route::post('send_mail','send_mail');
   
});
Route::controller(WishlistController::class)->group(function(){

    Route::post('add_wishlist','add_wishlist');
    Route::get('get_wishlists','get_wishlists');
   
});

Route::controller(CodeController::class)->group(function(){

    Route::post('save_code','save_code');
    Route::post('update_code/{id}','update_code');
    Route::get('get_codes','get_codes');
    Route::get('delete_code/{id}','delete_code');
    Route::get('get_code/{id}','get_code');

});
Route::controller(DeliveryCountryController::class)->group(function(){

    Route::post('save_country','save_country');
    Route::post('update_country/{id}','update_country');
    Route::get('get_countries','get_countries');
    Route::get('delete_country/{id}','delete_country');
    Route::get('get_country/{id}','get_country');

});

Route::controller(DeliveryCityController::class)->group(function(){

    Route::post('save_city','save_city');
    Route::post('update_city/{id}','update_city');
    Route::get('get_cities','get_cities');
    Route::get('delete_city/{id}','delete_city');
    Route::get('get_cities_by_country/{country_id}','get_cities_by_country');
    Route::get('get_city/{id}','get_city');

});

Route::controller(ProductController::class)->group(function(){

    Route::post('add_product','add_product');
    Route::post('update_product/{id}','update_product');
    Route::get('get_products','get_products');
    Route::get('get_product/{id}','get_product');
    Route::get('get_new_products','get_new_products');
    Route::get('get_all_products','get_all_products');
    Route::get('delete_product/{id}','delete_product');
   

});

Route::controller(OrderController::class)->group(function(){

    Route::post('store_order','store_order');
    Route::get('get_orders_auth_user','get_orders_auth_user');
    Route::get('get_orders','get_orders');
    Route::get('get_order/{id}','get_order');

});


Route::controller(ReviewController::class)->group(function(){

     Route::post('store_review','store_review');
   
    Route::get('get_reviews/{productId}','get_reviews');
    Route::get('get_all_reviews','get_all_reviews');

});
