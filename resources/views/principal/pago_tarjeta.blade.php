@extends('principal.layout')
@section('title', 'PROCESAR PAGO CON TARJETA BANCARIA')
@push('styles')
@endpush
@section('content')
<form  method= "POST" action="{{route('tarjeta.store')}}">
    @csrf
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Información General de la Venta: </h3>
                </div>
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <th>Expediente</th>
                            <td colspan="3">{{$cliente->cid_expedi}}</td>
                        </tr>
                        <tr>
                            <th><label for="nombre">Nombre</label></th>
                            <td colspan="3"><input class="form-control input-sm" type="text" id="nombre" name="nombre" value="{{$cliente->cnombre}} {{$cliente->capellidop}} {{$cliente->capellidom}}" autocomplete="off" required></td>
                        </tr>
                        <tr>
                            <th>Destino</th>
                            <td colspan="3">{{$cliente->destino}}</td>
                        </tr>
                        <tr>
                            <th>Fecha de Salida</th>
                            <td>{{$cliente->fsalida}}</td>
                            <th>Pasajeros</th>
                            <td>{{$cliente->numpax}}</td>
                        </tr>
                        <tr>
                            <th>Teléfono</th>
                            <td colspan="3">({{$cliente->clada}})&nbsp;{{$cliente->ctelefono}}
                                <strong>&nbsp;&nbsp;Ext.:&nbsp;</strong>{{$cliente->cext}}</td>
                        </tr>
                        <tr>
                            <th>Correo Electrónico</th>
                            <td colspan="3">{{$cliente->cmail}}</td>
                        </tr>
                        <tr>
                            <th>Ejecutivo</th>
                            <td colspan="3">{{$cliente->nvendedor}}</td>
                        </tr>
                    </table>
                    <input type="hidden" name="elaboro" id="elaboro" value="{{Auth()->user()->cid_empleado}}">
                    <input type="hidden" name="folexpo" id="folexpo" value="{{$cliente->folexpo}}">
                    <input type="hidden" name="expediente" id="expediente" value="{{$cliente->cid_expedi}}">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos Bancarios Mega: </h3>
                </div>
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <th>Moneda</th>
                            <td>
                                <select class="form-control input-sm importe_t" id="moneda" name="moneda" required autofocus>
                                    <option value="MXN" selected="true">MXN</option>
                                    <!-- <option value="USD">USD</option> -->
                                </select>
                            </td>
                            <th>Terminal Bancaria</th>
                            <td>
                                <select class="form-control input-sm" id="terminal_t" name="terminal_t" required onchange="CargosB(this.value)">
                                    <option value=''> SELECCIONE LA TERMINAL </option>
                                    @foreach($terminales as $terminal)
                                        <option value="{{$terminal->cid_tpv}}|{{$terminal->numint}}">{{$terminal->terminalpv}}</option>
                                        @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Banco de Aplicación</th>
                            <td>
                                <select class="form-control input-sm" id="bancoaplic" name="bancoaplic" required >
                                </select>
                            </td>
                            <th>Cargos Administrativos y Bancarios</th>
                            <td>
                                <select class="form-control input-sm" id="cargos" name="cargos" required >
                                </select>
                            </td>
                        </tr>
                        <tr id="datosBanco" hidden></tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div id="datos_terminal"class="box">
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <th>Titular</th>
                            <td>
                                <input id="titular" type="text" name="titular" value="" readonly>
                                <input id="nbanco" type="text" name="nbanco" value="" readonly>
                            </td>
                            <th>Moneda:</th>
                            <td>
                                <input type="hidden" id="moneda_cuenta" name="moneda_cuenta" value="" readonly>
                                <input type="text" id="moneda_c" name="moneda_c" value="" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>Fecha Op.</th>
                            <td>
                                <input titular="fecha" type="hidden" name="foperacion" value="{{$fecha2}}">{{$fecha2}}
                            </td>
                            <th>No. Cuenta</th>
                            <td>
                                <input type="text" id="cuenta" name="cuenta" value="" readonly>
                            </td>
                        </tr>
                        <tr id="datosBanco" hidden></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos Bancarios Cliente: </h3>
                </div>
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <th>Instrumento</th>
                            <td>
                                <select class="form-control input-sm" id="instrumento" name="instrumento" required>
                                    <option value=""></option>
                                    <option value="DEBITO">DÉBITO</option>
                                    <option value="CREDITO">CRÉDITO</option>
                                </select>
                            </td>
                            <th>Codigo</th>
                            <td>
                                <input class="form-control input-sm" id="codigo" name="codigo" type="text" value="****"  readonly></td>
                            <th>Fecha de Tipo de Cambio</th>
                            <td>
                                <input class="form-control input-sm" id="ftc" name="ftc" type="text" value="{{$tc->fecha}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>Tarjeta</th>
                            <td>
                                <select class="form-control input-sm" id="tarjeta" name="tarjeta" required>
                                    <option value=""></option>
                                    <option value="VISA">VISA</option>
                                    <option value="MASTER CARD">MASTER CARD</option>
                                    <option value="AMERICAN EXPRESS">AMERICAN EXPRESS</option>
                                </select>
                            </td>
                            <th>Autorización</th>
                            <td>
                                <input class="form-control input-sm soloN" id="autorizacion" name="autorizacion" type="text" value="" minlength="2" maxlength="6" autocomplete="off" required>
                            </td>
                            <th>Tipo de Cambio $</th>
                            <td>
                                <input class="form-control input-sm" id="tc_b" name="tc_b" type="text" value="{{$tc->tcambio}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>Tipo</th>
                            <td>
                                <select class="form-control input-sm" id="tipotarjeta" name="tipotarjeta" required>
                                    <option value=""></option>
                                    <option value="NACIONAL">NACIONAL</option>
                                    <option value="EXTRANJERO">EXTRANJERO</option>
                                </select>
                            </td>
                            <th>Valida</th>
                            <td>
                                <input class="form-control input-sm" type="month" id="valido" name="valido" value="" required/>
                            </td>
                            <th align="right">Importe</th>
                            <td>
                                <input class="form-control input-sm importe_t" id="importe_t" name="importe_t" type="number" autocomplete="off" value="" required min="1" step="any">
                            </td>
                        </tr>
                        <tr height="40px">
                            <th>Procedencia</th>
                            <td>
                                <select class="form-control input-sm" id="procedencia" name="procedencia" required>
                                    @foreach($ckbancos as $banco)
                                        <option value="{{$banco->numbanco}}">{{$banco->nombre}}-{{$banco->numbanco}}</option>
                                        @endforeach
                                </select>
                            </td>
                            <th>Movimiento</th>
                            <td>
                                <input class="form-control input-sm" id="movimiento" name="movimiento" type="text" value="S.B.C." readonly />
                            </td>
                            <td colspan="2">
                                <textarea readonly class="form-control input-sm" name="impteletra" id="impteletra" style="max-height:60px; max-width:100%; width:100%; height:60px;"></textarea>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div align="center">
                <button class="btn btn-primary">Imprimir Recibo</button>
            </div>
        </div>
    </div>
