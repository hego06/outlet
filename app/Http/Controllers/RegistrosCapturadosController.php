<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrosCapturadosController extends Controller
{
   public function registros(){
       return view('principal.registros_capturados');
   }

}
