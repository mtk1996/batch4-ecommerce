<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'PageController@home');
Route::get('/products', 'PageController@allProduct');
Route::get('/product/{slug}', 'PageController@productDetail');
Route::get('/profile/', 'PageController@profile');

//for auth
Route::get('/register', 'AuthController@showRegister');
Route::post('/register', 'AuthController@register');
Route::get('/login', 'AuthController@showLogin');
Route::post('/login', 'AuthController@login');

Route::get('/logout', 'AuthController@logout');

// api route
Route::group(['prefix' => 'api', 'namespace' => 'Api'], function () {
    Route::get('/home', 'HomeApi@home');
    Route::get('/product-detail/{slug}', 'ProductApi@detail');
    Route::get('/add-to-cart', 'ProductApi@addToCart');
    Route::post('/make-review', 'ProductApi@makeReview');
    Route::get('cart', 'ProductApi@carts');
    Route::post('change-cart/{id}', 'ProductApi@changeCart');
    Route::post('make-order', 'ProductApi@makeOrder');
    Route::get('/order', 'OrderApi@all');
    Route::post('/change-password', 'AuthApi@changePassword');
});


Route::get('/admin/login', 'Admin\AuthController@showLogin');
Route::post('/admin/login', 'Admin\AuthController@login');
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'isAdmin'], function () {

    Route::get('/', 'AuthController@dashboard');
    Route::resource('supplier', 'SupplierController');

    Route::resource('product', 'ProductController');
    Route::get('set-feature/{id}', 'ProductController@setFeature');

    Route::resource('product-add', 'ProductAddController');
    Route::resource('income', 'IncomeController');
    Route::get('/order', 'OrderController@all');
    Route::get('/change-order-status/{status}', 'OrderController@changeStatus');
});

Route::get('/locale/{locale}', function ($locale) {
    session()->put('locale', $locale); //mm en
    return redirect()->back()->with('success', 'Language Switch To ' . $locale);
});

Route::view('/test', 'welcome');
