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

Route::post('/oauth', 'Auth\LoginController@oauth')->middleware('recaptcha');


Route::get('/binarytype/{id}', 'ClosureController@store');
Route::get('/binary-children', 'GenealogyController@binaryChildren');

Route::resource('user', 'UserController')->except([
    'create', 'destroy'
]);


Route::get('oauth/logout', 'UserController@logoutApi')->middleware('auth:api');
Route::get('genealogy/verify/{indicator}', 'GenealogyController@verify');

Route::group([
    'prefix' => 'genealogy',
    'middleware' => 'auth:api'
        ], function() {
    Route::get('/show', 'GenealogyController@show')->name('genealogy.show');
    Route::get('/show/{id}', 'GenealogyController@show')->name('genealogy.show');
    Route::get('/indicator', 'GenealogyController@indicator')->name('genealogy.indicator');
    Route::get('/indicator/{id}', 'GenealogyController@indicator')->name('genealogy.indicator');
    Route::get('/family', 'GenealogyController@family')->name('genealogy.family');
    Route::get('/family/{id}', 'GenealogyController@family')->name('genealogy.family');
    Route::put('/change-side/{id}', 'GenealogyController@changeSide')->name('genealogy.change-side');
    Route::get('/', 'GenealogyController@index')->name('genealogies');
    Route::get('children/{leafs}', 'GenealogyController@leafs');
    Route::get('children', 'GenealogyController@leafs');


    Route::group([
        'prefix' => 'resume'
            ], function() {
        Route::get('/binary', 'GenealogyResumeController@show')->name('genealogies.resume.binary');
        Route::get('/{id}', 'GenealogyResumeController@show')->name('genealogies.resume.show');
        Route::get('/', 'GenealogyResumeController@index')->name('genealogies.resume');
    });
});

Route::group([
    'prefix' => 'users',
    'middleware' => 'auth:api'
        ], function() {
    Route::get('/resume', 'UserResumeController@show')->name('user.resume');
});

Route::group([
    'prefix' => 'financial',
    'middleware' => 'auth:api'
        ], function() {

    Route::group([
        'prefix' => 'withdraw'
            ], function () {
        Route::get('/', 'TransactionsController@listWithdraw')->name('financial.listWithdraw');
        Route::post('/', 'UserResumeController@withdraw')->name('financial.withdraw');
        Route::get('/show-by/{id}', 'WithdrawController@showSpecificByUser');
        Route::get('banks', 'BankController@index');
        Route::get('types', 'SysTypeAccountWithdrawController@index');
        Route::get('show/types', 'BankDraftController@typesShow');
        Route::group([
            'prefix' => 'accounts'
                ], function () {
            Route::post('banks', 'BankDraftController@store');
            Route::get('banks', 'BankDraftController@show');
            Route::post('plataform', 'AccountController@storePlataform');
            Route::get('plataform', 'AccountController@showPlataform');
            Route::post('crypto', 'AccountController@storeCrypto');
            Route::get('crypto', 'AccountController@showCrypto');
        });
    });

    Route::get('/transactions/{id}', 'TransactionsController@show')->name('financial.transactions.id');
    Route::get('/transactions', 'TransactionsController@show')->name('financial.transactions');
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
    'prefix' => 'dots',
    'middleware' => 'auth:api'
        ], function() {
    Route::get('binary/show', 'DotsBinaryController@show')->name('dots.binary');
    Route::get('binary/show/{id}', 'DotsBinaryController@show')->name('dots.binary');
    Route::get('unilevel/show', 'DotsUnilevelController@show')->name('dots.unilevel');
    Route::get('unilevel/show/{id}', 'DotsUnilevelController@show')->name('dots.unilevel');
});

Route::group([
    'prefix' => 'order',
    'middleware' => 'auth:api'
        ], function() {
    Route::post('/', 'OrderController@store')->name('order.store');
    Route::get('/show-by-user', 'OrderController@showByUser')->name('order.showByUser');
    Route::get('/{id}', 'OrderController@show')->name('order.show');
    Route::get('/', 'OrderController@index')->name('orders');
    Route::put('pay/{id}', 'OrderController@pay')->name('order.show');
});

Route::group([
    'prefix' => 'level',
    'middleware' => 'auth:api'
        ], function() {
    Route::get('/', 'LevelController@index');
});

Route::group([
    'prefix' => 'bonus',
    'middleware' => 'auth:api'
        ], function() {
    Route::get('/', 'BonusController@index');
    Route::get('/{id}', 'BonusController@show');
});


Route::group([
    'prefix', 'graduation',
    'middleware' => 'auth:api'
        ], function() {
    Route::get('/hist', 'GraduationsHistController@show');
});
