<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'user'], function () {
    // Получить всех пользователей
    Route::match(['get', 'post'], 'all', 'UserController@all');
    // по ID
    Route::match(['get', 'post'], 'get', 'UserController@get');

    // CRUD
    Route::match(['get', 'post'], 'create', 'UserController@create');
    Route::match(['get', 'post'], 'update', 'UserController@update');
    Route::match(['get', 'post'], 'delete', 'UserController@delete');
    Route::match(['get', 'post'], 'isDriving', 'UserController@isDriving');
});

Route::group(['prefix' => 'car'], function () {
    // Получить всех пользователей
    Route::match(['get', 'post'], 'all', 'CarController@all');
    // по ID
    Route::match(['get', 'post'], 'get', 'CarController@get');

    // CRUD
    Route::match(['get', 'post'], 'create', 'CarController@create');
    Route::match(['get', 'post'], 'update', 'CarController@update');
    Route::match(['get', 'post'], 'delete', 'CarController@delete');
    Route::match(['get', 'post'], 'driverSet', 'CarController@driverSet');
});
