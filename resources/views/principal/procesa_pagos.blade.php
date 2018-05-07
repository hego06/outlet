@extends('principal.layout')
@section('title', 'PROCESAR RECIBOS DE PAGOS')
@push('styles')
    <style type="text/css">
        #div1 {
            overflow:scroll;
            height:150px;
        }
    </style>
    @endpush

@section('content')
    @if(Session::has('message1'))
        <div class="alert alert-success alert-dismissible fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> {{Session::get('message1')}}
        </div>
    @endif
    @if(Session::has('message2'))
        <div class="alert alert-danger alert-dismissible fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error!</strong> {{Session::get('message2')}}
        </div>
    @endif
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos del cliente</h3>
                </div>
                <div class="box-body no-padding">
                    <div class="form-group">
                        <label>&nbsp;&nbsp;&nbsp;&nbsp;Nombre:&nbsp;</label>{{$cliente->cnombre}} {{$cliente->capellidop}} {{$cliente->capellidom}}
                    </div>
                    <div class="form-group">
                        <label>&nbsp;&nbsp;&nbsp;&nbsp;Teléfono:&nbsp;</label>({{$cliente->clada}})&nbsp;{{$cliente->ctelefono}}
                        <label>&nbsp;&nbsp;Ext.:&nbsp;</label>{{$cliente->cext}}<label>&nbsp;Tipo:&nbsp;</label>{{$cliente->ctipotel}}
                    </div>
                    <div class="form-group">
                        <label>&nbsp;&nbsp;&nbsp;&nbsp;Email:&nbsp;</label><span  id="email_">{{$cliente->cmail}}</span>
                    </div>
                </div>
            </div>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos del paquete</h3>
                </div>
                <div class="box-body no-padding">
                    <div class="form-group">
                        <label>&nbsp;&nbsp;&nbsp;&nbsp;Destino:&nbsp;</label>{{$cliente->destino}}
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label>Total del Paquete:&nbsp;</label>{{number_format($cliente->totpaquete)}}&nbsp; {{$cliente->moneda}}
                        </div>
                        <div class="col-sm-6">
                            <label>&nbsp;Depto:&nbsp;</label>{{$cliente->nid_depto}}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                         <label>F. Salida:&nbsp;</label>{{$cliente->fsalida}}
                        </div>
                        <div class="col-sm-6">
                         <label>&nbsp;No. Pasajeros:&nbsp;</label>{{$cliente->numpax}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>&nbsp;&nbsp;&nbsp;&nbsp;Ejecutivo:&nbsp;</label>{{$cliente->nvendedor}}
                    </div>
                </div>
            </div>

            <div class="box box-info">
                <div class="box-body no-padding">
                    <table class="table table-condensed">
                        <tbody>
                        <tr>
                            <th>Comentario</th>
                        </tr>
                        <tr>
                            <td>{{$cliente->observa}}</td>
                        </tr>
                        
                    </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">A pagar</h3>
                </div>
                <div class="box-body no-padding">
                <table class="table table-condensed">
                    <tbody>

                    <tr>
                        <th>Folio:</th>
                        <td id='folexpo'>{{$cliente->folexpo}}</td>
                        @if($cliente->cid_expedi=='' and $cliente->status !='L')
                            <td>
                                <button class="btn btn-warning btn-sm g_liga" id='g_liga' name="g_liga">Generar liga bancaria</button>
                            </td>
                            <td>
                                <button class="btn btn-info btn-sm" id="generar_exp">Generar expediente</button>
                            </td>
                            @endif
                        @if($cliente->cid_expedi=='' and $cliente->status =='L')
                            <td><span class='text-danger'>LIGA BANCARIA</span></td>
                            @endif
                        @if($cliente->cid_expedi!='')
                            <th>Expediente:</th>
                            <td>{{$cliente->cid_expedi}}</td>
                            @endif

                    </tr>
                    <tr>
                        <th>Tipo cambio:</th>
                        <td>{{$cliente->tc}}</td>
                        <th>Importe a pagar:</th>
                        <td>{{number_format($cliente->impteapag)}} {{$cliente->monedap}}</td>
                    </tr>
                </tbody>
                </table>
                </div>
            </div>
            @if($cliente->cid_expedi!='')
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Detalles movimiento</h3>
                    </div>
                    <div class="box-body no-padding">
                        <div class="table-responsive" id="div1">
                            <table class="table table-hover table-striped">
                            <tbody>
                            <tr>
                                <th>Solicitud</th>
                                <th>Emitida</th>
                                <th>Recibo</th>
                                <th>Importe</th>
                                <th>Moneda</th>
                                <th>Descargar</th>
                                <th>Cancelar</th>
                            </tr>
                                <tr>
                                @foreach($solicitudes as  $solicitud)

                            <tr>
                                <td><a href="{{ asset('pdf/'.$solicitud->folio.'.pdf') }}" alt="Abrir PDF" target="_blank">{{$solicitud->cid_solicitud}}</a></td>
                                <td><a href="{{ asset('pdf/'.$solicitud->folio.'.pdf') }}" alt="Abrir PDF" target="_blank">{{$solicitud->fechaemitido}}</a></td>
                                <td><a href="{{ asset('pdf/'.$solicitud->folio.'.pdf') }}" alt="Abrir PDF" target="_blank">{{$solicitud->folio}}</a></td>
                                <td><a href="{{ asset('pdf/'.$solicitud->folio.'.pdf') }}" alt="Abrir PDF" target="_blank">{{$solicitud->importe}}</a></td>
                                <td><a href="{{ asset('pdf/'.$solicitud->folio.'.pdf') }}" alt="Abrir PDF" target="_blank">{{$solicitud->moneda}}</a></td>
                                <td align="center"> <a href="{{route('descargar_Pdf.descargarPDF',$solicitud->folio)}}"><i class="fa fa-cloud-download fa-2x" aria-hidden="true"></i></a></td>
                                @if($solicitud->estatus=='EM')

                                    <td align="center"><button class="btn btn-default"  onclick='cancelaR("{{$solicitud->folio}}","{{$cliente->folexpo}}","{{$solicitud->cid_solicitud}}")'><i class="fa fa-times-circle fa-2x" aria-hidden="true"></i></button></td>
                                @endif



                            </tr>
                                    @endforeach

                        </tbody>
                        </table>
                    </div>
                </div>
            @endif
            @if($cliente->cid_expedi=='' and $cliente->status !='P')
                @else
                <div class="row">
                    <div class="col-sm-6">
                        <div class="box box-success">
                            <div class="box-body no-padding">
                                <table class="table table-condensed">
                                    <tbody>
                                    <tr>
                                        <th>Modo de pago</th>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <div class="col-sm-6">
                                                <a href="{{route('efectivo_pago.create',$cliente->folexpo)}}"><i class="fa fa-money fa-2x fa-sm" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="{{route('tarjeta_pago.create',$cliente->folexpo)}}"><i class="fa fa-credit-card fa-2x fa-sm" aria-hidden="true"></i></a>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                <div class="col-sm-6">
                    <div class="box box-danger">
                        <div class="box-body no-padding">
                            <table class="table table-condensed">
                                <tbody>
                                <tr>
                                    <th>Totales</th>
                                </tr>
                                <tr>
                                    <th>MXN:</th>
                                    <td>{{$totalMXN}}</td>
                                    <th>USD:</th>
                                    <td>{{$totalUSD}}</td>
                                </tr>

                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
	$("#generar_exp").click(function (e) {
		var confirma = confirm("SE GENERARÁ EXPEDIENTE \n¿DESEA CONTINUAR? *ESTE PROCESO NO PODRÁ SER REVERTIDO*");
		if(confirma){ 
			$.ajax({
				type: "POST",
				url: "{{route('expediente.genera')}}", 
				data: {
                    "_token": "{{ csrf_token() }}",
                    "folExpo": "{{$cliente->folexpo}}"
                },
				success: function(data){
                    console.log(data);
					if(data == 'HECHO'){ 
						alert('EXPEDIENTE GENERADO');
						location.reload();
					}else{
						alert('ERROR AL GENERAR EXPEDIENTE, PONGASE EN CONTACTO CON EL ADMINISTRADOR DEL SISTEMA.');
						console.log(data);
					}
				}	
			});
		}else{
			return;
		}
	});


    //Genera Liga Bancaria
	$(".g_liga").click(function (e) {//Objeto con clase g_liga
		var folio 	= $("#folexpo").text(); //Obtenemos folexpo
		var email_	= $("#email_").text(); //Obtenemos email
		//MENSAJE PARA CONFIRMAR
		var confirma = confirm("SE ENVIARÁ LIGA DE PAGO BANCARIA AL CORREO "+email_+"\n¿DESEA CONTINUAR?");
		if(confirma){
			$.ajax({
				type: "POST",
				url: "{{route('ligaBancaria.envia')}}",
				data: {
                    "_token": "{{ csrf_token() }}",
                    "folio":folio
                },
				success: function(data){
					if(data == 'HECHO'){
						alert('LIGA BANCARIA ENVÍADA');
						location.reload();
					}else{
						alert('ERROR AL ENVIAR LIGA BANCARIA, PONGASE EN CONTACTO CON EL ADMINISTRADOR DEL SISTEMA.');
						console.log(data);
					}
				}	
			});
		}else{
			return;
		}
	});
    function cancelaR(recibo,folexpo,solicitud){
        var answer = confirm("Se cancelará el recibo con\n»No. Folio:  "+recibo+"\n\n×Este proceso no se puede revertir.×\n¿Desea continuar?")
        if (answer){
            var motivo	= prompt("Motivo de cancelación(Obligatorio): ");
            if(motivo!=undefined && motivo){
                //var datos = "folexpo="+folexpo+"&recibo="+recibo+"&motivo="+motivo+"&solicitud="+solicitud;
                $.ajax({
                    type: "POST",
                    url: "{{route('cancelar_pago.cancelarSolicitud')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "folexpo":folexpo,
                        "motivo":motivo,
                        "recibo":recibo,
                        "solicitud":solicitud
                    },
                    success:function (cancelarR) {
                        location.reload();
                    }
                });
               // window.location=('php/cancela_recibo.php?'+datos);
            }
        }
    }
    //);
</script>
@endpush