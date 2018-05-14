<?php

namespace App\Http\Controllers;

use App\User;
use App\Recibodig;
use App\ClientesExpo;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel as Excel;

class ExcelController extends Controller
{
   public function exportVentas(){


		\Excel::create('Ventas', function($excel) {

		   $ejecutivos=User::all();

	       $registros=ClientesExpo::where('status','P')->get();
	       $ventas=ClientesExpo::where('status','P')->selectRaw('count(*) as Ventas')
            ->first();
		        $pax=ClientesExpo::where('status','P')->sum('numpax');
		        $USDVe=ClientesExpo::where('status','P')->where('moneda','USD')->sum('totpaquete');
		        $USDVe=number_format($USDVe,2);
		        $MXNVe=ClientesExpo::where('status','P')->where('moneda','MXN')->sum('totpaquete');
		        $MXNVe=number_format($MXNVe,2);
		        $USDIg=Recibodig::where('cancelado',0)->where('moneda','USD')->sum('monto');
		        $USDIg=number_format($USDIg,2);
		        $MXNIg=Recibodig::where('cancelado',0)->where('moneda','MXN')->sum('monto');
		        $MXNIg=number_format($MXNIg,2);

		    $excel->sheet('Ventas', function($sheet) use($registros, $ventas,$pax, $USDVe, $USDIg, $MXNVe, $MXNIg) {

		   
		    $sheet->row(2, ['','','','','REPORTE DE VENTAS']);
		    $sheet->row(4, ['FECHA','FOLIO','EXPEDIENTE','EJECUTIVO','PASAJEROS','CLIENTE','DESTINO','FECHA SALIDA','PRECIO PAQUETE','MONEDA','CONCEPTO', 'MONTO','MONEDA']);
		    $j=0;$i=1;
		    foreach ($registros as $index => $regi) {
		    	
		    	$nombre=$regi->cnombre." ".$regi->capellidop." ".$regi->capellidom;
		    	$sheet->row($index+5+$j,[$regi->fechahora,
                               $regi->folexpo,
                               $regi->cid_expedi,
                               $regi->nvendedor,
                               $regi->numpax,
                               $nombre,
                               $regi->destino,
                               $regi->fsalida,
                               $regi->totpaquete,
                               $regi->moneda,
                               '','',''
                           ]);
		    	
		    	$pagos=Recibodig::where('cid_expediente',$regi->cid_expedi)->where('cancelado',0)->get();
		    	foreach ($pagos as $pago) {
		    		$sheet->row($index+6+$i,['','','','','','','','','','',
		    			$pago->concepto,
		    			$pago->monto,
		    			$pago->moneda
		    		]);
		    		$i=$i+1;
		    	}
		    	$j=$i;
		    }
		    $sheet->row($j+12,['Total de Ventas','Total de Pasajeros','Total USD Ventas','Total MXN Ventas','Total USD Ingresos','Total MXN Ingresos']);
		    $sheet->row($j+13,[$ventas->Ventas, $pax,$USDVe,$MXNVe,$USDIg,$MXNIg]);

		}

	);

		})->export('xlsx');

	}
}
