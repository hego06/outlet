@extends('principal.layout')
@section('title', 'CAPTURA DE DATOS')
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
            <div class="col-md-5">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos del Cliente</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-4" >Nombre(s)</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="Nombre" name="cnombre" placeholder="Nombre(s)" required="required" value="norberto">
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-4" name="capellidop">Apellido Paterno</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="AP" name="capellidop" placeholder="Apellido Paterno" required="required" value="hernandez">
                        </div>
                    </div><br><br>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-4" >Apellido Materno</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="AM" name="capellidom" placeholder="Apellido Materno" value="gonzalez">
                        </div>
                    </div><br><br>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-4">Lada</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="Lada" name="clada" placeholder="Lada" required="required" value="044">
                        </div>
                    </div><br><br>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="col-sm-4">Teléfono</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <input type="tel" class="form-control" id="Tel" name="ctelefono" placeholder="Teléfono" required="required" value="09090">
                            </div>
                        </div>
                    </div><br><br>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-4">Ext.</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="Ext" name="cext" placeholder="Ext" value="89">
                        </div>
                    </div><br><br>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="col-sm-4">Tipo</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="Tipo" name="ctipotel">
                                <option>option 1</option>
                                <option>option 2</option>
                               
                            </select>
                        </div>
                    </div><br><br>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-4">Correo Electronico</label>
                        <div class="col-sm-8" >
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control" id="Email" name="cmail" placeholder="Email" required="required" value="example@ex.com">
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
                                        <input type="text" class="form-control" id="MT" name="cid_destin" placeholder="MT" value="mt01">
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

                                        <input type="text" class="form-control" id="destino" name="destino" placeholder="Destino" value="malasia">

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
                                    <input type="number" class="form-control" id="Nopas" name="numpax" placeholder="No. Pasajeros" min="1" required="required" value="3">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-4">Comentarios</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." id="Comentarios" name="observa">Esto es un comentario</textarea>
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
                                        <input type="text" class="form-control" id="Total" name="totpaquete" placeholder="Importe Total" value="1000">
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" >Moneda del Paquete</label>
                                            <input type="text" class="form-control" id="MonedaPack" name="monedap" placeholder="USD">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Importe del Anticipo</label>
                                            <input type="text" class="form-control" id="Anticipo" name="impteapag" placeholder="Anticipo" value="100">
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Moneda del Anticipo</label>
                                            <select class="form-control" id="MonedaAnt" name="moneda">
                                                <option>option 1</option>
                                                <option>option 2</option>
                                            </select>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-4">Importe con Letra</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="Letra" name="letras" placeholder="" hidden="hidden" value="importe con letra">
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">

                            </div>
                        </div>
                     </div>
                <div>
                    <button>Guardar</button>
                </div>
            </div>

        </form>
        </div>
    </section>

    <script src="../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
        $('#datepicker').datepicker({
            startDate: 'd/n/Y',
            autoclose: true
        });
    </script>
@endsection