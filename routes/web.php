<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/establecimientos/create', 'EstablecimientoController@create')->name('establecimientos.create');
    Route::get('/establecimientos/{establecimiento}/edit', 'EstablecimientoController@edit')->name('establecimientos.edit');

    //********* Imagen
    Route::post('/imagenes/store', 'ImagenController@store')->name('imagenes.store');
});
