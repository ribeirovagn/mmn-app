<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Route::group(['middleware' => ['admin', 'auth:api']], function() {

    Route::group([
        'prefix' => 'users'
            ], function () {
        Route::get('/', 'GenealogyController@index');
    });

    Route::group([
        'prefix' => 'bonus'
            ], function () {
        Route::get('/', 'BonusController@index');
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
    });
});
