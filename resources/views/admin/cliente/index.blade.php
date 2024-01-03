@extends('adminlte::page')

@section('title', 'Restaurant')

@section('content_header')
@stop

@section('content')
<a href="{{ route('cliente.create') }}" class="btn btn-primary mb-2">Registrar Cliente Nuevo</a>

<div class="card">
    <div class="card-body">
    <table class="table table-striped" id="cliente">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Direccion</th>
            <th>Numero De Celular</th>
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente)
        <tr>
            <td>{{$cliente->id}}</td>
            <td>{{$cliente->Nombre_cliente}}</td>
            <td>{{$cliente->Apellidop_cliente}}</td>
            <td>{{$cliente->Direccion_cliente}}</td>
            <td>{{$cliente->Celular_cliente}}</td>
            <td>
                <a href="{{ route('cliente.show', $cliente) }}" class="btn btn-info">Ver</a>
                <a  href="{{ route('cliente.edit', $cliente) }}" class="btn btn-secondary text-white" href="#">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
    </div>
</div>
@stop

@section('content_top_nav_right')
    @include('notificaciones')
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
    <link href="{{asset('css/stylos.css')}}" rel="stylesheet" type="text/css" />
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
            "bSort" : false,
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


