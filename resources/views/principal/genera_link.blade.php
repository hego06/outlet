@extends('principal.layout')
@section('title', 'GENERA LINK DE PAGOS ONLINE')
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
                        <label>&nbsp;&nbsp;&nbsp;&nbsp;Destino:&nbsp;</label>{{$cliente->cid_destin}}
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

            @if($cliente->cid_expedi=='' and $cliente->status !='P')
                @else
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box box-success">
                            <div class="box-body no-padding">
                                <table class="table table-condensed">
                                    <tbody>
                                    <tr>
                                        <th>Datos para pago</th>
                                    </tr>
                                    <form action=""> 
                                    <tr>
                                           
                                        <td align="lefth">
                                            <div class="form-group col-sm-6">
                                                <label for="">Exp:</label>
                                                <input type="text" name="ID" value="{{$cliente->cid_expedi}}">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="">MT:</label>
                                                <input type="text" name="MT" value="{{$cliente->cid_destin}}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="lefth">
                                            <div class="form-group col-sm-4">
                                                <label for="TT">T. de trasacción:</label>
                                                <select name="TT">
                                                    <option value="C">C</option>
                                                    <option value="3M">3M</option>
                                                    <option value="6M">6M</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-4">
                                                <label for="">Importe:</label>
                                                <input type="text" name="TP" size="4">
                                            </div>
                                            <div class="form-group col-sm-4">
                                            <label for="">Divisa:</label>
                                            <input type="text" size="4">
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <div class="form-group col-sm-6">
                                            <label for="">correo:</label>
                                            <input type="text" name="M">
                                            <input type="hidden" name="DD" value="{{ date('Y-m-d') }}">
                                            <input type="hidden" name="FE" value="{{ date('Y-m-d') }}">
                                            <input type="hidden" name="MON" value="1">
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <div class="form-group-full">
                                            <input type="submit" value="Pagar">
                                        </div>
                                        </td>
                                    </tr>
                                    </form>

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