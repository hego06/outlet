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


Route::post('busqueda-paquete','TdestpackController@busqueda')->name('paquete.busqueda');
Route::post('convertidor', 'ConvertidorNumeroLetra@convertidor')->name('numeroLetra.convertidor');


//rutas de ventas
Route::get('ventas_reporte','VentasController@index')->name('ventas_reporte.index');
Route::get('ventas_ver/{id}','VentasController@show')->name('ventas_reporte.show');