<?php

namespace App\Http\Controllers;

use App\ClientesExpo;
use App\Recibodig;
use App\Solicitudes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;


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
        $totalMXN=Solicitudes::where('cid_expediente',$exp)->where('moneda','MXN')->where('estatus','EM')->sum('importe');
        $totalMXN=number_format($totalMXN,2);
        $totalUSD=Solicitudes::where('cid_expediente',$exp)->where('moneda','USD')->where('estatus','EM')->sum('importe');
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
    public function PDF($folio){
        $recibo = Recibodig::where('folio', $folio)->first();

        $pdf = PDF::loadView('principal.pdf.recibos', compact('recibo'));

        $pdf ->save(public_path('pdf'). '/'. $folio.'.pdf');
        $pdf = PDF::loadView('principal.pdf.recibos', compact('recibo'));
        return $pdf->stream($folio.'.pdf');
    }

    public function descargarPDF($folio){
        return response()->download(public_path('pdf/'.$folio.'.pdf'));
    }
    public function cancelarSolicitud($folio){
        $now = new \DateTime();
        $fecha=$now->format('Y-n-d');
        $error = null;

        DB::beginTransaction();
        try {
        Solicitudes::where('folio',$folio)->update(
            [
                'estatus'=>'CA',
                'comentario'=>'cancelado',
                'fechacan'=> $fecha
            ]
        );

        Recibodig::where('folio',$folio)->update(
        [
            'cancelado'	=> 1,
            'motivocanc'=> 'cancelado',
            'quiencancela'=> Auth()->user()->id,
            'fcancela'=> $fecha

        ]
        );
            DB::commit();
            $success = true;
        }
        catch (\Exception $e) {
            $success = false;
            $error = $e->getMessage();
            DB::rollback();
            return  redirect()->action('ProcesaPagoController@show', compact('folexp'))->with('message2', $error);
        }
        if ($success) {

            return  redirect()->route('crear.PDF',$folio);
        }



    }

}
