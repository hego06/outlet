<?php

namespace App\Http\Controllers;

use App\Ventas;
use App\Solicitudes;
use App\Tnumeracion;
use App\ClientesExpo;
use App\Vtasoperador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Recibodig;

class TarjetaController extends Controller
{
    function guardaTarjeta(Request $request)
    {
        $elaboro = $request->elaboro;
		$folexpo = $request->folexpo;		
		$expediente	= $request->expediente;
		$nrecibo = $this->numeracion('RECIBO');
        $cid_solicitud = $this->numeracion('SOLICITUD');

        $cliente_obj = ClientesExpo::where('cid_expedi',$expediente)->first(); 

		$pasajero		= $cliente_obj->cnombre.' '.$cliente_obj->capellidop.' '.$cliente_obj->capellidom.' X '.$cliente_obj->numpax;				
		$ciniciales		= $cliente_obj->ciniciales;
		$cid_emplea 	= $cliente_obj->cid_emplea;
		$id 			= $cid_emplea;
		$nvendedor 		= $cliente_obj->nvendedor;
		$cliente		= strtoupper($request->nombre);
        $moneda_t 		= $request->moneda;
		$destino		= $cliente_obj->destino;
		$ndestino   	= strtoupper(trim($cliente_obj->destino));
		$fsalida		= $cliente_obj->fsalida;
        $telefono		= '('.$cliente_obj->clada.') '.$cliente_obj->ctelefono.' '.$cliente_obj->cext;
        
        
		$instrumento    = $request->instrumento;
		$codigo_t       = $request->codigo;
		$ftc_t 			= date('Y-m-d');
		$chora 			= date('H:i:s');
		$dfecha			= $ftc_t;
		$fechaop		= $ftc_t;
		$tarjeta_t 		= $request->tarjeta;
		$autoriza_t		= $request->autorizacion;
		$tc_t			= $request->tc_b;
		$tipo_t			= $request->tipotarjeta;
		$valida_t		= $request->valido;
        $importe_t		= $request->importe_t;
        // $letras_t		= $request->impteletra;
        $letras_t		= $request->impteletra;
		$procede_t		= $request->procedencia;
		$mov_t			= $request->movimiento;
		$titular 		= $request->titular;
		$moneda_c 		= $request->moneda_cuenta;
		$n_cuenta		= $request->cuenta;
        $bancop 		= $request->procedencia;
        

        $terminal_t		= explode("|",$request->terminal_t);
		$terminal 		= trim($terminal_t[0]); //TPVx

		$banco_t		= explode("-",$request->bancoaplic);
		$banco 			= trim($banco_t[0]); //NUMINT
		$nbanco 		= trim($request->nbanco); //NOMBRE BANCO
		$cargos_t 		= explode("-",$request->cargos);
		$cargo 			= $cargos_t[0];
		$nid_cargo		= $cargos_t[2];
        $pcargoad 		= $cargos_t[4];
        $pcombanc 		= trim($cargos_t[5]);
		$cargoad		= (($pcargoad * $importe_t) / 100);
		$combanc		= $importe_t * ($pcombanc / 100);
        $importevta 	= ($importe_t - $cargoad);
        

        if($pcombanc != ''){
			$piva = 16;
		}else{
			$piva = 1;
		}

		$iva  		= ($combanc * $piva) / 100;

		if($moneda_t == 'MXN'){
			$impteUSD = round(($importevta / $tc_t),2);
		}else{
			$impteUSD = $importevta;
		}
		$importebanc = ($importe_t) - ($combanc + $iva);
        $encrip		 = $this->encrip($moneda_t, $dfecha, $nrecibo, $importe_t, $tc_t, $ftc_t, '0');	
        
        //CARGOS ADMINISTRATIVOS A SERVICIOS - PCARGOAD	

        $enterop 	= '';
        $decimales	= '';
        $porcenta 	= '';
        $cconcepto 	= '';

        if ($pcargoad > 0){	
            $enterop 	= (integer)$pcargoad;
            $decimales	= (($pcargoad)-($enterop))*100;
            $porcenta 	= trim($pcargoad).'.'.trim($decimales);
            $cconcepto 	= 'Com. Tarj. Bancaria '.$porcenta.' %';

        }

        //VERIFICAR QUE NO EXISTA EL MOVIMIENTO

        if ($moneda_t=='USD'){
            $cantidad = round(($cargoad)/($tc_t),2);
        }

        else{
            $cantidad = $cargoad;
        }
        $error = null;
        DB::beginTransaction();
        try {
        $insertsolicitud = Solicitudes::create([
            'cid_solicitud'=>$cid_solicitud,
            'cid_expediente'=>$expediente,
            'dfecha'=>$dfecha,
            'chora'=>$chora,
            'tipo'=>'RE',
            'documento'=>'TB',
            'fechaemitido'=>$dfecha,
            'horaemitido'=>$chora,
            'estatus'=>'EM',
            'folio'=>$nrecibo,
            'moneda'=>$moneda_t,
            'importe'=>$importe_t
            ]);

        $insertdtarjetab = DB::table('dtarjetab')->insert([
            'cid_solicitud' => $cid_solicitud,
            'numint' => $banco,
            'moneda' => $moneda_t,
            'terminal' => $terminal,
            'instrumento' => $instrumento,
            'tarjeta' =>  $tarjeta_t,
            'tipo' => $tipo_t,
            'bancop' => $procede_t,
            'titular' => '****',
            'notarjeta' => '****',
            'cuenta' => $n_cuenta,
            'codigo' => $codigo_t,
            'valido' => $valida_t,
            'movimiento' => $mov_t,
            'importe' => $importe_t,
            'pcargoad' => $pcargoad,
            'cargoad' => $cargoad,
            'importeventa' => $importevta,
            'importeusd' => $impteUSD,
            'pcombanc' => $pcombanc,
            'combanc' => $combanc,
            'piva' => $piva,
            'iva' => $iva,
            'importebanc' => $importebanc,
            'dfecha' =>$fechaop,
            'hora' => $chora,
            'fechatc' => $ftc_t,
            'fechaop' => $fechaop,
            'nid_cargo' => $nid_cargo,
            'auttarj' => $autoriza_t,
            'cid_expediente' => $expediente
        ]);
            
        $buscasoli 	= Ventas::where('cid_solicitud',$cid_solicitud)->first();

        if (!$buscasoli){
            $insertventas = Ventas::create([
                'servicio'=>'Otros Servicios',
                'concepto'=>$cconcepto,
                'texto'=>'Pago a Meses',
                'cid_solicitud'=>$cid_solicitud,
                'individual'=>$cantidad,
                'pax'=>'1',
                'subtotal'=>$cantidad,
                'comisionable'=>'0',
                'serie'=>'1',
                'fecha'=>$dfecha,
                'id_serv'=>'4',
                'id_cons'=>'43',
                'num'=>'0',
                'cid_cotiza'=>'',
                'com_e_cruc'=>0.00,
                'tc_cruc'=>0.00
            ]);
        }
        else{
            $cantidad_o 	= $cantidad;
            $insertventas = Ventas::where('cid_solicitud',$cid_solicitud)->update(
                [
                    'servicio' => 'Otros Servicios',
                    'concepto' => '',
                    'texto'=> 'Pago a Meses',
                    'cid_solicitud' => $cid_solicitud,
                    'individual' => '',
                    'pax' => '1',
                    'subtotal' => '',
                    'comisionable' => '1',
                    'serie'=> '1',
                    'fecha' => $dfecha,
                    'id_serv' => '4',
                    'id_cons' => '43',
                    'num' => '0',
                    'cid_cotiza'=>'',
                    'com_e_cruc'=>0.00,
                    'tc_cruc'=>0.00
                ]);
            $cantidad_d	= $cantidad_o - $cantidad;
        }

        // //VERIFICAR QUE NO EXISTA EL MOVIMIENTO
        $buscavtasop = Vtasoperador::where('cid_solicitud',$cid_solicitud)->first();
        if (!$buscavtasop){
            //DAR DE ALTA EN OPERADORES  EL MOVIMIENTO
            $insertvtasop = Vtasoperador::create([
                'tipo'=>'T',
                'operador'=> $banco,
                'descriserv'=> $cconcepto,
                'importe'=> $cantidad,
                'moneda'=> '000',                                                 //verifivar de donde viene este dato
                 'importeusd'=> $cantidad,
                'fecha'=> $dfecha,
                'cid_expediente'=> $expediente,
                'cid_operador'=> 'BCO',
                'idexpe'=> '000000000000000',
                'fill'=> 'B',
                'cid_solicitud'=> $cid_solicitud,
                'documento' => '',
                'f_capconf' => '2018-01-01 00:00:00',
                'observa' => '',
                'f_pagada' => '2018-01-01 00:00:00',
                'numfac' => '',
                'imptefact' => '0.0',
                'monedafact' => '0',
                'fprog_pag' => '2018-01-01 00:00:00',
                'tcpago' => '0.0',
                'ope_pago' => '',
                'cid_cotizacion' => '',                                             //verificar
                'estatus' => '0',
                'cid_bloqueo' => '',
                'descriservc' => '',
                'importec' => '0.0',
                'importeusdc' => '0.0',
                'statuspag' => '0'
                ]);

            $cantidad_d 	= 0;
        }
        else{
            $insertvtasop = Vtasoperador::where('cid_solicitud', $cid_solicitud)
            ->update([
                'tipo' => 'T',
                'operadpr' => $banco,
                'descriserv' => '',
                'moneda' => $moneda_t,
                'importeusd' => '',
                'fecha' =>	$dfecha,
                'cid_expediente' => $expediente,
                'cid_operador' => 'BCO',
                'idexpe' => '000000000000000',
                'fill' => 'B',
                'cid_solicitud'	=> $cid_solicitud 
            ]);
            $cantidad_d 	= $cantidad_o - $cantidad ;
        }

        DB::table('recibodig')->insert([
            'folio' => $nrecibo,
            'nombre' => $cliente,
            'telefono' => $telefono,
            'pasajero' => $pasajero,
            'destino' => $ndestino,
            'cid_expediente' => $expediente,
            'fsalida' => $fsalida,
            'concepto' => 'TARJETA BANCARIA',
            'fechsaop' => $dfecha,
            'dfecha' => $dfecha,
            'fechatc' => $ftc_t,
            'intercam' => $tc_t,
            'banco' => $nbanco,
            'cuenta' => $n_cuenta,
            'moneda' => $moneda_t,
            'referencia' => $autoriza_t,
            'monto' => $importe_t,
            'letras' => $letras_t,
            'iniciales' => $ciniciales,
            'cid_solici' => $cid_solicitud,
            'desglosa' => '0',
            'fechahoy' => $dfecha,
            'encrip' => $encrip,
            'cid_empleado' => $id,
            'cancelado' => '0',
            'elaboro' => $elaboro,
            'direccion' => '',
            'colonia' => '',
            'mundel' => '',
            'estado' => '',
            'codigop' => '',
            'rfc' => '',
            'notas' => '',
            'motivocanc' =>'',
            'sustituidox' => '',
            'sustituidom' => '',
            'enviado' => '',
            'pdf' => '',
            'legvar1' => '',
            'legvar2'  => '',
            'fhrevisado' => '1000-10-10 00:00:00',
            'revisado' => '',
            'auto_rec' => '',
            'obser_grales' => '',
            'motivo_rechaza' => '',
            'quiencancela'  => '',
            'aplic' => '',
            'fcancela' => '1000-10-10',
        ]);
            DB::commit();
            $success = true;
        }
        catch (\Exception $e) {
            $success = false;
            $error = $e->getMessage();
            DB::rollback();
          echo $error;
           // return  redirect()->action('ProcesaPagoController@show', compact('folexpo'))->with('message2', 'Error al crear el Recibo'.$error.'');
        }
        if ($success) {
            return  redirect()->route('crear.PDF',array('expediente'=>$nrecibo));
        }
    }

