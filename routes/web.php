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

Route::get('/', 'InicioController')->name('inicio');

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/establecimientos/create', 'EstablecimientoController@create')->name('establecimientos.create')->middleware('revisar'); // usando middleware personalizado

    Route::post('/establecimientos', 'EstablecimientoController@store')->name('establecimientos.store');
    Route::get('/establecimiento/{establecimiento}/edit', 'EstablecimientoController@edit')->name('establecimientos.edit');
    Route::put('/establecimientos/{establecimiento}', 'EstablecimientoController@update')->name('establecimientos.update');

    //********* Imagen
    Route::post('/imagenes/store', 'ImagenController@store')->name('imagenes.store');
    Route::post('/imagenes/destroy', 'ImagenController@destroy')->name('imagenes.destroy');
});
