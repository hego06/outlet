<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClientesExpo;
use Carbon\Carbon;
use App\Tcambio;
setlocale(LC_TIME, 'es');

class PagoEfectivoController extends Controller
{
    public function create($fol)
    {
        $now = new Carbon();
        $fecha =strtoupper($now->formatLocalized('%d de %B del %Y, %r hrs'));
        $fecha2 =strtoupper($now->formatLocalized('%d de %B del %Y'));

        $cliente = ClientesExpo::where('folexpo',$fol)->first();
        return view('principal.pago_efectivo',compact('cliente','fecha','fecha2'));
    }
    public function store(Request $request)
    {
        return view('principal.solicitudes');
    }
}
