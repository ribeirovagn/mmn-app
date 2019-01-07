<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Route::group(['middleware' => ['admin', 'auth:api']], function() {
    Route::get('oauth/logout', 'UserController@logoutApi')->middleware('auth:api');
    
    
    Route::group([
        'prefix' => 'users'
            ], function () {
        Route::get('/', 'GenealogyController@index');
    });

    Route::group([
        'prefix' => 'bonus'
            ], function () {
        Route::get('/', 'BonusController@index');
        Route::post('/', 'BonusController@store');
        Route::put('/is_active/{id}', 'BonusController@changeActive');
    });

    Route::group([
        'prefix' => 'levels'
            ], function () {
        Route::post('/', 'LevelController@store');
        Route::delete('/{id}', 'LevelController@destroy');
    });

    Route::group([
        'prefix' => 'products'
            ], function () {
        Route::get('/details/{id}', 'ProductController@show');
        Route::get('/', 'ProductController@index');
    });

    Route::group([
        'prefix' => 'sys'
            ], function () {
        Route::group([
            'prefix' => 'business'
                ], function () {
            Route::get('/schedule', 'ConfigBinaryController@schedule');
            Route::get('/', 'SysBusinessController@index');
            Route::put('/', 'SysBusinessController@update');
        });
        Route::group([
            'prefix' => 'graduations'
                ], function () {
            Route::get('/', 'GraduationController@index');
            Route::post('/', 'GraduationController@store');
            Route::put('/{id}', 'GraduationController@update');
        });
    });
    
    
    Route::group([
        'prefix' => 'order'
    ], function () {
        Route::get('/', 'OrderController@index');
    });
});
