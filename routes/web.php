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
Route::get('/','App\Http\Controllers\Client\HomeController@index');

Route::get('/login',['as' => 'login','uses' =>'\App\Http\Controllers\Auth\LoginController@getLogin']);
Route::post('/login',['as' => 'login','uses' =>'\App\Http\Controllers\Auth\LoginController@postLogin']);

Route::middleware(['auth'])->group(function (){
    Route::controller(\App\Http\Controllers\CategoryController::class)->group(function () {
        Route::get('/categories','index');
        Route::get('/categories/create','create');
        Route::get('/categories/create','save_create');
    });
    Route::controller(\App\Http\Controllers\VoucherController::class)->group(function () {
        Route::get('/vouchers','index');
        Route::get('/vouchers/create','create');
    });
    Route::controller(\App\Http\Controllers\BannerController::class)->group(function () {
        Route::get('/banners','index');
        Route::get('/banners/create','create');
    });
    Route::controller(\App\Http\Controllers\UserController::class)->group(function () {
        Route::get('/users','index');
        Route::get('/users/create','create');
    });
    Route::controller(\App\Http\Controllers\ProductController::class)->group(function () {
        Route::get('/products','index');
        Route::get('/products/create','create');
    });
    Route::controller(\App\Http\Controllers\OrderController::class)->group(function () {
        Route::get('/orders','index');
    });
    Route::get('/admin/dashboard','App\Http\Controllers\DashboardController@index');




});
