@extends('principal.layout')
@section('title', 'CAPTURA DE DATOS')
@section('content')
    <script
            src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous"></script>
    <section class="content">
        <div class="row">
            <form role="form" action="" method="post">
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
                            <input type="text" class="form-control" id="Nombre" placeholder="Nombre(s)" required="required">
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-4" >Apellido Paterno</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="AP" placeholder="Apellido Paterno" required="required">
                        </div>
                    </div><br><br>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-4" >Apellido Materno</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="AM" placeholder="Apellido Materno">
                        </div>
                    </div><br><br>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-4">Lada</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="Lada" placeholder="Lada" required="required">
                        </div>
                    </div><br><br>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="col-sm-4">Teléfono</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <input type="tel" class="form-control" id="Tel" placeholder="Teléfono" required="required">
                            </div>
                        </div>
                    </div><br><br>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-4">Ext.</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="Ext" placeholder="Ext">
                        </div>
                    </div><br><br>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="col-sm-4">Tipo</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="Tipo">
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
                                <input type="email" class="form-control" id="Email" placeholder="Email" required="required">
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
                                        <input type="text" class="form-control" id="MT" placeholder="MT">
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

                                        <input type="text" class="form-control" id="destino" placeholder="Destino">

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
                                        <input type="text" class="input-sm form-control" id="Fsalida" min="{{$fecha}}" value="{{$fecha}}">
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div><br>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-4">No. Pasajeros</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="Nopas" placeholder="No. Pasajeros" min="1" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-4">Comentarios</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." id="Comentarios"></textarea>
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
                                        <input type="text" class="form-control" id="Total" placeholder="Importe Total">
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" >Moneda del Paquete</label>
                                            <input type="text" class="form-control" id="MonedaPack" placeholder="USD">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Importe del Anticipo</label>
                                            <input type="text" class="form-control" id="Anticipo" placeholder="Anticipo">
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Moneda del Anticipo</label>
                                            <select class="form-control" id="MonedaAnt">
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
                                    <input type="text" class="form-control" id="Letra" placeholder="" hidden="hidden">
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