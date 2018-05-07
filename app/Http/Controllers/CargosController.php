<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CargosController extends Controller
{
    function cargosB(Request $request)
    {
        $cid_tpv	= trim(strchr($request->terminal,"|",true));
        $cargos = DB::table('cargos')->where('cid_tpv',$cid_tpv)->get();
        
        echo '<option value="">SELECCIONE CARGOS</option>';

        if(!$cargos->isEmpty()) {
            foreach($cargos as $cargo)
            {
                $nombre = $cargo->cargo." - ".$cargo->mes." - ".$cargo->vtas." - ".$cargo->bco." - ".$cargo->obs;
                $tpv = $cargo->cargo.'-'.$cargo->cid_tpv.'-'.$cargo->nid_cargo."-".$cargo->mes."-".$cargo->vtas."-".$cargo->bco." - ".$cargo->obs;
                echo "<option value='$tpv'>".$nombre."</option>";
            }
        } 
        else {
            echo "<option selected='selected'>SIN CARGOS</option>";
        }
    }

    function bancoA(Request $request)
    {
        echo "bancoa";

        $tpv	= trim(strchr( $request->terminal,"|",true));
  	    $numint	= trim(strchr($request->terminal,"|"),"|");

        //$bancos = DB::select("SELECT * , bancos.numcuenta, bancos.uso, bancos.numint FROM ckbancos JOIN bancos ON ckbancos.numbanco= bancos.numbanco WHERE bancos.tpv='$tpv' AND bancos.numint='01'");
        $bancos = DB::table('ckbancos')
            ->join('bancos', 'ckbancos.numbanco', '=', 'bancos.numbanco')
            ->select('ckbancos.*', 'bancos.numcuenta', 'bancos.numint', 'bancos.uso')
            ->where("bancos.tpv", $tpv)
            ->where("bancos.numint",$numint)
            ->get();
            if(count($bancos) > 0){
                foreach($bancos as $banco)
                {
                    $nombre = $banco->nombre." - ".$banco->numcuenta." - ".$banco->uso." - ".$banco->numint;
                    $cuenta = $banco->numbanco." - " .$banco->numint;
                    echo "<option value='$cuenta'>$nombre</option>";
                }
            }
            else{
                echo "<option selected='selected'>SIN BANCOS</option>";
            }
    }

    function datosB(Request $request)
    {
        $numint		= trim(strchr($request->terminal,"|"),"|");
        $busqueda 	= DB::table('bancos')
                    ->where('numint', $numint)->first();

        $titular 	= $busqueda->titular;
        $moneda 	= $busqueda->moneda;
        $numbanco 	= $busqueda->numbanco;

        if($moneda == 'MXN'){
            $moneda_ = 'PESOS - MXN';
        }else{
            $moneda_ = 'DÓLARES - USD';
        }
    
        $fechaop 	= date('Y-m-d');
        $n_cuenta 	= $busqueda->numcuenta;
    
            
        $bancoN		= DB::table('ckbancos')
                        ->where('numbanco',$numbanco)->first();
        $nbanco 	= $bancoN->nombre;

        $datos =
            ['titular'=> $titular, 
            'nombre'=>$nbanco, 
            'moneda'=>$moneda, 
            'fecha'=>$fechaop, 
            'cuenta'=>$n_cuenta];
    
        echo json_encode($datos);
    }
}