    function numeracion($concepto){
        $numeracion	= Tnumeracion::where('cconcepto', $concepto)->first();

        $ultimoNumero	= trim($numeracion->nnumero) + 1;
        $_letra			= trim($numeracion->calfabeto);
        Tnumeracion::where('cconcepto',$concepto)
            ->update(['nnumero' => $ultimoNumero]);

        if($concepto == 'RECIBO'){
            $respuesta = 'EXP18'.str_pad($ultimoNumero, 4, "0", STR_PAD_LEFT);
        }

        if($concepto == 'SOLICITUD'){
            $respuesta = 'SCE8'.str_pad($ultimoNumero, 5, "0", STR_PAD_LEFT);
        }

        return $respuesta;
    }


    function encrip($moneda, $dfecha, $folio, $cant, $tc, $ftc, $dtosf){

        $cdig	= '';
        $fn		= trim(substr($folio,3,(strlen($folio)-3)));
        $cdig	= $cdig.$fn;
        $fech	= $dfecha;
        $fex	= substr($fech,8,2).substr($fech,5,2).substr($fech,2,2);
        $cdig	= $cdig.$fex;
        $fechat	= $ftc;
        $fes	= substr($fechat,8,2).substr($fechat,5,2).substr($fechat,2,2);
        $cdig	= $cdig.$fes;
    
    
    
        $ce		= (int)($tc);
        $cdd	= (($tc-$ce)*10000);
        $ces	= trim(substr($ce,0,2));
        $cds	= trim(substr($cdd,0,4));
    
            if (strlen($cds)<4){
                $cds	= '0'+$cds;
            }
    
        $tcs	= $ces.$cds;
        $cdig	= $cdig.$tcs;
        $ce		= (int)($cant);
        $cdd	= ($cant - $ce)*100;
    
        //PASAR LOS DECIMALES A STRING Y SI ES MENOR A 10 CENTAVOS AGREGARLE UN CERO
            if ($cdd < 10){
                $cds	= '0'.(substr($cdd,0,1));
            }
    
            else{
                $cds	= substr($cdd,0,2);
            }
        $ces	= trim(substr($ce,0,10));
    
        $cants	= $ces.$cds;
            if(strlen($cants) < 10){
                $cants	= str_repeat("0",(10-strlen($cants))).$cants;
            }
        $cdig	= $cdig.$cants;
                    function decifra($cadena){
                    $cad = str_split(strtoupper($cadena)); 
                    $texto = '';
                    $x = 0;
                    while($x < strlen($cadena)){
                        switch ($cad[$x]){
                            case '1':
                                $letra = 'S';
                                break;
                            case '2':
                                $letra = 'O';
                                break;
                            case '3':
                                $letra = 'Y';
                                break;
                            case '4':
                                $letra = 'T';
                                break;
                            case '5':
                                $letra = 'U';
                                break;
                            case '6':
                                $letra = 'P';
                                break;
                            case '7':
                                $letra = 'A';
                                break;
                            case '8':
                                $letra = 'D';
                                break;
                            case '9':
                                $letra = 'R';
                                break;
                            case '0':
                                $letra = 'E';
                                break;
                        }
                        $texto .= $letra;
                        $x++;
                    }
                    return $texto;
    
                }
        $cadena		= decifra($cdig);		
    
        //CAMBIAR LA CADENA A MAYUSCULAS MINUSCULAS 
        $cadena		= (substr($folio,0,3).$moneda).(substr($cadena,0,34));
    
    
        $cadenae	= '@';
            for($x = 0 ; $x<=strlen($cadena) ; $x++){
                $r1	= $x/2;
                $r2	= $r1-(int)($r1);
                    if ($r2>0){
                        $cadenae	= $cadenae.substr($cadena,$x,1);
                    }
                    else{
                        $cadenae	= $cadenae.strtolower(substr($cadena,$x,1));
                    }
                }	
        $cadenae	= trim($cadenae.$dtosf.'@');
        $total		= strlen($cadenae);
    
        return ($cadenae);	
    }	
}
