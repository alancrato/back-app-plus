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

/**
 * Routes Live Content
 **/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Routes Verified Emails
 **/

Route::get('email-verification/error', 'Auth\RegisterController@getVerificationError')->name('email-verification.error');
Route::get('email-verification/check/{token}', 'Auth\RegisterController@getVerification')->name('email-verification.check');

/**
 * Routes Settings Users
 **/

Route::get('users/settings', 'Auth\UserSettingsController@edit')->name('user.edit');
Route::put('users/settings', 'Auth\UserSettingsController@update')->name('user.update');

/**
 * Routes Register Users
 **/

Auth::routes();

/**
 * Routes Dashboard admin
 **/

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin\\'
], function (){
    Route::get('login', 'Auth\LoginController@ShowLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');

        Route::group([
           'middleware' => ['isVerified', 'can:admin']
        ], function (){
            Route::post('logout', 'Auth\LoginController@logout')->name('logout');
            Route::get('users/settings', 'Auth\UserSettingsController@edit')->name('user_settings.edit');
            Route::put('users/settings', 'Auth\UserSettingsController@update')->name('user_settings.update');
            Route::resource('users', 'UsersController');

            Route::get('dashboard', function (){
                return view('admin.dashboard');
            });

            Route::resource('/categories', 'CategoryController');
            Route::get('/states', 'StateController@states');
            Route::resource('/state', 'StateController');
            Route::resource('/promotions', 'PromotionController');
        });

});

Route::group([
    'middleware' => 'cors',
], function (){
    Route::get('/data/categories', 'Data\CategoryController@index');
    Route::get('/data/states', 'Data\StateController@states');
    Route::get('/data/state', 'Data\StateController@index');
    Route::get('/data/promotions', 'Data\PromotionController@index');
});
