@extends('principal.layout')
@section('title', 'RECIBO DE PAGO EN EFECTIVO')
@push('styles')
@endpush
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <div class="row">
        <div class="col-xs-12">
            <form role="form" action="{{route('pago_efectivo.store')}}" method="post">
                @csrf
                <input type="hidden" name="folexpo" id="folexpo" value="{{$cliente->folexpo}}">
                <input type="hidden" name="pax_principal" id="pax_principal" value="{{$cliente->cnombre}} {{$cliente->capellidop}} {{$cliente->capellidom}} x {{$cliente->numpax}}">
                <input type="hidden" name="expediente" id="expediente" value="{{$cliente->cid_expedi}}">
                <input type="hidden" name="cid_emplea" id="cid_emplea" value="{{$cliente->cid_emplea}}">
                <input type="hidden" name="ctelefono" id="ctelefono" value="{{$cliente->ctelefono}}">
                <input type="hidden" name="destino" id="destino" value="{{$cliente->destino}}">
                <input type="hidden" name="fsalida" id="fsalida" value="{{$cliente->fsalida}}" >
                <input type="hidden" name="tipo_c" id="tipo_c" value="{{$cliente->tc}}"    >
                <input type="hidden" name="ciniciales" id="ciniciales" value="{{$cliente->ciniciales}}">
                <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos Generales: </h3>
                </div>
                <div class="box-body">
                    <!-- Date range -->
                    <div class="form-group col-sm-3">
                        <div class="input-group ">
                            <label>Expediente:&nbsp;</label>{{$cliente->cid_expedi}}
                        </div>
                    </div>
                    <div class="form-group col-sm-4">
                        <div class="input-group ">
                            <label>Fecha/Hora:&nbsp;</label>{{$fecha}}
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="input-group ">
                            <label>Tipo:&nbsp;</label>RECIBO
                        </div>
                    </div>
                    <div class="form-group col-sm-3">
                        <div class="input-group ">
                            <label>Documento de Soporte:&nbsp;</label>EFECTIVO
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Información General de la Venta: </h3>
                    </div>
                    <div class="box-body">
                        <table class="table">
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
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Datos Complementarios: </h3>
                    </div>
                    <div class="box-body">
                        <table class="table">
                            <tr>
                                <th>Seleccionar Moneda</th>
                                <td colspan="2">
                                    <select class="form-control input-sm" id="monedaAnt" name="moneda_e" required>
                                        <option value="MXN">PESOS - MXN</option>
                                        <option value="USD">DÓLARES - USD</option>
                                    </select>
                                </td>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <th>Fecha de Operación</th>
                                <td colspan="5">{{$fecha2}}</td>
                            </tr>
                            <tr>
                                <th>Fecha de Tipo de Cambio</th>
                                <td colspan="2"><input type="hidden" name="fechatc" value="{{$tc->fecha}}">{{$tc->fecha}}</td>
                                <th colspan="2">Tipo de Cambio</th>
                                <td><input type="hidden" name="intercam" id="tc_e" value="{{$tc->tcambio}}">{{$tc->tcambio}}</td>
                            </tr>
                            <tr>
                                <th>Importe a Pagar</th>
                                <td><input class="form-control input-sm soloN" type="text" name="imptepag_e" id="anticipo" required="required" value=""  autocomplete="off"></td>
                                <td colspan="4">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="6"> <input type="text" readonly  class="form-control" id="impteletra" name="letras_e"></td>
                            </tr>
                            <tr hidden="true" class="importeUSD" id="importeUSD" name="importeUSD">
                                <th>Importe USD</th>
                                <td><input class="form-control input-sm soloN" type="text" name="impte_usd" id="impte_usd" value="" readonly></td>
                                <td colspan="4">&nbsp;</td>
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
        </div></form>

@endsection
@push('scripts')
    <script
            src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous"></script>
    <script>

        $(document).on('change','#anticipo, #monedaAnt', function() {
            ajaxConvertir();
        });

        $("#anticipo").bind('keyup keypress change',function (e) {
            ajaxConvertir();
        });

        function ajaxConvertir()
        {
            var anticipo	= $("#anticipo").val();
            var moneda = $("#monedaAnt").val();

                $.ajax({
                    type: "post",
                    url: "{{route('numeroLetra.convertidor')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "anticipo": anticipo,
                        "moneda": moneda
                    },
                    success: function (data) {
                        $('#impteletra').val(data);
                        console.log(data);
                    }
                });
        }
        $("#monedaAnt").change(function (e){
            var m_efectivo 	= $("#monedaAnt").val(); //Moneda del pago
            if(m_efectivo == 'MXN'){ //PESOS
                $("#importeUSD").attr("hidden", false); //MUESTRA INPUT PARA CONVERSIÓN
            }
            if(m_efectivo == 'USD' || m_efectivo == ''){ //DÓLARES O VACÍO
                $("#importeUSD").attr("hidden", true); 	//OCULTA INPUT PARA CONVERSIÓN
            }
        });
        $(document).on('change','#anticipo', function() {
            dolares();
            $("#anticipo").bind('keyup keypress change',function (e) {
                dolares();
            });
        });
        function dolares() {
            var m_efectivo 	= $("#monedaAnt").val(); //Moneda del pago
            if(m_efectivo == 'MXN'){ //PESOS
                $("#importeUSD").attr("hidden", false);
                var monto = $("#anticipo").val();//Monto a pagar
                var tc 		= $("#tc_e").val();
                tc 		= parseFloat(tc);
                monto 	= parseFloat(monto);
                var total	= monto/tc;
                total 	= total.toFixed(2);
                if(isNaN(monto)){
                    monto 	= 0;
                }
                if(isNaN(total)){
                    total = 0;
                }
                $("#impte_usd").val(total);//MUESTRA INPUT PARA CONVERSIÓN
            }
            if(m_efectivo == 'USD' || m_efectivo == ''){ //DÓLARES O VACÍO
                $("#importeUSD").attr("hidden", true); 	//OCULTA INPUT PARA CONVERSIÓN


            }
        }


        </script>
@endpush