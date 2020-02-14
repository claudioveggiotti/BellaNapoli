<?php

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


Route::get('/', function () {
    return view('welcome');
});

Route::resource('product', 'ProductCtrl');

Route::get('login', 'MainController@showLogin');
Route::post('login', 'MainController@doLogin');
Route::get('logout', 'MainController@doLogout');
Route::get('checklogin', 'MainController@checkLogin');
Route::get('signup', 'MainController@showSignUp');
Route::post('signup', 'MainController@doSignUp');

Route::get('addtocart/{idProd}', 'CartCtrl@addToCart');
Route::get('checkout', 'CartCtrl@checkout');
Route::get('emptycart', 'CartCtrl@emptyCart');
Route::get('buy', 'CartCtrl@buy');
