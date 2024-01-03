@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
@section('content')
<br><br><hr>
<nav id="navlist">
    <ul>
        <li @if($activeTab == 'comandas') class="active" @endif>
            <a href="{{ route('admin.festival.registrar', $festival->id) }}">Comandas</a>
        </li>
        <li @if($activeTab == 'reservas') class="active" @endif>
            <a href="{{ route('admin.festival.concluirreserva', $festival->id) }}">Reservas
                <span class="badge" id="rescant">{{ $countreserva }}</span>
            </a>
        </li>
        @if($count > 0)
        <li>
            <a data-toggle="modal" data-target="#MostrarPdf{{ $comandaspdf->id }}">Imprimir Ticket</a>
                @include('admin.festival.MostrarPdf')
            </a>
        </li>
        @endif
    </ul>
</nav>

<div style="width: 98%; margin: auto">

</div>
<form action="{{ route('admin.festival.storefestival') }}" method="post" enctype="multipart/form-data" class="registrar-form">
  @csrf
  <div class="row" style="margin-top: -30px; margin-left:auto; margin-right:auto;">
      <div class="col-md-7">
        <div class="card card-primary card-outline div_radius">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                        <input type="text" id="caja_id" name="caja_id" value="{{ $ultimo_registro->id }}" hidden>
                        <input type="text" id="festival_id" name="festival_id" value="{{ $festival->id }}" hidden>
                            <select name="id_plato" id="id_plato" class="form-select custom-select" size="6" style="width: 100%;">
                                <option value="" data-icon="fa-solid fa-bowl-rice" disabled selected hidden>Buscar Plato</option>
                                <center><optgroup label="C O M B O S" class="column"></center>
                                    @foreach ($combos as $index => $combo)
                                    @if ($combo->Nombre_categoria == 'combo' && $combo->festival_id == $festival->id )
                                        <option value="{{ $combo->id }}_{{ $combo->stock }}_{{ $combo->Precio_combo }}">
                                        {{ $combo->Nombre_combo }}
                                        </option>
                                    @endif
                                    @endforeach
                                </optgroup>
                                <center><optgroup label="G A S E O S A S / J U G O S" class="column"></center>
                                    @foreach ($combos as $index => $combo)
                                    @if ($combo->Nombre_categoria == 'gaseosas')
                                        <option value="{{ $combo->id }}_{{ $combo->stock }}_{{ $combo->Precio_combo }}">
                                        {{ $combo->Nombre_combo }}
                                        </option>
                                    @endif
                                    @endforeach
                                </optgroup>
                            </select>
                            </div><br>                        
                        </div>
                </div>    
                <div class="row">
                    <div class="col-md-3">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" class="form-control" name="cantidad" id="cantidad" aria-describedby="helpId" min="0" max="100">
                    </div>
                    <div class="col-md-3">
                        <label for="Precio_plato">Precio de venta</label>
                        <input type="number" class="form-control" name="Precio_plato" id="Precio_plato" aria-describedby="helpId">
                    </div>
                    <div class="col-md-6">
                        <label for="comentario">Comentario</label>
                        <textarea class="form-control" name="comentario" id="comentario" rows="1"></textarea>
                    </div>
                </div>
                <button type="button" class="btn btn-default btn1" id="agregar">
                <i class="fas fa-check-circle text-success"></i>
                Agregar
                </button>
                <div class="alert alert-danger print-save-error-msg" style="display:none">
                <ul></ul>
                </div>                
            </div>
            <div class="card-body" style="margin-top: -18px;">
            <!-- <h5 class="card-title">Special title treatment</h5> -->
            <div class="tableFixHead" style="height: 268px;">
            <div class="table-responsive">
                <table id="detalles" style="width:100%" class="table table-bordered table-sm table-hover text-center __web-inspector-hide-shortcut__">
                    <thead>
                        <tr>
                            <th>N</th>
                            <th>Plato</th>
                            <th>Comentario</th>
                            <th style="width: 10px;">Cantidad</th>
                            <th style="width: 80px;">P. venta</th>
                            <th style="width: 80px;">Subtotal</th>
                            <th><i class="fa-solid fa-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody id="tabla_venta_productos_temp">
                    </tbody>
                </table>
            </div>
            </div>
            <!--TERMINACION DEL DIV DEL SCROLL DE LA TABLA-->
            <!--INICIO DEL DIV DONDE SE PRESENTAN LOS TOTALES GLOBALES-->
                <div class="container" style="border:1px solid #A9A9A9;">
                <div class="row">
                    <div class="col-md-3">
                    <div class="btn-group" role="group" style="width:100%;height:75%;margin-left: -7px;">
                    </div>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-3  text-right">
                    <h5 class="" style="margin-top:8px;">
                        <p align="right"><span align="right" id="total_pagar_html">Bs 0.00</span>
                        </p>
                    </h5>
                    </div>
                </div>
                </div>
            </div>
        </div>      
      </div>
      <div class="col-md-5">
        <div class="card div_radius">
            <div class="card-header">
            <table>
                <tr>
                    <td style="width: 900px;"> 
                        <h3 class="card-title">Datos de la venta</h3>
                    </td>
                    <td class="text-right">
                    </td>
                </tr>
            </table>
            <div class="card-tools">
            </div>
            </div>
            <div class="card-body p-0">
            <div class="container">
                <div class="mb-3">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="inputNombre"  class="is-required">Nombre</label>
                            <select class="select2" name="mesa_id" id="mesa_id">
                                @foreach($mesas as $mesa)
                                    <option value="{{$mesa->id}}" >{{$mesa->Nombre_mesa}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="group">
                            <input type="text" name="total" id="total_pagar" class="form-control text-center input_style_total" placeholder="00.00" readonly="">
                        </div>
                    </div><br><br>
                    <div class="col-md-6">
                        <div class="group">
                            <label for="">Monto pagado</label>
                            <input type="text" id="pagado" name="pagado" class="form-control input_style" placeholder="$ 0.00" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="group">
                        <label for="">Cambio</label>
                        <input type="text" id="vuelto" name="vuelto" class="form-control input_style" readonly="" placeholder="$ 0.00"> 
                        </div>
                    </div>                  
                </div><br>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" id="venta_productos_realizada" class="btn btn-success btn-block btn12">
                            <i class="fas fa-check-circle text-success" style="background: white;"></i>
                            <span style="font-size: 15px;">Registrar</span>
                        </button>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
</form>
     
        <div class="card div_radius">
            <div class="card-header">
            <table>
                <tr>
                    <td style="width: 900px;"> 
                        <h3 class="card-title">Registro De Las Ventas</h3>
                    </td>
                    <td class="text-right">
                    </td>
                </tr>
            </table>
            <div class="card-tools">
            </div>
            </div>
            <div class="card-body p-0" id="table_infor" style="height: 330px; overflow-y: scroll;">
                <div class="container">
                    <table class="table table-hover">
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Producto</th>
                            <th>Total</th>
                            <th>Accion</th>
                        </tr>
                        @foreach($festivales as $festivale)
                            <tr>
                                <td>{{ $festivale->id }}</td>
                                <td>{{ $festivale->fecha_venta }}</td>
                                <td>
                                @foreach ($detallefestivales as $detallefestivale)
                                    @if($festivale->id == $detallefestivale->registrofestival_id)
                                        @if ($detallefestivale->combo)
                                            {{ Str::ucfirst($detallefestivale->combo->Nombre_combo) }} <br>
                                        @endif
                                    @endif
                                @endforeach
                                </td>
                                <td>{{ $festivale->total }}</td>
                                <td style="margin: 50%">
                                    <ul class="wrapper" style="height: 50px; display: inline-flex;">
                                        <li class="icon facebook" style="padding:4%" data-toggle="modal" data-target="#tablePdf{{ $festivale->id }}">
                                            <span class="tooltip" style="font-size: 10px;">IMPRIMIR</span>
                                            <span><i class="fa-solid fa-print"></i></span>
                                        </li>
                                        @include('admin.festival.tablePdf')
                                    </ul>
                                    <ul class="wrapper" style="height: 50px; display: inline-flex;">
                                        <li class="icon facebook" style="padding:4%" data-toggle="modal" data-target="#adddetalle{{ $festivale->id }}">
                                            <span style="color: blue"></i>ADD</span>
                                        </li>
                                        @include('admin.festival.add_detalle_registro')
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            </div>
        </div>
      </div>
  </div>
@endsection
<!-- CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 
<style>
    .column {
        width: 50%;
        float: left;
    }
    .custom-select {
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        font-size: 1rem;
        height: 300px;
        padding: .375rem 1.75rem .375rem .75rem;
        overflow: scroll;
    }
    .custom-select option {
        padding: 10px;
        color: #495057;
        font-weight: normal;
        width: 100%;
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

    #navlist ul {
    list-style-type: none;
    margin: 15px;
    padding: 0;
    overflow: hidden;
    background-color: #f9f9f9;
    }

    #navlist ul li {
    float: left;
    }

    #navlist ul li a {
    display: block;
    color: #333;
    text-align: center;
    padding: 14px 26px;
    text-decoration: none;
    font-size: 18px;
    }

    #navlist ul li a:hover {
    background-color: #ddd;
    }

    #navlist ul li.active a {
        background-color: #0A4D68;
        color: #fff;
    }

    #rescant {
        position: relative;
        background-color: #FFE569;
        color: black;
        padding: 4px 8px;
        border-radius: 50%;
        font-size: 16px;
        top: -10px;
        left: 5px;
    }

