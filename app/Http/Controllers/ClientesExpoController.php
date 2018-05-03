<?php

namespace App\Http\Controllers;

use App\TArea;
use App\Tcambio;
use App\Tdestpack;
use App\Tnumeracion;
use App\ClientesExpo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesExpoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registros = ClientesExpo::all()->sortByDesc('folexpo');
        $ejecutivos= DB::table('users')->get();
        return view('principal.registros_capturados',compact('registros','ejecutivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tc= Tcambio::select('tcambio')->where('fecha',date("y-m-d"))->get();
        if($tc->isEmpty())
        {
            return view('principal.no_tipo_cambio');
        }
        $now = new \DateTime();
        $fecha=$now->format('Y-n-d');
        $action=1;
        return view('principal.captura_datos', compact('fecha','action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = $request->all();
        if(isset($datos['status'])){
            $datos['status'] = "X";
        }else{
            $datos['status'] = "E";
        }
        $datos['folexpo'] = Tnumeracion::select('nnumero')->where('cconcepto','FOLIO')->get()->pluck('nnumero')[0]+1;
        $datos['fechahora'] =  date('Y-m-d h:i:s', time());
        $datos['hora'] = date('h:i:s', time());
        $datos['fecha'] = date('Y-m-d', time());
        $datos['ftc'] = date('Y-m-d', time());

        $cdestpack 		= explode("§", strtoupper($datos['destino']));
        $datos['destino'] = trim($cdestpack[0]);
        $datos['cid_destin'] = trim($cdestpack[1]);
        
        $datos['nid_area'] = Tdestpack::select('nid_area')->where('cid_destpack',$datos['cid_destin'])->get()->pluck('nid_area')[0];
        $datos['nid_depto'] = TArea::select('nid_depto')->where('nid_area',$datos['nid_area'])->get()->pluck('nid_depto')[0];

        
        $datos['tc'] = Tcambio::select('tcambio')->where('fecha',$datos['fecha'])->get()->pluck('tcambio')[0];
        $datos['cid_emplea'] = Auth()->user()->id;
        $datos['ciniciales'] = Auth()->user()->ciniciales;
        $datos['nvendedor'] = Auth()->user()->nvendedor;
        $datos['mailejec'] = Auth()->user()->email;

        ClientesExpo::create($datos);

        Tnumeracion::where('cconcepto','FOLIO')->update(['nnumero'=>$datos['folexpo']]);

        return redirect()->action('ClientesExpoController@index')->with('flash_message', 'Registro Capturado');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClientesExpo  $clientesExpo
     * @return \Illuminate\Http\Response
     */
    public function show($fol)
    {
        $cliente = ClientesExpo::where('folexpo',$fol)->first();

        return view('principal.show_cliente', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientesExpo  $clientesExpo
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientesExpo $clientesExpo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientesExpo  $clientesExpo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientesExpo $clientesExpo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientesExpo  $clientesExpo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientesExpo $clientesExpo)
    {
        //
    }
}
