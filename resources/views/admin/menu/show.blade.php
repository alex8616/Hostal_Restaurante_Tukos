@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List')])

@section('content')
<br><br><hr>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <table>
              <tr>
                <td style="width: 1500px;">
                  <h4 style="color:white">Menu del Dia <strong>{{ \Carbon\Carbon::parse($menu->fecha_registro)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y') }}</strong>
                              - ({{ \Carbon\Carbon::parse($menu->fecha_registro)->format('d-m-Y H:i a') }})</h4>
                </td>
                <td>
                  <button style="background: white; padding: 10px; border-radius: 8px;">
                    <a href="{{ route('admin.menu.addplus', $menu) }}" data-toggle="modal" data-target="#modaladdplus" style="color:black">
                        agregar
                    </a>   
                  </button>               
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
                    <strong>PLATO</strong>
                  </th>
                  <th class="text-center">
                    <strong>DESCRIPCION</strong>
                  </th>
                  <th class="text-center">
                    <strong>IMAGEN</strong>
                  </th>
                </thead>
                <tbody>
                    @php
                        $i=1;
                    @endphp
                    @foreach($detallemenus as $detallemenu)
                    <tr>  
                        <td class="text-center">{{ $i++}}</td>
                        <td>{{ucwords($detallemenu->plato->Nombre_plato)}}</td>
                        <td>{{$detallemenu->plato->Caracteristicas_plato}}</td>
                        <td style="width:300px">
                            <center>
                                @if (isset($detallemenu->plato->imagen))
                                    <img class="img-thumbnail" src="{{ asset('storage' . '/' . $detallemenu->plato->imagen) }}" style="width: 45%; height: 100px;"/>
                                @else
                                    <img class="img-thumbnail" src="{{ asset('storage/uploads/nofound.jpg') }}" style="width: 180px; height: 45%;"/>
                                @endif
                            </center>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <a href="{{route('admin.menu.index')}}" class="btn btn-primary float-left">Regresar</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- Modal -->
<style>
    .ui-menu .ui-menu-item a {
    font-size: 12px;
    }
    .ui-autocomplete {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1510 !important;
    float: left;
    display: none;
    min-width: 160px;
    width: 160px;
    padding: 4px 0;
    margin: 2px 0 0 0;
    list-style: none;
    background-color: #ffffff;
    border-color: #ccc;
    border-color: rgba(0, 0, 0, 0.2);
    border-style: solid;
    border-width: 1px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -webkit-background-clip: padding-box;
    -moz-background-clip: padding;
    background-clip: padding-box;
    *border-right-width: 2px;
    *border-bottom-width: 2px;
    }
    .ui-menu-item > a.ui-corner-all {
        display: block;
        padding: 3px 15px;
        clear: both;
        font-weight: normal;
        line-height: 18px;
        color: #555555;
        white-space: nowrap;
        text-decoration: none;
    }
    .ui-state-hover, .ui-state-active {
        color: #ffffff;
        text-decoration: none;
        background-color: #0088cc;
        border-radius: 0px;
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        background-image: none;
    }
</style>
<div class="modal fade" id="modaladdplus" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          Añadir al Menu del Dia <strong>{{ \Carbon\Carbon::parse($menu->fecha_registro)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y') }}</strong>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.menu.addplus') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" id="id_menu" name="id_menu" value="{{ $menu->id }}" hidden>
            <div id="orders-chart-legend" class="orders-chart-legend">
                <div class="container">
                    <div class="row">
                        <div class="col-9">
                            <div>
                                <label for="seach">Plato</label>
                                <div class="container">
                                    <input class="typeahead form-control" id="search" type="text">
                                    <input class="typeahead form-control" id="Nombre_plato" type="text" hidden>
                                    <input class="typeahead form-control" id="id_plato" type="text" hidden>
                                    <input class="typeahead form-control" id="Precio_plato" type="text" hidden>
                                </div>
                            </div>
                        </div>
                        <div class="col-2"><br>
                            <button type="button" class="btn btn-success" id="agregar">
                                <i class="zmdi zmdi-plus-square zmdi-hc-2x"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <table id="detalles" class="table table-striped col-md-12 table-bordered shadow-lg">
                <thead class="bg-primary text-white">
                    <tr>
                        <th style="width: 100px;" class="text-center">Quitar</th>
                        <th class="text-center">Plato</th>
                        <th class="text-center">Precio</th>
                    </tr>
                </thead>
            </table>
            <center>
                <button type="submit" id="guardar" class="btn btn-success">Registrar</button>
                <a href="{{ route('admin.menu.index') }}" class="btn btn-danger">Cancelar</a>
            </center>
        </form>
      </div>
    </div>
  </div>
</div>
@include('admin.menu.CrearMenu')
@endsection
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .is-required:after {
    content: '*';
    margin-left: 3px;
    color: red;
    font-weight: bold;
    }
</style>
@notifyCss

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.8/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.8/js/responsive.bootstrap4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
    var path_plato = "{{ route('menuautocomplete') }}";

    $( "#search" ).autocomplete({
        source: function( request, response ) {
        $.ajax({
            url: path_plato,
            type: 'GET',
            dataType: "json",
            data: {
            search: request.term
            },
            success: function( data ) {
            response( data );
            }
        });
        },
        select: function (event, ui) {
            $('#search').val(ui.item.label);
            $('#Nombre_plato').val(ui.item.Nombre_plato);
            $('#id_plato').val(ui.item.id);
            $('#Precio_plato').val(ui.item.Precio_plato);
            console.log(ui.item); 
            return false;
        }
    });
</script>
@notifyJs
@endpush