@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
@section('content')
<br><br><hr><br>
    <link href="assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/cards/card.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/elements/infobox.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
    
    <div class="card" style="width: 90%; margin:auto">
        <div class="card-header card-header-black">
            <h4 class="card-title">
                REPORTES TUKO'S
            </h4>
        </div>
        <table>
            <tr>
                <td style="width: 50px;">
                    <div class="card component-card_4" style="width: 90%">
                        <div class="card-body">
                            <div class="user-profile" style="width:55%; height:100%;">
                                <img src="{{ asset('/img/pedidos_img.jpg') }}" width="100%" height="650px" style="border-radius: 5px;">
                            </div>
                            <div class="user-info">
                                <h5 class="info-heading">REPORTE PEDIDOS</h5>
                                <p class="info-text">Puedes Hacer Una Consulta De Una Fecha N a otra Fecha N.</p>
                                
                                <form action="{{route('admin.comanda.ReportePedidosDiario')}}" target="_blank">
                                    <input type="date" value="{{ now()->format('Y-m-d') }}" id="PedidosDiarioStart" name="PedidosDiarioStart" hidden>
                                    <button class="badge badge-primary" type="submit">DIARIO</button>
                                    <a class="badge badge-success" data-toggle="modal" data-target="#ReportePedidosMensual" style="color: white; font-weight: bold;">MENSUAL</a>
                                    <a class="badge badge-warning" data-toggle="modal" data-target="#ReportePedidosRangoFecha" style="color: white; font-weight: bold;">RANGO DE FECHA</a>
                                </form>
                            </div>
                        </div>
                    </div>
                    @include('admin.comanda.ModalPedidosMensual')
                    @include('admin.comanda.ModalPedidosRangoFecha')
                    @include('admin.comanda.ModalPedidosDetallado')
                    @include('admin.comanda.ModalPlatosVendido')
                </td>
                <td style="width: 50px;">
                    <div class="card component-card_4" style="width: 90%">
                        <div class="card-body">
                            <div class="user-profile" style="width:55%; height:100%;">
                                <img src="{{ asset('/img/mesera_img.jpg') }}" width="100%" height="650px" style="border-radius: 5px;">
                            </div>
                            <div class="user-info">
                                <h5 class="info-heading">REPORTE MESAS</h5>
                                <p class="info-text">Puedes Hacer Una Consulta De Un Mes En Especifico.</p> 
                                
                                <form action="{{route('admin.comandamesa.ReporteMesasDiario')}}" target="_blank">
                                    <input type="date" value="{{ now()->format('Y-m-d') }}" id="PedidosDiarioStart" name="PedidosDiarioStart" hidden>
                                    <button class="badge badge-primary" type="submit">DIARIO</button>
                                    <a class="badge badge-success" data-toggle="modal" data-target="#ReporteMesasMensual" style="color: white; font-weight: bold;">MENSUAL</a>
                                    <a class="badge badge-warning" data-toggle="modal" data-target="#ReporteMesasRangoFecha" style="color: white; font-weight: bold;">RANGO DE FECHA</a>
                                </form>                     
                            </div>
                        </div>
                    </div>
                    @include('admin.comandamesa.ModalMesaMensual')
                    @include('admin.comandamesa.ModalMesasRangoFecha')
                </td>                
            </tr>
            <tr>
                <td style="width: 50px;">
                    <div class="card component-card_4" style="width: 90%">
                        <div class="card-body">
                            <div class="user-profile" style="width:45%;">
                                <img src="{{ asset('/img/tukomanas_img.jpg') }}" width="80%" style="border-radius: 5px;">
                            </div>
                            <div class="user-info">
                                <h5 class="info-heading">REPORTE TUKOMANAS</h5>
                                <p class="info-text">Puedes Hacer Una Consulta Por Semanas.</p>
                                
                                <form action="{{route('admin.comanda.ReporteTukomanasDiario')}}" target="_blank">
                                    <input type="date" value="{{ now()->format('Y-m-d') }}" id="PedidosDiarioStart" name="PedidosDiarioStart" hidden>
                                    <button class="badge badge-primary" type="submit">DIARIO</button>
                                    <a class="badge badge-success" data-toggle="modal" data-target="#ReporteTukomanasMensual" style="color: white; font-weight: bold;">MENSUAL</a>
                                    <a class="badge badge-warning" data-toggle="modal" data-target="#ReporteTukomanasRangoFecha" style="color: white; font-weight: bold;">RANGO DE FECHA</a>
                                </form>                    
                            </div>
                        </div>
                    </div>
                    @include('admin.comanda.ModalTukomanasMensual')
                    @include('admin.comanda.ModalTukomanasRangoFecha')
                </td>
                <td style="width: 50px;">
                    <div class="card component-card_4" style="width: 90%">
                        <div class="card-body">
                            <div class="user-profile" style="width:47%;">
                                <img src="{{ asset('/img/cafeteria/cafeteria2.jpeg') }}" width="100%" height="650px" style="border-radius: 5px;">
                            </div>
                            <div class="user-info">
                                <h5 class="info-heading">REPORTE CAFETERIA</h5>
                                <p class="info-text">Puedes Hacer Una Consulta Por Semanas.</p>
                                
                                <form action="{{route('admin.comanda.ReporteCafeteriaDiario')}}" target="_blank">
                                    <input type="date" value="{{ now()->format('Y-m-d') }}" id="PedidosDiarioStart" name="PedidosDiarioStart" hidden>
                                    <button class="badge badge-primary" type="submit">DIARIO</button>
                                    <a class="badge badge-success" data-toggle="modal" data-target="#ReporteCafeteriaMensual" style="color: white; font-weight: bold;">MENSUAL</a>
                                    <a class="badge badge-warning" data-toggle="modal" data-target="#ReporteCafeteriaRangoFecha" style="color: white; font-weight: bold;">RANGO DE FECHA</a>
                                </form>                    
                            </div>
                        </div>
                    </div>
                    @include('admin.comanda.ModalCafeteriaMensual')
                    @include('admin.comanda.ModalCafeteriaRangoFecha')
                </td>
            </tr>
            <tr>
                <td style="width: 50px;">
                    <div class="card component-card_4" style="width: 90%">
                        <div class="card-body">
                            <div class="user-profile" style="width:46%;">
                                <img src="{{ asset('/img/comidarapida_img.jpeg') }}" width="100%" style="border-radius: 5px;">
                            </div>
                            <div class="user-info">
                                <h5 class="info-heading">REPORTE COMIDA RAPIDA</h5>
                                <p class="info-text">Puedes Hacer Una Consulta Por Semanas.</p>
                                <form action="{{route('admin.comanda.ReporteComidaRapidaDiario')}}" target="_blank">
                                    <input type="date" value="{{ now()->format('Y-m-d') }}" id="PedidosDiarioStart" name="PedidosDiarioStart" hidden>
                                    <button class="badge badge-primary" type="submit">DIARIO</button>
                                    <a class="badge badge-success" data-toggle="modal" data-target="#ReporteComidaRapidaMensual" style="color: white; font-weight: bold;">MENSUAL</a>
                                    <a class="badge badge-warning" data-toggle="modal" data-target="#ReporteComidaRapidaRangoFecha" style="color: white; font-weight: bold;">RANGO DE FECHA</a>
                                </form>                    
                            </div>
                        </div>
                    </div>
                    @include('admin.comanda.ModalComidaRapidaMensual')
                    @include('admin.comanda.ModalComidaRapidaRangoFecha')
                </td>
                <td style="width: 50px;">
                    <div class="card component-card_4" style="width: 90%">
                        <div class="card-body">
                            <div class="user-profile" style="width:55%; height:100%;">
                                <img src="{{ asset('/img/pedidos_img.jpg') }}" width="100%" height="650px" style="border-radius: 5px;">
                            </div>
                            <div class="user-info">
                                <h5 class="info-heading">REPORTE GENERAL DETALLADO</h5>
                                <p class="info-text">Puedes Hacer Una Consulta De Una Fecha N a otra Fecha N.</p>
                                <a class="badge badge-info" data-toggle="modal" data-target="#ReportePedidosDetalle" style="color: white; font-weight: bold;">DETALLADO DIARIO</a>                     
                                <a class="badge badge-danger" data-toggle="modal" data-target="#ReportePlatosVendido" style="color: white; font-weight: bold;">PLATOS MAS VENDIDOS</a>                     
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <div class="card-body" style="margin:auto;">
            <div class="form-row">
                
                
                
                
                
            </div>
        </div>
            <div class="card-header card-header-black">
                <h4 class="card-title">
                    GRAFICAS TUKO'S
                </h4>
            </div>
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                <i class="fas fa-gift"></i>
                                Ventas diarias De Pedidos Restaurant TUKO'S
                            </h4>
                            <canvas id="ventas_diarias" height="150"></canvas>
                            <div id="orders-chart-legend" class="orders-chart-legend"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                <i class="fas fa-chart-line"></i>
                                Ventas - Meses De Pedidos Restaurant TUKO'S
                            </h4>
                            <canvas id="ventas" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                <i class="fas fa-gift"></i>
                                Ventas diarias De Mesas Restaurant TUKO'S
                            </h4>
                            <canvas id="ventas_diarias_mesas" height="150"></canvas>
                            <div id="orders-chart-legend" class="orders-chart-legend"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                <i class="fas fa-chart-line"></i>
                                Ventas - Meses De Mesas Restaurant TUKO'S
                            </h4>
                            <canvas id="ventas_mesas" height="150"></canvas>
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
@section('css')
    <link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
@notifyCss
@push('js')
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
<script>
        $(function() {
            var varVenta = document.getElementById('ventas_mesas').getContext('2d');
            var charVenta = new Chart(varVenta, {
                type: 'bar',
                data: {
                    labels: [<?php foreach ($mesasventasmes as $reg) {
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
            var varVenta = document.getElementById('ventas_diarias_mesas').getContext('2d');
            var charVenta = new Chart(varVenta, {
                type: 'bar',
                data: {
                    labels: [<?php foreach ($mesasventasdia as $ventadia) {
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
@endpush