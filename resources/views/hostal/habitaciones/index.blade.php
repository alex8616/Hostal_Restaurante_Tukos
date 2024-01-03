@extends('layouts.main', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
@section('content')
<br><br><br>
<link href="assets/css/components/custom-counter.css" rel="stylesheet" type="text/css">
<link href="assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
    <div class="widget widget-table-one">
        <div class="widget-content">
            <div class="form-row">
                <div class="col-md-4">
                    <div class="transactions-list">
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-icon">
                                    <div class="avatar avatar-xl">
                                        <span class="avatar-title rounded-circle">HD</span>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4>HABITACIONES DISPONIBLES</h4>
                                    <p class="meta-date">4 Aug 1:00PM</p>
                                </div>
                            </div>
                            <div class="t-rate rate-inc">
                                <span class="badge badge-primary" style="font-size: 30px; background: #8cc137">{{$HabitacionesDisponibles}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="transactions-list">
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-icon">
                                    <div class="avatar avatar-xl">
                                        <span class="avatar-title rounded-circle">HR</span>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4>HABITACIONES RESERVADAS</h4>
                                    <p class="meta-date">4 Aug 1:00PM</p>
                                </div>
                            </div>
                            <div class="t-rate rate-inc">
                                <span class="badge badge-primary" style="font-size: 30px;">{{$HabitacionesReservas}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="transactions-list">
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-icon">
                                    <div class="avatar avatar-lg">
                                        <span class="avatar-title rounded-circle">HO</span>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4>HABITACIONES OCUPADAS</h4>
                                    <p class="meta-date">4 Aug 1:00PM</p>
                                </div>

                            </div>
                            <div class="t-rate rate-inc">
                                <span class="badge badge-primary" style="font-size: 30px; background:#e94f57">{{$HabitacionesOcupadas}}</span>
                            </div>
                        </div>
                    </div>
                </div>                                              
            </div>            
        </div>
    </div>
</div>

<div class="worko-tabs">
    <input class="state" type="radio" title="tab-one" name="tabs-state" id="tab-one" checked />
    <input class="state" type="radio" title="tab-two" name="tabs-state" id="tab-two" />
    <input class="state" type="radio" title="tab-three" name="tabs-state" id="tab-three" />
    <input class="state" type="radio" title="tab-four" name="tabs-state" id="tab-four" />

    <div class="tabs flex-tabs">
        <label for="tab-one" id="tab-one-label" class="tab">Habitaciones General</label>
        <label for="tab-two" id="tab-two-label" class="tab">Habitaciones DISPONIBLES</label>
        <label for="tab-three" id="tab-three-label" class="tab">Habitaciones Ocuapados</label>
        <label for="tab-four" id="tab-four-label" class="tab">Reservas</label>
      
        @include('hostal.habitaciones.CrearHabitacion')
        <div id="tab-one-panel" class="panel active">
            <div class="row d-flex mx-auto">
            @foreach($habitaciones as $habitacione)
                <?php
                    $ruta_base = 'img/redimensionada/';
                    $archivos = scandir($ruta_base);
                    $archivos = array_diff($archivos, array('.', '..'));
                    $indice_aleatorio = array_rand($archivos);
                    $nombre_archivo = $archivos[$indice_aleatorio];
                    $url_imagen = $ruta_base . $nombre_archivo;
                ?>
                @if($habitacione->Estado_habitacion == 'DISPONIBLE')
                <div class="col-12 col-md-6 col-lg-3 p-2">
                    <div class="card" style="background-image: url('/img/black3.jpeg'); background-size: cover;">
                        <img src="{{ asset($url_imagen) }}" class="card-img-top" alt="widget-card-2" width="500px" height="300px">
                        <div class="card-body">
                            <h5 class="card-title" style="font-size: 22px;">
                                {{ $habitacione->Nombre_habitacion }}
                            </h5>    
                            <span class="shadow-none badge badge-success" style="font-size: 18px;">{{$habitacione->Estado_habitacion}}</span>
                            <p>{{Now()}}</p>
                            <hr>
                            <div id="xd" class="button-disponible">                
                            <center>
                                <button style="background: #8cc137">
                                    <a href="{{route('hostal.habitacion.CrearHospedaje', $habitacione)}}" style="all:unset; color: white; font-weight: bold;">
                                        HOSPEDAR
                                    </a>
                                </button>
                                <button style="background: #8cc137">
                                    <a href="{{route('hostal.habitacion.CrearReserva', $habitacione)}}" style="all:unset; color: white; font-weight: bold;">
                                        RESERVAR
                                    </a>
                                </button>
                            </center>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif($habitacione->Estado_habitacion == 'OCUPADO')
                <div class="col-12 col-md-6 col-lg-3 p-2">
                    <div class="card" style="background-image: linear-gradient(rgba(239,20,20,0.5), rgba(255,255,255,0.5)), url('/img/black3.jpeg'); background-size: cover;">
                        <img src="{{ asset('img/hab_sencilla_ocupado.jpeg') }}" class="card-img-top" alt="widget-card-2">
                        <div class="card-body">                                              
                        @foreach($reservashabitaciones as $reservashabitacione)
                        @endforeach                
                            @if($habitacione->Reserva_habitacion == 'NO')
                                @foreach($hospedajehabitaciones as $hospedajehabitacione)
                                    @if($hospedajehabitacione->habitacion_id == $habitacione->id && $hospedajehabitacione->TotalGeneralHospedaje == 0)
                                        <h5 class="card-title" style="font-size: 22px;">
                                            {{ $habitacione->Nombre_habitacion }} - {{ $hospedajehabitacione->CategoriaHabitacion }}
                                        </h5>
                                        <span class="shadow-none badge badge-danger" style="font-size: 18px;">{{$habitacione->Estado_habitacion}}</span>                                      
                                        <p>{{ date('Y-m-d', strtotime($hospedajehabitacione->ingreso_hospedaje)) }} - {{ date('Y-m-d', strtotime($hospedajehabitacione->salida_hospedaje)) }}</p>    
                                        <hr>
                                        <div id="xd" class="button-ocupado">
                                            <center>                                    
                                                <button style="background: #e94f57">
                                                    <a href="{{route('hostal.habitacion.DetalleHospedaje', $habitacione)}}" style="all:unset; color: white; font-weight: bold;">
                                                        INGRESAR
                                                    </a>
                                                </button>
                                                <button style="background: #e94f57">
                                                    <a href="#" style="all:unset; color: white; font-weight: bold;">
                                                        H
                                                    </a>
                                                </button>
                                                <button style="background: #e94f57"> 
                                                    <a class="icon limpieza" data-toggle="modal" data-target="#CambiarHabitacionHospedaje{{ $hospedajehabitacione->id }}" style="all:unset; color: white; font-weight: bold;">
                                                        EDITAR
                                                    </a>
                                                </button>
                                                @include('hostal.habitaciones.CambiarHabitacionHospedaje')
                                            </center>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        @foreach($reservashabitaciones as $reservashabitacione)                    
                        @if($reservashabitacione->habitacion_id == $habitacione->id && $habitacione->Reserva_habitacion == 'SI' && $reservashabitacione->Estado_reserva == 'INGRESO')
                            <h5 class="card-title" style="font-size: 22px;">
                                {{ $habitacione->Nombre_habitacion }} - {{ $reservashabitacione->CategoriaHabitacion_reserva }}
                            </h5>
                            <span class="shadow-none badge badge-danger" style="font-size: 18px;">{{$habitacione->Estado_habitacion}}</span>                                      
                            <p>{{ date('Y-m-d', strtotime($reservashabitacione->ingreso_reserva)) }} <strong>-</strong> {{ date('Y-m-d', strtotime($reservashabitacione->salida_reserva)) }}</p>
                            <hr>
                            <div id="xd" class="button-ocupado">
                                <center>
                                    <button style="background: #e94f57">
                                        <a class="icon limpieza" href="{{route('hostal.habitacion.DetalleReserva', $habitacione)}}" style="all:unset; color: white; font-weight: bold;">
                                            INGRESAR
                                        </a>
                                    </button>  
                                    <button style="background: #e94f57">
                                        <a href="#" style="all:unset; color: white; font-weight: bold;">
                                            R
                                        </a>
                                    </button>
                                    <button style="background: #e94f57"> 
                                        <a class="icon limpieza" data-toggle="modal" data-target="#CambiarHabitacion{{ $reservashabitacione->id }}" style="all:unset; color: white; font-weight: bold;">
                                            EDITAR
                                        </a>
                                    </button>
                                    @include('hostal.habitaciones.CambiarHabitacionReserva')
                                </center>
                            </div>
                        @endif
                        @endforeach  
                        </div>
                    </div>
                </div>
                @else
                <div class="col-12 col-md-6 col-lg-3 p-2">
                    <div class="card" style="background-image: linear-gradient(rgba(242, 92, 5,0.5), rgba(255,255,255,0.5)),url('/img/black3.jpeg'); background-size: cover;">
                        <img src="{{ asset('img/hab_sencilla_limpieza.jpeg') }}" class="card-img-top" alt="widget-card-2">
                        <div class="card-body">
                            <h5 class="card-title" style="font-size: 22px;">
                                {{ $habitacione->Nombre_habitacion }}
                            </h5>    
                            <span class="shadow-none badge badge-warning" style="font-size: 18px; background: #FF6C17;">{{$habitacione->Estado_habitacion}}</span>
                            <p>{{Now()}} - {{$habitacione->id}}</p>
                            <hr>
                            <div id="xd" class="button-disponible">                
                                <center>
                                    <!-- Button trigger modal -->                                    
                                    <button type="submit" style="width: 100%; border-radius: 5px; background: #FF6C17; color: white; font-weight: bold;" data-toggle="modal" data-target="#modalLimpieza{{$habitacione->id}}">
                                        TERMINAR LIMPIEZA
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="modalLimpieza{{$habitacione->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">HABITACION</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                        <P style="color: red; font-size: 20px; font-weight: bold;">¿Ya Se Termino De Realizar La Limpieza De La {{$habitacione->Nombre_habitacion}}?</P>
                                                    </div>
                                                    <form method="POST" action="{{ route('CambiarEstadoLimpieza', $habitacione->id) }}">
                                                        @method('PUT')
                                                        @csrf
                                                        <input type="text" id="id_hab" name="id_hab" value="{{$habitacione->id}}" hidden>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">No, Canclear</button>
                                                        <button type="submit" class="btn btn-primary">Si, Confirmar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIN Modal -->
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
                <div class="col-12 col-md-6 col-lg-3 p-2">
                    <div class="card" style="background-image: url('/img/black3.jpeg'); background-size: cover;">
                        <div class="card-body">
                            <center>
                                <h5 class="card-title" style="font-weight: bold;">AGREGAR HABITACION</h5>
                            </center>
                            <hr>
                            <center>
                                <a href="" data-toggle="modal" data-target="#modelId">
                                    <svg  viewBox="0 0 14 14" id="meteor-icon-kit__regular-plus-s" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill-rule="evenodd" clip-rule="evenodd" d="M6 6V1C6 0.44772 6.4477 0 7 0C7.5523 0 8 0.44772 8 1V6H13C13.5523 6 14 6.4477 14 7C14 7.5523 13.5523 8 13 8H8V13C8 13.5523 7.5523 14 7 14C6.4477 14 6 13.5523 6 13V8H1C0.44772 8 0 7.5523 0 7C0 6.4477 0.44772 6 1 6H6z" fill="#758CA3"></path></g></svg>
                                </a>
                            </center>
                        </div>
                    </div>
                </div>
                @include('hostal.habitaciones.CrearHabitacion')
            </div>
        </div>
        <div id="tab-two-panel" class="panel">
            <div class="d-flex flex-wrap justify-content-between">
            @foreach($habitaciones as $habitacione)
                @if($habitacione->Estado_habitacion == 'DISPONIBLE')
                    <div class="col-12 col-md-6 col-lg-3 p-2">
                        <div class="card" style="background-image: url('/img/black3.jpeg'); background-size: cover;">
                            <img src="{{ asset('img/img_hotels_mix/1.jpg') }}" class="card-img-top" alt="widget-card-2">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 22px;">
                                    {{ $habitacione->Nombre_habitacion }} -
                                </h5>    
                                <span class="shadow-none badge badge-success" style="font-size: 18px;">{{$habitacione->Estado_habitacion}}</span>
                                <p>{{Now()}}</p>
                                <hr>
                                <div id="xd" class="button-disponible">                
                                <center>
                                    <button style="background: #8cc137;">
                                        <a href="{{route('hostal.habitacion.CrearHospedaje', $habitacione)}}" style="all:unset; color: white; font-weight: bold;">
                                            HOSPEDAR
                                        </a>
                                    </button>
                                    <button style="background: #8cc137;">
                                        <a href="{{route('hostal.habitacion.CrearReserva', $habitacione)}}" style="all:unset; color: white; font-weight: bold;">
                                            RESERVAR
                                        </a>
                                    </button>
                                </center>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div id="tab-three-panel" class="panel">
            <div class="row d-flex mx-auto">
            @foreach($habitaciones as $habitacione)
                @if($habitacione->Estado_habitacion == 'OCUPADO')
                <div class="col-12 col-md-6 col-lg-3 p-2">
                    <div class="card" style="background-image: linear-gradient(rgba(239,20,20,0.5), rgba(255,255,255,0.5)), url('/img/black3.jpeg'); background-size: cover;">
                        <img src="{{ asset('img/img_hotels_mix/1.jpg') }}" class="card-img-top" alt="widget-card-2">
                        <div class="card-body">
                        <h5 class="card-title" style="font-size: 22px;">
                            {{ $habitacione->Nombre_habitacion }} -
                        </h5>                        
                        <span class="shadow-none badge badge-danger" style="font-size: 18px;">{{$habitacione->Estado_habitacion}}</span>             
                        @foreach($reservashabitaciones as $reservashabitacione)
                        @endforeach                
                            @if($habitacione->Reserva_habitacion == 'NO')
                                @foreach($hospedajehabitaciones as $hospedajehabitacione)
                                @endforeach
                                <p>{{ date('Y-m-d', strtotime($hospedajehabitacione->ingreso_hospedaje)) }} - {{ date('Y-m-d', strtotime($hospedajehabitacione->salida_hospedaje)) }}</p>
                                <hr>
                                <div id="xd" class="button-ocupado">
                                    <center>
                                        <button style="background: #e94f57">
                                            <a href="{{route('hostal.habitacion.DetalleHospedaje', $habitacione)}}" style="all:unset; color: white; font-weight: bold;">
                                                INGRESAR
                                            </a>
                                        </button>
                                        <button style="background: #e94f57">
                                            <a href="#" style="all:unset; color: white; font-weight: bold;">
                                                H
                                            </a>
                                        </button>
                                        <button style="background: #e94f57"> 
                                            <a class="icon limpieza" data-toggle="modal" data-target="#CambiarHabitacionHospedaje{{ $hospedajehabitacione->id }}" style="all:unset; color: white; font-weight: bold;">
                                                EDITAR
                                            </a>
                                        </button>
                                    </center>
                                    @include('hostal.habitaciones.CambiarHabitacionHospedaje')
                                </div>
                            @endif
                        @foreach($reservashabitaciones as $reservashabitacione)                    
                        @if($reservashabitacione->habitacion_id == $habitacione->id && $habitacione->Reserva_habitacion == 'SI' && $reservashabitacione->Estado_reserva == 'INGRESO')
                            <p>{{ date('Y-m-d', strtotime($reservashabitacione->ingreso_reserva)) }} <strong>-</strong> {{ date('Y-m-d', strtotime($reservashabitacione->salida_reserva)) }}</p>
                            <hr>
                            <div id="xd" class="button-ocupado">
                                <center>
                                    <button style="background: #e94f57">
                                        <a class="icon limpieza" href="{{route('hostal.habitacion.DetalleReserva', $habitacione)}}" style="all:unset; color: white; font-weight: bold;">
                                            INGRESAR
                                        </a>
                                    </button>
                                    <button style="background: #e94f57">
                                        <a href="#" style="all:unset; color: white; font-weight: bold;">
                                            R
                                        </a>
                                    </button>  
                                    <button style="background: #e94f57"> 
                                        <a class="icon limpieza" data-toggle="modal" data-target="#CambiarHabitacion{{ $reservashabitacione->id }}" style="all:unset; color: white; font-weight: bold;">
                                            EDITAR
                                        </a>
                                    </button>
                                    @include('hostal.habitaciones.CambiarHabitacionReserva')
                                </center>
                            </div>
                        @endif
                        @endforeach 
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
            </div>
        </div>
        <div id="tab-four-panel" class="panel">
            <div class="row d-flex mx-auto">
                @foreach($habitaciones as $habitacione)
                    @foreach($reservashabitaciones as $reservashabitacione)
                    @if($reservashabitacione->Estado_reserva == 'ESPERA')
                        @if($reservashabitacione->habitacion_id == $habitacione->id)
                        <div class="col-12 col-md-6 col-lg-3 p-2">
                            <div class="card" style="background-image: url('/img/black3.jpeg'); background-size: cover;">
                                <img src="{{ asset('img/img_hotels_mix/1.jpg') }}" class="card-img-top" alt="widget-card-2">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-size: 22px;">
                                        {{ $habitacione->Nombre_habitacion }} -
                                        @foreach($clientes as $cliente)
                                            @if($cliente->id == $reservashabitacione->cliente_id)
                                                <p>{{ $cliente->Nombre_cliente }}  {{ $cliente->Celular_cliente }}</p>
                                            @endif
                                        @endforeach
                                    </h5>    
                                    <span class="shadow-none badge badge-primary" style="font-size: 18px;">{{$habitacione->Estado_habitacion}}</span>
                                    <p style="color:black;">{{ date('Y-m-d', strtotime($reservashabitacione->ingreso_reserva)) }} <strong>-</strong> {{ date('Y-m-d', strtotime($reservashabitacione->salida_reserva)) }}</p>
                                    <hr>
                                    <div id="xd" clas
                                    s="button-reservado">
                                        <center>                                    
                                            @if (Carbon\Carbon::now()->gte($reservashabitacione->ingreso_reserva))
                                                <button type="submit" style="background: #144fe6;">
                                                    <a href="{{route('hostal.habitacion.ConcluirReserva', $reservashabitacione)}}" style="all:unset; color: white; font-weight: bold;">
                                                        Concluir
                                                    </a>
                                                </button>
                                            @else
                                                <button class="myButton" style="background: #144fe6;">
                                                    <a style="all:unset; color: white; font-weight: bold;">
                                                        Concluir
                                                    </a>
                                                </button>
                                            @endif                                            
                                            <button data-toggle="modal" data-target="#CambiarHabitacion{{ $reservashabitacione->id }}" style="background: #144fe6;">
                                                <a style="all:unset; color: white; font-weight: bold;">
                                                    Editar
                                                </a>
                                            </button>
                                            @include('hostal.habitaciones.CambiarReserva')
                                            <!-- Button trigger modal -->                                    
                                            <button type="submit" style="background: #144fe6; color: white; font-weight: bold;" data-toggle="modal" data-target="#modalCanclearReserva{{$habitacione->id}}">
                                                Cancelar
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="modalCanclearReserva{{$habitacione->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">HABITACION</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="container-fluid">
                                                                <P style="color: red; font-size: 20px; font-weight: bold;">¿Esta Seguro De Cancelar La Reserva De La {{$habitacione->Nombre_habitacion}}?</P>
                                                            </div>
                                                            <form method="POST" action="{{ route('CancelarReserva', $reservashabitacione->id) }}" style="all:unset;">
                                                                @method('PUT')
                                                                @csrf
                                                                <input type="text" id="reserva_id" name="reserva_id" value="{{$reservashabitacione->id}}" hidden>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">No, Canclear</button>
                                                                <button type="submit" class="btn btn-primary">Si, Confirmar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- FIN Modal -->
                                        </center>                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
@notifyCss
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="@sweetalert2/themes/dark/dark.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    .card-container {
        display: flex;
        align-items: stretch;
    }

    .card {
        overflow: hidden;
    }

    /* STRUCTURE */
    .wrapper {
        max-width: 100%;
        width: 100%;
        margin: auto;
    }
    header {
        padding: 0 15px;
    }
    .columns {
        display: flex;
        flex-flow: row wrap;
        justify-content: center;
        margin: 5px 0;
    }
    .column {
        flex: 1;
        margin: 2px;
        padding: 15px;
        flex-basis: 20%;
        border-radius: 5%;
    }
    .column:first-child {
        margin-left: 0;
    }
    .column:last-child {
        margin-right: 0;
    }
    footer {
        padding: 0 15px;
    }
    @media screen and (max-width: 980px) {
        .columns .column {
            margin-bottom: 5px;
            flex-basis: 40%;
        }
        .columns .column:nth-last-child(2) {
            margin-right: 0;
        }
        .columns .column:last-child {
            flex-basis: 100%;
            margin: 0;
        }
    }
    @media screen and (max-width: 780px) {
        .columns .column {
            flex-basis: 30%;
            margin: 0 0 5px 0;
        }
    }
    @media screen and (max-width: 1200px) {
        .columns .column {
            flex-basis: 30%;
            margin: 0 0 5px 0;
        }
    }
    @media screen and (max-width: 680px) {
        .columns .column {
            flex-basis: 100%;
            margin: 0 0 5px 0;
        }
    }
    
    button{
    font-size: 3vmin;
    padding: .4em 1em;
    background: #fff;
    color: #000000;
    border: 1px solid #A0AEC0;
    margin: .1em;
    transition: background .2s ease, color .2s ease, box-shadow .2s ease, transform .2s ease;
    box-shadow: 0 0 0 #BEE3F8;
    transform: translateY(0);
    }
    button:first-of-type{
    border-radius: .5em 0 0 .5em;
    }
    button:last-of-type{
    border-radius: 0 .5em .5em 0;
    }
    button i{
    color: #A0AEC0;
    margin-right: .1em;
    transition: all .2s ease-out;
    }

    /*disponible button*/
    .button-disponible{
    width: 100%;
    margin: auto;
    }
    .button-disponible:hover button{
    color: #495057;
    }

    .button-disponible:hover button:hover{    
    transform: translateY(-.2em);
    }
    .button-disponible:hover button i{
    color: #CBD5E0;
    }
    .button-disponible:hover button:hover i{
    color: #FED7E2;
    transform: rotate(-10deg);
    }

    /*ocuapdo button*/
    .button-ocupado{
    width: 100%;
    margin: auto;
    }
    .button-ocupado:hover button{
    color: #495057;
    }

    .button-ocupado:hover button:hover{
    transform: translateY(-.2em);
    }
    .button-ocupado:hover button i{
    color: #CBD5E0;
    }
    .button-ocupado:hover button:hover i{
    color: #FED7E2;
    transform: rotate(-10deg);
    }

    /*reserva button*/
    .button-reservado{
    width: 100%;
    margin: auto;
    }
    .button-reservado:hover button{
    color: #495057;
    }

    .button-reservado:hover button:hover{
    transform: translateY(-.2em);
    }
    .button-reservado:hover button i{
    color: #CBD5E0;
    }
    .button-reservado:hover button:hover i{
    color: #FED7E2;
    transform: rotate(-10deg);
    }


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




    :root {
    --red: red;
    --cyan:hsl(129, 100%, 50%);
    --orange: hsl(34, 97%, 64%);
    --blue: #0466c8;
    --varyDarkBlue: hsl(234, 12%, 34%);
    --grayishBlue: hsl(229, 6%, 66%);
    --veryLightGray: hsl(0, 0%, 98%);
    --weight1: 200;
    --weight2: 400;
    --weight3: 400;
    }

    .attribution { 
    font-size: 11px; text-align: center; 
    }
    .attribution a { 
    color: hsl(228, 45%, 44%); 
    }

    h1:first-of-type {
    font-weight: var(--weight1);
    color: var(--varyDarkBlue);

    }

    h1:last-of-type {
    color: var(--varyDarkBlue);
    }

    @media (max-width: 400px) {
    h1 {
        font-size: 1.5rem;
    }
    }

    .box p {
        color: var(--grayishBlue);
    }

    .box {
    border-radius: 5px;
    box-shadow: 0px 30px 40px -20px var(--grayishBlue);
    padding: 30px;
    margin: 10px; 
    width: 350px; 
    }

    img {
    float: right;
    }

    @media (max-width: 450px) {
    .box {
        height: 400px;
    }
    }

    @media (max-width: 950px) and (min-width: 450px) {
    .box {
        text-align: center;
        height: 380px;
    }
    }

    .cyan {
    border-top: 15px solid var(--cyan);
    }
    .red {
    border-top: 15px solid var(--red);
    }
    .blue {
    border-top: 15px solid var(--blue);
    }
    .orange {
    border-top: 3px solid var(--orange);
    }

    h2 {
    color: var(--varyDarkBlue);
    font-weight: var(--weight3);
    }


    @media (min-width: 950px) {
    .row1-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .row2-container {
        word-break:break-all;
        display: flex;
        justify-content: center;
        align-items: center;
        word-break:break-all;
    }


    }

    /*
    Auther: Abdelrhman Said
    */

    @import url("https://fonts.googleapis.com/css2?family=Poppins&display=swap");

    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }

    *:focus,
    *:active {
    outline: none !important;
    -webkit-tap-highlight-color: transparent;
    }

    .icon {
    position: relative;
    background: #ffffff;
    border-radius: 50%;
    padding: 15px;
    margin: 10px;
    width: 50px;
    height: 50px;
    font-size: 18px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: all 0.2s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .tooltip {
    position: absolute;
    top: 0;
    font-size: 14px;
    background: #ffffff;
    color: #ffffff;
    padding: 5px 8px;
    border-radius: 5px;
    box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
    opacity: 0;
    pointer-events: none;
    transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .tooltip::before {
    position: absolute;
    content: "";
    height: 8px;
    width: 8px;
    background: #ffffff;
    bottom: -3px;
    left: 50%;
    transform: translate(-50%) rotate(45deg);
    transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .icon:hover .tooltip {
    top: -45px;
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
    }

    .icon:hover span,
    .icon:hover .tooltip {
    text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.1);
    }

    .ingreso:hover,
    .ingreso:hover .tooltip,
    .ingreso:hover .tooltip::before {
    background: #1877F2;
    color: #ffffff;
    }

    .desayuno:hover,
    .desayuno:hover .tooltip,
    .desayuno:hover .tooltip::before {
    background: #E4405F;
    color: #ffffff;
    }

    .limpieza:hover,
    .limpieza:hover .tooltip,
    .limpieza:hover .tooltip::before {
    background: #333333;
    color: #ffffff;
    }
</style>
@push('js')
@notifyJs
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  $(document).ready(function() {
    // Habilitar/deshabilitar el botón en función de la selección del select
    $(document).on("change", "#habitacion_id", function() {
      if ($(this).val() != "") {
        $(".btn-primary").prop("disabled", false);
      } else {
        $(".btn-primary").prop("disabled", true);
      }
    });
  });
</script>
<script>
    toastr.options.timeOut = 10000;
    toastr.options.toastClass = 'custom-toast-style';
    toastr.options.backgroundColor = 'red';

    let buttons = document.getElementsByClassName("myButton");
    for (let button of buttons) {
        button.addEventListener("click", function() {
            toastr.error("No Se Puede Concluir La Reserva PorQue Aun No Es La FECHA!!!");
        });
    }
</script>
@endpush