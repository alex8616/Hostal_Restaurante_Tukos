@extends('layouts.main', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
@section('content')
<br><br><hr>

<div class="worko-tabs" style="width: 96%; margin: auto;">

    <div>
        <input class="state" type="radio" title="tab-one" name="tabs-state" id="tab-one" checked />
        <input class="state" type="radio" title="tab-two" name="tabs-state" id="tab-two" />
        <input class="state" type="radio" title="tab-three" name="tabs-state" id="tab-three" />
        <input class="state" type="radio" title="tab-four" name="tabs-state" id="tab-four" />

        <div class="tabs flex-tabs" style="background: white;">
            <label for="tab-one" id="tab-one-label" class="tab">LISTA DE HOSPEDAJES CONCLUIDOS</label>
            <label for="tab-two" id="tab-two-label" class="tab">LISTA DE HOSPEDAJES EN ESPERA</label>
            <label for="tab-three" id="tab-three-label" class="tab">LISTA DE HOSPEDAJES CANCELADAS</label>
            
            <div id="tab-one-panel" class="panel active">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                            <div class="card-header card-header-warning">
                            <table style="width:100%">
                                <tr>
                                    <td><h4 class="card-title">LISTA DE HOSPEDAJES - CONCLUIDAS</h4></td>                           
                                </tr>
                                </table>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered shadow-lg mt-4 dt-responsive" id="categoria">
                                        <colgroup>
                                            <col class="table-col1">
                                            <col class="table-col2">
                                            <col class="table-col3">
                                            <col class="table-col4">
                                            <col class="table-col5">
                                            <col class="table-col6">
                                        </colgroup>
                                        <thead class="table-head" title="Click to sort">
                                            <tr class="table-row">
                                            <th class="col-head" scope="col"><center>#</center></th>
                                            <th class="col-head" scope="col"><center>HABITACION</center></th>                                    
                                            <th class="col-head" scope="col"><center>INGRESO - SALIDA</center></th>
                                            <th class="col-head" scope="col"><center>CLIENTE</center></th>
                                            <th class="col-head" scope="col"><center>ESTADO</center></th>
                                            <th class="col-head" scope="col"><center>TOTAL</center></th>
                                            <th class="col-head" scope="col"><center>ACCION</center></th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-body">
                                                @php
                                                    $i=1;
                                                @endphp
                                                @foreach ($hospedajehabitaciones as $hospedajehabitacione)
                                                @if($hospedajehabitacione->TotalGeneralHospedaje > 0)
                                                    <tr class="table-row">
                                                        <td class="cell" style="font-size: 14px;"><center>{{ $i++ }}</center></td>
                                                        <td class="cell" style="font-size: 14px;">
                                                            @foreach ($habitaciones as $habitacione)
                                                                @if($habitacione->id == $hospedajehabitacione->habitacion_id)         
                                                                    {{ $habitacione->Nombre_habitacion }} <br>
                                                                @endif
                                                            @endforeach 
                                                        </td>
                                                        <td class="cell" style="font-size: 14px;">
                                                            {{ date('Y-m-d', strtotime($hospedajehabitacione->ingreso_hospedaje)) }} <strong>-</strong> {{ date('Y-m-d', strtotime($hospedajehabitacione->salida_hospedaje)) }}
                                                        </td>                                            
                                                        <td class="cell" style="font-size: 14px;">
                                                            @foreach ($detallehospedajehabitaciones as $detallehospedajehabitacione)
                                                                @foreach ($clienteshostal as $cliente)
                                                                    @if($detallehospedajehabitacione->cliente_id == $cliente->id && $detallehospedajehabitacione->hospedaje_habitacion_id == $hospedajehabitacione->id)         
                                                                        {{ $cliente->Nombre_cliente }} <br>
                                                                    @endif
                                                                @endforeach 
                                                            @endforeach                                         
                                                        </td>
                                                        <td>
                                                            <center>
                                                                <span class="shadow-none badge badge-success">CONCLUIDO</span>
                                                            </center>
                                                        </td>
                                                        <td class="cell" style="font-size: 14px;"><center>Bs. {{ number_format($hospedajehabitacione->TotalGeneralHospedaje, 2) }}</center></td>                                                                              
                                                            <td class="cell" style="font-size: 14px;">
                                                                <center>                                                               
                                                                    <ul class="wrapper" style="height: 50px; display: inline-flex;">
                                                                        <li class="icon facebook" style="padding:4%" data-toggle="modal" data-target="#MostrarPdf{{ $hospedajehabitacione->id }}">
                                                                            <span class="tooltip" style="font-size: 10px;">IMPRIMIR</span>
                                                                            <span><i class="fa-solid fa-print"></i></span>
                                                                        </li>
                                                                        @include('hostal.habitaciones.MostrarPdf')
                                                                        <button class="myButton">
                                                                        <li class="icon youtube">
                                                                            <span class="tooltip" style="font-size: 10px;">ELIMINAR</span>
                                                                            <span><i class="fa-solid fa-trash" ></i></span>
                                                                        </li>
                                                                        </button>                                                                    
                                                                    </ul>
                                                                </center>
                                                            </td>
                                                    </tr>
                                                @endif
                                                @endforeach
                                        </tbody>        
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab-two-panel" class="panel">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                            <div class="card-header card-header-warning">
                            <table style="width:100%">
                                <tr>
                                    <td><h4 class="card-title">LISTA DE HOSPEDAJES NO CONCLUIDOS</h4></td>                           
                                </tr>
                                </table>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered shadow-lg mt-4 dt-responsive" id="categoria">
                                        <colgroup>
                                            <col class="table-col1">
                                            <col class="table-col2">
                                            <col class="table-col3">
                                            <col class="table-col4">
                                            <col class="table-col5">
                                            <col class="table-col6">
                                        </colgroup>
                                        <thead class="table-head" title="Click to sort">
                                            <tr class="table-row">
                                            <th class="col-head" scope="col"><center>#</center></th>
                                            <th class="col-head" scope="col"><center>HABITACION</center></th>                                    
                                            <th class="col-head" scope="col"><center>INGRESO - SALIDA</center></th>
                                            <th class="col-head" scope="col"><center>CLIENTE</center></th>
                                            <th class="col-head" scope="col"><center>TOTAL</center></th>
                                            <th class="col-head" scope="col"><center>ESTADO</center></th>
                                            <th class="col-head" scope="col"><center>ACCION</center></th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-body">
                                                @php
                                                    $i=1;
                                                @endphp
                                                @foreach ($hospedajehabitaciones as $hospedajehabitacione)
                                                @if($hospedajehabitacione->TotalGeneralHospedaje == 0)
                                                    <tr class="table-row">
                                                        <td class="cell" style="font-size: 14px;"><center>{{ $i++ }}</center></td>
                                                        <td class="cell" style="font-size: 14px;">
                                                            @foreach ($habitaciones as $habitacione)
                                                                @if($habitacione->id == $hospedajehabitacione->habitacion_id)         
                                                                    {{ $habitacione->Nombre_habitacion }} <br>
                                                                @endif
                                                            @endforeach 
                                                        </td>
                                                        <td class="cell" style="font-size: 14px;">
                                                            {{ date('Y-m-d', strtotime($hospedajehabitacione->ingreso_hospedaje)) }} <strong>-</strong> {{ date('Y-m-d', strtotime($hospedajehabitacione->salida_hospedaje)) }}
                                                        </td>                                            
                                                        <td class="cell" style="font-size: 14px;">
                                                            @foreach ($detallehospedajehabitaciones as $detallehospedajehabitacione)
                                                                @foreach ($clienteshostal as $cliente)
                                                                    @if($detallehospedajehabitacione->cliente_id == $cliente->id && $detallehospedajehabitacione->hospedaje_habitacion_id == $hospedajehabitacione->id)         
                                                                        {{ $cliente->Nombre_cliente }} <br>
                                                                    @endif
                                                                @endforeach 
                                                            @endforeach                                         
                                                        </td>
                                                        <td>
                                                            <center>
                                                                <span class="shadow-none badge badge-danger">NO CONCLUIDO</span>
                                                            </center>
                                                        </td>
                                                        <td class="cell" style="font-size: 14px;"><center>Bs. {{ number_format($hospedajehabitacione->TotalGeneralHospedaje, 2) }}</center></td>                                                                              
                                                            <td class="cell" style="font-size: 14px;">
                                                                <center>
                                                                    <ul class="wrapper" style="height: 50px; display: inline-flex;">
                                                                        <li class="icon facebook" style="padding:4%">
                                                                            <a href="{{route('hostal.habitacion.DetalleHospedaje', $hospedajehabitacione->habitacion_id)}}" style="all:unset;">
                                                                                <span class="tooltip" style="font-size: 10px;">DETALLES</span>
                                                                                <span><i class="fa-solid fa-rectangle-list"></i></span>
                                                                            </a>
                                                                        </li>
                                                                        <button class="myButton">
                                                                        <li class="icon youtube" type="submit">
                                                                            <span class="tooltip" style="font-size: 10px;">ELIMINAR</span>
                                                                            <span><i class="fa-solid fa-trash" type="submit"></i></span>
                                                                        </li>
                                                                        </button>
                                                                    </ul>
                                                                </center>
                                                            </td>
                                                    </tr>
                                                @endif
                                                @endforeach
                                        </tbody>        
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab-three-panel" class="panel">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                            <div class="card-header card-header-warning">
                            <table style="width:100%">
                                <tr>
                                    <td><h4 class="card-title">LISTA DE RESERVAS - CANCELADAS</h4></td>                           
                                </tr>
                                </table>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered shadow-lg mt-4 dt-responsive" id="categoria">
                                        <colgroup>
                                            <col class="table-col1">
                                            <col class="table-col2">
                                            <col class="table-col3">
                                            <col class="table-col4">
                                            <col class="table-col5">
                                            <col class="table-col6">
                                        </colgroup>
                                        <thead class="table-head" title="Click to sort">
                                            <tr class="table-row">
                                            <th class="col-head" scope="col"><center>#</center></th>
                                            <th class="col-head" scope="col"><center>HABITACION</center></th>                                    
                                            <th class="col-head" scope="col"><center>INGRESO - SALIDA</center></th>
                                            <th class="col-head" scope="col"><center>CLIENTE</center></th>
                                            <th class="col-head" scope="col"><center>TOTAL</center></th>
                                            
                                            <th class="col-head" scope="col"><center>ACCION</center></th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-body">
                                            
                                        </tbody>          
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{$hospedajehabitaciones->links()}}    
        </div>
    </div>
