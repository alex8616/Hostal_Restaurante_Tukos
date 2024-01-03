@extends('adminlte::page')

@section('title', 'Reportes - Estadisticas')

@section('content_header')
    <h1>Gráfico de ventas</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <i class="fas fa-gift"></i>
                Ventas Mensuales
            </h4>
        <div class="table-responsive ">
                   <table class="table table-striped mt-0.5 table-bordered shadow-lg mt-4">
                    <thead class="bg-primary text-white">
                           <tr>
                               <th>Mes</th>
                               <th>Total Mes</th>
                               <th>Ver detalles</th>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach ($ventasmes as $total)
                           <tr>
                                   <td>{{ \Carbon\Carbon::createFromFormat('m', $total->mes)->formatLocalized('%B')}}</td>
                                   <td>Bs. {{ number_format($total->totalmes, 2) }}</td>
                                   <td>
                                        <a href="{{ route('admin.comanda.index') }}" class="small-box-footer h4">Ventas <i
                                        class="fa fa-arrow-circle-right"></i></a>
                                   </td>
                               </tr>
                           @endforeach
                       </tbody>
                </table>
            </div>


            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                <i class="fas fa-gift"></i>
                                Ventas diarias
                            </h4>
                            <canvas id="ventas_diarias" height="100"></canvas>
                            <div id="orders-chart-legend" class="orders-chart-legend"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                <i class="fas fa-chart-line"></i>
                                Ventas - Meses
                            </h4>
                            <canvas id="ventas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                <i class="fa-solid fa-kitchen-set"></i>
                                Platos más vendidos
                            </h4>
                            <div class="table-responsive ">
                                <table class="table table-striped mt-0.5 table-bordered shadow-lg mt-4">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th>Nombre</th>
                                            <th>Cantidad vendida</th>
                                            <th>Ver detalles</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productosvendidos as $productosvendido)
                                            <tr>
                                                <td>{{ $productosvendido->id }}</td>
                                                <td>{{ Str::ucfirst($productosvendido->Nombre_plato) }}</td>
                                                <td><strong>{{ $productosvendido->cantidad }}</strong> Unidades</td>
                                                <td>
                                                        <a class="btn btn-primary"
                                                            href="{{ route('admin.plato.show', $productosvendido->id) }}">
                                                            Ver <i class="far fa-eye"></i>
                                                        </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                            <i class="fa-solid fa-location-dot"></i>
                                Ubicacion De Los Clientes
                            </h4><br><br>
                            <div class="flex-center position-ref full-height">
                                <div class="content">
                                    <div id="mapa" style="width: 100%; height:500px"></div>
                                </div>
                            </div>
                            <script>
                            function iniciarMapa(){
                                var center = {lat: -19.58341986454926, lng: -65.75655027805412};
                                var lugares = [
                                    @foreach ($clientes as $cliente)
                                        [{{$cliente->latidud}},{{$cliente->longitud}}],    
                                    @endforeach
                                ];
                                var nombre = [
                                    @foreach ($clientes as $cliente)
                                        [{{$cliente->id}}],
                                    @endforeach
                                ];

                                var map = new google.maps.Map(document.getElementById('mapa'),{
                                    zoom: 15,
                                    center: center
                                });

                                const svgMarker = {
                                    path: "M10.453 14.016l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
                                    fillColor: "blue",
                                    fillOpacity: 0.6,
                                    strokeWeight: 0,
                                    rotation: 0,
                                    scale: 2,
                                    anchor: new google.maps.Point(15, 30),
                                };

                                var square = {
                                    path: 'M -2,-2 2,-2 2,2 -2,2 z', // 'M -2,0 0,-2 2,0 0,2 z',
                                    strokeColor: '#F00',
                                    fillColor: '#F00',
                                    fillOpacity: 1,
                                    scale: 5
                                };
                                for(i = 0; i < lugares.length; i++){
                                    var location = new google.maps.LatLng(lugares[i][0],lugares[i][1])
                                    var marker = new google.maps.Marker({
                                        position: location,
                                        title: 'CLIENTES',
                                        label: `${i + 1}`,
                                        draggable: false,
                                        map: map,
                                    });
                                }
                            }
                            </script>
                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZfZFrJxVmMfX7uxTrFDkEF6WncPIAvUY&callback=iniciarMapa" ></script>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@stop

@section('content_top_nav_right')
<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-bell"></i>
        @if (count(auth()->user()->unreadNotifications))
        <span class="badge badge-warning">{{ count(auth()->user()->unreadNotifications) }}</span>
            
        @endif
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notifi">
    <span class="dropdown-header" >Notificaciones Sin Leer</span>
        @forelse (auth()->user()->unreadNotifications as $notification)
        <a href="{{ route('admin.pensionado.listpensionados') }}" class="dropdown-item">
        <i class="fa-solid fa-hand-pointer"></i> El Pensionado <strong>{{ $notification->data['tipo']}}</strong> <br> se esta por terminar
        <span class="ml-3 float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
        </a>
        @empty
            <span class="ml-3 float-right text-muted text-sm">Sin notificaciones por leer </span><br> 
        @endforelse
        <a href="{{ route('markAsRead') }}" class="dropdown-item dropdown-footer">Marcar Todos LEIDO</a>
        <div class="dropdown-divider"></div>
            <span class="dropdown-header">Notificaciones Leidas</span>
            @forelse (auth()->user()->readNotifications as $notification)
            <a href="{{ route('admin.pensionado.listpensionados') }}" class="dropdown-item">
            <i class="fa-solid fa-check-double"></i> pension {{ $notification->data['tipo'] }}
            <span class="ml-3 float-right text-muted text-sm">{{ $notification->data['cliente_id'], $notification->created_at->diffForHumans() }}</span>
            </a>
            @empty
            <span class="ml-3 float-right text-muted text-sm">Sin notificaciones leidas</span>
        @endforelse
    </div>
    </li>
@endsection

@section('css')
    <link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <script>
        $(function() {

            var varVenta = document.getElementById('ventas').getContext('2d');
            var charVenta = new Chart(varVenta, {
                type: 'bar',
                data: {
                    labels: [<?php foreach ($ventasmes as $reg) {
    setlocale(LC_TIME, 'es_ES', 'Spanish_Bolivia', 'Bolivia');
    $mes_traducido = strftime('%B', strtotime($reg->mes));

    echo '"' . $mes_traducido . '",';
} ?>],
                    datasets: [{
                        label: 'Ventas',
                        data: [<?php foreach ($ventasmes as $reg) {
    echo '' . $reg->totalmes . ',';
} ?>],
                        backgroundColor: 'rgba(20, 204, 20, 1)',
                        borderColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 1
                    }],
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
            var varVenta = document.getElementById('ventas_diarias').getContext('2d');
            var charVenta = new Chart(varVenta, {
                type: 'bar',
                data: {
                    labels: [<?php foreach ($ventasdia as $ventadia) {
    $dia = $ventadia->dia;
    echo '"' . $dia . '",';
} ?>],
                    datasets: [{
                        label: 'Ventas',
                        data: [<?php foreach ($ventasdia as $reg) {
    echo '' . $reg->totaldia . ',';
} ?>],
                        backgroundColor: 'rgba(20, 204, 20, 1)',
                        borderColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                },
            });
        });
    </script>

@stop
