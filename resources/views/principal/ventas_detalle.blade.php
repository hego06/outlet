@extends('principal.layout')
@section('title', 'DETALLE DE VENTAS')
@push('styles')
@endpush
@section('content')
    <div class="row">

        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos de la Venta</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                        <table id="example1" class="table table-striped">
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
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$registros->fechahora}}</td>
                                    <td>{{$registros->folexpo}}</td>
                                    <td>{{$registros->cid_expedi}}</td>
                                    <td>{{Auth()->User()->name}}</td>
                                    <td>{{$registros->numpax}}</td>
                                    <td>{{$registros->cnombre}} {{$registros->capellidop}} {{$registros->capellidom}}</td>
                                    <td>{{$registros->destino}}</td>
                                    <td>{{$registros->fsalida}}</td>
                                    <td>{{$registros->totpaquete}}</td>
                                    <td>{{$registros->moneda}}</td>
                                 </tr>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Registro de Pagos</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>FOLIO DE SOLICITUD</th>
                                <th>FECHA DE PAGO</th>
                                <th>FORMA DE PAGO</th>
                                <th>MONTO</th>
                                <th>MONEDA</th>
                                <th>INTERCAMBIO</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recibos as $registro)
                                <tr>
                                    <td>{{$registro->cid_solici}}</td>
                                    <td>{{$registro->fechsaop}}</td>
                                    <td>{{$registro->concepto}}</td>
                                    <td>{{$registro->monto}}</td>
                                    <td>{{$registro->moneda}}</td>
                                    <td>{{$registro->intercam}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="box box-danger">
                <div class="box-body no-padding">
                    <table class="table table-condensed">
                        <tbody>
                        <tr>
                            <th>Totales por Forma de Pago</th>
                        </tr>
                        <tr>
                            <th>Efectivo:</th>
                            <td>{{$efectivo}}</td>
                            <th>Tarjeta:</th>
                            <td>{{$tarjeta}}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="box box-danger">
                <div class="box-body no-padding">
                    <table class="table table-condensed">
                        <tbody>
                        <tr>
                            <th>Totales por Moneda</th>
                        </tr>
                        <tr>
                            <th>MXN:</th>
                            <td>{{$MXN}}</td>
                            <th>USD:</th>
                            <td>{{$USD}}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
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
@endpush