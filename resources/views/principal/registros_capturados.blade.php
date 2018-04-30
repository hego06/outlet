@extends('principal.layout')
@section('title', 'REGISTROS CAPTURADOS')
@section('content')
    @if(Session::has('flash_message'))
        <div class="alert alert-success alert-dismissible fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> {{Session::get('flash_message')}}
        </div>
    @endif
<div class="row">
  <div class="col-xs-12">
    
  </div>
</div>
<div class="row">
    <div class="col-xs-12">
    <div class="box">
            <!-- <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div> -->
            <!-- /.box-header -->
            <div class="box-body">
            <div class="row">
              <div class="col-xs-6">
                <h1>Calendario</h1>
              </div>
              <div class="col-xs-6">
                <h1>Agente de ventas</h1>
              </div>
            </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>FOLIO</th>
                  <th>EXPEDIENTE</th>
                  <th>EJECUTIVO</th>
                  <th>F. REGISTRO</th>
                  <th>MONEDA PAGO</th>
                  <th>ESTATUS</th>
                  <th>CLIENTE</th>
                  <th>DESTINO</th>
                  <th>ACCIONES</th>
                </tr>
                </thead>
                <tbody>
                @foreach($registros as $registro)
                  <tr>
                    <td>{{$registro->id}}</td>
                    <td></td>
                    <td>{{Auth()->User()->name}}</td>
                    <td>{{$registro->fechahora}}</td>
                    <td>{{$registro->monedap}}</td>
                    <td>{{$registro->status}}</td>
                    <td>{{$registro->cnombre}} {{$registro->capellidop}} {{$registro->capellidom}}</td>
                    <td>{{$registro->destino}}</td>
                    <td>
                        <a href="{{route('clientes_expo.edit', $registro)}}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                        <a href="{{route('clientes_expo.show',$registro)}}" class="btn btn-xs btn-info" target="_blank"><i class="fa fa-eye"></i></a>
                    </td>

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
    })
  });
</script>
@endpush