</style>
@notifyCss
@push('js')
<!-- JavaScript -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.8/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.8/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            width: '200%',
        });
    });    
</script>
<script>  
    let precio1 = document.getElementById("total_pagar")
    let precio2 = document.getElementById("pagado")
    let precio3 = document.getElementById("vuelto")
  
        precio2.addEventListener("change", () => {
        if(precio2.value < precio1.value){
            precio3.value = 0;
        }else{
            precio3.value = parseFloat(precio2.value) - parseFloat(precio1.value);   
        }
    })    
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
          id_plato = datosProducto[0];
          articulo = $("#id_plato option:selected").text();
          cantidad = $("#cantidad").val();
          comentario = $("#comentario").val();
          descuento = $("#descuento").val();
          Precio_plato = $("#Precio_plato").val();
          if (id_plato != "" && cantidad != "" && cantidad > 0 && descuento != "" && Precio_plato != "") {
              if (parseInt(cantidad) > 0) {
                  subtotal[cont] = (cantidad * Precio_plato);
                  total = total + subtotal[cont];
                  var fila = '<tr id="fila' + cont +
                      '"><td>'+ cont +'</td> <td><input type="hidden" name="id_plato[]" value="' +
                      id_plato + '">' + articulo + '</td> <td> <input type="hidden" name="comentario[]" value="' +
                      comentario + '">' + comentario + '</td> <td> <input type="hidden" name="cantidad[]" value="' +
                      cantidad + '"> <input type="number" value="' + cantidad +
                      '" class="form-control" disabled> </td><td> <input type="hidden" name="Precio_plato[]" value="' +
                      parseFloat(Precio_plato).toFixed(2) + '"> <input class="form-control" type="number" value="' +
                      parseFloat(Precio_plato).toFixed(2) +
                      '" disabled> </td> <td align="right">Bs ' + parseFloat(subtotal[cont]).toFixed(
                          2) + '</td><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont +
                      ');"><i class="fa fa-trash-alt"></i></button></td></tr>';
                  cont++;
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
  
      function limpiar() {
          $("#id_plato").prop("selectedIndex", 0);
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
