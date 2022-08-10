<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'App\Http\Controllers\ClientController@index');
Route::get('/shop', 'App\Http\Controllers\ClientController@shop');
Route::get('/product/{id}', 'App\Http\Controllers\ClientController@detail');
Route::get('/contact', 'App\Http\Controllers\ClientController@getContact');
Route::get('/blog', 'App\Http\Controllers\ClientController@getblog');
Route::get('/about', 'App\Http\Controllers\ClientController@getAbout');
Route::get('/cart', 'App\Http\Controllers\ClientController@getCart');
Route::post('/add-cart/{id}', 'App\Http\Controllers\ClientController@addCart');
Route::post('/cart/update-cart', 'App\Http\Controllers\ClientController@updateCart');
Route::get('/cart/delete-item/{id}', 'App\Http\Controllers\ClientController@deleteCart');
Route::get('/cart/delete-item-product/{id}/{color}/{size}', 'App\Http\Controllers\ClientController@deleteItem');
Route::get('/login', ['as' => 'login', 'uses' => '\App\Http\Controllers\Auth\LoginController@getLogin']);
Route::post('/login', ['as' => 'login', 'uses' => '\App\Http\Controllers\Auth\LoginController@postLogin']);
Route::get('/logout', ['as' => 'logout', 'uses' => '\App\Http\Controllers\Auth\LoginController@logout']);
Route::get('/check-out', 'App\Http\Controllers\ClientController@getCheckOut');
Route::post('/check-out', 'App\Http\Controllers\ClientController@postCheckOut');
Route::get('/thank-you', 'App\Http\Controllers\ClientController@thankYouPage');
Route::middleware(['auth'])->group(function () {
    Route::controller(\App\Http\Controllers\OrderController::class)->group(function () {
        Route::get('/orders', 'index');
        Route::get('/orders/{id}', 'getDetail');
        Route::get('/orders/printf-order/{order_id}', 'printfBill');
    });
    Route::get('/admin/dashboard', 'App\Http\Controllers\DashboardController@index');
});

Route::group(['middleware' => 'verfiy-role-account'], function () {
    Route::controller(\App\Http\Controllers\CategoryController::class)->group(function () {
        Route::get('/categories', 'index');
        Route::get('/categories/create', 'create');
        Route::post('/categories/create', 'save_create');
        Route::get('/categories/edit/{id}', 'update');
        Route::post('/categories/edit/{id}', 'save_update');
        Route::post('/categories/delete/{id}', 'delete');
    });
    Route::controller(\App\Http\Controllers\VoucherController::class)->group(function () {
        Route::get('/vouchers', 'index');
        Route::get('/vouchers/create', 'create');
        Route::post('/vouchers/create', 'save_create');
        Route::get('/vouchers/edit/{id}', 'update');
        Route::post('/vouchers/edit/{id}', 'save_update');
        Route::post('/vouchers/delete/{id}', 'delete');
    });
    Route::controller(\App\Http\Controllers\BannerController::class)->group(function () {
        Route::get('/banners', 'index');
        Route::get('/banners/create', 'create');
        Route::post('/banners/create', 'save_create');
        Route::get('/banners/edit/{id}', 'update');
        Route::post('/banners/edit/{id}', 'save_update');
        Route::post('/banners/delete/{id}', 'delete');
    });
    Route::controller(\App\Http\Controllers\UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/create', 'create');
        Route::post('/users/create', 'save_create');
        Route::get('/users/edit/{id}', 'update');
        Route::post('/users/edit/{id}', 'save_update');
        Route::post('/users/delete/{id}', 'delete');
    });
    Route::controller(\App\Http\Controllers\ProductController::class)->group(function () {
        Route::get('/products', 'index');
        Route::get('/products/create', 'create');
        Route::post('/products/create', 'save_create');
        Route::get('/products/edit/{id}', 'update');
        Route::post('/products/edit/{id}', 'save_update');
        Route::post('/products/delete/{id}', 'delete');
    });
});