</form>
@endsection
@push('scripts')
<script>
function CargosB(terminal){
	$.ajax({
		type: "POST",
		url: "{{route('cargos_b')}}",
		data: {
            '_token': '{{ csrf_token() }}',
            'terminal':terminal
        },
		success: function(data){
			$("#cargos").empty();
			$("#cargos").append(data);
            console.log('cargos'+data);
			bancoA(terminal);
            datosB(terminal);
		}
	});
}

function bancoA(terminal){
	$.ajax({
		type: "POST",
		url: "{{route('banco_a')}}",
		data: {
            '_token': '{{ csrf_token() }}',
            'terminal':terminal
        },
		success: function(data){
			$("#bancoaplic").empty();
			$("#bancoaplic").append(data);
            console.log(data);
		}
	});
}

function datosB(terminal){
	$.ajax({
		type: "POST",
		url: "{{route('datos_b')}}",
		data: {
            '_token': '{{ csrf_token() }}',
            'terminal':terminal
        },
        dataType: 'json',
		success: function(data){
			$("#titular").val(data.titular);
            $("#cuenta").val(data.cuenta);
            $("#moneda_cuenta").val(data.moneda);
            $("#moneda_c").val(data.moneda_c);
            $("#fecha").val(data.fecha);
            $("#nbanco").val(data.nombre);
		}
	});
}

    // $(document).on('change','#importe_t', function() { 
    //     ajaxConvertir(); 
    //     });
    $("#importe_t").bind('keypress keyup',function (e) {
        ajaxConvertir();
    });
    function ajaxConvertir()
    {
        var anticipo	= $("#importe_t").val();
        var moneda = $("#monedaAnt").val();
        $.ajax({
            type: "POST",
            url: "{{route('numeroLetra.convertidor')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                "anticipo": anticipo,
                "moneda": moneda
            },
            success: function(data){
                $('#impteletra').val(data);
                console.log(data);
            }
        });

    }
</script>
@endpush