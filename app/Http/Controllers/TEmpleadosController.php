<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TEmpleadosController extends Controller
{
    function empledos()
    {
        $empleado = User::all();

        return $empleado;
    }
}
