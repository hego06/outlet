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


Route::group(['middleware' => 'auth'],function(){
    require_once "rutas.php";
    require_once "ruta2.php";

    Route::get('/', function () {
        return view('principal.layout');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
