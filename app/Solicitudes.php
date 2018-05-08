<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Solicitudes extends Model
{
    protected $table = 'solicitudes';
    protected $guarded = [];
    public $timestamps = false;

    public function getDfechaAttribute($dfecha){
        $tiempo= new Carbon($dfecha);
        $fecha =strtoupper($tiempo->formatLocalized('%d-%B-%Y '));
        return $fecha;
    }
    public function getFechaemitidoAttribute($fechaemitido){
        $tiempo= new Carbon($fechaemitido);
        $fecha =strtoupper($tiempo->formatLocalized('%d-%B-%Y '));
        return $fecha;
    }
    public function getImporteAttribute($importe){
        $formato =  number_format($importe, 2);
        return $formato;
    }
}
