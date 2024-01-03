@extends('layouts.main', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
@section('content')
<br><br><br>
<div style="background-color:white; width:95%; margin:auto;">
    <div class="parent">
        <div class="div1">
            <center><h3>HOSTAL TUKO'S LA CASA REAL</h3></center>
        </div>
        <div class="div2">
        <form action="#" method="POST" id="add_employee_form" enctype="multipart/form-data">
        @csrf
            <div class="form-row" style="margin: 15px;">
                <div class="col-md-4">
                    <label for="inputNombre" class="is-required">Documento del Cliente</label>
                    <input class="otraclaseform validate-input" id="Documento_cliente" name="Documento_cliente" type="text" 
                    name="Nombre_cliente" onkeyup="javascript:this.value=this.value.toUpperCase();" onfocus="removeRedBorder(this)" onblur="checkInputValue(this)">
                    <input class="otraclaseform validate-input" id="cliente_id" type="text" 
                    name="cliente_id" onkeyup="javascript:this.value=this.value.toUpperCase();" hidden>
                </div>
                <div id="form_cliente" style="display:none; margin: 5px;">
                    <div class="form-row">
                        <div class="col-md-4">
                            <label for="Nombre_cliente" class="is-required">Nombres</label>
                            <input class="otraclaseform validate-input" name="Nombre_cliente" 
                            id="Nombre_cliente" type="text" onfocus="removeRedBorder(this)" onblur="checkInputValue(this)">
                        </div>
                        <div class="col-md-4">
                            <label for="Apellido_cliente" class="is-required">Apellidos</label>
                            <input class="otraclaseform validate-input" name="Apellido_cliente" 
                            id="Apellido_cliente" type="text" onfocus="removeRedBorder(this)" onblur="checkInputValue(this)">
                        </div>
                        <div class="col-md-4">
                            <label for="Profesion_cliente" class="is-required">Profesion</label>
                            <input class="otraclaseform validate-input" name="Profesion_cliente" 
                            id="Profesion_cliente" type="text" onfocus="removeRedBorder(this)" onblur="checkInputValue(this)">
                        </div>
                    </div><br>
                    <div class="form-row">
                        <div class="col-md-3">
                            <label for="Nacionalidad_cliente" class="is-required">Nacionalidad</label>
                            <select class="Nacionalidad_cliente otraclaseform validate-input" id="Nacionalidad_cliente" name="Nacionalidad_cliente">
                                @foreach ($countries['countries'] as $country)
                                    <option value="{{ $country['nationality'] }}">{{ $country['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="EstadoCivil_cliente" class="is-required">Estado Civil</label><br>
                            <select class="Nacionalidad_cliente otraclaseform validate-input" id="EstadoCivil_cliente" name="EstadoCivil_cliente">
                                <option value="Soltero(a)">Soltero(a)</option>
                                <option value="Casado(a)">Casado(a)</option>
                                <option value="Viudo(a)">Viudo(a)</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="Edad_cliente" class="is-required">Edad</label>
                            <input class="otraclaseform validate-input" name="Edad_cliente" 
                            id="Edad_cliente" type="text" onfocus="removeRedBorder(this)" onblur="checkInputValue(this)">
                        </div>
                        <button type="submit" class="btn btn-success" id="add_employee_btn">Registrar</button>
                    </div>
                </div>
            </div
            </form>
        </div>
        <div class="div3">
            <form onsubmit="validar();" action="{{ route('hostal.habitacion.hospedajestore') }}" method="POST">
            @csrf
                <table class="tg" style="width: 100%;" id="detalles">
                    <tbody>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Identificacion</th>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">Nacionalidad</th>
                            <th class="text-center">Profesion</th>
                            <th class="text-center">Edad</th>
                            <th class="text-center">Estado Civil</th>
                            <th class="text-center">Quitar</th>
                        </tr>
                    </tbody>
                </table> 
                <div class="card card-primary card-outline div_radius">
                    <input type="text" id="habitacion_id" name="habitacion_id" value="{{$habitacion->id}}" hidden>
                    <div class="form-row" style="margin: 10px;">
                        <div class="col-md-6">
                            <label for="ingreso_hospedaje"  class="is-required">Ingreso</label>
                            <input class="otraclase" id="ingreso_hospedaje" type="date" 
                            name="ingreso_hospedaje" value="<?php echo date('Y-m-d') ?>" oninput="calculate()" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="salida_hospedaje">Salida</label>
                            <input class="otraclase" name="salida_hospedaje" 
                            id="salida_hospedaje" type="date" min="<?php echo date('Y-m-d') ?>" oninput="calculate()">
                        </div>
                    </div><br>
                    <script src="http://momentjs.com/downloads/moment.min.js"></script>
                    <script>
                        try {
                            function calculate() {
                                var date1 = document.getElementById('salida_hospedaje').value; 
                                var date0 = document.getElementById('ingreso_hospedaje').value; 
                                var fecha1 = moment(date0);
                                var fecha2 = moment(date1);
                                var resultado = document.getElementById('dias_hospedarse');
                                var myResult = fecha2.diff(fecha1, 'days');
                                resultado.value = myResult;
                            }
                        } catch (error) { throw error; }
                    </script>
                    <div class="form-row" style="margin: 10px;">
                        <div class="col-md-6">
                        <label for="procedencia_hospedaje"  class="is-required">Procedente</label>
                        <select class="select2" id="procedencia_hospedaje" name="procedencia_hospedaje" required>
                            <option value="" disabled selected>Seleccione</option>
                            @foreach($departamentos as $departamento)
                            <option value="{{ $departamento['name'] }}"><strong>{{ $departamento['name'] }}</strong></option>
                            @foreach($departamento['ciudades'] as $ciudad)
                                <option value="{{ $ciudad['name'] }}">&nbsp;&nbsp;&nbsp;{{ $ciudad['name'] }}</option>
                            @endforeach
                            @endforeach
                        </select>
                        </div>

                        <div class="col-md-6">
                            <label for="destino_hospedaje">Destino</label><br>
                            <select class="select2" id="destino_hospedaje" name="destino_hospedaje" required>
                                <option value="" disabled selected>Seleccione</option>
                                @foreach($departamentos as $departamento)
                                    <option value="{{ $departamento['name'] }}"><strong>{{ $departamento['name'] }}</strong></option>
                                    @foreach($departamento['ciudades'] as $ciudad)
                                        <option value="{{ $ciudad['name'] }}">&nbsp;&nbsp;&nbsp;{{ $ciudad['name'] }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div><br>
                    <div class="form-row" style="margin: 10px;">
                        <div class="col-md-6">
                            <label for="dias_hospedarse">Dias a Hospedarse</label>
                            <input class="otraclase" name="dias_hospedarse" 
                            id="dias_hospedarse" type="text">
                        </div>
                        <div class="col-md-6">
                            <label for="Precio_habitacion"  class="is-required">Precio Habitacion</label>
                            <input class="otraclase" id="Precio_habitacion" value="{{$habitacion->Precio_habitacion}}" type="text" 
                            name="Precio_habitacion" onkeyup="PasarValor();" reonly>
                        </div>
                    </div><br>
                    <div class="form-row" style="margin: 10px;">
                        <div class="col-md-4">
                            <label for="Adelanto"><strong style="color:black">Adelanto</strong></label>
                            <input class="otraclase" name="Adelanto" 
                            id="Adelanto" type="text" value="0" onkeyup="PasarValor();">
                        </div>
                        <div class="col-md-4">
                            <label for="Adelanto"><strong style="color:black">Deuda Pendiente</strong></label>
                            <input class="otraclase" name="PrecioRestante" 
                            id="PrecioRestante" type="text" value="0" onkeyup="PasarValor();" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="Total"><strong style="color:black">TOTAL</strong></label>
                            <input class="otraclase" name="Total" 
                            id="Total" type="text" value="0" readonly>
                        </div>
                    </div><br>
                    <input  class="buton" type="button" id="boton_calc" value="Costo" hidden>
                    <script>
                        var m1 = document.getElementById("dias_hospedarse");
                        var m2 = document.getElementById("Precio_habitacion");
                        var m3 = document.getElementById("Adelanto");
                        var boton_de_calcular = document.getElementById("boton_calc");
                        boton_de_calcular.addEventListener("click", res);

                        function res() {
                            var multi = (m1.value * m2.value) - m3.value;
                            var totales = m1.value * m2.value;
                            document.getElementById("PrecioRestante").value=multi;
                            document.getElementById("Total").value=totales;
                        }
                        var tiempo = 1000;
                        // intervalo
                        var interval = setInterval(function() {
                        $('#boton_calc').trigger('click');
                        }, tiempo);
                    </script>   
                    <center>
                        <button type="submit" id="guardar" class="btn btn-success">Registrar</button>
                        <a href="{{ route('hostal.habitacion.index') }}" class="btn btn-danger">Cancelar</a>
                    </center>
                </div> 
            </form>
        </div>
        <div class="div4">
            HABITACION: <br>
            Bs. <br>
            $Us. <br>
        </div>
    </div>
</div>
@endsection
@notifyCss
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/bottonfooder.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/caja/registrar.css')}}" rel="stylesheet" type="text/css"/>
<style>
    /**color de borde formulario register*/
    .nueva-fila {
        background-color: #BBFFA1; /* Verde claro */
    }

    label.is-required::before {
        content: "*";
        color: red;
        margin-right: 5px;
    }
    
    input.validate-input.red-border {
        border: 1px solid red;
    }


    /*fin color de borde formulario register*/

    .otraclase{
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .otraclase:focus {
        border-color: #4d94ff;
        box-shadow: 0 0 0 0.25rem rgba(77, 148, 255, 0.25);
    }

    .otraclaseform{
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .otraclaseform:focus {
        border-color: #4d94ff;
        box-shadow: 0 0 0 0.25rem rgba(77, 148, 255, 0.25);
    }
    /*form control final input*/
    /* table css baucher*/
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
    overflow:hidden;word-break:normal;}
    .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
    font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
    .tg .tg-0lax{text-align:left;vertical-align:top}
    /* fin baucher */
    /*grid css*/
    .parent {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        grid-template-rows: 0.2fr repeat(1, 1fr);
        grid-column-gap: 0px;
        grid-row-gap: 0px;
    }

    .div1 { grid-area: 1 / 1 / 2 / 6; }
    .div2 { grid-area: 2 / 1 / 3 / 5; }
    .div3 { grid-area: 3 / 1 / 4 / 5; }
    .div4 { grid-area: 2 / 5 / 4 / 6; }
    /*fin grid css*/

    .img-flag {
        height: 16px;
        margin-right: 5px;
        position: relative;
        top: -1px;
    }
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
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="http://momentjs.com/downloads/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
<script>
    jQuery(function() {
        $('.Nacionalidad_cliente').each(function() {
            $(this).select2({
                width: "100%",
                dropdownParent: $(this).parent(), // fix select2 search input focus bug
            })
        })
        // fix select2 bootstrap modal scroll bug
        $(document).on('select2:close', '.Nacionalidad_cliente', function(e) {
            var evt = "scroll.select2"
            $(e.target).parents().off(evt)
            $(window).off(evt)
        })
    })
</script>
<script>
    $('.select2').select2({
        width: '100%',
    });
</script>
<script>
    $("#add_employee_form").submit(function(e) {
    e.preventDefault(); // Agrega esta línea para evitar que se envíe el formulario y se recargue la página
    
    const fd = new FormData($('#add_employee_form')[0]);
    const submitBtn = $(this).find('button[type="submit"]');
    
    submitBtn.text('Adding...');
    
        $.ajax({
            url: '{{ route('store') }}',
            method: 'post',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
            if (response.status == 200) {
                // Aquí obtienes los datos del cliente que acabas de agregar
                const cliente_id = response.cliente.id;
                const identificacion = response.cliente.Documento_cliente;
                const nombre = response.cliente.Nombre_cliente;
                const nacionalidad = response.cliente.Nacionalidad_cliente;
                const profesion = response.cliente.Profesion_cliente;
                const edad = response.cliente.Edad_cliente;
                const estado_civil = response.cliente.EstadoCivil_cliente;
                
                // Creas una nueva fila con los datos del cliente
                const fila = '<tr class="selected" id="fila' + cont +
                    '"><td class="text-center">' + cont + '</td><td><input type="hidden" name="cliente_id[]" value="' +
                    cliente_id + '">' + identificacion +'</td><td><input type="hidden" name="" value="' +
                    nombre + '">' + nombre +'</td><td><input type="hidden" name="" value="' +
                    nacionalidad + '">' + nacionalidad +'</td><td><input type="hidden" name="" value="' +
                    profesion + '">' + profesion +'</td><td><input type="hidden" name="" value="' +
                    edad + '">' + edad +'</td><td><input type="hidden" name="" value="' +
                    estado_civil + '">' + estado_civil +'</td><td class="text-center"><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont +
                    ');"><i class="zmdi zmdi-close"></i></button></td></tr>';
                
                cont++;
                // Agregas la fila a la tabla
                $('#detalles').append(fila);
                
                // Agregas el ID del cliente a la lista de clientes agregados
                addedUsers.push(cliente_id);
                
                // Agregar la clase "nueva-fila" a la fila recién agregada
            $('#detalles tr:last').addClass('nueva-fila');

            // Después de 5 segundos, eliminar la clase "nueva-fila" de la fila
            setTimeout(function() {
                $('#detalles tr:last').removeClass('nueva-fila');
            }, 5000);

                // esconder los inputs
                $("#form_cliente").hide();
                
                toastr.options = {
                    "backgroundColor": '#009944',
                    "positionClass": "toast-top-right",
                    "closeButton": true,
                    "progressBar": true,
                    "timeOut": "5000"
                };
                toastr.success("Se ha Agregado a la tabla Correctamente.", "Mensaje de éxito", {
                    "iconClass": 'toast-success'
                }); 
            }
        },
        complete: function() {
            $("#add_employee_form").fadeIn();
            submitBtn.text('Submit');
        }
    });
    $("#add_employee_form").fadeOut();
        vaciar(); // Llamada a la función vaciar() para esconder los inputs
    });
</script>
<script type="text/javascript">
    var path_cliente = "{{ route('autocompletehostalcliente') }}";
    $( "#Documento_cliente" ).autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: path_cliente,
                type: 'GET',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function( data ) {
                    response( data );
                },
                error: function () {
                    response([]); }
                });
            },
            select: function (event, ui) {
                $('#Documento_cliente').val(ui.item.Documento_cliente);
                $('#cliente_id').val(ui.item.id);
                $('#Nombre_cliente').val(ui.item.Nombre_cliente);
                $('#Apellido_cliente').val(ui.item.Apellido_cliente);
                $('#Nacionalidad_cliente').val(ui.item.Nacionalidad_cliente);
                $('#Profesion_cliente').val(ui.item.Profesion_cliente);
                $('#Edad_cliente').val(ui.item.Edad_cliente);
                $('#EstadoCivil_cliente').val(ui.item.EstadoCivil_cliente);
                agregar();
                return false;
            },
            response: function(event, ui) {
                if (!ui.content.length) {
                    $("#form_cliente").show();                    
                } else {
                    $("#form_cliente").hide();
                }
            }
    });

    $(document).ready(function() {
        $('#Documento_cliente').on('input', function() {
            if ($(this).val() === '') {
                $('#cliente_id').val('');
                $('#Nombre_cliente').val('');
                $('#Apellido_cliente').val('');
                $('#Nacionalidad_cliente').val('');
                $('#Profesion_cliente').val('');
                $('#Edad_cliente').val('');
                $('#EstadoCivil_cliente').val('');
                $("#form_cliente").hide();
            }
        });
    });
