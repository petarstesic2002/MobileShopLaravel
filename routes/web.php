<?php

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

//RUTE KOJIMA SVI KORISNICI MOGU DA PRISTUPE
Route::get('/', 'App\Http\Controllers\FrontController@index');

//ABOUT
Route::get('/about', 'App\Http\Controllers\FrontController@about');

//POJEDINACAN PROIZVOD
Route::get('/item/{id}','App\Http\Controllers\ProductsController@show');

//CART
Route::get('/cart','App\Http\Controllers\FrontController@showCart')->name('cart');
Route::post('/add-to-cart','App\Http\Controllers\FrontController@addToCart')->name('addToCart');
Route::post('/lower-cart-quantity','App\Http\Controllers\FrontController@lowerFromCart');
Route::get('/clear-cart','App\Http\Controllers\FrontController@clearCart');

//PROIZVODI
Route::get('/items','App\Http\Controllers\ProductsController@index');

//AJAX GET PROIZVODI
Route::get('/getItems','App\Http\Controllers\ProductsController@getProducts');

//OVA RUTA NIJE U MIDDLEWARE DA BI IZ FUNKCIJE REDIRECTOVALA NA LOGIN, A NE NA HOME PAGE
Route::get('/checkout','App\Http\Controllers\OrdersController@index');

//RUTE SAMO ZA NEULOGOVANE KORISNIKE
Route::group(['middleware' => 'guestM'], function(){

    Route::get('/login','App\Http\Controllers\FrontController@showLogin');
    Route::get('/register','App\Http\Controllers\FrontController@showRegister');
    Route::post('/try-login','App\Http\Controllers\LoginController@login')->name('login');
    Route::post('/try-register','App\Http\Controllers\LoginController@register')->name('register');

});

//ZA ULOGOVANE KORISNIKE
Route::group(['middleware' => 'user'], function(){

    //PROFILE
    Route::get('/profile', 'App\Http\Controllers\ProfileController@index');
    Route::get('/profile/orders', 'App\Http\Controllers\ProfileController@userOrders');
    Route::put('/profile/edit','App\Http\Controllers\ProfileController@editProfile');
    Route::put('/profile/card','App\Http\Controllers\ProfileController@editCard');

    //CONTACT
    Route::get('/contact', 'App\Http\Controllers\FrontController@showContact');
    Route::post('/mail','App\Http\Controllers\FrontController@contact')->name('contact');

    //CHECKOUT PURCHASE
    Route::get('/purchase', 'App\Http\Controllers\OrdersController@purchase');

    //LOGOUT
    Route::get('/logout','App\Http\Controllers\LoginController@logout')->name('logout');

});

//ADMIN
Route::group(['middleware'=>'admin'],function(){

    Route::get('/admin','App\Http\Controllers\AdminController@index');
    Route::get('/admin/logout','App\Http\Controllers\AdminController@logout');

    //USERS
    Route::get('/admin/users','App\Http\Controllers\AdminUsersController@showUsers');
    Route::get('/admin/users/get','App\Http\Controllers\AdminUsersController@getUsers');
    Route::get('/admin/user/{id}','App\Http\Controllers\AdminUsersController@showEditUser');
    Route::put('/admin/user/edit','App\Http\Controllers\AdminUsersController@editUser');
    Route::delete('/admin/user/delete','App\Http\Controllers\AdminUsersController@deleteUser');
    Route::get('/admin/users/add','App\Http\Controllers\AdminUsersController@showAddUser');
    Route::post('/admin/user/add','App\Http\Controllers\AdminUsersController@addUser');
    Route::get('/admin/orders/{id}','App\Http\Controllers\AdminUsersController@userOrders');

    //PRODUCTS
    Route::get('/admin/products','App\Http\Controllers\AdminProductsController@showProducts');
    Route::get('/admin/products/get','App\Http\Controllers\AdminProductsController@getProducts');
    Route::get('/admin/product/{id}','App\Http\Controllers\AdminProductsController@showEditProduct');
    Route::put('/admin/product/edit','App\Http\Controllers\AdminProductsController@editProduct');
    Route::delete('/admin/product/delete','App\Http\Controllers\AdminProductsController@deleteProduct');
    Route::get('/admin/products/add','App\Http\Controllers\AdminProductsController@showAdd');
    Route::post('/admin/product/add','App\Http\Controllers\AdminProductsController@addProduct');

});
