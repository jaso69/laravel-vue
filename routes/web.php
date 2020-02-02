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

Route::post('/notas', 'AgendaController@store')->name('agenda.store');

Route::post('/notas/update', 'AgendaController@update')->name('agenda.update');

Route::post('/notas/destroy', 'AgendaController@destroy')->name('agenda.destroy');

Route::post('/users/update', 'UsersController@update')->name('users.update');

Route::post('/users/destroy', 'UsersController@destroy')->name('users.destroy');

Route::post('/gasto', 'GastoController@store')->name('gasto.store');

Route::get('/gasto', 'GastoController@index')->name('gasto.index');
