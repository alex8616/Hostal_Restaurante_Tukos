@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List')])

@section('content')
<br><br><hr>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-blue">
          <table style="width:100%">
              <tr>
                <td><h4 class="card-title">LISTADO DE CLIENTES PENSIONADOS SEGUN CATEGORIA</h4></td>
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
                  <a href="#" id="addnew" type="button" data-toggle="modal" data-target="#modelId">Añadir</a> 
                </td>
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
                        <th class="col-head" scope="col"><center>ID</center></th>
                        <th class="col-head" scope="col"><center>NOMBRE DE PENSIONADO</center></th>
                        <th class="col-head" scope="col"><center>TIPO DE PENSION</center></th>
                        <th class="col-head" scope="col"><center>FECHO INICIO</center></th>
                        <th class="col-head" scope="col"><center>FECHA CONCLUCION</center></th>
                        <th class="col-head" scope="col"><center>TIEMPO RESTANTE</center></th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $i=1;
                    @endphp
                    @foreach ($tipoclientes as $tipocliente)
                    @if($tipocliente->Fecha_Final <= now()->toDateString())
                        <tr class="table-row" style="background-color: #FF7373">
                            <td class="cell" style="font-size: 14px; height: 40px;"><center>{{$tipocliente->id}}</center></td>
                            <td class="cell" style="font-size: 14px; height: 40px;">{{$tipocliente->Nombre_tipoclientes}}</td>
                            <td class="cell" style="font-size: 14px; height: 40px;">{{$tipocliente->tipo}}</td>
                            <td class="cell" style="font-size: 14px; height: 40px;">{{$tipocliente->Fecha_Inicio}}</td>
                            <td class="cell" style="font-size: 14px; height: 40px;">{{$tipocliente->Fecha_Final}}</td>
                            <td class="cell" style="font-size: 14px; height: 40px;">
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
                            <td class="cell" style="font-size: 14px; height: 40px;">{{$tipocliente->id}}</td>
                            <td class="cell" style="font-size: 14px; height: 40px;">{{$tipocliente->Nombre_tipoclientes}}</td>
                            <td class="cell" style="font-size: 14px; height: 40px;">{{$tipocliente->tipo}}</td>
                            <td class="cell" style="font-size: 14px; height: 40px;">Inicio el {{ \Carbon\Carbon::parse($tipocliente->Fecha_Inicio)->setTimezone('America/La_Paz')->isoFormat(' dddd D \d\e MMMM \d\e\l Y')}}</td>
                            <td class="cell" style="font-size: 14px; height: 40px;">Concluye el {{ \Carbon\Carbon::parse($tipocliente->Fecha_Final)->setTimezone('America/La_Paz')->isoFormat(' D \d\e MMMM \d\e\l Y')}}</td>
                            <span class="clock" data-countdown="{{ $tipocliente->Fecha_Final}}"></span>
                            <td class="cell" style="font-size: 14px; height: 40px;">
                                {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', now())->diffInDays(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tipocliente->Fecha_Final))}} Dias
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
<!-- Modal crear plato -->
@include('admin.pensionado.CrearPensioado')
@endsection
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

@push('js')
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
            'success'
        )
    </script>
@endif
<script>
    $(document).ready(function() {
        $('#categoria').DataTable({
            responsive: true,
            autoWidth: false,
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
                [6, 10, 50, -1],
                [5, 10, 50, "All"]
            ]

        });
    });
</script>
@notifyJs
@endpush