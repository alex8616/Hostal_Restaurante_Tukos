@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<br><br><hr>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="border-bottom text-center pb-4">
                        <h3>{{ isset($role->name) ? Str::ucfirst($role->name) : '' }}</h3>
                        <div class="d-flex justify-content-between">
                        </div>
                    </div>
                    <div class="border-bottom py-4">
                        <div class="list-group">
                            <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list"
                                href="#list-home" role="tab" aria-controls="home">
                                Permisos
                            </a>
                            <a type="button" class="list-group-item list-group-item-action" id="list-profile-list"
                                data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Usuarios</a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-8 pl-lg-5">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-home" role="tabpanel"
                            aria-labelledby="list-home-list">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>Permisos asignados al rol</h4>
                                </div>
                            </div>
                            <div class="profile-feed">
                                <div class="d-flex align-items-start profile-feed-item">

                                    <div class="table-responsive">
                                        <table id="order-listing"
                                            class="table table-striped mt-0.5 table-bordered shadow-lg dt-responsive nowrap permisos">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th>Descripción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($role->permissions as $permission)
                                                    <tr>
                                                        <td>{{ $permission->description }}</td>
                                                    </tr>
                                                @empty <span class="text-danger">
                                                        <h4>El rol no tiene permisos</h4>
                                                    </span>

                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>Usuarios con el rol</h4>
                                </div>
                            </div>
                            <div class="profile-feed">
                                <div class="d-flex align-items-start profile-feed-item">

                                    <div class="table-responsive">
                                        <table id="order-listing1"
                                            class="table table-striped mt-0.5 table-bordered shadow-lg dt-responsive nowrap ">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Correo electrónico</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>
                                                            {{ $user->name }}
                                                        </td>
                                                        <td>{{ $user->email }}</td>
                                                        <td style="width: 250px;">
                                                            {!! Form::open(['route' => ['admin.users.destroy', $user], 'method' => 'DELETE', 'class' => 'eliminar-form']) !!}
                                                            @can('users.show')
                                                                <a href="{{ route('admin.users.show', $user) }}"
                                                                    class="btn btn-info">Ver</a>
                                                            @endcan

                                                            @can('users.edit')
                                                                <a class="btn btn-success"
                                                                    href="{{ route('admin.users.edit', $user) }}">Editar</a>
                                                            @endcan

                                                            @can('users.destroy')
                                                                <button class="btn btn-danger" type="submit">Eliminar</button>
                                                            @endcan

                                                            {!! Form::close() !!}
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
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary float-right">Regresar</a>
        </div>
    </div>
@stop

@section('css')
<link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
@stop

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
            $('.permisos').DataTable({
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
