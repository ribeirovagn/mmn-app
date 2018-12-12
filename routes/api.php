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

Route::resource('user', 'UserController')->except([
    'create', 'destroy'
]);

Route::group([
    'prefix' => 'genealogy',
    'middleware' => 'auth:api'
        ], function() {
    Route::get('/show/{id}', 'GenealogyController@show')->name('genealogy.show');
    Route::get('/indicator/{id}', 'GenealogyController@indicator')->name('genealogy.indicator');
    Route::get('/change-side/{id}', 'GenealogyController@changeSide')->name('genealogy.change-side');
    Route::get('/', 'GenealogyController@index')->name('genealogies');
   
    Route::group([
        'prefix' => 'resume'
            ], function() {
        Route::get('/{id}', 'GenealogyResumeController@show')->name('genealogies.resume.show');
        Route::get('/', 'GenealogyResumeController@index')->name('genealogies.resume');
    });
});

Route::group([
    'prefix' => 'product',
    'middleware' => 'auth:api'
        ], function() {
    Route::get('/type/{id}', 'ProductTypeController@show')->name('product.type.id');
    Route::get('/type', 'ProductTypeController@index')->name('product.type');
    Route::get('/', 'ProductController@index')->name('products');
});

Route::group([
    'prefix' => 'order',
    'middleware' => 'auth:api'
        ], function() {
    Route::post('/', 'OrderController@store')->name('order.store');
    Route::get('/', 'OrderController@index')->name('orders');
    Route::get('/{id}', 'OrderController@show')->name('order.show');
    Route::put('pay/{id}', 'OrderController@pay')->name('order.show');
});

Route::group([
    'prefix' => 'level',
    'middleware' => 'auth:api'
], function(){
    Route::get('/', 'LevelController@index');
});

Route::group([
    'prefix' => 'bonus',
    'middleware' => 'auth:api'
        ], function() {
    Route::get('/', 'BonusController@index');
    Route::get('/{id}', 'BonusController@show');
});
