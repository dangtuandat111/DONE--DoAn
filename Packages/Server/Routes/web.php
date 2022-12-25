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

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\LoginController@getLogin')->name('server.login.get');
    Route::post('/login', 'Auth\LoginController@postLogin')->name('server.login.post');
    Route::get('/logout', 'Auth\LoginController@logout')->name('server.logout.get');

    Route::get('/signup', 'Auth\SignupController@getSignup')->name('server.signup.get');
    Route::post('/signup', 'Auth\SignupController@signup')->name('server.signup.post');

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::middleware('shareAuthData')->group(function() {
            Route::get('/', 'Home\HomeController@index')->name('server.home.get');

            Route::prefix('/brand')->group(function() {
                Route::get('', 'Brand\BrandController@getBrand')->name('server.brand.get');
                Route::get('/create', 'Brand\BrandController@createBrand')->name('server.brand.create.get');
                Route::post('/create', 'Brand\BrandController@createBrand')->name('server.brand.create.post');
                Route::get('/edit', 'Brand\BrandController@editBrand')->name('server.brand.edit.get');
                Route::post('/edit', 'Brand\BrandController@editBrand')->name('server.brand.edit.post');
            });

            Route::prefix('/category')->group(function() {
                Route::get('', 'Category\CategoryController@getCategory')->name('server.category.get');
                Route::get('/create', 'Category\CategoryController@createCategory')->name('server.category.create.get');
                Route::post('/create', 'Category\CategoryController@createCategory')->name('server.category.create.post');
                Route::get('/edit', 'Category\CategoryController@editCategory')->name('server.category.edit.get');
                Route::post('/edit', 'Category\CategoryController@editCategory')->name('server.category.edit.post');
            });

            Route::prefix('/customer')->group(function() {
                Route::get('', 'Customer\CustomerController@getCustomer')->name('server.customer.get');
                Route::get('/create', 'Category\CategoryController@createCategory')->name('server.customer.create.get');
                Route::post('/create', 'Category\CategoryController@createCategory')->name('server.customer.create.post');
                Route::get('/edit', 'Category\CategoryController@editCategory')->name('server.customer.edit.get');
                Route::post('/edit', 'Category\CategoryController@editCategory')->name('server.customer.edit.post');
            });

            Route::prefix('/profile')->group(function() {
                Route::get('', 'Profile\ProfileController@getProfile')->name('server.profile.get');
                Route::post('/updateInfo', 'Profile\ProfileController@updateInfo')->name('server.api.profile.update');
            });

            Route::prefix('/account')->group(function() {
                Route::get('', 'User\UserController@getAccount')->name('server.account.get');
                Route::get('/create', 'User\UserController@createAccount')->name('server.account.create.get');
                Route::post('/create', 'User\UserController@createAccount')->name('server.account.create.post');
            });

            Route::prefix('/product')->group(function() {
                Route::prefix('/option')->group(function() {
                    Route::get('', 'User\UserController@getAccount')->name('server.account.get');
                    Route::get('/create', 'User\UserController@createAccount')->name('server.account.create.get');
                    Route::post('/create', 'User\UserController@createAccount')->name('server.account.create.post');
                });
            });

            Route::group(['prefix' => 'product'], (function() {
                Route::prefix('/option')->group(function() {
                    Route::get('', 'Option\OptionController@getOption')->name('server.option.get');
                    Route::get('/create', 'Option\OptionController@createOption')->name('server.option.create.get');
                    Route::get('/createGroup', 'Option\OptionController@createOptionGroup')->name('server.option.group.create.get');
                });
                Route::prefix('/property')->group(function() {
                    Route::get('', 'Property\PropertyController@getProperty')->name('server.property.get');
                    Route::get('/create', 'Property\PropertyController@createProperty')->name('server.property.create.get');
                    Route::get('/createGroup', 'Property\PropertyController@createPropertyGroup')->name('server.property.group.create.get');
                });
                Route::prefix('/product')->group(function() {
                    Route::get('', 'Product\ProductController@getProduct')->name('server.product.get');
                    Route::get('/createProduct', 'Product\ProductController@createProduct')->name('server.product.create');
                    Route::get('/createProductVariant', 'Product\ProductController@createProductVariant')->name('server.product.variant.create');
                    Route::get('/editProduct', 'Product\ProductController@editProduct')->name('server.product.edit');
                    Route::get('/editProductVariant', 'Product\ProductController@editProductVariant')->name('server.product.variant.edit');
                });
            }));
        });
    });
});
