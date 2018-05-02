@extends('principal.layout')
@section('title', 'PROCESAR RECIBOS DE PAGOS')
@section('content')

<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Datos del cliente</h3>
                </div>
                <div class="box-body no-padding">
                <table class="table table-condensed">
                    <tbody>
                    <tr>
                        <th>Nombre:</th>
                        <td colspan="7">{{$cliente->cnombre}} {{$cliente->capellidop}} {{$cliente->capellidom}}</td>
                    </tr>
                    <tr>
                        <th>Teléfono:</th>
                        <td>{{$cliente->ctelefono}}</td>
                        <th>Lada:</th>
                        <td>{{$cliente->clada}}</td>
                        <th>Ext.:</th>
                        <td>{{$cliente->cext}}</td>
                        <th>Tipo:</th>
                        <td>{{$cliente->ctipotel}}</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>{{$cliente->cmail}}</td>
                    </tr>
                </tbody></table>
                </div>
            </div>
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Datos del paquete</h3>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-condensed">
                        <tbody>
                        <tr>
                            <th>Destino:</th>
                            <td colspan="2">{{$cliente->destino}}</td>
                        </tr>
                        <tr>
                            <th>Total del paquete:</th>
                            <td>{{$cliente->totpaquete}} {{$cliente->moneda}}</td>
                            <th>Depto:</th>
                            <td>{{$cliente->nid_depto}}</td>
                        </tr>
                        <tr>
                            <th>F. salida:</th>
                            <td>{{$cliente->fsalida}}</td>
                            <th>No. pasajeros:</th>
                            <td>{{$cliente->numpax}}</td>
                        </tr>
                        <tr>
                            <th>Ejecutivo</th>
                            <td>{{$cliente->nvendedor}}</td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
            <div class="box box-info">
                <div class="box-body no-padding">
                    <table class="table table-condensed">
                        <tbody>
                        <tr>
                            <th>Comentario</th>
                        </tr>
                        <tr>
                            <td>{{$cliente->observa}}</td>
                        </tr>
                        
                    </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">A pagar</h3>
                </div>
                <div class="box-body no-padding">
                <table class="table table-condensed">
                    <tbody>

                    <tr>
                        <th>Folio:</th>
                        <td>{{$cliente->folexpo}}</td>
                        @if($cliente->cid_expedi=='' and $cliente->status !='L')
                            <td>
                                <button class="btn btn-warning btn-sm">Generar liga bancaria</button>
                            </td>
                            <td>
                                <button class="btn btn-info btn-sm">Generar expediente</button>
                            </td>
                            @endif
                        @if($cliente->cid_expedi=='' and $cliente->status =='L')
                            <td><span class='text-danger'>LIGA BANCARIA</span></td>
                            @endif
                        @if($cliente->cid_expedi!='')
                            <th>Expediente:</th>
                            <td>{{$cliente->cid_expedi}}</td>
                            @endif

                    </tr>
                    <tr>
                        <th>Tipo cambio:</th>
                        <td>{{$cliente->tc}}</td>
                        <th>Importe a pagar:</th>
                        <td>{{$cliente->impteapag}} {{$cliente->monedap}}</td>
                    </tr>
                </tbody>
                </table>
                </div>
            </div>
            @if($cliente->cid_expedi!='')
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Detalles movimiento</h3>
                    </div>
                    <div class="box-body no-padding">
                        <table class="table table-condensed">
                            <tbody>
                            <tr>
                                <th>Solicitud</th>
                                <th>Emitida</th>
                                <th>Recibo</th>
                                <th>Importe</th>
                                <th>Moneda</th>
                                <th>Descargar</th>
                                <th>Cancelar</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
            @endif
            @if($cliente->cid_expedi=='' and $cliente->status !='L')
                @else
                <div class="row">
                    <div class="col-sm-6">
                    <div class="box box-success">
                    <div class="box-body no-padding">
                        <table class="table table-condensed">
                            <tbody>
                            <tr>
                                <th>Modo de pago</th>
                            </tr>
                            <tr>
                                <td><a href=""><i class="fa fa-money fa-3x fa-lg" aria-hidden="true"></i></a></td>
                                <td><a href=""><i class="fa fa-credit-card fa-3x fa-lg" aria-hidden="true"></i></a></td>
                            </tr>

                        </tbody>
                        </table>
                    </div>
                </div>
            @endif
                </div>
                <div class="col-sm-6">
                <div class="box box-danger">
                <div class="box-body no-padding">
                    <table class="table table-condensed">
                        <tbody>
                        <tr>
                            <th>Totales</th>
                        </tr>
                        <tr>
                            <th>MXN:</th>
                            <td></td>
                            <th>USD:</th>
                            <td></td>
                        </tr>
                        
                    </tbody>
                    </table>
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection