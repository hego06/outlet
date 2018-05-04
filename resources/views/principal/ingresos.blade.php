@extends('principal.layout')
@section('title', 'REPORTE DE INGRESOS')
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
                    <div class="row">
                        <div class="col-sm-4">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th colspan="3" align="center">EXPEDIENTES</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th>No. Expediente</th>
                                    <th>MXN</th>
                                    <th>USD</th>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-8">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th colspan="2">INGRESOS TARJETA BANCARIA</th>
                                    <th colspan="2">INGRESOS EFECTIVO</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th>MXN</th>
                                    <th>USD</th>
                                    <th>MXN</th>
                                    <th>USD</th>
                                    <th>MONEDA</th>
                                    <th></th>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

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