<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tnumeracion;
use App\ClientesExpo;
use Carbon\Carbon;
use App\Tcambio;
use Illuminate\Support\Facades\DB;
setlocale(LC_TIME, 'es');

class PagoEfectivoController extends Controller
{
    public function create($fol)
    {
        $now = new Carbon();
        $fecha =strtoupper($now->formatLocalized('%d de %B del %Y, %r hrs'));
        $fecha2 =strtoupper($now->formatLocalized('%d de %B del %Y'));
        $fecha3 =strtoupper($now->formatLocalized('%Y-%m-%d'));
        $tc=Tcambio::where('fecha',$fecha3)->first();

        $cliente = ClientesExpo::where('folexpo',$fol)->first();
        return view('principal.pago_efectivo',compact('cliente','fecha','fecha2','tc'));
    }
    public function store(Request $request)
    {
        $now = new Carbon();
        $fecha=strtoupper($now->formatLocalized('H:i:s'));
        $fecha3 =strtoupper($now->formatLocalized('%Y-%m-%d'));
        $cliente = ClientesExpo::where('folexpo',$request->folexpo)->first();
        $solicitud = $this->numeracion('SOLICITUD');
        $nrecibo= $this->numeracion('RECIBO');
        $folexpo=strtoupper(trim($cliente->folexpo));
        $expedinte=strtoupper(trim($cliente->cid_expedi));
        $nombre=strtoupper(trim($request->nombre));
        $moneda=strtoupper(trim($request->moneda_e));
        $monto=strtoupper(trim($request->imptepag_e));
        $letras=strtoupper(trim($request->letras_e));
        $ciniciales=strtoupper(trim($request->ciniciales));
        $pasajero=strtoupper(trim($request->pax_principal));
        $idejec=trim($request->cid_emplea);
        $ctelefono=trim($request->ctelefono);
        $destino=trim($request->ctelefono);
        $fsalida =trim($request->destino);
        $tcambio=trim($request->intercam);
        $dfecha	= $fecha3;
        $chora	=$fecha;
        $ftc 	=trim($request->fechatc);
        $f_modif= $now;
        $banco	= '';
        $concepto= 'EFECTIVO';
        $desglosa = 1;
        $documento='EF';
        $tipo='RE';
        $estatus='EM';
        $encrip=encrip($moneda, $dfecha, $nrecibo, $monto, $tcambio, $ftc, '0');
        if($moneda=='MXN'){
            $importeusd=($monto)*($tcambio);
        }
        else{
            $importeusd=$monto;
        }

        //Tabla solicitudes
        DB::table('solicitudes')->insert(
            [
                'cid_solicitud'=>$solicitud,
                'cid_expediente'=>$expedinte,
                'dfecha'=>$dfecha,
                'chora'=>$chora,
                'tipo'=>$tipo,
                'documento'=>$documento,
                'fechaemitido'=>$dfecha,
                'horaemitido'=>$chora,
                'estatus'=>$estatus,
                'comentario'=>'',
                'dispersion'=>0,
                'folio'=>$nrecibo,
                'moneda'=>$moneda,
                'importe'=>$monto

            ]
        );

        //tabla recibodig
        DB::table('recibodig')->insert(
            [
                'folio'=>$nrecibo,
                'nombre'=>$nombre,
                'telefono'=>$ctelefono,
                'pasajero'=>$pasajero,
                'destino'=>$destino,
                'cid_expediente'=>$expedinte,
                'fsalida'=>$fsalida,
                'concepto'=>$concepto,
                'fechsaop'=>$dfecha,
                'dfecha'=>$dfecha,
                'fechatc'=>$ftc,
                'intercam'=>$tcambio,
                'banco'=>$banco,
                'cuenta'=>'',
                'moneda'=>$moneda,
                'referencia'=>'',
                'monto'=>$monto,
                'letras'=>$letras,
                'iniciales'=>$ciniciales,
                'cid_solici'=>$solicitud,
                'desglosa'=>$desglosa,
                'fechahoy'=>$dfecha,
                'encrip'=>$encrip,
                'legvar1'=>'',
                'legvar2'=>'',
                'cid_empleado'=>'',
                'cancelado'=>0,
                'elaboro'=>''
            ]
        );

        //tabla defectivo
        DB::table('defectivo')->insert(
            [
                'cid_solicitud'=>$solicitud,
                'numint'=>$banco,
                'moneda'=>$moneda,
                'importe'=>$monto,
                'importeventa'=>$monto,
                'importeusd'=>$importeusd,
                'importebanc'=>$monto,
                'dfecha'=>$dfecha,
                'hora'=>$chora,
                'fechatc'=>$ftc,
                'fechaop'=>$dfecha,
                'pcombanc'=>'0',
                'piva'=>'0',
                'iva'=>'0',
                'pcargoad'=>'0',
                'cargoad'=>'0',
                'referencia'=>'',
            ]
        );

        //imprimir
       // $foliorecibo	= encode_this("folio=".$nrecibo."&folexpo=".$folexpo);




        return view('principal.solicitudes');
    }

