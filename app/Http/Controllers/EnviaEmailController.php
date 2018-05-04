<?php

namespace App\Http\Controllers;

use App\PagosWeb;
use App\Tnumeracion;
use App\ClientesExpo;
use App\Mail\LigaBancaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EnviaEmailController extends Controller
{
    public function send(Request $request)
    {
        $datosCliente = ClientesExpo::where('folexpo',$request->folio)->first();

        if($datosCliente->monedap == 'MXN'){
            $importeusd	= 0.00;
            $importemxn	= $datosCliente->impteapag;
            $tipom		= 1;
        }

        if($datosCliente->monedap == 'USD'){
            $importemxn	= 0.00;
            $importeusd	= $datosCliente->impteapag;
            $tipom		= 2;
        }

        $result = PagosWeb::orderBy('cons_liga', 'desc')->take(1)->first();

        if (!$result) {
            $consecutivo = '001';
        }
        else{
            $consecutivo = str_pad($result->cons_liga+1, 3, '0', STR_PAD_LEFT);
        }

        $folio_c= $datosCliente->folexpo.'_'.$consecutivo;	
        $referencia	= "https://pay.megatravel.com.mx?ID=$folio_c&MT=$datosCliente->cid_destin&DD=$datosCliente->fsalida&TP=$datosCliente->impteapag&MON=$tipom&M=";

        Mail::to('hego_06@hotmail.com')->send(new LigaBancaria($datosCliente, $referencia));

        //GENERAR CLIENTE -------------

        $cid_cliente 	= $this->numeracion('CLIENTE');
    
        DB::table('tclientes')->insert([
            'cid_cliente' => $cid_cliente,
            'ctipocliente'=> 'D',
            'cnombre' => $datosCliente->cnombre,
            'capellidop' => $datosCliente->capellidop,
            'capellidom' => $datosCliente->capellidom,
            'clada' => $datosCliente->clada,
            'ctelefono' => $datosCliente->ctelefono,
            'cext' => $datosCliente->cext,
            'ctipotelefono' => $datosCliente->ctipotel,
            'cmail' => $datosCliente->cmail
        ]);

        $nombreCli = $datosCliente->cnombre.' '.$datosCliente->capellidop.' '.$datosCliente->capellidom;
        DB::table('pagosweb')->insert([
            'fechahora' => date('Y-m-d H:i:s'),
            'cid_expediente' => $datosCliente->folexpo, 
            'fechasalida' => $datosCliente->fsalida, 
            'tchoy' => '00', //verrificar que dato guarda
            'cid_cliente' => $cid_cliente, 
            'nomcte' => $nombreCli, 
            'cid_destpack' => $datosCliente->cid_destin, 
            'nomdestpack' => $datosCliente->destino, 
            'cid_empleado' => $datosCliente->cid_emplea, 
            'nomempleado' => $datosCliente->nvendedor, 
            'emailejec' => $datosCliente->mailejec, 
            'nomcontacto' => $nombreCli, 
            'emailcontacto' => $datosCliente->cmail, 
            'importemxn' => $importemxn, 
            'importeusd' => $importeusd, 
            'referencia' => $referencia,
            'fechahorap' => date('Y-m-d H:i:s'), //la hora de pago no se guarda
            'estatus' => 'L',
            'monedapag' => $datosCliente->monedap, 
            'cadenaweb'=>'',
            'link_enc'=>'',
            'aplic'=>'',
            'npax' => $datosCliente->numpax,
            'cons_liga' => $consecutivo
        ]);

        DB::table('expo_mov')
            ->where('folexpo', $datosCliente->folexpo)
            ->update(
            ['status' => 'L', 'tproceso' => date('Y-m-d')]
        );
        
        echo 'HECHO';
    }

    function numeracion($concepto){
		$numeracion	= Tnumeracion::where('cconcepto', $concepto)->first();

		$ultimoNumero	= trim($numeracion->nnumero) + 1;
		$_letra			= trim($numeracion->calfabeto);
		Tnumeracion::where('cconcepto',$concepto)
					->update(['nnumero' => $ultimoNumero]);

		if($concepto == 'CLIENTE'){
			$respuesta = 'MCE8'.str_pad($ultimoNumero, 3, "0", STR_PAD_LEFT);
		}
		return $respuesta;
	}
}
