<?php

Route::get('registros','ClientesExpoController@index')->name('clientes_expo.index');
Route::get('nuevo-registro','ClientesExpoController@create')->name('clientes_expo.create');
Route::post('nuevo-registro','ClientesExpoController@store')->name('clientes_expo.store');
Route::get('show-registro/{registro}','ClientesExpoController@show')->name('clientes_expo.show');
Route::post('edit-registro','ClientesExpoController@store')->name('clientes_expo.edit');

//Rutas tipo de cambio 

Route::get('nuevo-tipo-cambio','TipoCambioController@create')->name('tipo_cambio.create');
Route::post('nuevo-tipo-cambio','TipoCambioController@store')->name('tipo_cambio.store');
Route::post('update-tipo-cambio','TipoCambioController@update')->name('tipo_cambio.update');
Route::get('show-tipo-cambio','TipoCambioController@show')->name('tipo_cambio.show');

//rutas procesa pago


Route::get('procesa-pago/{registro}','ProcesaPagoController@show')->name('procesa_pago.show');
Route::get('solicitudes-pago','ProcesaPagoController@index')->name('solicitudes_pago.index');

//rutas pago en efectivo
Route::get('efectivo-pago/{registro}','PagoEfectivoController@create')->name('efectivo_pago.create');
Route::post('efectivo-pagos','PagoEfectivoController@store')->name('pago_efectivo.store');

//rutas pago con tarjeta
Route::get('tarjeta-pago/{registro}','PagoTarjetaController@create')->name('tarjeta_pago.create');

//ruta genera expediente
Route::post('genera-expediente','ExpedienteController@generaExpediente')->name('expediente.genera');


//ruta Liga bancaria

Route::post('mail/send', 'EnviaEmailController@send')->name('ligaBancaria.envia');