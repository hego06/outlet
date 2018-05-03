<?php

namespace App\Http\Controllers;

use NumerosEnLetras;
use Illuminate\Http\Request;

class ConvertidorNumeroLetra extends Controller
{
    public function convertidor(Request $request)
    {
        $monto = $request->anticipo;
        $moneda = $request->moneda;
        $cadena= NumerosEnLetras::convertir($monto,$moneda,true);

        $parte1=explode('(',$cadena);
        $parte2=explode(')',$parte1[1]);

        $parentesis= $parte2[0];

        echo $parentesis;
    }
}
