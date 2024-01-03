@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
<div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S</span><br>REGISTRO MENUS</h1>
</div>
@stop

@section('content')
<form action="{{ url('/menu') }}" method="post" enctype="multipart/form-data">
@csrf
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div id="orders-chart-legend" class="orders-chart-legend">
                        <div class="container">
                            <label for="id_plato">Plato</label>
                            <select class="form-control selectpicker articuloB" data-live-search="true" name="id_plato"
                                id="id_plato" lang="es" autofocus>
                                <option value="" data-icon="fa-solid fa-bowl-rice" disabled selected>Buscar Plato</option>
                                @foreach ($platos as $plato)
                                    <option value="{{ $plato->id }}_{{ $plato->stock }}_{{ $plato->Precio_plato }}">
                                        {{ $plato->Nombre_plato }} {{ $plato->Precio_plato }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button type="button" id="agregar" class="btn btn-info float-right"> <i class="fas fa-check"></i> Agregar Artículo</button>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div id="orders-chart-legend" class="orders-chart-legend">
                        <div class="container">
                        <table id="detalles" class="table table-striped col-md-12 table-bordered shadow-lg">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Eliminar</th>
                                    <th>Plato</th>
                                </tr>
                            </thead>
                        </table>
                        </div>
                    </div>
                </div>
                <button type="submit" id="guardar" class="btn btn-success float-right">Registrar</button>
                <a href="{{ route('admin.menu.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </div>
</form>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"></link>
    <link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <style>
    #button{
        width: 50%;
    }
    </style>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>

    <script>
     $(document).ready(function() {
         $("#agregar").click(function() {
             agregar();
          });
       });

        var cont = 1;
        total = 0;
        subtotal = [];
        $("#guardar").hide();
        $("#id_plato").change(mostrarValores);

        function mostrarValores() {
            datosProducto = document.getElementById('id_plato').value.split('_');
        }

        function agregar() {
            datosProducto = document.getElementById('id_plato').value.split('_');
            id_plato = datosProducto[0];

            articulo = $("#id_plato option:selected").text();
            if (id_plato != "") {
                    var fila = '<tr class="selected" id="fila' + cont +
                        '"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont +
                        ');"><i class="fa fa-trash-alt"></i> Quitar De La Lista</button></td> <td><input type="hidden" name="id_plato[]" value="' +
                        id_plato + '">' + articulo + '</td></tr>';
                    cont++;
                    limpiar();
                    evaluar();
                    $('#detalles').append(fila);
                }else {
                Swal.fire({
                    icon: 'error',
                    title: 'Lo siento',
                    text: 'NO seleccionaste Nada ...',
                })
            }
        }
    
        function limpiar() {
            $("#cantidad").val("");
            $("#descuento").val("0");
        }

        function evaluar() {
            $("#guardar").show();   
        }

        function eliminar(index) {
            total = total - subtotal[index];
            total_pagar_html = total;
            $("#total").html("Bs" + total);
            $("#total_pagar_html").html("Bs" + total_pagar_html.toFixed(2));
            $("#total_pagar").val(total_pagar_html.toFixed(2));
            $("#fila" + index).remove();
            evaluar();
        }
    </script>
    <script>
        $(document).ready(function() {
            $("form").keypress(function(e) {
                if (e.which == 13) {
                    return true;
                }
            });
        });
    </script>
@stop
