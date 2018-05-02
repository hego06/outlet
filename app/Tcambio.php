<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tcambio extends Model
{
    protected $table = 'tcambio';

    protected $fillable = [
        'tcambio', 'fecha'
    ];

    public $timestamps = false; 
}
