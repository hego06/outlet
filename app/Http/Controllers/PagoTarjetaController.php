<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClientesExpo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Tcambio;
class PagoTarjetaController extends Controller
{
    public function create($fol)
    {
        $now = new Carbon();
        $fecha2 =strtoupper($now->formatLocalized('%d de %B del %Y'));
        $fecha3 =strtoupper($now->formatLocalized('%Y-%m-%d'));
        $tc=Tcambio::where('fecha',$fecha3)->first();
        $cliente = ClientesExpo::where('folexpo',$fol)->first();

        $terminales=DB::table('terminalpv')->where('activo','=','1')->get();
        $ckbancos=DB::table('ckbancos')->get();
        return view('principal.pago_tarjeta',compact('cliente','terminales','fecha2','ckbancos','tc'));
    }
}
