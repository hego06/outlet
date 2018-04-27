<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CapturaDatosController extends Controller
{
    public function captura(){
        return view('principal.captura_datos');
    }
}
