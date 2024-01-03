@extends('layouts.main', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
@section('content')
<br><br>
<div style="background-color:white; width:95%; height:100%; margin:auto; border-radius: 10px;">
    <div class="parent" style="margin: 20px;">
        <div class="div1">
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
                    <div id="form_cliente" style="display:none; margin: 5px; width:100%;">
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
                                <label for="FechaNacimiento" class="is-required">Fecha De Nacimiento</label>
                                <input class="otraclaseform validate-input" name="FechaNacimiento" id="FechaNacimiento" type="date" 
                                onfocus="removeRedBorder(this)" onblur="checkInputValue(this)" onchange="calcularEdad()">
                            </div>
                            <div class="col-md-3">
                                <label for="Edad_cliente" class="is-required">Edad</label>
                                <input class="otraclaseform validate-input" name="Edad_cliente" id="Edad_cliente" type="text" 
                                onfocus="removeRedBorder(this)" onblur="checkInputValue(this)">
                            </div>                            
                        </div><br>
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="Img_cliente" class="is-required">Img Documento</label><br>
                                <input type="file" id="imagenes" name="imagenes[]" accept="image/*" multiple>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success" id="add_employee_btn">Registrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form> 
        </div>                             
        <div class="div2">
            <form onsubmit="validar();" action="{{ route('hostal.habitacion.reservastore') }}" method="POST">
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
                <input type="text" id="habitacion_id" name="habitacion_id" value="{{$habitacion->id}}" hidden>
                <div class="form-row" style="margin: 10px;">
                    <div class="col-md-6">
                        <label for="ingreso_reserva"  class="is-required">Ingreso</label>
                        <input class="otraclase" id="ingreso_reserva" type="date" 
                        name="ingreso_reserva" min="<?php echo date('Y-m-d') ?>" oninput="calculate()">
                    </div>
                    <div class="col-md-6">
                        <label for="salida_reserva">Salida</label>
                        <input class="otraclase" name="salida_reserva" id="salida_reserva" type="date" min="<?php echo date('Y-m-d') ?>" oninput="calculate()" disabled>
                        <span class="error" style="background-color: #FC5D5D; color: white; padding: 5px; width: 100%; font-weight: bold;" id="select-error">Selecciona una opción de categorias antes de continuar.</span>
                    </div>
                </div><br>
                <script src="http://momentjs.com/downloads/moment.min.js"></script>
                <script>
                    try {
                        function calculate() {
                            var date1 = document.getElementById('salida_reserva').value; 
                            var date0 = document.getElementById('ingreso_reserva').value; 
                            var fecha1 = moment(date0);
                            var fecha2 = moment(date1);
                            var resultado = document.getElementById('dias_reserva');
                            var myResult = fecha2.diff(fecha1, 'days');
                            resultado.value = myResult;
                        }
                    } catch (error) { throw error; }
                </script>
                <div class="form-row" style="margin: 10px;">
                    <div class="col-md-6">
                        <label for="dias_reserva">Dias a Hospedarse</label>
                        <input class="otraclase" name="dias_reserva" 
                        id="dias_reserva" type="text">
                    </div>
                    <div class="col-md-6">
                        <label for="Precio_habitacion_reserva"  class="is-required">Precio Habitacion</label>
                        <input class="otraclase" id="Precio_habitacion_reserva" type="text" name="Precio_habitacion_reserva" value="0" onkeyup="PasarValor();" onkeyup="PreciCategoria();">
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
                        <input class="otraclase" name="PrecioRestante_reserva" 
                        id="PrecioRestante_reserva" type="text" value="0" onkeyup="PasarValor();" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="Total_reserva"><strong style="color:black">TOTAL</strong></label>
                        <input class="otraclase" name="Total_reserva" 
                        id="Total_reserva" type="text" value="0" readonly>
                    </div>
                </div><br>
                <input  class="buton" type="button" id="boton_calc" value="Costo" hidden>
                <script>
                    var m1 = document.getElementById("dias_reserva");
                    var m2 = document.getElementById("Precio_habitacion_reserva");
                    var m3 = document.getElementById("Adelanto");
                    var boton_de_calcular = document.getElementById("boton_calc");
                    boton_de_calcular.addEventListener("click", res);

                    function res() {
                        var multi = (m1.value * m2.value) - m3.value;
                        var totales = m1.value * m2.value;
                        document.getElementById("PrecioRestante_reserva").value=multi;
                        document.getElementById("Total_reserva").value=totales;
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
        <div class="div3"><br>                         
            <a href="#" style="all:unset; font-weight: bold; font-size: 22px;">{{$habitacion->Nombre_habitacion}}</a> - 
            <select class="selectpersonaliza" name="CategoriaHabitacion_reserva" id="CategoriaHabitacion_reserva" onchange="PreciCategoria();">
                <option value="" disabled selected>Selecciona ..</option>
                <option value="SIMPLE">SIMPLE</option>
                <option value="DOBLE">DOBLE</option>
                <option value="TRIPLE">TRIPLE</option>
                <option value="MATRIMONIAL">MATRIMONIAL</option>
            </select> <br><br>
            <div class="form-row">
                <div class="col-md-6">
                    <a href="#" style="all:unset; font-weight: bold; font-size: 22px;">Bs.</a> <input id="show" name="show" type="text" disabled style="width: 50px;"><br>
                </div>
                <div class="col-md-6">
                    <label class="switch">
                        <input id="CamaraHotelera" name="CamaraHotelera" type="checkbox">
                        <span class="slider"></span>
                    </label>
                </div>
            </div>
            <label id="mySwitchLabel" style="color: red;">La Informacion De Los Huespedes NO Se Mostraran En La Camara Hotelera.</label>
            <input type="hidden" name="CamaraHotelera" value="no">
        </div>
        </form>
    </div>
</div>
@endsection
@notifyCss
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" />

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
    /*Swith Toggle*/
    .switch {
    position: relative;
    width: 80px;
    height: 34px;
    margin-bottom: 15px;
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
    -webkit-transform: translateX(45px);
    -ms-transform: translateX(45px);
    transform: translateX(45px);
    }

    /* Rounded sliders */
    .slider.round {
    border-radius: 34px;
    }

    .slider.round:before {
    border-radius: 50%;
    }

    /*Fin Swicth Toggle*/

    #error-select {
        display: none;
    }
    .border-rojo {
        border-color: red;
    }

    .selectpersonaliza{        
        font-size: 1rem;
        height: calc(1.5em + 0.5rem + 2px);
        padding: 0.25rem 1rem;
        border-radius: 0.25rem;
        border-color: #007bff;
        border:2px solid rgba(0,0,0,0.2);
    }

    .selectpersonaliza:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
    }

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
    grid-template-columns: repeat(4, 1fr) 20px;
    grid-template-rows: repeat(5, 1fr);
    grid-column-gap: 0px;
    grid-row-gap: 0px;
    }

    .div1 { grid-area: 1 / 1 / 2 / 4; }
    .div2 { grid-area: 2 / 1 / 6 / 6; }
    .div3 { grid-area: 1 / 4 / 2 / 6; }
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="http://momentjs.com/downloads/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
<script>
   $(document).ready(function() {
        $("#CamaraHotelera").on("change", function() {
            if ($(this).is(":checked")) {
                $("input[name='CamaraHotelera']").val("sí");
            } else {
                $("input[name='CamaraHotelera']").val("no");
            }
        });
    });

    const switchElement = document.getElementById("CamaraHotelera");
    const switchLabel = document.getElementById("mySwitchLabel");

    switchElement.addEventListener("change", function() {
        if (this.checked) {
            switchLabel.textContent = "La Informacion De Los Huespedes SI se Mostraran En La Camara Hotelera.";
            switchLabel.style.color = "green"; // Cambiar el color del texto a verde si se verifica la condición
        } else {
            switchLabel.textContent = "La Informacion De Los Huespedes NO Se Mostraran En La Camara Hotelera.";
            switchLabel.style.color = "red"; // Cambiar el color del texto a rojo si no se verifica la condición
        }
    });
