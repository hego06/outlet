<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recibodig extends Model
{
    protected $table = 'recibodig';

    public function getMontoAttribute($monto){
        $formato =  number_format($monto, 2);
        return $formato;
    }
}
