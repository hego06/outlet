<?php

Route::get('registros','ClientesExpoController@index')->name('clientes_expo.index');
Route::get('nuevo-registro','ClientesExpoController@create')->name('clientes_expo.create');
Route::post('nuevo-registro','ClientesExpoController@store')->name('clientes_expo.store');
Route::get('show-registro/{registro}','ClientesExpoController@show')->name('clientes_expo.show');
Route::get('editar-registro/{registro}','ClientesExpoController@edit')->name('clientes_expo.edit');
Route::post('busqueda-registro','ClientesExpoController@busqueda')->name('clientes_expo.busqueda');

//Rutas tipo de cambio 

Route::get('nuevo-tipo-cambio','TipoCambioController@create')->name('tipo_cambio.create')->middleware('admin');
Route::post('nuevo-tipo-cambio','TipoCambioController@store')->name('tipo_cambio.store')->middleware('admin');
Route::post('update-tipo-cambio','TipoCambioController@update')->name('tipo_cambio.update')->middleware('admin');
Route::get('show-tipo-cambio','TipoCambioController@show')->name('tipo_cambio.show');

//rutas procesa pago

Route::get('procesa-pago/{registro}','ProcesaPagoController@show')->name('procesa_pago.show')->middleware('admin');
Route::get('solicitudes-pago','ProcesaPagoController@index')->name('solicitudes_pago.index')->middleware('admin');

//rutas pago en efectivo
Route::get('efectivo-pago/{registro}','PagoEfectivoController@create')->name('efectivo_pago.create')->middleware('admin');
Route::post('efectivo-pagos','PagoEfectivoController@store')->name('pago_efectivo.store')->middleware('admin');

//rutas pago con tarjeta
Route::get('tarjeta-pago/{registro}','PagoTarjetaController@create')->name('tarjeta_pago.create')->middleware('admin');

//ruta genera expediente
Route::post('genera-expediente','ExpedienteController@generaExpediente')->name('expediente.genera')->middleware('admin');


//ruta Liga bancaria
Route::post('mail/send', 'EnviaEmailController@send')->name('ligaBancaria.envia');


//rutas cobro por tarjeta bancaria
Route::post('cargos_b', 'CargosController@cargosB')->name('cargos_b');
Route::post('banco_a', 'CargosController@bancoA')->name('banco_a');
Route::post('datosB', 'CargosController@datosB')->name('datos_b');

Route::post('pago_tarjeta', 'TarjetaController@guardaTarjeta')->name('tarjeta.store');

