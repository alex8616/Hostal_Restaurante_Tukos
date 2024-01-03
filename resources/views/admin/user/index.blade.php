@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<br><br><hr>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-black">
                <table style="width:100%">
                    <tr>
                        <td><h4 class="card-title">USUARIOS DEL SISTEMA</h4></td>
                        <td class="text-right">
                        <div class="wrap">
                        </div>
                        </td>
                        <td class="text-right">
                        <div class="wrap">
                        </div>
                        </td>
                        <td class="text-right">
                        <div class="wrap">
                            <a href="{{ route('admin.users.create') }}" id="addnew" type="button">Añadir</a> 
                        </div>
                        </td>
                    </tr>
                    </table>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <div class="card">
                <div class="card-body">
                    <center>
                    <table id="order-listing"
                        class="table table-striped mt-0.5 table-bordered shadow-lg dt-responsive nowrap users" style="width: 90%;">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Nombre</th>
                                <th>Correo electrónico</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        {{ ucwords($user->name) }}
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td class="text-right" style="width: 400px;">
                                        {!! Form::open(['route' => ['admin.users.destroy', $user], 'method' => 'DELETE', 'class' => 'eliminar-form']) !!}
                                            <center>
                                            <ul class="wrapper" style="height: 50px; display: inline-flex;">
                                                <li class="icon facebook" style="padding:4%">
                                                    <span class="tooltip" style="font-size: 10px;">EDITAR</span>
                                                    <a href="{{ route('admin.users.edit', $user) }}" style="all: unset;">
                                                        <span><i class="fa-solid fa-arrow-up-right-from-square"></i></span>
                                                    </a>
                                                </li>
                                                <li class="icon spetie" style="padding:4%">
                                                <span class="tooltip" style="font-size: 10px;">MOSTRAR</span>
                                                    <a href="{{ route('admin.users.show', $user) }}" style="all: unset;">
                                                        <span><i class="fa-brands fa-readme"></i></span>
                                                    </a>
                                                </li>
                                                <button>
                                                <li class="icon youtube" type="submit">
                                                    <span class="tooltip" style="font-size: 10px;">ELIMINAR</span>
                                                    <span><i class="fa-solid fa-trash" type="submit"></i></span>
                                                </li>
                                                </button>
                                            </ul>
                                            </center>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </center>
                </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@stop


<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/caja/registrar.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 
<style>
    .is-required:after {
    content: '*';
    margin-left: 3px;
    color: red;
    font-weight: bold;
    }
    .wrap {
      text-align: right;
    }
    #addnew{
    -webkit-transition: all 200ms cubic-bezier(0.390, 0.500, 0.150, 1.360);
    -moz-transition: all 200ms cubic-bezier(0.390, 0.500, 0.150, 1.360);
    -ms-transition: all 200ms cubic-bezier(0.390, 0.500, 0.150, 1.360);
    -o-transition: all 200ms cubic-bezier(0.390, 0.500, 0.150, 1.360);
    transition: all 200ms cubic-bezier(0.390, 0.500, 0.150, 1.360);
    max-width: 180px;
    text-decoration: none;
    border-radius: 8px;
    padding: 10px 20px;
    }

    #addnew {
        color: rgba(30, 22, 54, 0.6);
        box-shadow: rgba(30, 22, 54, 0.4) 0 0px 0px 2px inset;
        background-color: #ffff;
    }

    #addnew:hover {
        color: rgba(255, 255, 255, 0.85);
        box-shadow: rgba(30, 22, 54, 0.7) 0 0px 0px 40px inset;
    }

    #addnew {
        color: rgba(30, 22, 54, 0.6);
        box-shadow: rgba(30, 22, 54, 0.4) 0 0px 0px 2px inset;
    }

    #addnew:hover {
        color: rgba(255, 255, 255, 0.85);
        box-shadow: rgba(30, 22, 54, 0.7) 0 80px 0px 2px inset;
    }
</style>
@notifyCss

@section('js')
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.8/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.8/js/responsive.bootstrap4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>

    <script>
        $('.eliminar-form').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Quieres eliminar?',
                text: "El registro se eliminara definitivamente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>
    @if (session('delete') == 'ok')
        <script>
            Swal.fire(
                'Eliminar!',
                'Se Eliminó el registro.',
                'warning'
            )
        </script>
    @endif


    <script>
        $(document).ready(function() {
            $('.users').DataTable({
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
@stop
