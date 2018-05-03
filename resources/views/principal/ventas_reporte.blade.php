@extends('principal.layout')
@section('title', 'REPORTE DE VENTAS')
@push('styles')
    <!-- daterange picker -->
    <link rel="stylesheet" href="adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css">
@endpush
@section('content')
    <div class="row">
        <div class="col-xs-12">

        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <!-- Date range -->
                    <div class="form-group col-sm-6">
                        <label>Rango de Fechas: </label>

                        <div class="input-group ">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="rangofechas">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Ejecutivo: </label>

                        <select class="form-control" id="ejecutivo" name="ejecutivo">
                            <option value="0">Selecciona Ejecutivo</option>
                            @foreach($ejecutivos as $ejecutivo)
                                <option value="{{$ejecutivo->id}}">{{$ejecutivo->nvendedor}}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
            </div>
            <div class="box">
                <!-- <div class="box-header">
                  <h3 class="box-title">Data Table With Full Features</h3>
                </div> -->
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped table-responsive">
                        <thead>
                        <tr>
                            <th>FECHA</th>
                            <th>FOLIO</th>
                            <th>EXPEDIENTE</th>
                            <th>EJECUTIVO</th>
                            <th>PAX</th>
                            <th>CLIENTE</th>
                            <th>DESTINO</th>
                            <th>F. SALIDA</th>
                            <th>PRECIO PAQUETE</th>
                            <th>MONEDA</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($registros as $registro)
                            <tr>
                                <td>{{$registro->fechahora}}</td>
                                <td>{{$registro->folexpo}}</td>
                                <td>{{$registro->cid_expedi}}</td>
                                <td>{{Auth()->User()->name}}</td>
                                <td>{{$registro->numpax}}</td>
                                <td>{{$registro->cnombre}} {{$registro->capellidop}} {{$registro->capellidom}}</td>
                                <td>{{$registro->destino}}</td>
                                <td>{{$registro->fsalida}}</td>
                                <td>{{$registro->totpaquete}}</td>
                                <td>{{$registro->moneda}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            $('#example1').DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron registros",
                    "info": "Pagina _PAGE_ de _PAGES_",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    "sSearch": "Buscar",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente"
                    }
                }
            });
            $('#rangofechas').daterangepicker()
        });

    </script>
    <!-- date-range-picker -->
    <script src="adminlte/bower_components/moment/min/moment.min.js"></script>
    <script src="adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
@endpush