</script>
<script>
    //Arreglo para almacenar los ID de los usuarios agregados a la tabla
    var addedUsers = [];

    $(document).ready(function() {
        $("#agregar").click(function() {
            agregar();
        });
    });

    var cont = 1;

    function agregar() {
        datosProducto = document.getElementById('cliente_id').value.split('_');
        datosclienteid = document.getElementById('cliente_id').value.split('_');
        datosidentificacion = document.getElementById('Documento_cliente').value.split('_');
        datosNombre = document.getElementById('Nombre_cliente').value.split('_');
        datosNacionalidad = document.getElementById('Nacionalidad_cliente').value.split('_');
        datosProfesion = document.getElementById('Profesion_cliente').value.split('_');
        datosEdad = document.getElementById('Edad_cliente').value.split('_');
        datosEstadoCivil = document.getElementById('EstadoCivil_cliente').value.split('_');

        cliente_id = datosProducto[0];

        cliente = $("#cliente_id option:selected").text();

        //Comprobar si el ID del usuario seleccionado ya se encuentra en el arreglo de usuarios agregados
        if (addedUsers.indexOf(cliente_id) != -1) {
            toastr.options = {
                  "closeButton": true,
                  "debug": false,
                  "newestOnTop": false,
                  "progressBar": true,
                  "positionClass": "toast-top-right",
                  "preventDuplicates": false,
                  "onclick": null,
                  "showDuration": "300",
                  "hideDuration": "1000",
                  "timeOut": "5000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut",
                  "iconClasses": {
                    error: 'toast-error'
                  }
                }

                toastr.error('<i class="fas fa-exclamation-circle"></i> Error: No se puede agregar en la tabla por que ya esta en la tabla.', 'Error');
              
                return;
            }
            if (cliente_id != "") {
            var fila = '<tr class="selected" id="fila' + cont +
                '"><td class="text-center">' + cont + '</td><td><input type="hidden" name="cliente_id[]" value="' +
                cliente_id + '">' + datosidentificacion +'</td><td><input type="hidden" name="" value="' +
                Nombre_cliente + '">' + datosNombre +'</td><td><input type="hidden" name="" value="' +
                Nacionalidad_cliente + '">' + datosNacionalidad +'</td><td><input type="hidden" name="" value="' +
                Profesion_cliente + '">' + datosProfesion +'</td><td><input type="hidden" name="" value="' +
                Edad_cliente + '">' + datosEdad +'</td><td><input type="hidden" name="" value="' +
                EstadoCivil_cliente + '">' + datosEstadoCivil +'</td><td class="text-center"><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont +
                ');"><i class="zmdi zmdi-close"></i></button></td></tr>';
            cont++;
            $('#detalles').append(fila);
            vaciar();
            //Agregar el ID del usuario seleccionado al arreglo de usuarios agregados
            addedUsers.push(cliente_id);
            
            // Agregar la clase "nueva-fila" a la fila recién agregada
            $('#detalles tr:last').addClass('nueva-fila');

            // Después de 5 segundos, eliminar la clase "nueva-fila" de la fila
            setTimeout(function() {
                $('#detalles tr:last').removeClass('nueva-fila');
            }, 5000);

            toastr.options = {
                "backgroundColor": '#009944',
                "positionClass": "toast-top-right",
                "closeButton": true,
                "progressBar": true,
                "timeOut": "5000"
            };
            toastr.success("Se ha Agregado a la tabla Correctamente.", "Mensaje de éxito", {
                "iconClass": 'toast-success'
            }); 
        } else {
        Swal.fire({
            icon: 'error',
            title: 'Lo siento',
            text: 'NO seleccionaste Nada ...',
            });
        }
    }
    function eliminar(index) {
        datosProducto = document.getElementById('cliente_id').value.split('_');
        cliente_id = datosProducto[0];
        $("#fila" + index).remove();
        addedUsers.splice(addedUsers.indexOf(cliente_id), 1); // Eliminar el ID del usuario del arreglo
    }
    function vaciar() {
        $("#Documento_cliente").val("");
        $("#cliente_id").val("");
        $("#Nombre_cliente").val("");
        $("#Apellido_cliente").val("");
        $("#Nacionalidad_cliente").val("");
        $("#Profesion_cliente").val("");
        $("#Edad_cliente").val("");
        $("#EstadoCivil_cliente").val("");
    }
</script>
<script>
    function removeRedBorder(input) {
        input.classList.remove('red-border');
    }

    function checkInputValue() {
        const inputs = document.querySelectorAll('.validate-input');
        for (let i = 0; i < inputs.length; i++) {
            const input = inputs[i];
            if (input.value) {
                input.classList.remove('red-border');
            } else {
                input.classList.add('red-border');
            }
        }
    }

</script>
@notifyJs
@endpush