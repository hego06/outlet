<?php

Route::get('registros','ClientesExpoController@index')->name('clientes_expo.index');
Route::get('nuevo-registro','ClientesExpoController@create')->name('clientes_expo.create');
Route::post('nuevo-registro','ClientesExpoController@store')->name('clientes_expo.store');