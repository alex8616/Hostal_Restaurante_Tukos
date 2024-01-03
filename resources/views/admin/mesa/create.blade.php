@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<br><br><hr>
<ul>
    <li id="cartpedido">
        <h4>
            <a data-toggle="modal" data-target="#modelId">
                <i class="fa fa-shopping-cart red"></i>  Ver Platos 
                <span id="areaContador" class="badge badge-red">0</span>
            </a>
        </h4>
    </li>
</ul>
<form action="{{ url('/mesa') }}" method="post" enctype="multipart/form-data" class="registrar-form">
@csrf
<input type="text" id="caja_id" name="caja_id" value="{{ $ultimo_registro->id }}" hidden>
<div class="parent">
<div class="content">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header card-header-danger">
                        <table style="width:100%">
                            <tr>
                                <td><h4 class="card-title">DATOS PLATO</h4></td>
                                <td class="text-right">
                                <div class="wrap">
                                </div>
                                </td>
                                <td class="text-right">
                                <div class="wrap">
                                </div>
                                </td>
                                <td class="text-right">
                                </td>
                            </tr>
                        </table> 
                    </div>
            <div class="container" id="containerplatos" style="background-color:white"><br>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <div class="form-chek form-check-inline form-switch" style="float: right;">
                            <input type="hidden" class="switch" value="1" name="pensionado" id="pensionado">
                            <input class="switch" type='checkbox' value="0" name="pensionado" id="pensionadoCheckbox">
                        </div>

                        <div class="form-group col-md-12" id="pensionados-container" style="display: none;">
                            <label for="cliente_id">Pensionados</label>
                            <select class="form-control selectpicker clienteB" data-live-search="false" name="pensionado_id" id="pensionado_id" lang="es">
                                <option value="" data-icon="fa-solid fa-square" disabled selected>Seleccionar Pensionado</option>
                                @foreach ($pensionados as $pensionado)
                                    @if($pensionado->estado == 'TRUE')
                                        <option value="{{ $pensionado->id }}">
                                            {{ $pensionado->Nombre_tipoclientes }} 
                                        </option>
                                    @endif                                    
                                @endforeach
                            </select>
                        </div> 
                    </div>
                    <div class="form-group col-md-12">
                        <label for="cliente_id">Numero De Mesa</label>
                        <select class="form-control selectpicker clienteB" data-live-search="false" name="mesa_id" id="mesa_id" lang="es">
                            <option value="" data-icon="fa-solid fa-square" disabled selected>Seleccionar Mesa</option>
                            @foreach ($mesas as $mesa)
                                <option  value="{{ $mesa->id }}">
                                    {{ $mesa->Nombre_mesa }} 
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="id_plato">Plato</label>
                        <select class="form-control selectpicker articuloB" data-live-search="false" name="id_plato"
                            id="id_plato" lang="es" autofocus>
                            <option value="" data-icon="fa-solid fa-bowl-rice" disabled selected>Buscar Plato</option>
                            @foreach ($menus as $plato)
                                <option data-content="<table><tr>
                                @if(isset($plato->imagen))
                                    <td style='width:200px'>
                                    <img class='img-fluid img-thumbnail' src='{{ asset('storage' . '/' . $plato->imagen) }}' style='width:500px;'/></td>
                                @else 
                                    <td style='width:200px'>
                                    <img class='img-fluid img-thumbnail' src='{{ asset('imagen/nofound.png') }}' style='width:500px;'/></td>
                                @endif
                                <td style='width:60px'><br></td>
                                <td style='width:200px'><h5><strong>{{ $plato->Nombre_plato }}</strong></h5>
                                </td>
                                </tr></table>" value="{{ $plato->id }}_{{ $plato->stock }}_{{ $plato->Precio_plato }}">
                                {{ $plato->Nombre_plato }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputApellidop" class="is-required">Precio De Venta Plato</label>
                        <input type="number" class="form-control" name="Precio_plato" id="Precio_plato">    
                    </div>
                    <div class="form-group col-md-4">
                        <label for="cantidad" class="is-required">Cantidad</label>
                        <input type="number" class="form-control" name="cantidad" id="cantidad" min="0"
                        max="100" value="1">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="comentario">Comentario</label>
                        <textarea class="form-control" name="comentario" id="comentario" rows="1"></textarea>
                    </div>
                </div><br>
            </div>
            <button type="button" class="btn btn-warning btn-lg" id="agregar" >
                AÑADIR PEDIDO A LA LISTA
                <!-- <script>
                    function contar(){
                        var botonElement = document.getElementById("agregar");
                        var pElement = document.getElementById("areaContador");
                        var contador = 0;
                        botonElement.onclick = function () {
                            contador++;
                            pElement.textContent = contador;
                        }
                    }
                </script> -->
            </button>
        </div>
    </div>
    <!-- Button trigger modal -->
    
    
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>LISTA DE PLATOS A REGISTRARSE</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-striped mt-0.5 table-bordered shadow-lg mt-4 dt-responsive nowrap" id="detalles">
                            <tfoot>
                                <tr>
                                    <th>
                                        <p align="right">TOTAL PAGAR:<span align="right" id="total_pagar_html">Bs 0.00</span>
                                            <input  name="total" id="total_pagar" hidden>
                                        </p>
                                    </th>
                                </tr>
                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    </div>
                        <center>
                            <button type="submit" id="guardar" class="btn btn-success" style="padding:10px;  font-size: 16px;">REGISTRAR</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">CERRAR</button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@stop

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"></link>
<link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('css/material-dashboardForms.css?v=2.1.1') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
   
   input.switch {
    display: inline-block;
        cursor: pointer;
        height: 20px;
        width: 60px;
        position: relative;
        margin: 0 !important;
        padding: 0 !important;
    }
    input.switch:checked::before {
        background: #0ab534;
    }
    input.switch::before {
        font-size: 14px;
        color: #fff;
        content:'SI - NO';
        position: absolute;
        background: #ea5849;
        width: 80px;
        border-radius: 1px;
        height: 25px;
        top: -4px;
        left: 0px;
        text-align: center;
    }
    input.switch::after {
    content:'';
    display: block;
    position: absolute;
    background: #FFF;
    border-radius: 2px;
    height: 21px;
    width: 35px;
    top: -3px;
    left: 3px;
    box-shadow: 0 0.1em 0.3em rgba(0,0,0,0.3);
    transition: all 300ms;
    }
    input.switch:checked::after {
    left: 42px; 
    }
    input.round.switch::after, input.round.switch::before {
        border-radius: 20px;
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
        color: #ea5849;
        box-shadow: #ea5849 0 0px 0px 40px inset;
    }

    a.button2 {
        color: #ea5849;
        box-shadow: #ea5849 0 0px 0px 2px inset;
    }

    a.button2:hover {
        color: #ea5849;
        box-shadow: #ea5849 0 80px 0px 2px inset;
    }
    .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
    }

    .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
    }

    input:checked + .slider {
    background-color: #2196F3;
    }

    input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
    }
    .bootstrap-select .btn {
    background-color: #fff;
    border-style: solid;
    border-left-width: 3px;
    border-top: none;
    border-bottom: none;
    border-right: none;
    color: black;
    font-weight: 200;
    padding: 12px 12px;
    font-size: 16px;
    margin-bottom: 10px;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    font-weight: bold !important;
    color: #8F8F8F !important;
    background: #fff !important;
    text-transform: uppercase;
    border-left-color: #FF0000;
    }
    .bootstrap-select .dropdown-menu {
    margin: 15px 0 0;
    }
    select::-ms-expand {
    /* for IE 11 */
    display: none;
    }
    #cartpedido{
      background-color:#ff9900;
      list-style: none;
      display: inline-block;
      color: #fff;
      text-decoration: none;
      color: #fff;
      padding: 5px 0px 0px;
      color: #fff;
      transition-duration: 0.3s;
      -moz-transition-duration: 0.3s;
      -webkit-transition-duration: 0.3s;
      border-radius: 8px;
   }
    a {
    -webkit-transition: all 200ms cubic-bezier(0.390, 0.500, 0.150, 1.360);
    -moz-transition: all 200ms cubic-bezier(0.390, 0.500, 0.150, 1.360);
    -ms-transition: all 200ms cubic-bezier(0.390, 0.500, 0.150, 1.360);
    -o-transition: all 200ms cubic-bezier(0.390, 0.500, 0.150, 1.360);
    transition: all 200ms cubic-bezier(0.390, 0.500, 0.150, 1.360);
    max-width: 100%;
    text-decoration: none;
    border-radius: 8px;
    padding: 10px 20px;
    }
