<?php

namespace App\Http\Controllers;

use App\Expediente;
use App\Recibodig;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IngresosController extends Controller
{
    public function index(){
        $ing=Recibodig::all();

            $ingresoTMXN=Recibodig::where('concepto', 'TARJETA BANCARIA')->where('moneda','MXN')->where('cancelado',0)->groupBy('cid_expediente')->sum('monto');


        $ejecutivos=User::all();
        $ingresoUSD=Recibodig::where('concepto', 'TARJETA BANCARIA')->where('moneda','USD')->where('cancelado',0)->sum('monto');
        $ingresoEMXN=Recibodig::where('concepto', 'EFECTIVO')->where('moneda','MXN')->where('cancelado',0)->sum('monto');


        return view('principal.ingresos',compact('ejecutivos','ingresoTMXN'));
    }
}
