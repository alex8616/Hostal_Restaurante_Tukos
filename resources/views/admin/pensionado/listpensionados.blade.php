@extends('adminlte::page')

@section('title', 'Restaurant')

@section('content_header')
<div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S</span><br>LISTADO DE PENSIONADOS - FECHA CUMPLIDA</h1>
</div>
@stop

@section('content')
<a href="{{ route('admin.cliente.create') }}" class="btn btn-primary mb-2">Registrar Pension Nuevo</a>
<a href="{{ route('admin.cliente.index') }}" class="btn btn-primary mb-2">Lista Clientes Pensioados</a>

<div class="card">
    <div class="card-body">
    <table class="table table-striped" id="cliente">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Plan Pension</th>
            <th>Fecha Inicio</th>
            <th>Fecha Conclucion</th>
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($news as $tipocliente)
        @if($tipocliente->Fecha_Final = now()->toDateString())
            <tr style="background-color: #FF5252">
                <td>{{$tipocliente->id}}</td>
                <td>{{$tipocliente->cliente->Nombre_cliente}} {{$tipocliente->cliente->Apellidop_cliente}}</td>
                <td>{{$tipocliente->tipo}}</td>
                <td>{{$tipocliente->Fecha_Inicio}}</td>
                <td>{{$tipocliente->Fecha_Final}}</td>
                <td>
                @if ($tipocliente->tipo != 'Normal')
                        <a class="btn btn-danger" href="{{ route('cambio.estado.tipocliente', $tipocliente) }}"
                            title="Editar">
                            Dar De BAJA 
                        </a>
                @else
   
                            CLIENTE DADO DE BAJA 
                @endif
                </td>
            </tr> 
        @else
            <tr>
                <td>{{$tipocliente->id}}</td>
                <td>{{$tipocliente->cliente->Nombre_cliente}} {{$tipocliente->cliente->Apellidop_cliente}}</td>
                <td>{{$tipocliente->tipo}}</td>
                <td>{{$tipocliente->Fecha_Inicio}}</td>
                <td>{{$tipocliente->Fecha_Final}}</td>
                <span class="clock" data-countdown="{{ $tipocliente->Fecha_Final}}"></span>
                <td>
                    {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', now())->diffInDays(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tipocliente->Fecha_Final))}} Dias
                </td>
            </tr> 
        @endif
        @endforeach
    </tbody>
</table>
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
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>
    <script>
        $('#cliente').DataTable({
            responsive: true,
            autoWidth: false,
            "language": {
            "lengthMenu": "Mostrar  " +
                                   `<select class="custon-select custom-select-sm form-control form-control-sm"> 
                                        <option value='10'>10</option>
                                        <option value='25'>25</option>
                                        <option value='50'>50</option>
                                        <option value='100'>100</option>
                                        <option value='-1'>All</option>
                                    </select>`
                                    + " Registros Por Pagina",
            "zeroRecords": "No Se Encontro Ningun Usuario - Lo Siento",
            "info": "Mostrando La Pagina _PAGE_ de _PAGES_",
            "infoEmpty": "Ningun Registro Coincide Con Lo Buscado",
            "infoFiltered": "(Filtrado de _MAX_ Registros Totales)",
            'search': 'Buscar:',
            'paginate':{
                'next': 'Siguiente',
                'previous': 'Anterior'
            }
        }
        });
    </script>
@stop


