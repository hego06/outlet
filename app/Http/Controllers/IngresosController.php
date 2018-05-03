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
        $ejecutivos=User::all();

        return view('principal.ingresos',compact('ejecutivos'));
    }
}
