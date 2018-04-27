@extends('principal.layout')
@section('title', 'CAPTURA DE DATOS')
@section('content')
    <section class="content">
        <div class="row">

            <div class="stepwizard col-md-offset-3">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step">
                        <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                        <p>Step 1</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-2" type="button" class="btn btn-default btn-circle">2</a>
                        <p>Step 2</p>
                    </div>
                </div>
            </div>
            <form role="form" action="" method="post">
                <!-- left column -->
            <div class="row setup-content" id="step-1">
            <div class="col-md-8 col-md-offset-3">
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
                            <input type="text" class="form-control" id="Nombre" placeholder="Nombre(s)">
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-4" >Apellido Paterno</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="AP" placeholder="Apellido Paterno">
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
                            <input type="email" class="form-control" id="Lada" placeholder="Lada">
                        </div>
                    </div><br><br>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="col-sm-4">Teléfono</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <input type="password" class="form-control" id="Tel" placeholder="Teléfono">
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
                                <input type="email" class="form-control" id="Email" placeholder="Email">
                            </div>
                        </div>
                    </div>


                    <!-- /.box-body -->

                    <div class="box-footer">
                        <a href="#step-2"><button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button></a>
                    </div>
                </div>
            </div>
         </div>
        </div>
        <div class="row setup-content" id="step-2">
            <div class="col-md-8 col-md-offset-3">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Destino</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-4">Destino</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="destino" placeholder="Destino">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-4" >Clave MT</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="MT" placeholder="Clave MT">
                                </div>
                            </div><br><br>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-4">Fecha de Salida</label>
                                <div class="col-sm-8">
                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" class="form-control pull-right" id="Fsalida">
                                </div>
                                </div>
                                <!-- /.input group -->
                            </div><br>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-4">No. Pasajeros</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="Nopas" placeholder="No. Pasajeros">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-4">Comentarios</label>
                                <div class="col-sm-8">
                                <textarea class="form-control" rows="3" placeholder="Enter ..." id="Comentarios"></textarea>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                              
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Importe</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Importe Total del Paquete</label>

                                        <input type="text" class="form-control" id="Total" placeholder="Importe Total">

                                </div>
                                <br><br>
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="col-sm-4" >Moneda del Paquete</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="MonedaPack" placeholder="USD">
                                    </div>
                                </div><br><br>
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="col-sm-4" >Importe del Anticipo</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="Anticipo" placeholder="Anticipo">
                                    </div>
                                </div><br><br>
                               <div class="form-group">
                                    <label for="exampleInputPassword1" class="col-sm-4">Moneda del Anticipo</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="MonedaAnt">
                                            <option>option 1</option>
                                            <option>option 2</option>

                                        </select>
                                    </div>
                                </div><br><br>
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="col-sm-4">Importe con Letra</label>
                                    <div class="col-sm-8">
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." id="Letra"></textarea>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">

                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
            </form>
        </div>
@endsection