</div>
@endsection
@notifyCss
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/caja/registrar.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 
<style>
     /*Para los TABS*/
    h2{
    font-size: 4px;
    }
    @import "bourbon";
    /* Android 2.3 :checked fix */
    @keyframes fake {
        from {
            opacity: 1;
    }
        to {
            opacity: 1;
    }
    }
    body {
        animation: fake 1s infinite;
    }
    .worko-tabs {
        margin: 10px;
        width: 100%;
    }
    .worko-tabs .state {
        position: absolute;
        left: -10000px;
    }
    .worko-tabs .flex-tabs {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }
    .worko-tabs .flex-tabs .tab {
        flex-grow: 1;
        max-height: 40px;
    }
    .worko-tabs .flex-tabs .panel {
        background-color: #fff;
        padding: 10px;
        min-height: 300px;
        display: none;
        width: 100%;
        flex-basis: auto;
    }
    .worko-tabs .tab {
        display: inline-block;
        padding: 5px;
        vertical-align: top;
        background-color: #eee;
        cursor: hand;
        cursor: pointer;
        border-left: 10px solid #ccc;
    }
    .worko-tabs .tab:hover {
        background-color: #fff;
    }
    #tab-one:checked ~ .tabs #tab-one-label, #tab-two:checked ~ .tabs #tab-two-label, #tab-three:checked ~ .tabs #tab-three-label, #tab-four:checked ~ .tabs #tab-four-label {
        background-color: #fff;
        cursor: default;
        border-left-color: #000000;
    }
    #tab-one:checked ~ .tabs #tab-one-panel, #tab-two:checked ~ .tabs #tab-two-panel, #tab-three:checked ~ .tabs #tab-three-panel, #tab-four:checked ~ .tabs #tab-four-panel {
        display: block;
    }
    @media (max-width: 600px) {
        .flex-tabs {
            flex-direction: column;
    }
        .flex-tabs .tab {
            background: #fff;
            border-bottom: 1px solid #ccc;
    }
        .flex-tabs .tab:last-of-type {
            border-bottom: none;
    }
        .flex-tabs #tab-one-label {
            order: 1;
    }
        .flex-tabs #tab-two-label {
            order: 3;
    }
        .flex-tabs #tab-three-label {
            order: 5;
    }
        .flex-tabs #tab-four-label {
            order: 7;
    }
        .flex-tabs #tab-one-panel {
            order: 2;
    }
        .flex-tabs #tab-two-panel {
            order: 4;
    }
        .flex-tabs #tab-three-panel {
            order: 6;
    }
        .flex-tabs #tab-four-panel {
            order: 8;
    }
        #tab-one:checked ~ .tabs #tab-one-label, #tab-two:checked ~ .tabs #tab-two-label, #tab-three:checked ~ .tabs #tab-three-label, #tab-four:checked ~ .tabs #tab-four-label {
            border-bottom: none;
    }
        #tab-one:checked ~ .tabs #tab-one-panel, #tab-two:checked ~ .tabs #tab-two-panel, #tab-three:checked ~ .tabs #tab-three-panel, #tab-four:checked ~ .tabs #tab-four-panel {
            border-bottom: 1px solid #ccc;
    }
    }
</style>
@push('js')
@notifyJs
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    toastr.options.timeOut = 10000;
    toastr.options.toastClass = 'custom-toast-style';
    toastr.options.backgroundColor = 'red';

    let buttons = document.getElementsByClassName("myButton");
    for (let button of buttons) {
        button.addEventListener("click", function() {
            toastr.error("No Tienes Permiso Para ELIMINAR");
        });
    }
</script>
@endpush


