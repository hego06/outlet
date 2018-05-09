<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tdestpack extends Model
{
    protected $table = 'tdestpack';

    public function getCdestpackAttribute($value)
    {
        return utf8_encode($value);
    }
}
