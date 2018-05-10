@extends('principal.layout')
@section('title', 'CAPTURA DE DATOS')
@push('styles')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            top: 10px;
            width: 45px;
            height: 23px;
        }

        .switch input {display:none;}

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0px;
            left: 0px;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 2px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    @endpush
@section('content')
    <script
            src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous"></script>
    <section class="content">
        <div class="row">
        <form role="form" action="{{route('clientes_expo.store')}}" method="post">
            @csrf
                <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-danger">
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div class="form-group">
                        <label class="col-sm-5">Tipo de Cambio: {{$tcambio->tcambio}} </label>
                        </div>

                        <div class="form-group">
                            <!-- Rounded switch -->
                            <label class="switch">
                                <input type="checkbox" id="cotizacion" name="status" checked>
                                <span class="slider round"></span>
                            </label>
                            <label>GUARDAR REGISTRO COMO COTIZACIÓN</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos del Cliente</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-4" >Nombre(s)</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="Nombre" name="cnombre" placeholder="Nombre(s)" required="required" >
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-4" name="capellidop">Apellido Paterno</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="AP" name="capellidop" placeholder="Apellido Paterno" required="required" >
                        </div>
                    </div><br><br>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-4" >Apellido Materno</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="AM" name="capellidom" placeholder="Apellido Materno" >
                        </div>
                    </div><br><br>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-4">Lada</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="Lada" name="clada" placeholder="Lada" required="required" >
                        </div>
                    </div><br><br>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="col-sm-4">Teléfono</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <input type="tel" class="form-control" id="Tel" name="ctelefono" placeholder="Teléfono" required="required" >
                            </div>
                        </div>
                    </div><br><br>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-4">Ext.</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="Ext" name="cext" placeholder="Ext" >
                        </div>
                    </div><br><br>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="col-sm-4">Tipo</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="Tipo" name="ctipotel">
                                <option value="CELULAR">	CELULAR	</option>
                                <option value="HOGAR">		HOGAR	</option>
                                <option value="OFICINA">	OFICINA	</option>
                                <option value="RADIO">		RADIO	</option>
                                <option value="RECADOS">	RECADOS	</option>
                               
                            </select>
                        </div>
                    </div><br><br>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-4">Correo Electronico</label>
                        <div class="col-sm-8" >
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control" id="Email" name="cmail" placeholder="Email" required="required" >
                            </div>
                        </div>
                    </div>


                    <!-- /.box-body -->

                    <div class="box-footer">
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-7">
                <!-- general form elements -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Destino</h3>
                    </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Clave MT</label>
                                       <div class="input-group">
                                        <input type="text" class="form-control" id="mt" name="cid_destin" placeholder="MT">
                                            <span class="input-group-btn">
                                                <button id="buscaMT" name="buscaMT" onclick="BuscaMT(2)" type="button" class="btn btn-info btn-flat">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                      </div>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Destino</label>

                                        <input type="text" class="form-control" id="destino" name="destino" placeholder="Destino" 
                                        required list="cid_destino" onkeyup="BuscaMT(1)" autocomplete="off"  
                                        onpaste="return false;" onblur="verificaDest(this); monedaP();">
                                        <datalist id="cid_destino"></datalist>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-4">Fecha de Salida</label>
                                <div class="col-sm-8">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="input-sm form-control" id="Fsalida" name="fsalida" min="{{$fecha}}" value="{{$fecha}}">
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div><br>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-4">No. Pasajeros</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="Nopas" name="numpax" placeholder="No. Pasajeros" min="1" required="required" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-4">Comentarios</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." id="Comentarios" name="observa"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- /.box-body -->

                        <div class="box-footer">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                    <!-- general form elements -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Importe</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">
                            <div>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Importe Total del Paquete</label>
                                        <input type="text" class="form-control" id="Total" name="totpaquete" placeholder="Importe Total" >
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" >Moneda del Paquete</label>
                                            <input type="hidden" class="form-control" id="MonedaPack" name="moneda" placeholder="USD" value="USD">
                                            <input type="text" class="form-control" placeholder="USD" value="DÓLARES-USD" disabled>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Importe del Anticipo</label>
                                            <input type="text" class="form-control" id="anticipo" name="impteapag" placeholder="Anticipo">
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Moneda del Anticipo</label>
                                            <select class="form-control" id="monedaAnt" name="monedap">
                                                <option value="MXN">PESOS - MXN</option>
                                                <option value="USD">DÓLARES - USD</option>
                                            </select>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-4">Importe con Letra</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="impteletra" name="letras">
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">

                            </div>
                        </div>
                     </div>
                <div>
                    <button class="btn btn-primary">Guardar</button>
                </div>
            </div>

        </form>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $('#Anticipo').click(function () {

                var num = $('input:text[name=impteapag]').val();


                $('#Letras').val($("#Anticipo").val());
            })
        });


    //BUSCA MT 
    function BuscaMT(tipo){
        var mt;
        var destino;
        if(tipo == 2){ //BUSCA CLAVE MT
            mt = $("#mt").val();
            alert(mt);
            if(mt!=''){
                $.ajax({
                    type: "POST",
                    url: "busqueda-paquete",
                    data: {
                    "_token": "{{ csrf_token() }}",
                    "mt": mt,
                    "busqueda": tipo
                    },
                    success: function(data){
                        if(data == 'NO'){
                            alert('MT NO ENCONTRADO');
                            $("#destino").val('');
                            $("#mt").val('');
                            $("#mt").focus();
                        }else{
                            $("#destino").focus();
                            $("#destino").val(data);
                        }
                            console.log(data);
                    }
                });
            }else{
                alert('INGRESE CLAVE MT PARA REALIZAR LA BÚSQUEDA DEL DESTINO');
                $("#mt").focus();
            }
        }
        if(tipo == 1){ //BUSCA DESTINO INGRESADO 
            destino = $("#destino").val();
            $.ajax({
                type: "POST",
                url: "busqueda-paquete",
                data: {
                "_token": "{{ csrf_token() }}",
                "destino": destino,
                "busqueda":tipo
                },
                success: function(data){
                    $("#cid_destino").empty();
                    $("#cid_destino").append(data);
                }
            });
        }
    }

    $(document).on('change','#anticipo, #monedaAnt', function() { 
        ajaxConvertir(); 
        });

    $("#anticipo").bind('keyup keypress change',function (e) {
        ajaxConvertir();
    });

    function ajaxConvertir()
    {
        var anticipo	= $("#anticipo").val();
		var destino 	= $("#destino").val();
        var moneda = $("#monedaAnt").val();
		if(anticipo!='' || destino !=''){
			$.ajax({
				type: "POST",
				url: "convertidor",
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
		}else{
			alert('PRIMERO INGRESE UN DESTINO');
			$("#destino").focus();
			$("#impteletra").text('');
			$("#anticipo").empty();
			return false;
		}
    }
    </script>
@endpush