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
        // $value = Tdestpack::where('cid_destpack','65004')->first();
        // dd(mb_detect_encoding($value['cdestpack']));

        $tc= Tcambio::select('tcambio')->where('fecha',date("y-m-d"))->get();
        if($tc->isEmpty())
        {
            return view('principal.no_tipo_cambio');
        }
        if(Auth()->user()->nid_depto == 10 || Auth()->user()->nid_depto == 13)
        {
            $registros = ClientesExpo::all()->sortByDesc('folexpo');
        }
        else{
            $registros = ClientesExpo::where('cid_emplea', Auth()->user()->cid_empleado)->get();
        }

        $ejecutivos= DB::table('templeados')->get();
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
        $tcambio=Tcambio::where('fecha',date("y-m-d"))->first();
        return view('principal.captura_datos', compact('fecha','tcambio'));
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
        if(isset($datos['capellidom'])){

        }else{
            $datos['capellidom']='';
        }
        if(isset($datos['cext'])){

        }else{
            $datos['cext']='';
        }
        if(isset($datos['observa'])){

        }else{
            $datos['observa']='';
        }


        $cdestpack 		= explode("§", strtoupper($datos['destino']));
        $datos['destino'] = trim($cdestpack[0]);
        $datos['cid_destin'] = trim($cdestpack[1]);
        
        $datos['nid_area'] = Tdestpack::select('nid_area')->where('cid_destpack',$datos['cid_destin'])->get()->pluck('nid_area')[0];
        $datos['nid_depto'] = TArea::select('nid_depto')->where('nid_area',$datos['nid_area'])->get()->pluck('nid_depto')[0];

        
        $datos['tc'] = Tcambio::select('tcambio')->where('fecha',$datos['fecha'])->get()->pluck('tcambio')[0];
        $datos['cid_emplea'] = Auth()->user()->cid_empleado;
        $datos['ciniciales'] = Auth()->user()->ciniciales;
        $datos['nvendedor'] = Auth()->user()->cnombre;
        $datos['mailejec'] = Auth()->user()->email;
        $datos['motivocanc']='';
        $datos['quiencancela']='';
        $datos['cid_cotiza']='';
        $datos['cid_expedi']='';
        $datos['tproceso']=date('Y-m-d', time());
        $datos['aplic']='S';
        $datos['archivo']=0;
        $datos['lamm']='';

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
    public function edit($fol)
    {
        $now = new \DateTime();
        $fecha=$now->format('Y-n-d');
        $tcambio=Tcambio::where('fecha',date("y-m-d"))->first();
        $cliente=ClientesExpo::where('folexpo',$fol)->first();
        if(Auth()->user()->nid_depto == 10 || Auth()->user()->nid_depto == 13)
        {
            return view('principal.edit_datos', compact('fecha','tcambio','cliente'));
        }
        else{
            if($cliente['cid_emplea']==Auth()->user()->cid_empleado)
                return view('principal.edit_datos', compact('fecha','tcambio','cliente'));

            return redirect()->back();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientesExpo  $clientesExpo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(isset($request->status)){
            $request->status='X';
        }else{
            $request->status='E';
        }
        if(isset($request->capellidom)){

        }else{$request->capellidom='';

        }
        if(isset($request->observa)){

        }else{
            $request->observa='';
        }
        $cdestpack 	= explode("§", strtoupper($request->destino));
        $destino = trim($cdestpack[0]);
        $cid_destin = trim($cdestpack[1]);
        $area=Tdestpack::where('cid_destpack',$cid_destin)->first();
        $idarea=$area->nid_area;
        $depto=TArea::where('nid_area',$idarea)->first();
        $iddepto=$depto->nid_depto;
        $tc=Tcambio::where('fecha', date("y-m-d"))->first();
        $empleado=Auth()->user()->cnombre.Auth()->user()->capellidop;

        $error = null;
        DB::beginTransaction();
        try {
            ClientesExpo::where('folexpo', $request->folexpo)->update([
                'fechahora' => date('Y-m-d H:i:s', time()),
                'hora' => date('h:i:s', time()),
                'ftc' => date('Y-m-d', time()),
                'cnombre' =>strtoupper($request->cnombre),
                'capellidop' =>strtoupper( $request->capellidop),
                'capellidom' => strtoupper($request->capellidom),
                'clada' =>$request->clada,
                'ctelefono' =>$request->ctelefono,
                'cext' => strtoupper($request->cext),
                'ctipotel' =>strtoupper( $request->ctipotel),
                'cmail' =>strtoupper( $request->cmail),
                'fsalida' => $request->fsalida,
                'numpax' => $request->numpax,
                'observa' =>strtoupper( $request->observa),
                'totpaquete' => $request->totpaquete,
                'monedap' => $request->monedap,
                'impteapag' => strtoupper($request->impteapag),
                'moneda' => $request->moneda,
                'cid_emplea' => Auth()->user()->cid_empleado,
                'nvendedor' =>strtoupper($empleado),
                'ciniciales'=> strtoupper(Auth()->user()->ciniciales),
                'fecha' => date('Y-m-d H:i:s', time()),
                'status' =>strtoupper( $request->status),
                'cid_destin' => $cid_destin,
                'destino' => $destino,
                'nid_depto' =>$iddepto,
                'nid_area' =>$idarea,
                'letras' => strtoupper($request->letras),
                'tc' => $tc->tcambio,
                'aplic' => ''
            ]);
            DB::commit();
            $success = true;
        }
        catch (\Exception $e) {
                $success = false;
                $error = $e->getMessage();
                DB::rollback();
                return  redirect()->route('clientes_expo.index')->with('message2', 'Error al guardar Cambio'.$error.' ');
            }
        if ($success) {
            return  redirect()->route('clientes_expo.index')->with('message1', 'Cambio Guardado');
        }
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
