<?php

use Illuminate\Http\Request;

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
Route::middleware('auth:admin_api')->get('/server', function (Request $request) {
    return $request->user('admin_api');
});

Route::group([], function() {
    Route::post('/brand/update_status', 'Brand\BrandController@updateStatus')->name('server.api.branch.update');
    Route::post('/brand/search', 'Brand\BrandController@searchBrand')->name('server.api.branch.search');

    Route::post('/category/update_status', 'Category\CategoryController@updateStatus')->name('server.api.category.update');
    Route::post('/category/search', 'Category\CategoryController@searchCategory')->name('server.api.category.search');

    Route::group(['prefix' => 'customer'], function () {
        Route::post('/update_status', 'Customer\CustomerController@updateStatus')->name('server.api.customer.update');
        Route::post('/search', 'Customer\CustomerController@searchCustomer')->name('server.api.customer.search');
        Route::post('/detail', 'Customer\CustomerController@getDetail')->name('server.api.customer.detail');
        Route::post('/resetPass', 'Customer\CustomerController@resetPass')->name('server.customer.edit.reset_pass');
        Route::post('/forceLogin', 'Customer\CustomerController@forceLogin')->name('server.customer.edit.logout');
    });

    Route::group(['prefix' => 'account'], function () {
        Route::post('/update_status', 'User\UserController@updateStatus')->name('server.api.user.update');
        Route::post('/search', 'User\UserController@searchAccount')->name('server.api.user.search');
        Route::post('/upgrade', 'User\UserController@updateRole')->name('server.api.user.upgrade');
    });

    Route::group(['prefix' => 'product'], (function() {
        Route::prefix('/option')->group(function() {
            Route::post('/create', 'Option\OptionController@createOption')->name('server.api.option.create');
            Route::post('/createOptionGroup', 'Option\OptionController@createOptionGroup')->name('server.api.option.group.create');
            Route::post('/search', 'Option\OptionController@searchOption')->name('server.api.option.search');
            Route::post('/updateStatus', 'Option\OptionController@updateOptionGroupStatus')->name('server.api.option.group.status');
            Route::post('/updateOptionGroup', 'Option\OptionController@updateOptionGroup')->name('server.api.option.group.update');
            Route::post('/updateOption', 'Option\OptionController@updateOptionGroup')->name('server.api.option.update');
        });
        Route::prefix('/property')->group(function() {
            Route::post('/create', 'Property\PropertyController@createProperty')->name('server.api.property.create');
            Route::post('/createPropertyGroup', 'Property\PropertyController@createPropertyGroup')->name('server.api.property.group.create');
            Route::post('/searchPropertyGroup', 'Property\PropertyController@searchPropertyGroup')->name('server.api.property.group.search');
            Route::post('/searchProperty', 'Property\PropertyController@searchProperty')->name('server.api.property.search');
        });
        Route::prefix('/')->group(function() {
            Route::post('/search', 'Product\ProductController@searchProduct')->name('server.api.product.search');
            Route::post('/createProduct', 'Product\ProductController@createProduct')->name('server.api.product.create');
            Route::post('/editProduct', 'Product\ProductController@editProduct')->name('server.api.product.edit');
            Route::post('/getProductVariant', 'Product\ProductController@getProductVariantList')->name('server.api.product.variant');
            Route::post('/editProductVariant', 'Product\ProductController@editProductVariant')->name('server.api.product.variant.edit');
        });
    }));
});
