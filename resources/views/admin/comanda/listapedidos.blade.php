@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<br><br><hr>
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="hero">
                    <h1 id="htitle"><span id="title">PLATOS PEDIDOS</span></h1><br>
                </div>
                <div id="orders-chart-legend" class="orders-chart-legend">
                    <div class="container">
                    @foreach ($PedidoPlatos as $PedidoPlato )
                        <div class="row" id="plas">
                            <div class="col-sm-8" id="plascol1">{{$PedidoPlato->Nombre_plato}}</div>
                            <div class="col-sm-4" id="plascol2"><h3>{{$PedidoPlato->cantidad}}</h3></div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="hero">
                    <h1 id="htitle"><span id="title">PLATOS MESAS</span></h1><br>
                </div>
                <div id="orders-chart-legend" class="orders-chart-legend">
                    <div class="container">
                    @foreach ($PedidoPlatoMesas as $PedidoPlatoMesa )
                        <div class="row" id="plas">
                            <div class="col-sm-8" id="plascol1">{{$PedidoPlatoMesa->Nombre_plato}}</div>
                            <div class="col-sm-4" id="plascol2"><h3>{{$PedidoPlatoMesa->cantidad}}</h3></div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

    <link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <link href="http://fonts.cdnfonts.com/css/dseg14-classic" rel="stylesheet">
    <link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 
    <link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 
<style>
 
    #plas{     
        margin-top: 1rem;
        background: #dbdfe5;
    }
    #plascol1{
        background-color: white;
        height: 60px;
        width: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: sans-serif;
        font-weight: bold;
        margin:5px 0px;
    }
    #plascol2{
        font-family: 'DSEG14 Classic', sans-serif;  
        background-color: #CFD2CF;
        height: 60px;
        width: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin:5px 0px;
    }
    .card{
        background-color: #343c44;
    }
    </style>
@notifyCss

@push('js')
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.8/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.8/js/responsive.bootstrap4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    <script>
          function actualizar(){location.reload(true);}
        //Función para actualizar cada 4 segundos(4000 milisegundos)
        setInterval("actualizar()",20500);
    </script>
    <script>
        $(document).ready(function() {
            $('.venta').DataTable({
                responsive: true,
                autoWidth: false,
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registro por página",
                    "zeroRecords": "No se encontro registro",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "search": "Buscar",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente"
                    },
                    "infoEmpty": "No hay registros",
                    "infoFiltered": "(Filtrado de _MAX_ registros totales)"
                },
                "lengthMenu": [
                    [5, 10, 50, -1],
                    [5, 10, 50, "All"]
                ]

            });
        });
    </script>
@endpush
