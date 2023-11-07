<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth',
    'namespace' => 'App\Http\Controllers',

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

//admins
Route::group([

    'middleware' => ['auth:api', 'jwtauth:admin'],
    'prefix' => 'auth/admin',
    'namespace' => 'App\Http\Controllers',

], function ($router) {

    Route::get('dashboard', 'AdminController@dashboard');

});


//usuarios comuns
Route::group([

    'middleware' => ['auth:api', 'jwtauth:user'],
    'prefix' => 'auth/user',
    'namespace' => 'App\Http\Controllers',

], function ($router) {

    Route::post('registeruser', 'UserController@userRegister');
    Route::post('registervendedor', 'UserController@vendedorRegister');
    Route::post('getvendas', 'UserController@vendasIndex');
    Route::post('getvendasbyid', 'UserController@indexVendasId');
    Route::post('registervenda', 'UserController@registerVendas');
    Route::get('getvendedores', 'UserController@vendedoresIndex');

});

//vendedores
Route::group([

    'middleware' => ['auth:api', 'jwtauth:vendedor'],
    'prefix' => 'auth/vendedor',
    'namespace' => 'App\Http\Controllers',

], function ($router) {

    Route::post('getvendedorvendas', 'VendedorController@getvendedorvendas');
    Route::post('registervenda', 'VendedorController@registerVendas');

});
