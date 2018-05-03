<?php

namespace App\Http\Controllers;

use App\ClientesExpo;
use App\Solicitudes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProcesaPagoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registros = ClientesExpo::all();
        $solicitudes=Solicitudes::all();
        return view('principal.solicitudes',compact('registros','solicitudes'));
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($fol)
    {
        $cliente = ClientesExpo::where('folexpo',$fol)->first();
        $exp=$cliente->cid_expedi;
        $solicitudes=Solicitudes::where('cid_expediente',$exp)->get();
        $totalMXN=Solicitudes::where('cid_expediente',$exp)->where('moneda','MXN')->sum('importe');
        $totalMXN=number_format($totalMXN,2);
        $totalUSD=Solicitudes::where('cid_expediente',$exp)->where('moneda','USD')->sum('importe');
        $totalUSD=number_format($totalUSD,2);
        return view('principal.procesa_pagos',compact('cliente','solicitudes','totalMXN','totalUSD'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
