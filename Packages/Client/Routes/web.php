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

Route::prefix('customer')->group(function() {
    Route::get('/', 'Home\HomeController@getHome')->name('client.home.get');

    Route::post('/search', 'Search\SearchProductController@search')->name('client.search');
    Route::get('/productDetail', 'Search\SearchProductController@productDetail')->name('client.product.detail');
    Route::post('/productDetail', 'Search\SearchProductController@productDetail')->name('client.product.detail');

    Route::post('/login', 'Login\LoginController@login')->name('client.login');
    Route::post('/signup', 'Signup\SignupController@signup')->name('client.signup');
    Route::post('/logout', 'Login\LoginController@logout')->name('client.logout');

    Route::get('/cart', 'Cart\CartController@getCart')->name('client.cart');
    Route::post('/addCart', 'Cart\CartController@addCart')->name('client.cart.add');
    Route::post('/updateCart', 'Cart\CartController@updateCart')->name('client.cart.update');
    Route::post('/deleteCart', 'Cart\CartController@deleteCart')->name('client.cart.delete');

    Route::get('/checkout', 'Checkout\CheckoutController@checkout')->name('client.checkout');
    Route::post('/checkout', 'Checkout\CheckoutController@checkout')->name('client.checkout.post');

    Route::get('/profile', 'Profile\ProfileController@getProfile')->name('client.profile');
    Route::post('/updateProfile', 'Profile\ProfileController@updateProfile')->name('client.profile.update');
    Route::post('/sendMailUpdate', 'Profile\ProfileController@sendMailUpdate')->name('client.profile.update.mail');
    Route::post('/updatePassword', 'Profile\ProfileController@updatePassword')->name('client.profile.update.pass');
    Route::post('/profile', 'Profile\ProfileController@postProfile')->name('client.profile.post');
    Route::post('/updateAvatar', 'Profile\ProfileController@updateAvatar')->name('client.profile.update.avatar');
});
