<?php

namespace App\Http\Controllers;

use App\Solicitudes;
use App\ClientesExpo;
use Illuminate\Http\Request;

class GeneraLigaController extends Controller
{
    public function create($fol)
    {
        $cliente = ClientesExpo::where('cid_expedi',$fol)->first();
        $exp=$cliente->cid_expedi;
        $totalMXN=Solicitudes::where('cid_expediente',$exp)->where('moneda','MXN')->where('estatus','EM')->sum('importe');
        $totalMXN=number_format($totalMXN,2);
        $totalUSD=Solicitudes::where('cid_expediente',$exp)->where('moneda','USD')->where('estatus','EM')->sum('importe');
        $totalUSD=number_format($totalUSD,2);
        //dd([$cliente, $totalMXN, $totalUSD]);
        return view('principal.genera_link',compact('cliente','totalMXN','totalUSD'));
    }
}
