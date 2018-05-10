<?php

namespace App\Http\Controllers;

use App\Tcambio;
use Carbon\Carbon;
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
        $tc_actual = Tcambio::where('fecha', date('y-m-d'))->get();
        $datos = $request->all();
        $datos['fecha'] = $fechaHoy;
        if($tc_actual->isEmpty())
        {
            Tcambio::create($datos);
            return redirect()->back()->with('mensaje1', 'Tipo de Cambio Creado') ;
        }
        else
        {
            Tcambio::where('fecha',$fechaHoy)->update(['tcambio'=>$datos['tcambio']]);
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
