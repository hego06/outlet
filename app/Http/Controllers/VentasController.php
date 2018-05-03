<?php

namespace App\Http\Controllers;

use App\User;
use App\Recibodig;
use App\ClientesExpo;
use Illuminate\Http\Request;


class VentasController extends Controller
{
   public function index(){
       $registros=ClientesExpo::where('status','P')->get();
       $ejecutivos=User::all();
       return view('principal.ventas_capturadas',compact('registros','ejecutivos'));
   }
   public function show($registro){
       $registros=ClientesExpo::where('cid_expedi',$registro)->first();
       $recibos=Recibodig::where('cid_expediente',$registro)->get();
       $efectivo=Recibodig::where('cid_expediente',$registro)->where('concepto','EFECTIVO')->sum('monto');
       $efectivo=number_format($efectivo,2);
       $tarjeta=Recibodig::where('cid_expediente',$registro)->where('concepto','TARJETA BANCARIA')->sum('monto');
       $tarjeta=number_format($tarjeta,2);
       $MXN=Recibodig::where('cid_expediente',$registro)->where('moneda','MXN')->sum('monto');
       $MXN=number_format($MXN,2);
       $USD=Recibodig::where('cid_expediente',$registro)->where('moneda','USD')->sum('monto');
       $USD=number_format($USD,2);
       return view('principal.ventas_detalle',compact('recibos','registros','efectivo','tarjeta','MXN','USD'));
   }
}
