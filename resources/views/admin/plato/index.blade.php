@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List')])

@section('content')
<br><br><hr>
<!--Font-awsome-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container">
          <header>
        <div style="text-align:center;margin-top:2px;font-weight:bold;text-decoration:none;">
        </div>            
          </header>
    <div class="xs-menu-cont">
    <a id="menutoggle"><i class="fa fa-align-justify"></i> </a>
      <nav class="xs-menu displaynone">
        <ul>
          <li>
            <a href="{{route('admin.caja.index')}}">CAJA</a>
          </li>
          <li>
            <a href="#">About</a>
          </li>
          <li>
            <a href="#">Services</a>
          </li>
          <li>
            <a href="#">Team</a>
          </li>
          <li>
            <a href="#">Portfolio</a>
          </li>
          <li>
            <a href="#">Blog</a>
          </li>
          <li>
            <a href="#">Contact</a>
          </li>

        </ul>
      </nav>
    </div>
    <nav class="menu">
      <ul>
        <li class="active">
          <a href="{{route('admin.plato.index')}}">LISTA PLATOS</a>
        </li>
        <li>
          <a href="{{route('admin.plato.listar')}}">GRID PLATOS</a>  
        </li>
      </ul>
    </nav>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-blue">
          <table style="width:100%">
              <tr>
                <td><h4 class="card-title">LISTADO DE PLATOS</h4></td>
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
                        <th class="col-head" scope="col"><center>Foto Del Plato</center></th>
                        <th class="col-head" scope="col"><center>Nombre Del Plato</center></th>
                        <th class="col-head" scope="col"><center>Categoria Del Plato</center></th>
                        <th class="col-head" scope="col"><center>Precio Del Plato</center></th>
                       <th class="col-head" scope="col"><center>Acciones</center></th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                            @php
                                $i=1;
                            @endphp
                            @foreach($categorias as $categoria)
                                <a href="{{route('admin.plato.cat',$categoria->id)}}">
                                  {{strtoupper($categoria->Nombre_categoria)}}
                                </a>
                            @endforeach
                            @foreach ($platos as $plato)
                            <tr class="table-row">
                                <td class="cell" style="font-size: 14px;"><center>{{ $i++ }}</center></td>
                                <td class="cell" style="font-size: 14px;">
                                  <center>
                                      @if (isset($plato->imagen))
                                          <img class="img-thumbnail" src="{{ asset('storage' . '/' . $plato->imagen) }}" style="width:120px; height:100px;"/>
                                      @else
                                          <img class="img-thumbnail" src="{{ asset('img/errorimg.jpeg') }}" style="width:120px; height:100px;"/>
                                      @endif
                                  </center>
                                </td>
                                <td class="cell" style="font-size: 14px;">{{ ($plato->Nombre_plato) }}</td>
                                <td class="cell" style="font-size: 14px;">{{ ($plato->Nombre_categoria) }}</td>
                                <td class="cell" style="font-size: 14px;">{{ ($plato->Precio_plato) }} Bs.</td>
                                    <td class="cell" style="font-size: 14px;">
                                        <center>
                                            <form action="{{ route('admin.plato.destroy', $plato) }}" method="POST" class="eliminar-form">
                                                @method('DELETE')
                                                @csrf
                                                <ul class="wrapper" style="height: 50px; display: inline-flex;">
                                                    <li class="icon facebook" style="padding:4%" data-toggle="modal" style="padding:6%" data-target="#EditPlato{{ $plato->id }}">
                                                        <span class="tooltip" style="font-size: 10px;">EDITAR</span>
                                                        <span><i class="fa-solid fa-arrow-up-right-from-square"></i></span>
                                                    </li>
                                                    <li class="icon spetie" style="padding:4%" data-toggle="modal" data-target="#ShowPlato{{ $plato->id }}">
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
                                        </center>
                                    </td>
                            </tr>
                            @include('admin.plato.EditPlato')
                            @include('admin.plato.ShowPlato')
                        @endforeach
                    </tbody>          
                </table>
                {{$platos->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- Modal crear plato -->
@include('admin.plato.CrearPlato')
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
            bPaginate: false,
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