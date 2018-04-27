<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CapturaDatosController extends Controller
{
    public function captura(){
        $now = new \DateTime();
      $fecha=$now->format('Y-n-d');
        return view('principal.captura_datos', compact('fecha'));
    }
}
