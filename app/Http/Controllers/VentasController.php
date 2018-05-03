<?php

namespace App\Http\Controllers;

use App\User;
use App\Recibodig;
use App\ClientesExpo;
use Illuminate\Http\Request;


class VentasController extends Controller
{
   public function index(){
       $registros=ClientesExpo::all();
       $ejecutivos=User::all();
       return view('principal.ventas_reporte',compact('registros','ejecutivos'));
   }
   public function show($id){
       $recibos=Recibodig::where('cid_expediente',$id)->get();
       return view('principal.ventas_detalle',compact('recibos','id'));
   }
}