    function numeracion($concepto){
        $numeracion	= Tnumeracion::where('cconcepto', $concepto)->first();

        $ultimoNumero	= trim($numeracion->nnumero) + 1;
        $_letra			= trim($numeracion->calfabeto);
        Tnumeracion::where('cconcepto',$concepto)
            ->update(['nnumero' => $ultimoNumero]);


        if($concepto == 'EXPEDIENTE'){
            $respuesta = 'OUT18'.str_pad($ultimoNumero, 5, "0", STR_PAD_LEFT);
        }

        if($concepto == 'RECIBO'){
            $respuesta = 'EXP18'.str_pad($ultimoNumero, 4, "0", STR_PAD_LEFT);
        }

        if($concepto == 'SOLICITUD'){
            $respuesta = 'SCE8'.str_pad($ultimoNumero, 5, "0", STR_PAD_LEFT);
        }

        if($concepto == 'CLIENTE'){
            $respuesta = 'MCE8'.str_pad($ultimoNumero, 3, "0", STR_PAD_LEFT);
        }

        if($concepto == 'FUNCIONARIO'){
            $respuesta = 'FNE8'.str_pad($ultimoNumero, 3, "0", STR_PAD_LEFT);
        }

        if($concepto == 'FOLIO'){
            $respuesta = str_pad($ultimoNumero, 4, "0", STR_PAD_LEFT);
        }

        return $respuesta;
    }


    function encrip($moneda, $dfecha, $folio, $cant, $tc, $ftc, $dtosf){
        $cdig	= '';
        //Campo 3 - PARTE NUMERICA DEL FOLIO - +6
        $fn		= trim(substr($folio,3,(strlen($folio)-3)));
        $cdig	= $cdig.$fn;

        //CAMPO 5 - FECHA DE EXPEDICIÓN - +6
        $fech	= $dfecha;
        $fex	= substr($fech,8,2).substr($fech,5,2).substr($fech,2,2);
        $cdig	= $cdig.$fex;

        //CAMPO 6 - FECHA DE TIPO DE CAMBIO +6
        $fechat	= $ftc;
        $fes	= substr($fechat,8,2).substr($fechat,5,2).substr($fechat,2,2);
        $cdig	= $cdig.$fes;

        //CAMPO 7 - TIPO DE CAMBIO +6
        $ce		= (int)($tc);
        $cdd	= (($tc-$ce)*10000);
        $ces	= trim(substr($ce,0,2));
        $cds	= trim(substr($cdd,0,4));

        if (strlen($cds)<4){
            $cds	= '0'+$cds;
        }
        $tcs	= $ces.$cds;
        //echo $tcs."-";
        $cdig	= $cdig.$tcs;

        //CAMPO 8 - MONTO - CANTIDAD TOTAL DEL RECIBO +9
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

        //CAMBIAR A LETRAS

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
