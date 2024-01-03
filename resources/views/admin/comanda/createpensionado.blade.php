@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<br><br><hr>
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
        <a href="{{route('admin.comanda.create')}}">CLIENTE NORMAL</a>
      </li>
      <li>
            <a href="{{route('admin.comanda.createpensionado')}}">CLIENTE PENSIONADO</a>  
      </li>
      <li id="cartpedido">
            <h4>
                <a data-toggle="modal" data-target="#modelId">
                    <i class="fa fa-shopping-cart red"></i>  Ver Pedidos 
                    <span id="areaContador" class="badge badge-red">0</span>
                </a>
            </h4>
      </li>
    </ul>
  </nav>
</div>
<form action="{{ route('admin.comanda.storepensionado') }}" method="post" enctype="multipart/form-data" class="registrar-form">
        @csrf
<div class="parent">
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">                    
                <div class="card-header card-header-info">
                    <h4 class="card-title">DATOS CLIENTES - PENSIONADOS</h4>
                </div>
                <input type="text" id="caja_id" name="caja_id" value="{{ $ultimo_registro->id }}" hidden>
                <div class="container" style="background-color: white;"><br>
                <div class="form-row">                    
                    <div class="form-group col-md-4">
                        <label for="inputNombre"  class="is-required">Grupo o Nombre De Pension</label>
                        <input class="typeahead form-control" id="seach_pensionado" type="text" 
                        name="Nombre_cliente" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Nombre_cliente')}}" required>
                        <input class="typeahead form-control" id="tipo_cliente_id" type="text" 
                        name="tipo_cliente_id" onkeyup="javascript:this.value=this.value.toUpperCase();" hidden>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputNombre">Tipo De Pension</label>
                        <input class="typeahead form-control" name="tipo" id="tipo" type="text" readonly><br>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputApellidom">Direccion Domicilio</label>
                        <input class="typeahead form-control" id="Direccion_tipoclientes" type="text" readonly><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header card-header-info">
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
                    <div class="form-group col-md-4">
                        <label for="inputNombre" class="is-required">Plato</label>
                        <input class="typeahead form-control" name="search" id="search" type="text">
                        <input class="typeahead form-control" name="Nombre_plato" id="Nombre_plato" type="text" hidden>
                        <input class="typeahead form-control" name="id_plato" id="id_plato" type="text" hidden>    
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputApellidop" class="is-required">Precio De Venta Plato</label>
                        <input type="number" class="form-control" name="Precio_plato" id="Precio_plato">    
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputApellidom" class="is-required">Cantidad</label>
                        <input type="number" class="form-control" name="cantidad" id="cantidad" min="0"
                        max="100" oninput="validity.valid||(value='')">
                    </div>
                </div><br>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="comentario">Comentario</label>
                        <textarea class="form-control" name="comentario" id="comentario" rows="1"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputApellidop">Descuento</label>
                        <select name="descuento" id="descuento" class="form-select" aria-describedby="basic-addon2" oninput="validity.valid||(value='')">
                            <option value="0">0</option>
                            <option value="5.1383434783">Plan Básico</option>
                            <option value="10.07905217">Plan Familiar</option>
                            <option value="15.01978261">Plan Empresarial</option>
                            <option value="20.94861652">Plan Especial</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-warning btn-lg" id="agregar" >
                AÑADIR PEDIDO A LA LISTA
            </button>
        </div>
    </div>
    <!-- Button trigger modal -->
    
    
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">>LISTA DE PLATOS A REGISTRARSE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">LISTA DE PLATOS A REGISTRARSE</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <table class="table table-striped mt-0.5 table-bordered shadow-lg mt-4 dt-responsive nowrap" id="detalles">
                                        <thead class=" text-primary">
                                        <tr>
                                            <th class="text-center">
                                                <strong>Quitar</strong>
                                            </th>
                                            <th class="text-center">
                                                <strong>Artículo</strong>
                                            </th>
                                            <th class="text-center">
                                                <strong>Comentario</strong>
                                            </th>
                                            <th class="text-center">
                                                <strong>Precio Venta (Bs)</strong>
                                            </th>
                                            <th class="text-center">
                                                <strong>Descuento</strong>
                                            </th>
                                            <th class="text-center">
                                                <strong>Cantidad</strong>
                                            </th>
                                            <th class="text-center">
                                                <strong>SubTotal (Bs)</strong>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th colspan="6">
                                                    <p align="right">TOTAL PAGAR:</p>
                                                </th>
                                                <th>
                                                    <p align="right"><span align="right" id="total_pagar_html">Bs 0.00</span>
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
    ol, ul {
      list-style: none;
    }
    blockquote, q {
      quotes: none;
    }
    blockquote:before, blockquote:after, q:before, q:after {
      content: '';
      content: none;
    }
    table {
      border-collapse: collapse;
      border-spacing: 0;
    }
    header h2 {
      margin: 25px 10px;
      font-size: 28px;
      text-align: center;
      color:  #ea5849;
    }
    .container {
      margin: 10px auto;
      display: table;
      max-width: 100%;
      width: 100%;
    }

    nav.menu {
      background: #ea5849;
      position: relative;
      min-height: 45px;
      height: 100%;
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

    .menu > ul > li {
      list-style: none;
      display: inline-block;
      color: #fff;
      line-height: 45px;
      
    }
    .menu > ul li a, .xs-menu li a {
      text-decoration: none;
      color: #fff;
      padding: 10px 24px;
    }
    .menu > ul li a:hover {
      background:#444;
      color: #fff;
      transition-duration: 0.3s;
      -moz-transition-duration: 0.3s;
      -webkit-transition-duration: 0.3s;
    }
   
    .displaynone{
      display: none;
    }
    .xs-menu-cont{
    display:none;
    }
    .xs-menu-cont > a:hover{
    cursor: pointer;
    }
      
    .xs-menu li {
    color: #fff;
    padding: 14px 30px;
    border-bottom: 1px solid #ccc;
    background: #FF0000;

    }
    .xs-menu  a{
    text-decoration:none;
    }

    
    #menutoggle i {
        color: #fff;
        font-size: 50px;
        margin: 0;
        padding: 0;
    }


    /*--column--*/
    .mm-6column:after, .mm-6column:before, .mm-3column:after, .mm-3column:before{
    content:"";
    display:table;
    clear:both;


    }
    .mm-6column, .mm-3column {
    float: left;
    position: relative;
    }
    .mm-6column {
        width: 100%;
    }
    .mm-3column {
            width: 25%;
    }
    .responsive-img {
        display: block;
        max-width: 100%;

    }
    .left-images{
    margin-right:25px;
    }
    .left-images, .left-categories-list {
      float: left;
    }
    .categories-list li {
        display: block;
        line-height: normal;
        margin: 0;
        padding: 5px 0;
    }
    .categories-list li :hover{
        background:inherit !important;
    }

    .categories-list span {
        font-size: 18px;
        padding-bottom: 5px;
        text-transform: uppercase;
    }
    .mm-view-more{
      background: none repeat scroll 0 0 #FF0000;
        color: #fff;
        display: inline !important;
        line-height: normal;
        padding: 5px 8px !important;
      margin-top:10px;
    }
    .display-on{
    display:block;
    transition-duration: 0.9s;
    }
    .drop-down > a:after{
    content:"\f103";
    color:red;
    font-family: FontAwesome;
    font-style: normal;
    margin-left: 5px;
    }

    img{
      height:150px;
      width:100%;
    }

    .is-required:after {
    content: '*';
    margin-left: 3px;
    color: red;
    font-weight: bold;
    }

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
</style>

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

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

    <script type="text/javascript">
        var path_pensionado = "{{ route('autocompletepensionado') }}";
    
        $( "#seach_pensionado" ).autocomplete({
            source: function( request, response ) {
            $.ajax({
                url: path_pensionado,
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
            $('#seach_pensionado').val(ui.item.label);
            $('#tipo_cliente_id').val(ui.item.id);
            $('#Direccion_tipoclientes').val(ui.item.Direccion_tipoclientes);
            $('#tipo').val(ui.item.tipo);
            console.log(ui.item); 
            return false;
            }
        });
    </script>
    <script>
        $("#cliente_id").change(function() {
            if($("#cliente_id").val() !== "0"){
                $('#tipo_cliente_id').prop('disabled', true);
            }
        });
        $("#tipo_cliente_id").change(function() {
            if($("#tipo_cliente_id").val() !== "0"){
                $('#cliente_id').prop('disabled', true);
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
            datosNombre = document.getElementById('Nombre_plato').value.split('_');
            pElement = document.getElementById("areaContador");
            id_plato = datosProducto[0];
            articulo = $("#id_plato option:selected").text();
            cantidad = $("#cantidad").val();
            comentario = $("#comentario").val();
            descuento = $("#descuento").val();
            Precio_plato = $("#Precio_plato").val();
            if (id_plato != "" && cantidad != "" && cantidad > 0 && descuento != "" && Precio_plato != "" && tipo_cliente_id != "") {
                if (parseInt(cantidad) > 0 && tipo_cliente_id != "") {
                    subtotal[cont] = (cantidad * Precio_plato) - (cantidad * Precio_plato * descuento / 100);
                    total = total + subtotal[cont];
                    pElement.textContent = cont;
                    var fila = '<tr class="selected" id="fila' + cont +
                        '"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont +
                        ');"><i class="zmdi zmdi-close"></i></button></td> <td><input type="hidden" name="id_plato[]" value="' +
                        id_plato + '">' + datosNombre + '</td> <td> <input type="hidden" name="comentario[]" value="' +
                        comentario + '">' + comentario + '</td> <td> <input type="hidden" name="Precio_plato[]" value="' +
                        parseFloat(Precio_plato).toFixed(2) + '"> <input class="form-control" type="number" value="' +
                        parseFloat(Precio_plato).toFixed(2) +
                        '" disabled> </td> <td> <input type="hidden" name="descuento[]" value="' +
                        parseFloat(descuento) + '"> <input class="form-control" type="number" value="' +
                        parseFloat(descuento) + '" disabled> </td> <td> <input type="hidden" name="cantidad[]" value="' +
                        cantidad + '"> <input type="number" value="' + cantidad +
                        '" class="form-control" disabled> </td> <td align="right">Bs ' + parseFloat(subtotal[cont]).toFixed(
                            2) + '</td></tr>';
                    cont++;
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
            $("#search").val("");
            $("#cantidad").val("");
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