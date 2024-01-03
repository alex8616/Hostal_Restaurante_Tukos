@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
<div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S</span><br>REGISTRO A PENSIONADOS</h1>
</div>
@stop

@section('content')
<form action="{{ url('/tipopensionado') }}" method="post" enctype="multipart/form-data">
@csrf
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div id="orders-chart-legend" class="orders-chart-legend">
                        <div class="container">
                            <div class="col-md-12 mb-3">
                                <label for="nombre">Nombre De Pension</label>
                                <input type="text" name="Nombre_tipoclientes" id="Nombre_tipoclientes" value="{{ old('Nombre_tipoclientes') }}" 
                                    class="form-control" tabindex="1" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="nombre">Direccion De Pension</label>
                                <input type="text" name="Direccion_tipoclientes" id="Direccion_tipoclientes" value="{{ old('Direccion_tipoclientes') }}" 
                                    class="form-control" tabindex="1" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="inputApellidom">Tipo De Pension</label>
                                <select id="tipo" name="tipo" class="form-control">
                                    <option value="" >Seleccione Una De las Opciones</option>
                                    <option value="Basico" {{ old('tipo.0') == "Basico" ? "selected" :""}}>Basico</option>
                                    <option value="Familiar" {{ old('tipo.0') == "Familiar" ? "selected" :""}}>Familiar</option>
                                    <option value="Empresarial" {{ old('tipo.0') == "Empresarial" ? "selected" :""}}>Empresarial</option>
                                </select>
                                @if ($errors->has('$cliente->tipo'))
                                        <span class="error text-danger" style="color:#fff";>{{ $errors->first('$cliente->tipo') }}</span><br>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="inputNombre">Fecha Inicio</label>
                                    <input type="date" class="form-control" id="Fecha_Inicio" name="Fecha_Inicio" value="{{ old('Fecha_Inicio') }}">
                                    @if ($errors->has('Fecha_Inicio'))
                                            <span class="error text-danger" style="color:#fff";>{{ $errors->first('Fecha_Inicio') }}</span><br>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                            <div class="form-group">
                                    <label for="inputApellidop">Fecha Final</label>
                                    <input type="date" class="form-control" id="Fecha_Final" name="Fecha_Final" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Fecha_Final') }}">
                                    @if ($errors->has('Precio_plato'))
                                            <span class="error text-danger" style="color:#fff";>{{ $errors->first('Fecha_Final') }}</span><br>
                                    @endif
                                </div>
                            </div>  
                        </div>
                        <div class="container">
                            <label for="cliente_id">Clientes</label>
                            <select class="form-control selectpicker" data-live-search="true" name="cliente_id"
                                id="cliente_id" lang="es" autofocus>
                                <option value="" data-icon="fas fa-user-tie" disabled selected>Seleccionar cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}_{{ $cliente->stock }}_{{ $cliente->Precio_plato }}">
                                        {{ $cliente->Nombre_cliente }} {{ $cliente->Apellidop_cliente }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button type="button" id="agregar" class="btn btn-info float-right"> <i class="fas fa-check"></i> Agregar Cliente Al Grupo</button>
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
                                    <th>Cliente Agregado</th>
                                </tr>
                            </thead>
                        </table>
                        </div>
                    </div>
                </div>
                <button type="submit" id="guardar" class="btn btn-success float-right">Registrar</button>
                <a href="{{ route('admin.pensionado.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </div>
</form>
@stop

@section('content_top_nav_right')
    @include('notificaciones')
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
        window.onload = function(){
            var fecha = new Date(); //Fecha actual
            var mes = fecha.getMonth()+1; //obteniendo mes
            var dia = fecha.getDate(); //obteniendo dia
            var ano = fecha.getFullYear(); //obteniendo año
            if(dia<10)
                dia='0'+dia; //agrega cero si el menor de 10
            if(mes<10)
                mes='0'+mes //agrega cero si el menor de 10
            document.getElementById('Fecha_Inicio').value=ano+"-"+mes+"-"+dia;
        }
    </script>
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
        $("#cliente_id").change(mostrarValores);

        function agregar() {
            datosProducto = document.getElementById('cliente_id').value.split('_');
            cliente_id = datosProducto[0];

            cliente = $("#cliente_id option:selected").text();
            if (cliente_id != "") {
                    var fila = '<tr class="selected" id="fila' + cont +
                        '"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont +
                        ');"><i class="fa fa-trash-alt"></i> Quitar De La Lista</button></td> <td><input type="hidden" name="cliente_id[]" value="' +
                        cliente_id + '">' + cliente + '</td></tr>';
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
