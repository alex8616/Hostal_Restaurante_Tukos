@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<br><br>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/cards/card.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/elements/infobox.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
    
    @include('complement.spinner')

    <div class="form-row" style="margin:auto; width:100%;">
        <div class="col-md-4">
            <div class="main-container" id="container" style="width: 100%; margin-top: 30px;">
                <div id="infobox3" class="col-xl-12 col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow" style="all:unset; background: #eeeeee;">
                        <div class="widget-content widget-content-area">
                            <div class="card component-card_4">
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
                                        <a class="badge badge-info" data-toggle="modal" data-target="#ReportePedidosDetalle" style="color: white; font-weight: bold;">DETALLADO DIARIO</a>                     
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.Comanda.ModalPedidosMensual')
        @include('admin.Comanda.ModalPedidosRangoFecha')
        @include('admin.Comanda.ModalPedidosDetallado')
        <div class="col-md-4">
            <div class="main-container" id="container" style="width: 100%; margin-top: 30px;">
                <div id="infobox3" class="col-xl-12 col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow" style="all:unset; background: #eeeeee;">
                        <div class="widget-content widget-content-area">
                            <div class="card component-card_4">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.comandamesa.ModalMesaMensual')
        @include('admin.comandamesa.ModalMesasRangoFecha')
        <div class="col-md-4">
            <div class="main-container" id="container" style="width: 100%; margin-top: 30px;">
                <div id="infobox3" class="col-xl-12 col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow" style="all:unset; background: #eeeeee;">
                        <div class="widget-content widget-content-area">
                            <div class="card component-card_4">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.Comanda.ModalTukomanasMensual')
        @include('admin.Comanda.ModalTukomanasRangoFecha')
        <div class="col-md-4">
            <div class="main-container" id="container" style="width: 100%;">
                <div id="infobox3" class="col-xl-12 col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow" style="all:unset; background: #eeeeee;">
                        <div class="widget-content widget-content-area">
                            <div class="card component-card_4">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.Comanda.ModalCafeteriaMensual')
        @include('admin.Comanda.ModalCafeteriaRangoFecha')
        <div class="col-md-4">
            <div class="main-container" id="container" style="width: 100%;">
                <div id="infobox3" class="col-xl-12 col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow" style="all:unset; background: #eeeeee;">
                        <div class="widget-content widget-content-area">
                            <div class="card component-card_4">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.Comanda.ModalComidaRapidaMensual')
        @include('admin.Comanda.ModalComidaRapidaRangoFecha')
    </div>

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="bootstrap/js/popper.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/js/app.js"></script>

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="plugins/apex/apexcharts.min.js"></script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

</html>
@endsection
@notifyCss
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/bottonfooder.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/caja/registrar.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="{{ asset('css/spinner.css') }}">
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{asset('js/spinner.js')}}"></script>
@notifyJs
@endpush
