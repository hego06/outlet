@extends('principal.layout')
@section('title', 'INICIO')
@push('styles')
@endpush

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                       <h2><p>Registro de<br>
                               Información</p></h2>
                    </div>
                    <div class="icon">
                        <i class="fa fa-clipboard"></i>
                    </div>
                    <a href="{{route('clientes_expo.store')}}" class="small-box-footer">
                        Ir <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
            <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h2><p>Registros<br>
                                Capturados</p></h2>
                    </div>
                    <div class="icon">
                        <i class="fa fa-file-text-o"></i>
                    </div>
                    <a href="{{route('clientes_expo.index')}}" class="small-box-footer">
                        Ir <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h2><p>Tipo de<br>
                                Cambio</p></h2>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money"></i>
                    </div>
                    <a href="{{route('tipo_cambio.create')}}" class="small-box-footer">
                        Ir <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h2><p>Solicitudes<br>
                                de Pago</p></h2>
                    </div>
                    <div class="icon">
                        <i class="fa fa-newspaper-o"></i>
                    </div>
                    <a href="{{route('solicitudes_pago.index')}}" class="small-box-footer">
                        Ir <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection