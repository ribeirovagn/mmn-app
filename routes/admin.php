<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Route::post('/oauth', 'Auth\LoginController@oauth')->middleware('recaptcha');
Route::get('oauth/logout', 'UserController@logoutApi')->middleware('auth:api');
Route::group(['middleware' => ['admin', 'auth:api']], function() {
    Route::get('business/plan', 'BusinessPlan@index');

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
        Route::put('/{id}', 'BonusController@update');
    });

    Route::group([
        'prefix' => 'levels'
            ], function () {
        Route::post('/', 'LevelController@store');
        Route::delete('/{id}', 'LevelController@destroy');
        Route::put('/{id}', 'LevelController@update');
    });

    Route::group([
        'prefix' => 'financial'
            ], function () {
        Route::group(['prefix' => 'withdraw'], function () {
            Route::get('/', 'UserResumeController@withdrawByStatus');
            Route::get('/show/{id}', 'WithdrawController@show');
            Route::put('/update/{id}', 'WithdrawController@update');
        });
    });

    Route::group([
        'prefix' => 'products'
            ], function () {
        Route::get('/details/{id}', 'ProductController@show');
        Route::get('/type', 'ProductTypeController@index');
        Route::get('/', 'ProductController@index');
        Route::post('/', 'ProductController@store');
        Route::put('/{id}', 'ProductController@update');
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
            Route::post('/level', 'GraduationsLevelsController@store');
        });
    });


    Route::group([
        'prefix' => 'order'
            ], function () {
        Route::get('/', 'OrderController@index');
    });
});
