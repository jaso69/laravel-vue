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

Route::get('/', function () {
    return view('welcome');
});

Route::Auth();

Route::post('/notas', 'AgendaController@store')->middleware('auth:api');

Route::post('/notas/update', 'AgendaController@update')->middleware('auth:api');

Route::post('/notas/destroy', 'AgendaController@destroy')->middleware('auth:api');

Route::post('/users/update', 'UsersController@update')->middleware('auth:api');

Route::post('/users/destroy', 'UsersController@destroy')->middleware('auth:api');

Route::post('/comunidades', 'ComunidadController@store')->middleware('auth:api');

Route::get('/comunidades', 'ComunidadController@index')->middleware('auth:api');

Route::post('/comunidades/update', 'ComunidadController@update')->middleware('auth:api');

Route::post('/comunidades/destroy', 'ComunidadController@destroy')->middleware('auth:api');

Route::post('/viviendas', 'ViviendaController@index')->middleware('auth:api');

Route::post('/vivienda', 'ViviendaController@store')->middleware('auth:api');

Route::post('/vivienda/update', 'ViviendaController@update')->middleware('auth:api');

Route::post('/vivienda/destroy', 'ViviendaController@destroy')->middleware('auth:api');

Route::post('/gasto', 'GastoController@store')->middleware('auth:api');

Route::get('/gasto', 'GastoController@index')->middleware('auth:api');
