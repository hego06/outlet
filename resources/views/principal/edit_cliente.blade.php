@extends('principal.layout')
@section('title', 'EDITAR DATOS')
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
                                <label class="col-sm-5">Tipo de Cambio: {{$cliente->tc}} </label>
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
                                    <input type="text" class="form-control" id="Nombre" name="cnombre" placeholder="Nombre(s)" required="required" value="{{$cliente->cnombre}}" >
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-4" name="capellidop">Apellido Paterno</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="AP" name="capellidop" placeholder="Apellido Paterno" required="required" value="{{$cliente->capellidop}}" >
                                </div>
                            </div><br><br>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-4" >Apellido Materno</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="AM" name="capellidom" placeholder="Apellido Materno" value="{{$cliente->capellidom}}" >
                                </div>
                            </div><br><br>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-4">Lada</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="Lada" name="clada" placeholder="Lada" required="required" value="{{$cliente->clada}}" >
                                </div>
                            </div><br><br>
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="col-sm-4">Teléfono</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input type="tel" class="form-control" id="Tel" name="ctelefono" placeholder="Teléfono" required="required" value="{{$cliente->ctelefono}}" >
                                    </div>
                                </div>
                            </div><br><br>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-4">Ext.</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="Ext" name="cext" placeholder="Ext" value="{{$cliente->cext}}" >
                                </div>
                            </div><br><br>
                            <div class="form-group">
                                <label for="exampleInputPassword1" class="col-sm-4">Tipo</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="Tipo" name="ctipotel"  >
                                        @if($cliente->ctipotel=='CELULAR')
                                            <option value="CELULAR" selected>	CELULAR	</option>
                                        @elseif($cliente->ctipotel=='HOGAR')
                                            <option value="HOGAR" selected>		HOGAR	</option>
                                        @elseif($cliente->ctipotel=='OFICINA')
                                            <option value="OFICINA">	OFICINA	</option>
                                        @elseif($cliente->ctipotel=='RADIO')
                                            <option value="RADIO">		RADIO	</option>
                                        @elseif($cliente->ctipotel=='RECADOS')
                                            <option value="RECADOS">	RECADOS	</option>
                                        @endif
                                    </select>
                                </div>
                            </div><br><br>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-4">Correo Electronico</label>
                                <div class="col-sm-8" >
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="email" class="form-control" id="Email" name="cmail" placeholder="Email" required="required" value="{{$cliente->cmail}}" >
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
                                            <input type="text" class="form-control" id="MT" name="cid_destin" placeholder="MT" value="{{$cliente->cid_destin}}" >
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-info btn-flat">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Destino</label>

                                        <input type="text" class="form-control" id="destino" name="destino" placeholder="Destino" value="{{$cliente->destino}}" >

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
                                            <input type="text" class="input-sm form-control" id="Fsalida" name="fsalida" value="{{$cliente->fsalida}}" >
                                        </div>
                                    </div>
                                    <!-- /.input group -->
                                </div><br>
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="col-sm-4">No. Pasajeros</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="Nopas" name="numpax" placeholder="No. Pasajeros" min="1" required="required" value="{{$cliente->numpax}}" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="col-sm-4">Comentarios</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" rows="3" placeholder="Enter ..." id="Comentarios" name="observa" value="{{$cliente->observa}}" >{{$cliente->observa}}</textarea>
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
                                        <input type="text" class="form-control" id="Total" name="totpaquete" placeholder="Importe Total" value="{{$cliente->totpaquete}}"  >
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" >Moneda del Paquete</label>
                                        <input type="hidden" class="form-control" id="MonedaPack" name="monedap" placeholder="USD" value="DÓLARES-USD" >
                                        <input type="text" class="form-control" id="MonedaPack" name="monedap" placeholder="USD" value="DÓLARES-USD" disabled>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Importe del Anticipo</label>
                                        <input type="text" class="form-control" id="Anticipo" name="impteapag" placeholder="Anticipo" value="{{$cliente->impteapag}}"  >
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Moneda del Anticipo</label>
                                        <select class="form-control" id="MonedaAnt" name="moneda" >
                                            @if($cliente->monedap=='MXN')
                                                <option value="MXN" selected>PESOS - MXN</option>
                                            @else
                                                <option value="USD" selected>DÓLARES - USD</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-4">Importe con Letra</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" rows="3" id="Letra" name="letras" value="{{$cliente->letras}}" >{{$cliente->letras}}</textarea>
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
    </script>
@endpush