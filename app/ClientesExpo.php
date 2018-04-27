<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientesExpo extends Model
{
    protected $table = 'mov_expo';
    protected $guarded = []; 

    public $timestamps = false;
}
