@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List')])

@section('content')
<br>
<form onsubmit="validar();" action="{{ route('admin.ambiente.reservastore') }}" method="POST">
    @csrf
    <div class="row" style="margin:auto;">
        <div class="col-md-5">
            <div class="card card-primary card-outline div_radius">
            <div class="card-header">
                <table>
                    <tr>
                        <td style="width: 75%;"> 
                            <h3 class="card-title">Datos de la Reserva <strong style="color:red">{{$ambiente->Nombre_Ambiente}}</strong></h3>
                        </td>
                    </tr>
                </table>
            <div class="card-tools">
            </div>
            </div>
                <div class="row" style="margin: 4px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="motivo">Nombre Completo CLIENTE</label><br>
                            <input type="text" name="cliente" id="cliente" value="{{ old('cliente') }}" class="form-control"
                                tabindex="1" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                        </div>
                    </div>
                </div><br>
                <div class="row" style="margin: 4px;">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="ambiente_id" id="ambiente_id" value="{{ old('id', $ambiente->id) }}" class="form-control"
                                tabindex="1" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" hidden>
                                <label for="fecha">Fecha: </label><br>
                            <input type="date" name="fecha" id="fecha" value="{{ old('fecha') }}" class="form-control"
                                tabindex="1" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="hora_inicio">Hora Inicio: </label><br>
                            <input type="time" name="hora_inicio" id="hora_inicio" value="{{ old('hora_inicio') }}" class="form-control"
                                tabindex="1" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="hora_fin">Hora Fin: </label><br>
                            <input type="time" name="hora_fin" id="hora_fin" value="{{ old('hora_fin') }}" class="form-control"
                                tabindex="1" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                        </div>
                    </div>
                </div><br>
                <div class="row" style="margin: 4px;">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="motivo">Motivo: </label><br>
                            <input type="text" name="motivo" id="motivo" value="{{ old('motivo') }}" class="form-control"
                                tabindex="1" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="precio">Precio Alquiler Ambiente </label>
                        <input id="precio" name="precio" type="text"  class="form-control" oninput="calculate()" onkeyup="PasarValor();" required>
                    </div>
                </div><br>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <div class="row" style="margin: 4px;">                            
                    <div class="col-md-4 grid-margin stretch-card">
                        <label for="adelanto">TOTAL A PAGARSE: </label>
                        <input id="total" name="total" type="text"  class="form-control" oninput="calculate()" onkeyup="PasarValor2();">
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <label for="adelanto">Adelanto: </label>
                        <input id="adelanto" name="adelanto" type="text"  class="form-control" oninput="calculate()" required>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <label for="deuda_pagar">Total Deuda</label>
                        <input id="deuda_pagar" name="deuda_pagar" class="form-control" required>
                    </div>  
                </div><br><br>
                <div class="form-group" style="margin: auto;">
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <button type="submit" class="btn btn-success" tabindex="4" style="width:100%;">Registrar </button>
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" style="width:100%;">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-7">        
        <div class="card div_radius">
            <div class="card-header">
            <table>
                <tr>
                    <td style="width: 900px;"> 
                        <h3 class="card-title"><strong>LA RESERVA TENDRA REFRIGERIO O ALGUN DETALLE?</strong></h3>
                    </td>
                </tr>
            </table>
            <div class="card-tools">
            </div>  
            </div>
            <div class="card-body p-0">
                <div class="container">
                    <center>
                        <table>
                            <tr>
                                <td style="width: 20px; align-content:right;"><span class="auto-style4"> SI</span></td>
                                <td style="width: 30px;"><input name="pago1" class="pago" type="radio" value="Ventanilla"/></td>
                                <td style="width: 30px;"><span class="auto-style4"> NO</span></td>
                                <td style="width: 30px;"><input checked="checked" class="pago" name="pago1" type="radio" value="Deposito"/></td>
                            </tr>
                        </table>
                    </center>
                        <br>
                        <div id="div1">
                            <center>
                            <span style="color:#FF0000">RESERVA DEL SALON SIN REFRIGERIO</span>
                            </center>
                        </div>
                        <!--Para register-->     
                        <div id="div2" style="display:none;">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="descripcion_refrigerio">Descripcion</label><br>
                                        <input class="form-control" name="descripcion_refrigerio" id="descripcion_refrigerio">
                                    </div> 
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cantidad_refrigerio">Cantidad: </label><br>
                                        <input id="cantidad_refrigerio" name="cantidad_refrigerio" type="text"  class="form-control" oninput="calculate()">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="precio_refrigerio">Precio Unitario: </label><br>
                                        <input id="precio_refrigerio" name="precio_refrigerio" type="text"  class="form-control" oninput="calculate()">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-default btn1" id="agregar">
                                        <i class="fas fa-check-circle text-success"></i>
                                            Agregar
                                        </button>
                                    </div>
                                </div>                              
                            </div><br>             
                                <div class="card-body" style="margin-top: -18px;">
                                <!-- <h5 class="card-title">Special title treatment</h5> -->
                                <div class="tableFixHead" id="divscroll" style="height: 268px;">
                                    <table id="detalles" style="width:100%" class="table table-bordered table-sm table-hover text-center __web-inspector-hide-shortcut__">
                                        <thead>
                                            <tr>
                                            <th>Num</th>
                                            <th>Descripcion</th>
                                            <th style="width: 10px;">Cantidad</th>
                                            <th style="width: 80px;">Precio venta</th>
                                            <th style="width: 80px;">Subtotal</th>
                                            <th scope="col"><i class="fas fa-trash-alt" style="width: 5px;"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabla_venta_productos_temp">
                                        </tbody>
                                    </table>
                                    <!-- /.table -->
                                </div>
                                <!--TERMINACION DEL DIV DEL SCROLL DE LA TABLA-->
                                <!--INICIO DEL DIV DONDE SE PRESENTAN LOS TOTALES GLOBALES-->
                                    <div class="container" style="border:1px solid #A9A9A9;">
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
        <div class="card div_radius">
            <div class="row" style="margin: 5px;">
                <div class="col-md-12"></div>
                <div class="col-md-12 text-right">
                    <table class="table">
                        <tr>
                            <td colspan="5">Precio Del Alquiler {{$ambiente->Nombre_Ambiente}}</td>
                            <td>
                                <input  type="number" name="total_reserva" id="total_reserva" class="monto" value="0" onchange="sumar();" readonly>
                            </td>
                            
                        </tr>
                        <tr>
                            <td colspan="5">Precio Del Detalle</td>
                            <td>
                                <input  type="number" name="total_pagar" id="total_pagar" class="monto" value="0" onchange="sumar();" readonly>
                            </td>
                        </tr>
                        <tr>                            
                            <td colspan="5"><strong>TOTAL A PAGARSE</strong></td>
                            <td>
                                <strong>
                                    <input type="number" name="total_total2" id="total_total2" value="0" readonly>
                                </strong>
                            </td>
                        </tr>
                    </table>
                    <script>
                        function PasarValor(){
                            document.getElementById("total_reserva").value = document.getElementById("precio").value;
                        }
                        function PasarValor2(){
                            document.getElementById("total_total2").value = document.getElementById("total").value;
                        }
                        function sumar(){
                            const $total = document.getElementById('total');
                            let subtotal_suma = 0;
                            [ ...document.getElementsByClassName( "monto" ) ].forEach( function ( element ) {
                                if(element.value !== '') {
                                    subtotal_suma += parseFloat(element.value);
                                }
                            });
                            $total.value = subtotal_suma.toFixed(2);
                            }
                    </script>
                </div>
            </div>
        </div>
