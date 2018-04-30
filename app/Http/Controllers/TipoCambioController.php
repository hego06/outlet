<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\TipoCambio;
use Illuminate\Http\Request;

class TipoCambioController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('principal.captura_tipo_cambio');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fechaHoy = Carbon::now()->toDateString();
        $tc_actual = TipoCambio::where('fecha', Carbon::now())->get();
        $datos = $request->all();
        $datos['fecha'] = $fechaHoy;
        if($tc_actual->isEmpty())
        {
            TipoCambio::create($datos);
            return redirect()->back()->with('mensaje1', 'Tipo de Cambio Creado') ;
        }
        else
        {
            TipoCambio::where('fecha',$fechaHoy)->update(['t_cambio'=>$datos['t_cambio']]);
            return redirect()->back()->with('mensaje1', 'Tipo de Cambio Actualizado') ;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoCambio  $tipoCambio
     * @return \Illuminate\Http\Response
     */
    public function show(TipoCambio $tipoCambio)
    {
        $tipoCambio = TipoCambio::where('fecha',Carbon::now())->get();
        return $tipoCambio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoCambio  $tipoCambio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoCambio $tipoCambio)
    {
        //
    }
}