</script>
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
<script>
    function calcularEdad() {
    var fechaNacimiento = new Date(document.getElementById("FechaNacimiento").value);
    var fechaActual = new Date();
    var edad = fechaActual.getFullYear() - fechaNacimiento.getFullYear();
    if (fechaActual.getMonth() < fechaNacimiento.getMonth() || 
        (fechaActual.getMonth() == fechaNacimiento.getMonth() && fechaActual.getDate() < fechaNacimiento.getDate())) {
        edad--;
    }
    document.getElementById("Edad_cliente").value = edad;
    }
</script>
/*Imagen View Mostrar*/
<script>
    // Función para mostrar las imágenes seleccionadas en el div correspondiente
    function mostrarImagenesSeleccionadas(event) {
    const divImagenes = document.getElementById('imagenesSeleccionadas');
    divImagenes.innerHTML = '';
    if (event.target.files.length > 0) {
        for (let i = 0; i < event.target.files.length; i++) {
        const imagen = event.target.files[i];
        const imagenURL = URL.createObjectURL(imagen);
        const imagenDiv = document.createElement('div');
        imagenDiv.classList.add('imagen-seleccionada');
        const imagenElement = document.createElement('img');
        imagenElement.src = imagenURL;
        imagenElement.addEventListener('click', function() {
            const modalImagen = document.getElementById('modalImagen');
            const imagenModal = document.getElementById('imagenModal');
            modalImagen.style.display = 'block';
            imagenModal.src = this.src;
        });
        imagenDiv.appendChild(imagenElement);
        divImagenes.appendChild(imagenDiv);
        }
    }
    }

    // Asignar la función mostrarImagenesSeleccionadas al evento onChange del input de imágenes
    document.getElementById('imagenes').addEventListener('change', mostrarImagenesSeleccionadas);

    // Cerrar el modal cuando se haga click fuera de la imagen
    window.onclick = function(event) {
    const modalImagen = document.getElementById('modalImagen');
    if (event.target == modalImagen) {
        modalImagen.style.display = "none";
    }
    }
</script>
/*FIN Imagen View Mostrar*/
/*Sacar Valor Del Select*/
<script>
    function PreciCategoria() {
        var select = document.getElementById("CategoriaHabitacion_reserva");
        var input = document.getElementById("Precio_habitacion_reserva");
        switch (select.value) {
            case 'SIMPLE':
                input.value = 100;
                break;
            case 'DOBLE':
                input.value = 200;
                break;
            case 'TRIPLE':
                input.value = 300;
                break;
            case 'MATRIMONIAL':
                input.value = 400;
                break;
            default:
                input.value = 0;
                break;
        }
    }
</script>
<script>
    const input = document.getElementById('salida_reserva');
    const select = document.getElementById('CategoriaHabitacion_reserva');
    const error = document.getElementById('select-error');

    select.addEventListener('change', function() {
        if (select.value === '') {
            input.disabled = true;
        } else {
            input.disabled = false;
        }
    });

    input.addEventListener('click', function() {
        if (select.value === '') {
            error.style.display = 'block';
            select.classList.add('border-rojo');
        } else {
            error.style.display = 'none';
            select.classList.remove('border-rojo');
        }
    });

</script>
@notifyJs
@endpush