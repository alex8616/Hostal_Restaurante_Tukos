@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<br><br><hr>
<div class="card">
    <div class="card-body">
        <div class="form-group row">
            <div class="col-md-4 text-center">
                @if ($comanda->cliente_id != 0)
                    <label class="form-control-label "><strong>Cliente</strong></label>
                    <p>{{ucwords($comanda->cliente->Nombre_cliente)}} {{ucwords($comanda->cliente->Apellidop_cliente)}}</p>
                @else
                    <label class="form-control-label "><strong>Pensionado</strong></label>
                    @foreach ($tipoclientes as $tipocliente)  
                    @endforeach
                    <p>{{ $tipocliente->Nombre_tipoclientes }} </p>
                @endif
            </div>
            <div class="col-md-4 text-center">
                <label class="form-control-label"><strong>Número Venta</strong></label>
                <p>{{$comanda->id}}</p>
            </div>
            <div class="col-md-4 text-center">
                <label class="form-control-label"><strong>Vendedor</strong></label>
                <p>{{Str::ucfirst($comanda->user->name)}}</p>
            </div>
        </div>
        <div class="form-group">
            <h4 class="card-title text-bold">Detalles de venta</h4>
            <div class="table-responsive col-md-12 table-bordered shadow-lg">
                <table id="saleDetails" class="table table-striped">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Plato</th>
                            <th>Comentario</th>
                            <th>Precio Venta (Bs)</th>
                            <th>Descuento(Bs)</th>
                            <th>Cantidad</th>
                            <th>SubTotal(Bs)</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="5">
                                <p align="right">TOTAL:</p>
                            </th>
                            <th>
                                <p align="left">Bs. {{number_format($comanda->total,2)}}</p>
                            </th>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <p align="left">Son: {{$numtext}}</p>
                            </td>
                        </tr>
                    </tfoot>
                    
                    <tbody>
                        @foreach($detallecomandas as $detallecomanda)
                        <tr>
                            <td>{{ucwords($detallecomanda->plato->Nombre_plato)}}</td>
                            <td>{{$detallecomanda->comentario}}</td>
                            <td>Bs. {{$detallecomanda->precio_venta}}</td>
                            <td>{{$detallecomanda->descuento}} %</td>
                            <td>{{$detallecomanda->cantidad}}</td>
                            <td align="left">Bs. {{number_format($detallecomanda->cantidad*$detallecomanda->precio_venta - $detallecomanda->cantidad*$detallecomanda->precio_venta*$detallecomanda->descuento/100,2)}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer text-muted">
        <a href="{{route('admin.comanda.index')}}" class="btn btn-primary float-right">Regresar</a>
    </div>
</div>
</div>
@endsection
<link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 

@push('js')

@notifyJs
@endpush