</style>
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    const checkbox = document.getElementById('pensionadoCheckbox');
    const pensionadosContainer = document.getElementById('pensionados-container');

    checkbox.addEventListener('change', function() {
    if (this.checked) {
        pensionadosContainer.style.display = 'block';
    } else {
        pensionadosContainer.style.display = 'none';
        document.getElementById('pensionado_id').value = '';
    }
    });
</script>
<script type="text/javascript">
    var path_plato = "{{ route('autocomplete') }}";

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
            $('#id_plato').val(ui.item.id);
            $('#Nombre_plato').val(ui.item.Nombre_plato);
            $('#Precio_plato').val(ui.item.Precio_plato);
            console.log(ui.item); 
            return false;
        }
    });
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
    $("#id_plato").change(mostrarValores);

    function mostrarValores() {
        datosProducto = document.getElementById('id_plato').value.split('_');
        $("#Precio_plato").val(datosProducto[2]);
    }

    function agregar() {
        datosProducto = document.getElementById('id_plato').value.split('_');
        pElement = document.getElementById("areaContador");
        id_plato = datosProducto[0];

        articulo = $("#id_plato option:selected").text();
        cantidad = $("#cantidad").val();
        comentario = $("#comentario").val();
        Precio_plato = $("#Precio_plato").val();
        if (id_plato != "" && cantidad != "" && cantidad > 0  && Precio_plato != "") {
            if (parseInt(cantidad) > 0) {
                subtotal[cont] = (cantidad * Precio_plato);
                total = total + subtotal[cont];
                pElement.textContent = cont;
                var fila = '<tr class="selected" id="fila' + cont +
                '"style="width:50%"><td style="width:100%"><strong style="color:blue;">QUITAR DE LA LISTA: </strong><button style="padding:0px; margin:auto;" type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont +');">Eliminar</button>'+
                '<hr><strong style="color:blue;">PLATO: </strong>'+ '<input type="hidden" name="id_plato[]" value="' + id_plato + '">' + articulo +
                '<hr><strong style="color:blue;">P. VENTA (Bs): </strong>'+'<input style="border:none; width:80px" type="hidden" name="Precio_plato[]" value="' +
                    parseFloat(Precio_plato).toFixed(2) + '"><input style="border:none; width:80px" type="number" value="' +
                    parseFloat(Precio_plato).toFixed(2)+ '" disabled>'+
                '<hr><strong style="color:blue;">CANTIDAD: </strong>'+ '<input type="hidden" name="cantidad[]" value="' +
                    cantidad + '"><input style="border:none; width:40px" type="number" value="' + cantidad + '" disabled>'+
                '<hr><strong style="color:blue;">SUB TOTAL (Bs): </strong>'+ parseFloat(subtotal[cont]).toFixed(2) +
                '<hr><strong style="color:blue;">COMENTARIO: </strong></th>'+ '<input type="hidden" name="comentario[]" value="' +comentario + '">' + comentario + '.' + '</td></tr>';
                cont++;
                // var fila = '<tr class="selected" id="fila' + cont +'"style="width:50%"><th style="width:50%">ELIMINAR:<hr>PLATO:<hr>P. VENTA (Bs)<hr>Cantidad<hr>SUB TOTAL (Bs)<hr>COMENTARIO</th>'+
                //     '<th style="width:50%; padding:0px; margin:auto;"><button style="padding:0px; margin:auto;" type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont +
                //     ');">Quitar</button><hr><input type="hidden" name="id_plato[]" value="' +
                //     id_plato + '">' + articulo + '<hr><input type="hidden" name="Precio_plato[]" value="' +
                //     parseFloat(Precio_plato).toFixed(2) + '"><input style="border:none" type="number" value="' +
                //     parseFloat(Precio_plato).toFixed(2) +
                //     '" disabled><hr><input type="hidden" name="cantidad[]" value="' +
                //     cantidad + '"><input style="border:none" type="number" value="' + cantidad +
                //     '" disabled><hr>Bs ' + parseFloat(subtotal[cont]).toFixed(2) + 
                //     '<hr><input type="hidden" name="comentario[]" value="' +comentario + '">' + comentario + '.' + '</th></tr>';
                // cont++;
                
                sms();
                limpiar();
                totales();
                evaluar();
                $('#detalles').append(fila);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Lo siento',
                    text: 'La cantidad a vender supera el stock.',
                })
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Lo siento',
                text: 'Rellene todos los campos del detalle de la venta.',
            })
        }
    }

    function sms(){
        Swal.fire('Plato Agreado A La Lista Correctamente')
    }

    function limpiar() {
        $("#id_plato").val("");
        $("#cantidad").val("1");
        $("#descuento").val("0");
        $("#comentario").val("");
        $("#Precio_plato").val("");
    }

    function totales() {
        $("#total").html("Bs " + total.toFixed(2));
        total_pagar = total;
        $("#total_pagar_html").html("Bs " + total_pagar.toFixed(2));
        $("#total_pagar").val(total_pagar.toFixed(2));
    }

    function evaluar() {
        if (total > 0) {
            $("#guardar").show();
        } else {
            $("#guardar").hide();
        }
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

<script>
    $('.registrar-form').submit(function(e) {
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
@if (session('delete') == 'ok')
    <script>
        Swal.fire(
            'Eliminar!',
            'Se Eliminó el registro.',
            'warning'
        )
    </script>
@endif
@notifyJs
@endpush