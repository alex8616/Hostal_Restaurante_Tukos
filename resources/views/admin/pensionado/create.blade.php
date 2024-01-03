@extends('adminlte::page')

@section('title', 'Restaurant')

@section('content_header')
<div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S</span><br>REGISTRO PENSIONADO NUEVO</h1>
</div>
@stop

@section('content')

<div class="card" style="width: 50%">
    <div class="card-body">
        <form action="{{ url('/pensionado') }}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="nombre">Nombre De Pension</label>
                    <input type="text" name="Nombre_tipoclientes" id="Nombre_tipoclientes" value="{{ old('Nombre_tipoclientes') }}" 
                        class="form-control" tabindex="1" autofocus>
                </div>
                <div class="col-md-6 mb-3">
                <label for="nombre">Direccion De Pension</label>
                <input type="text" name="Direccion_tipoclientes" id="Direccion_tipoclientes" value="{{ old('Direccion_tipoclientes') }}" 
                    class="form-control" tabindex="1" autofocus>
            </div>  
            <div class="col-md-12 mb-3">
                <label for="inputApellidom">Tipo De Pension</label>
                <select id="tipo" name="tipo" class="form-control">
                    <option value="" >Seleccione Una De las Opciones</option>
                    <option value="Basico" {{ old('tipo.0') == "Basico" ? "selected" :""}}>Basico</option>
                    <option value="Familiar" {{ old('tipo.0') == "Familiar" ? "selected" :""}}>Familiar</option>
                    <option value="Empresarial" {{ old('tipo.0') == "Empresarial" ? "selected" :""}}>Empresarial</option>
                </select>
                @if ($errors->has('$cliente->tipo'))
                        <span class="error text-danger" style="color:#fff";>{{ $errors->first('$cliente->tipo') }}</span><br>
                @endif
            </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="inputNombre">Fecha Inicio</label>
                        <input type="date" class="form-control" id="Fecha_Inicio" name="Fecha_Inicio" value="{{ old('Fecha_Inicio') }}">
                        @if ($errors->has('Fecha_Inicio'))
                                <span class="error text-danger" style="color:#fff";>{{ $errors->first('Fecha_Inicio') }}</span><br>
                        @endif
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                <div class="form-group">
                        <label for="inputApellidop">Fecha Final</label>
                        <input type="date" class="form-control" id="Fecha_Final" name="Fecha_Final" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Fecha_Final') }}">
                        @if ($errors->has('Precio_plato'))
                                <span class="error text-danger" style="color:#fff";>{{ $errors->first('Fecha_Final') }}</span><br>
                        @endif
                    </div>
                </div>
            </div>
            </div>
            <div class="form-group">
                <center>
                    <button type="submit" class="btn btn-danger">Cancelar</button>
                    <button type="submit" class="btn btn-success">Registrar</button>
                </center> 
            </div>
        </div>
    </form>
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
        <i class="fa-solid fa-hand-pointer"></i> El Pensionado del cliente con <br><strong>{{ $notification->data['tipo'] }}</strong> se esta por terminar
        <span class="ml-3 float-right text-muted text-sm">{{ $notification->data['Fecha_Final'] }}</span>
        </a>
        @empty
            <span class="ml-3 float-right text-muted text-sm">Sin notificaciones por leer </span><br> 
        @endforelse
        <a href="{{ route('markAsRead') }}" class="dropdown-item dropdown-footer">Marcar Todos LEIDO</a>
        <div class="dropdown-divider"></div>
            <span class="dropdown-header">Notificaciones Leidas</span>
            @forelse (auth()->user()->readNotifications as $notification)
            <a href="{{ route('admin.pensionado.listpensionados') }}" class="dropdown-item">
            <i class="fa-solid fa-check-double"></i> pension {{ $notification->data['id'] }}
            <span class="ml-3 float-right text-muted text-sm">{{ $notification->data['id'], $notification->created_at->diffForHumans() }}</span>
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
    <style>
        .card{
        
            position: relativa;
            top: 50%;
            left: 25%;
        }
    </style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        window.onload = function(){
            var fecha = new Date(); //Fecha actual
            var mes = fecha.getMonth()+1; //obteniendo mes
            var dia = fecha.getDate(); //obteniendo dia
            var ano = fecha.getFullYear(); //obteniendo año
            if(dia<10)
                dia='0'+dia; //agrega cero si el menor de 10
            if(mes<10)
                mes='0'+mes //agrega cero si el menor de 10
            document.getElementById('Fecha_Inicio').value=ano+"-"+mes+"-"+dia;
        }
    </script>
@stop