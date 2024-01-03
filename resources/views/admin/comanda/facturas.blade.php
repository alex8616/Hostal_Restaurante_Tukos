@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<br><br><hr>
<div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-danger">
            <table style="width:100%">
              <tr>
                <td><h4 class="card-title">FACTURAS</h4></td>
                <td class="text-right">
                  <div class="wrap">
                  </div>
                </td>
                <td class="text-right">
                  <div class="wrap">
                  </div>
                </td>
                </td>
              </tr>
            </table>
          </div>
          <div class="card-body">
            <div class="table-responsive"><br>
            <table class="table table-striped mt-0.5 table-bordered shadow-lg mt-4 dt-responsive nowrap" id="categoria">
                <thead class=" text-primary">
                  <th class="text-center">
                    <strong>N FACTURA</strong>
                  </th>
                  <th class="text-center">
                    <strong>FECHA DE EMISION</strong>
                  </th>
                  <th class="text-center">
                    <strong>CODIGO DE CONTROL</strong>
                  </th>
                  <th class="text-center">
                    <strong>CLIENTE</strong>
                  </th>
                  <th class="text-center">
                    <strong>TOTAL</strong>
                  </th>
                  <th class="text-center">
                    <strong>ESTADO</strong>
                  </th>
                  <th class="text-center">
                    <strong>ACCION</strong>
                  </th>
                </thead>
                <tbody>
                    @php
                        $i=1;
                    @endphp
                    @foreach ($facturas as $factura)
                        <tr>
                            <td class="text-center">
                            {{ $factura->numFactura }}
                            </td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($factura->fecha_Emision)->format('d-m-Y H:i a') }}
                            </td>
                            <td class="text-center">
                                {{ $factura->codigo_Control }} 
                            </td>
                            <td>{{ $factura->comanda->cliente->Nombre_cliente }} 
                                    {{ $factura->comanda->cliente->Apellidop_cliente }} 
                            </td>
                            <td class="text-center">
                                Bs. {{ number_format($factura->comanda->total, 2) }}
                            </td>
                            @if ($factura->estado == 'VALIDO')
                                <td class="text-center">
                                    <a class="btn btn-success" href="{{ route('cambio.estado.factura', $factura) }}"
                                        title="Editar" data-toggle="modal" data-target="#EstadoFact{{ $factura->id }}">
                                        VALIDO
                                    </a>
                                </td>
                            @else
                                <td class="text-center">
                                        CANCELADO
                                </td>
                            @endif
                            <td style="width: 50px;">
                                <form action="{{ route('admin.comanda.destroy', $factura) }}" method="POST" class="eliminar-form">
                                        @method('DELETE')
                                        @csrf
                                        <a href="#" class="btn btn-info text-bold"  data-toggle="modal" data-target="#ImpreFactura{{ $factura->id }}" title="Imprimir Comanda"> <i class="zmdi zmdi-print zmdi-hc-2x"></i></a>
                                        <button type="submit" class="btn btn-danger" title="Eliminar Registro">
                                            <i class="zmdi zmdi-delete zmdi-hc-2x"></i>
                                        </button>
                                </form>
                            </td></a>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="EstadoFact{{ $factura->id }}" tabindex="-1" role="dialog" aria-labelledby="EstadoFact" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title"><pre>Cancelar Factura N°: {{  $factura->numFactura }}</pre></h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                <pre style="color:red">Nota una vez cancelado la factura sera, permanente.</pre>
                                <p style="color:red">* estas seguro que quieres cancelar la Factura.</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="{{ route('cambio.estado.factura', $factura->id) }}" class="btn btn-danger">CANCELAR FACTURA</a>
                              </div>
                            </div>
                          </div>
                        </div>
                         <!-- Modal -->
                        <div class="modal fade" id="ImpreFactura{{ $factura->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">{{ $factura->comanda->cliente->Nombre_cliente }} 
                                                          {{ $factura->comanda->cliente->Apellidop_cliente }} 
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                  Quiere Realizar la impresion en que Tamaño de hoja?
                                  <center>
                                    <a href="{{ route('admin.comanda.factura', $factura) }}" class="btn btn-success" target="_blank" title="Imprimir Comanda">Tamaño A4</a>
                                    <a href="{{ route('admin.comanda.ticketfactura', $factura) }}" class="btn btn-blue" target="_blank" title="Imprimir Comanda">Tickect</a>
                                  </center>
                              </div>
                            </div>
                          </div>
                        </div>
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
<link href="{{asset('css/bottonfooder.css')}}" rel="stylesheet" type="text/css"/>
<style>
  html, body
  .modal {
    position: fixed;
    background: rgba(0,0,0,0.8);
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
  }

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
     <script>
        $('#registrar-form').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Estas Seguro Que Quieres Registrar La VENTA?',
                text: "Verificaste Todos Los Registros Correctamente",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Registrar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>
    @notifyJs
@endpush