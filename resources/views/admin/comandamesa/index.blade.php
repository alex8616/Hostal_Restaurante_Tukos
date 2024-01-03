@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<br><br><hr>
<div class="container-fluid" style="width: 90%;">
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
            <table style="width:100%">
                <tr>
                <td><h4 class="card-title">COMANDAS - MESAS</h4></td>
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
                    <a href="{{ route('admin.mesa.create') }}" class="button">Añadir</a>
                    </div>
                </td>
                </tr>
            </table>
            </div>
            <div class="card-body">
            <div class="table-responsive"><br>
            <table class="table table-striped mt-0.5 table-bordered shadow-lg mt-4 dt-responsive nowrap" id="categoria">
                <thead class=" text-primary">
                    <th class="text-center">
                    <strong>ID</strong>
                    </th>
                    <th class="text-center">
                    <strong>FECHA DE REGISTRO</strong>
                    </th>
                    <th class="text-center">
                    <strong>N° MESA</strong>
                    </th>
                    <th class="text-center">
                    <strong>TOTAL</strong>
                    </th>
                    <th class="text-center">
                    <strong>ACCION</strong>
                    </th>
                </thead>
                <tbody>
                    @php
                        $i=1;
                    @endphp
                    @foreach ($comandamesas as $comanda)
                        <tr>
                            <td align="center">
                            {{ $i++ }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($comanda->fecha_venta)->format('d-m-Y H:i a') }}
                            </td>
                            <td align="center">{{ $comanda->mesa->Nombre_mesa }}</td>
                            <td align="center">Bs. {{ number_format($comanda->total, 2) }}</td>
                            <td class="cell" style="font-size: 14px;">
                                <center>
                                <ul class="wrapper" style="height: 50px; display: inline-flex;">
                                    <li class="icon facebook" style="padding:4%">
                                        <a href="{{ route('admin.comandamesa.pdf', $comanda) }}" style="all:unset">
                                            <span class="tooltip" style="font-size: 10px;">IMPRIMIR</span>
                                            <span><i class="fa-solid fa-print"></i></span>
                                        </a>
                                    </li>
                                </ul>
                                </center>
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
@endsection

<link href="{{ asset('css/material-dashboardForms.css?v=2.1.1') }}" rel="stylesheet" />
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
    a {
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

    a.button {
        color: rgba(30, 22, 54, 0.6);
        box-shadow: rgba(30, 22, 54, 0.4) 0 0px 0px 2px inset;
        background-color: #ffff;
    }

    a.button:hover {
        color: rgba(255, 255, 255, 0.85);
        box-shadow: rgba(30, 22, 54, 0.7) 0 0px 0px 40px inset;
    }

    a.button2 {
        color: rgba(30, 22, 54, 0.6);
        box-shadow: rgba(30, 22, 54, 0.4) 0 0px 0px 2px inset;
    }

    a.button2:hover {
        color: rgba(255, 255, 255, 0.85);
        box-shadow: rgba(30, 22, 54, 0.7) 0 80px 0px 2px inset;
    }
</style>
@notifyCss
@push('js')
{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.8/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.8/js/responsive.bootstrap4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script>
<script>
    $(document).ready(function() {
        $('#categoria').DataTable({
            responsive: true,
            autoWidth: false,
            "bSort" : false,
            "language": {
                "lengthMenu": "Mostrar registro por página",
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
                [8, 10, 50, -1],
                [5, 10, 50, "All"]
            ]

        });
    });
</script>
    @notifyJs
@endpush
