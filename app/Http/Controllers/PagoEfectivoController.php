<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClientesExpo;
use Carbon\Carbon;
use App\Tcambio;
use Illuminate\Support\Facades\DB;
setlocale(LC_TIME, 'es');

class PagoEfectivoController extends Controller
{
    public function create($fol)
    {
        $now = new Carbon();
        $fecha =strtoupper($now->formatLocalized('%d de %B del %Y, %r hrs'));
        $fecha2 =strtoupper($now->formatLocalized('%d de %B del %Y'));
        $fecha3 =strtoupper($now->formatLocalized('%Y-%m-%d'));
        $tc=Tcambio::where('fecha',$fecha3)->first();

        $cliente = ClientesExpo::where('folexpo',$fol)->first();
        return view('principal.pago_efectivo',compact('cliente','fecha','fecha2','tc'));
    }
    public function store(Request $request)
    {
        return view('principal.solicitudes');
    }
}
