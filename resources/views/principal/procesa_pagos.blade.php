@extends('principal.layout')
@section('title', 'PROCESAR RECIBOS DE PAGOS')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos del cliente</h3>
                </div>
                <div class="box-body no-padding">
                    <div class="form-group">
                        <label>&nbsp;&nbsp;&nbsp;&nbsp;Nombre:&nbsp;</label>{{$cliente->cnombre}} {{$cliente->capellidop}} {{$cliente->capellidom}}
                    </div>
                    <div class="form-group">
                        <label>&nbsp;&nbsp;&nbsp;&nbsp;Teléfono:&nbsp;</label>({{$cliente->clada}})&nbsp;{{$cliente->ctelefono}}
                        <label>&nbsp;&nbsp;Ext.:&nbsp;</label>{{$cliente->cext}}<label>&nbsp;Tipo:&nbsp;</label>{{$cliente->ctipotel}}
                    </div>
                    <div class="form-group">
                        <label>&nbsp;&nbsp;&nbsp;&nbsp;Email:&nbsp;</label>{{$cliente->cmail}}
                    </div>
                </div>
            </div>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos del paquete</h3>
                </div>
                <div class="box-body no-padding">
                    <div class="form-group">
                        <label>&nbsp;&nbsp;&nbsp;&nbsp;Destino:&nbsp;</label>{{$cliente->destino}}
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label>Total del Paquete:&nbsp;</label>{{number_format($cliente->totpaquete)}}&nbsp; {{$cliente->moneda}}
                        </div>
                        <div class="col-sm-6">
                            <label>&nbsp;Depto:&nbsp;</label>{{$cliente->nid_depto}}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                         <label>F. Salida:&nbsp;</label>{{$cliente->fsalida}}
                        </div>
                        <div class="col-sm-6">
                         <label>&nbsp;No. Pasajeros:&nbsp;</label>{{$cliente->numpax}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>&nbsp;&nbsp;&nbsp;&nbsp;Ejecutivo:&nbsp;</label>{{$cliente->nvendedor}}
                    </div>
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
                <div class="box-header with-border">
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
                        <td>{{number_format($cliente->impteapag)}} {{$cliente->monedap}}</td>
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
            @if($cliente->cid_expedi=='' and $cliente->status !='P')
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
                                        <td align="center">
                                            <div class="col-sm-6">
                                                <a href="{{route('efectivo_pago.create',$cliente->folexpo)}}"><i class="fa fa-money fa-2x fa-sm" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href=""><i class="fa fa-credit-card fa-2x fa-sm" aria-hidden="true"></i></a>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                                </table>
                            </div>
                        </div>

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
            @endif
        </div>
    </div>
</section>
@endsection