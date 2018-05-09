<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ClientesExpo extends Model
{
    protected $table = 'expo_mov';
    protected $guarded = []; 

    public $timestamps = false;

    public function setFsalidaAttribute($fechaSalida)
    {
        $this->attributes['fsalida'] = Carbon::parse($fechaSalida)->format('Y-m-d');
    }
    public function getStatusAttribute($status)
    {
        if($status=='X'){
            $estatus='COTIZACIÓN';
        }
        else if($status=='E'){
            $estatus='PENDIENTE';
        }else if($status=='P'){
            $estatus='PROCESADA';
        }else{
            $estatus='LIGA BANCARIA';
        }
        return $estatus;

    }
    public function setCnombreAttribute($cnombre)
    {
        $this->attributes['cnombre'] = strtoupper($cnombre);
    }
    public function setCapellidopAttribute($capellidop)
    {
        $this->attributes['capellidop'] = strtoupper($capellidop);
    }
    public function setCapellidomAttribute($capellidom)
    {
        $this->attributes['capellidom'] = strtoupper($capellidom);
    }
    public function setCmailAttribute($cmail)
    {
        $this->attributes['cmail'] = strtoupper($cmail);
    }
    public function setObservaAttribute($observa)
    {
        $this->attributes['observa'] = strtoupper($observa);
    }
    public function setLetrasAttribute($letras)
    {
        $this->attributes['letras'] = strtoupper($letras);
    }
}

