<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Recibodig extends Model
{
    protected $table = 'recibodig';
    protected $guarded = [];
    public $timestamps = false;

    public function getMontoAttribute($monto){
        $formato =  number_format($monto, 2);
        return $formato;
    }
    public function getFsalidaAttribute($fsalida){
        $tiempo = new Carbon($fsalida);
        $fecha =strtoupper($tiempo->formatLocalized('%d-%b-%Y '));
        return $fecha;
    }

    public function getFechatcAttribute($fechatc){
        $tiempo = new Carbon($fechatc);
        $fecha =strtoupper($tiempo->formatLocalized('%d-%b-%Y '));
        return $fecha;
    }
    public function getFechahoyAttribute($fechahoy){
        $tiempo = new Carbon($fechahoy);
        $fecha =strtoupper($tiempo->formatLocalized('%d de %B del %Y '));
        return $fecha;
    }

    public function getFechsaopAttribute($fechsaop){
        $tiempo = new Carbon($fechsaop);
        $fecha =strtoupper($tiempo->formatLocalized('%d-%b-%Y '));
        return $fecha;
    }
}
