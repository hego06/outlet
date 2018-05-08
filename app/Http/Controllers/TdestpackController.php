<?php

namespace App\Http\Controllers;

use App\Tdestpack;
use Illuminate\Http\Request;

class TdestpackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function busqueda(Request $request)
    {
        $parametros = $request->all();

        $tipo= $parametros['busqueda'];


        if($tipo == 2)
        {
            $mt=$parametros['mt'];
            $paquete = Tdestpack::
            where('cid_destpack','LIKE','%'.$mt.'%')
            ->where('bactiva','S')
            ->where('cid_destpack','LIKE','MT%')
            ->where('cid_destpack','NOT LIKE', 'MTC%')->get();

            if (!$paquete->isEmpty()) {
                $cid_destpack	= strtoupper(trim($paquete->pluck('cid_destpack')[0]));
                $cdestpack 		= strtoupper(trim($paquete->pluck('cdestpack')[0]));
                $respuesta 		= $cdestpack.' § '.$cid_destpack;
                return $respuesta;
            }else{
                echo 'NO';
            }
        }
        else
        {
            $dest  = $parametros['destino'];
            $destinos = Tdestpack::take(10)
                        ->where('cdestpack','LIKE','%'.$dest.'%')
                        ->where('cid_destpack','LIKE','MT%')
                        ->where('cid_destpack','NOT LIKE', 'MTC%')
                        ->where('cid_destpack','NOT LIKE','MD%')
                        ->where('bactiva','S')->get();

            if (!$destinos->isEmpty()) {
                foreach($destinos as $destino){
                    $cid_destpack = strtoupper(trim($destino->cid_destpack));
                    $cdestpack = strtoupper(trim($destino->cdestpack));
                    $respuesta 		= $cdestpack.' § '.$cid_destpack;
                    echo "<option value='$respuesta'>$respuesta</option>";
                }
            }
        }

    }

}
