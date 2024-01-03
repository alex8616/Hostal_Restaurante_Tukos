@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List')])

@section('content')
<br><br>
<hr>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-warning">
            <table style="width:100%">
              <tr>
                <td><h4 class="card-title">LISTA DETALLE DE REGISTROS - {{$ambiente->Nombre_Ambiente}}</h4></td>
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
                    <a href="{{route('admin.ambiente.CrearReserva', $ambiente)}}" class="button" target="_blank">añadir</a>
                    <a href="{{route('admin.ambiente.ExportPDF', $ambiente)}}" class="button" target="_blank" data-target="#ExportarPDF">Exportar PDF</a>
                    <a href="#" class="button" data-toggle="modal" data-target="#modelId">Reporte Por ..</a>
                  </div>
                </td>
              </tr>
            </table>
          </div>
          <div class="card-body">
            <div class="table-responsive">
            <table class="table table-striped mt-0.5 table-bordered shadow-lg mt-4 dt-responsive nowrap" id="categoria">
                <thead class=" text-primary">
                <th class="text-center" style="width: 100px;">
                    <strong>N°</strong>
                  </th>
                  <th class="text-center">
                    <strong>MOTIVO DE RESERVA</strong>
                  </th>
                  <th class="text-center" style="width: 200px;">
                    <strong>FECHA DE RESERVA</strong>
                  </th>
                  <th class="text-center" style="width: 200px;">
                    <strong>HORA INICIO</strong>
                  </th>
                  <th class="text-center">
                    <strong>HORA FINAL</strong>
                  </th>
                  <th class="text-center">
                    <strong>TOTAL</strong>
                  </th>
                  <th class="text-center">
                    <strong>Acciones</strong>
                  </th>
                </thead>
                <tbody>
                    @php
                        $i=1;
                    @endphp
                    @foreach ($reservas as $reserva)
                    @if($reserva->deuda_pagar == 0)
                        <tr>
                            <td class="text-center">{{$reserva->id}}</td>
                            <td class="text-center">{{$reserva->motivo}}</td>
                            <td class="text-center">{{$reserva->fecha}}</td>
                            <td class="text-center">{{$reserva->hora_inicio}}</td>
                            <td class="text-center">{{$reserva->hora_fin}}</td>
                            <td class="text-center">{{$reserva->total}}</td>
                            <td class="text-center">
                                <form action="{{ route('ambiente.destroyreserva', $reserva) }}" method="POST" class="eliminar-form">
                                    @method('DELETE')
                                    @csrf
                                    <ul class="wrapper" style="height: 50px; display: inline-flex;">
                                        <li class="icon spetie" style="padding:4%" data-toggle="modal" data-target="#ShowReserva{{ $reserva->id }}">
                                            <span class="tooltip" style="font-size: 10px;">MOSTRAR</span>
                                            <span><i class="fa-brands fa-readme"></i></span>
                                        </li>
                                        <button>
                                        <li class="icon youtube" type="submit">
                                            <span class="tooltip" style="font-size: 10px;">ELIMINAR</span>
                                            <span><i class="fa-solid fa-trash" type="submit"></i></span>
                                        </li>
                                        </button>
                                    </ul>
                                </form>
                            </td>
                            @include('admin.ambiente.ShowReserva')
                        </tr>
                    @else 
                    <tr style="background-color: #FF6262;">
                        <td class="text-center">{{$reserva->id}}</td>
                        <td class="text-center">{{$reserva->motivo}}</td>
                        <td class="text-center">{{$reserva->fecha}}</td>
                        <td class="text-center">{{$reserva->hora_inicio}}</td>
                        <td class="text-center">{{$reserva->hora_fin}}</td>
                        <td class="text-center">{{$reserva->total}}</td>
                        <td class="text-center">
                            <form action="{{ route('ambiente.destroyreserva', $reserva->id) }}" method="POST" class="eliminar-form">
                                @method('DELETE')
                                @csrf
                                <ul class="wrapper" style="height: 50px; display: inline-flex;">
                                    <li class="icon facebook" data-toggle="modal" style="padding:4%" data-target="#EditReserva{{ $reserva->id }}">
                                        <span class="tooltip" style="font-size: 10px;">COMPLETAR</span>
                                        <span><i class="fa-solid fa-arrow-up-right-from-square"></i></span>
                                    </li>
                                    <li class="icon spetie" style="padding:4%" data-toggle="modal" data-target="#ShowReserva{{ $reserva->id }}">
                                        <span class="tooltip" style="font-size: 10px;">MOSTRAR</span>
                                        <span><i class="fa-brands fa-readme"></i></span>
                                    </li>
                                    <button>
                                    <li class="icon youtube" type="submit">
                                        <span class="tooltip" style="font-size: 10px;">ELIMINAR</span>
                                        <span><i class="fa-solid fa-trash" type="submit"></i></span>
                                    </li>
                                    </button>
                                </ul>
                            </form>
                            @include('admin.ambiente.ShowReserva')
                            @include('admin.ambiente.EditReserva')
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            {{$reservas->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buscar Por Rango FECHA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.ambiente.rangefecha', $ambiente->id) }}" method="get" target="_blank">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" id="ambiente_id" name="ambiente_id" value="{{$ambiente->id}}" hidden>
                            <label for="">Desde Fecha</label>
                            <input type="date" id="desdefecha" name="desdefecha">
                        </div>
                        <div class="col-md-6">
                            <label for="">Hasta Fecha</label>
                            <input type="date" id="hastafecha" name="hastafecha">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-6 grid-margin stretch-card">
                            <button type="submit" class="btn btn-success" tabindex="4" style="width: 100%;" >Buscar </button>
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close" style="width: 100%;">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/bottonfooder.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/caja/registrar.css')}}" rel="stylesheet" type="text/css"/>
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