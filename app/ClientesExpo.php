<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ClientesExpo extends Model
{
    protected $table = 'mov_expo';
    protected $guarded = []; 

    public $timestamps = false;

    public function setFsalidaAttribute($fechaSalida)
    {
        $this->attributes['fsalida'] = Carbon::parse($fechaSalida)->format('Y-m-d');
    }
}

