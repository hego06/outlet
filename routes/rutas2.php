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
Route::get('ventas_reporte','VentasController@index')->name('ventas_reporte.index')->middleware('ventas');
Route::get('ventas_ver/{registro}','VentasController@show')->name('ventas_reporte.show')->middleware('ventas');

//rutas ingresos
Route::get('ingresos_reporte','IngresosController@index')->name('ingresos_reporte.index')->middleware('ventas');

//rutas PDF
Route::get('genera_pdf/{folio}','ProcesaPagocontroller@PDF')->name('crear.PDF');
Route::get('descargar_pdf/{folio}','ProcesaPagocontroller@descargarPDF')->name('descargar_Pdf.descargarPDF');

//ruta cancelar solicitud
Route::post('cancelar_pago','ProcesaPagocontroller@cancelarSolicitud')->name('cancelar_pago.cancelarSolicitud');

//ruta editar
Route::post('editar-registro','ClientesExpoController@update')->name('clientes_expo.update');

//ruta excel
Route::get('crear-excel','ExcelController@exportVentas')->name('ventas.excel');