</form>
@endsection
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/bottonfooder.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/caja/registrar.css')}}" rel="stylesheet" type="text/css"/>
<style>
    #divscroll {
        overflow:scroll;
        height:200px;
        width:100%;
        overflow-x: hidden;
    }
    #divscroll table {
        width:100%;
        overflow-x: hidden;
    }
    ::-webkit-scrollbar{
        width: 10px;
        background-color: #F5F5F5;
    }
    ::-webkit-scrollbar-track{
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #F5F5F5;
    }
    ::-webkit-scrollbar-thumb{
        background-color: #F90; 
        background-image: -webkit-linear-gradient(90deg,rgba(255, 255, 255, .2) 25%,transparent 25%,transparent 50%,rgba(255, 255, 255, .2) 50%,rgba(255, 255, 255, .2) 75%,transparent 75%,transparent)
    }
    .hide-scroll {
        overflow: hidden;
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
    $(document).ready(function(){
      $(".pago").click(function(evento){
              
                var valor = $(this).val();
              
                if(valor == 'Deposito'){
                    $("#div1").css("display", "block");
                    $("#div2").css("display", "none");
                }else{
                    $("#div1").css("display", "none");
                    $("#div2").css("display", "block");
                }
        });
    });
</script>
<script>
     try {
        function calculate() {
            var myBox1 = document.getElementById('total').value; 
            var myBox2 = document.getElementById('adelanto').value;
            var resultado = document.getElementById('deuda_pagar'); 
            var myResult = myBox1 - myBox2;
            resultado.value = myResult;
        }
    } catch (error) { throw error; }

    
    $(document).ready(function() {
        $("#agregar").click(function() {
            agregar();
        });
    });
    var cont = 1;
    total_detalle = 0;
    subtotal = [];
    function agregar() {
        descripcion = $("#descripcion_refrigerio").val();
        cantidad = $("#cantidad_refrigerio").val();
        otroprecio = $("#precio_refrigerio").val();
        if (descripcion != "" && cantidad != "" && cantidad > 0 && otroprecio != "") {
            if (parseInt(cantidad) > 0) {
                subtotal[cont] = (cantidad * otroprecio);
                total_detalle = total_detalle + subtotal[cont];
                var fila = '<tr id="fila' + cont +
                    '"><td>'+ cont +'</td> <td><input type="hidden" name="descripcion[]" value="' +
                    descripcion + '">' + descripcion + '</td> <td> <input type="hidden" name="cantidad[]" value="' +
                    cantidad + '"> <input type="number" value="' + cantidad +
                    '" class="form-control" disabled> </td><td> <input type="hidden" name="precio_refrigerio[]" value="' +
                    parseFloat(otroprecio).toFixed(2) + '"> <input class="form-control" type="number" value="' +
                    parseFloat(otroprecio).toFixed(2) +
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
        $("#cantidad").val("");
        $("#descuento").val("0");
        $("#comentario").val("");
    }
    function totales() {
        $("#total").html("Bs " + total_detalle.toFixed(2));
        total_pagar = total_detalle;
        $("#total_pagar_html").html("Bs " + total_pagar.toFixed(2));
        $("#total_pagar").val(total_pagar.toFixed(2));
    }
    function evaluar() {
        if (total_detalle > 0) {
            $("#guardar").show();
        } else {
            $("#guardar").hide();
        }
    }
    function eliminar(index) {
        total_detalle = total_detalle - subtotal[index];
        total_pagar_html = total_detalle;
        $("#total").html("Bs" + total_detalle);
        $("#total_pagar_html").html("Bs" + total_pagar_html.toFixed(2));
        $("#total_pagar").val(total_pagar_html.toFixed(2));
        $("#fila" + index).remove();
        evaluar();
    }
</script>
@notifyJs
@endpush