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
    Route::get('/admin/dashboard','App\Http\Controllers\DashboardController@index');
    Route::get('/products/create','App\Http\Controllers\ProductController@create');
});
