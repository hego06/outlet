<?php

namespace App\Http\Controllers;

use App\User;
use App\Recibodig;
use App\ClientesExpo;
use Illuminate\Http\Request;


class VentasController extends Controller
{
   public function index(){
       $ejecutivos=User::all();

       $registros=ClientesExpo::where('status','P')->get();
       $registros->map(function ($registro) {
            $registro['pagos'] = Recibodig::select('concepto','monto','moneda')
            ->where('cid_expediente',$registro['cid_expedi'])
            ->where('cancelado',0)
            ->get();
            return $registro;
        });
       $ventas=ClientesExpo::where('status','P')->selectRaw('count(*) as Ventas')
            ->first();
        $pax=ClientesExpo::where('status','P')->sum('numpax');
        $USDVe=ClientesExpo::where('status','P')->where('moneda','USD')->sum('totpaquete');
        $USDVe=number_format($USDVe,2);
        $MXNVe=ClientesExpo::where('status','P')->where('moneda','MXN')->sum('totpaquete');
         $MXNVe=number_format($MXNVe,2);
         $USDIg=Recibodig::where('cancelado',0)->where('moneda','USD')->sum('monto');
          $USDIg=number_format($USDIg,2);
        $MXNIg=Recibodig::where('cancelado',0)->where('moneda','MXN')->sum('monto');
         $MXNIg=number_format($MXNIg,2);
       return view('principal.ventas_capturadas',compact('registros','ejecutivos', 'ventas','pax','USDVe','MXNVe','USDIg','MXNIg'));
   }
   public function show($registro){
       $registros=ClientesExpo::where('cid_expedi',$registro)->first();
       $recibos=Recibodig::where('cid_expediente',$registro)->where('cancelado',0)->get();
       $efectivoMXN=Recibodig::where('cid_expediente',$registro)->where('cancelado',0)->where('concepto','EFECTIVO')->where('moneda','MXN')->sum('monto');
       $efectivoMXN=number_format($efectivoMXN,2);
       $efectivoUSD=Recibodig::where('cid_expediente',$registro)->where('cancelado',0)->where('concepto','EFECTIVO')->where('moneda','USD')->sum('monto');
       $efectivoUSD=number_format($efectivoUSD,2);
       $tarjetaMXN=Recibodig::where('cid_expediente',$registro)->where('cancelado',0)->where('concepto','TARJETA BANCARIA')->where('moneda','MXN')->sum('monto');
       $tarjetaMXN=number_format($tarjetaMXN,2);
       $tarjetaUSD=Recibodig::where('cid_expediente',$registro)->where('cancelado',0)->where('concepto','TARJETA BANCARIA')->where('moneda','USD')->sum('monto');
       $tarjetaUSD=number_format($tarjetaUSD,2);
       $MXN=Recibodig::where('cid_expediente',$registro)->where('cancelado',0)->where('moneda','MXN')->sum('monto');
       $MXN=number_format($MXN,2);
       $USD=Recibodig::where('cid_expediente',$registro)->where('cancelado',0)->where('moneda','USD')->sum('monto');
       $USD=number_format($USD,2);
       return view('principal.ventas_detalle',compact('recibos','registros','tarjetaUSD','tarjetaMXN','MXN','USD','efectivoUSD','efectivoMXN'));
   }
}
