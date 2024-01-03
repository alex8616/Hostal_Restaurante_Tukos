@extends('layouts.main', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
@section('content')
<br><br><br>
<div style="background-color:white; width:95%; margin:auto;">
    <div class="parent">
        <div class="div1">
            HOSTAL TUKO'S LA CASA REAL
        </div>
        <div class="div2">
            DEPARTAMENTO DE RECEPCION
            <div id="info-tabla"></div>

            <form action="#" method="POST" id="add_employee_form" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="col-md-4">
                        <label for="inputNombre"  class="is-required">Documento del Cliente</label>
                        <input class="typeahead form-control" id="Documento_cliente" name="Documento_cliente" type="text" 
                        name="Nombre_cliente" onkeyup="javascript:this.value=this.value.toUpperCase();">
                        <input class="typeahead form-control" id="cliente_id" type="text" 
                        name="cliente_id" onkeyup="javascript:this.value=this.value.toUpperCase();" hidden>
                    </div>
                    <div id="form_cliente" style="display:none;">
                        <div class="col-md-4">
                            <label for="Nombre_cliente">Nombres</label>
                            <input class="typeahead form-control" name="Nombre_cliente" 
                            id="Nombre_cliente" type="text">
                        </div>
                        <div class="col-md-4">
                            <label for="Apellido_cliente">Apellidos</label>
                            <input class="typeahead form-control" name="Apellido_cliente" 
                            id="Apellido_cliente" type="text">
                        </div><br>
                        <div class="form-row">
                            <div class="col-md-3">
                                <label for="Nacionalidad_cliente"  class="is-required">Nacionalidad</label>
                                <input class="typeahead form-control" name="Nacionalidad_cliente" 
                                id="Nacionalidad_cliente" type="text">
                            </div>
                            <div class="col-md-3">
                                <label for="Profesion_cliente">Profesion</label>
                                <input class="typeahead form-control" name="Profesion_cliente" 
                                id="Profesion_cliente" type="text">
                            </div>
                            <div class="col-md-3">
                                <label for="EstadoCivil_cliente">Estado Civil</label>
                                <input class="typeahead form-control" name="EstadoCivil_cliente" 
                                id="EstadoCivil_cliente" type="text">
                            </div>
                            <div class="col-md-3">
                                <label for="Edad_cliente">Edad</label>
                                <input class="typeahead form-control" name="Edad_cliente" 
                                id="Edad_cliente" type="text">
                            </div>
                            <button type="submit" class="btn btn-success" id="add_employee_btn">Registrar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="div3">
            <table class="tg" style="width: 100%;" id="detalles">
                <tbody>
                    <tr>
                        <td class="tg-0lax" colspan="2" style="width: 15%; padding:5px; font-weight: bold;">APELLIDOS <br> (LAST NAME)</td>
                        <td colspan="4" id="tdapellidos">
                        
                        </td>
                        <td class="tg-0lax"></td>
                        <td class="tg-0lax" colspan="2" style="width: 15%; padding:5px; font-weight: bold;">NOMBRES <br> (NAME)</td>
                        <td class="tg-0lax" colspan="4" id="tdnombres">

                        </td>
                    </tr>
                    <tr>
                        <td class="tg-0lax" colspan="2" style="width: 15%; padding:5px; font-weight: bold;">NACIONALIDAD <br> (NACIONALITY)</td>
                        <td colspan="4" id="tdnacionalidad">

                        </td>
                        <td class="tg-0lax"></td>
                        <td class="tg-0lax" colspan="2" style="width: 15%; padding:5px; font-weight: bold;">PROFESION <br> (NAME)</td>
                        <td class="tg-0lax" colspan="4" id="tdprofesion">

                        </td>
                    </tr>
                    <tr>
                        <td class="tg-0lax" colspan="2" style="width: 15%; padding:5px; font-weight: bold;">C.I. <br> (PASSAPORT)</td>
                        <td class="tg-0lax" colspan="4" id="tddocumento">
                        
                        </td>
                        <td class="tg-0lax"></td>
                        <td class="tg-0lax" colspan="2" style="width: 15%; padding:5px; font-weight: bold;">EDAD <br> (AGE)</td>
                        <td class="tg-0lax" colspan="4" id="tdedad">
                        
                        </td>
                    </tr>
                    <tr>
                        <td class="tg-0lax" colspan="2" style="width: 15%; padding:5px; font-weight: bold;">ESTADO CIVIL <br> (MARITAL STATUS)</td>
                        <td class="tg-0lax" colspan="4" id="tdestadocivil">
                        
                        </td>
                    </tr>
                </tbody>
            </table>           
        </div>
        <div class="div4">
            HABITACION:
            Bs.
            $Us.
        </div>
    </div>
</div>
@endsection
@notifyCss
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/bottonfooder.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/caja/registrar.css')}}" rel="stylesheet" type="text/css"/>
<style>
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
                theme: "bootstrap-5",
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
                limpiar();
                vaciar();
                
                // Agregas la fila a la tabla
                $('#detalles').append(fila);
                
                // Agregas el ID del cliente a la lista de clientes agregados
                addedUsers.push(cliente_id);
                
                Swal.fire(
                    'Added!',
                    'Employee Added Successfully!',
                    'success'
                )
            }
        },
        complete: function() {
            $("#add_employee_form").fadeIn();
            submitBtn.text('Submit');
        }
    });
    
    $("#add_employee_form").fadeOut();
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
                console.log(ui.item); 
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
</script>
<script>
    var addedUsers = []; // Arreglo para almacenar los usuarios agregados
    var cont = 0; // Contador para las filas agregadas

    function agregar() {
        datosProducto = document.getElementById('cliente_id').value.split('_');
        datosidentificacion = document.getElementById('Documento_cliente').value.split('_');
        datosApellido = document.getElementById('Apellido_cliente').value.split('_');
        datosNombre = document.getElementById('Nombre_cliente').value.split('_');
        datosNacionalidad = document.getElementById('Nacionalidad_cliente').value.split('_');
        datosProfesion = document.getElementById('Profesion_cliente').value.split('_');
        datosEdad = document.getElementById('Edad_cliente').value.split('_');
        datosEstadoCivil = document.getElementById('EstadoCivil_cliente').value.split('_');

        cliente_id = datosProducto[0];

        cliente = $("#cliente_id option:selected").text();

        // Comprobar si el ID del usuario seleccionado ya se encuentra en el arreglo de usuarios agregados
        if (addedUsers.indexOf(cliente_id) != -1) {
            Swal.fire({
                icon: 'error',
                title: 'Usuario ya agregado',
                text: 'Este usuario ya ha sido agregado a la tabla',
            });
            return;
        }

        if (cliente_id != "") {
            // Verificar si las celdas ya tienen algún valor
            var apellidosHtml = $('#tdapellidos').html().trim();
            var nombresHtml = $('#tdnombres').html().trim();
            var nacionalidadHtml = $('#tdnacionalidad').html().trim();
            var profesionHtml = $('#tdprofesion').html().trim();
            var documentoHtml = $('#tddocumento').html().trim();
            var estadoCivilHtml = $('#tdestadocivil').html().trim();
            var edadHtml = $('#tdedad').html().trim();

            // Agregar los nuevos valores al final de los valores existentes, separados por un salto de línea
            $('#tdapellidos').html((apellidosHtml ? apellidosHtml + "<br>" : "") + datosApellido);
            $('#tdnombres').html((nombresHtml ? nombresHtml + "<br>" : "") + datosNombre);
            $('#tdnacionalidad').html((nacionalidadHtml ? nacionalidadHtml + "<br>" : "") + datosNacionalidad);
            $('#tdprofesion').html((profesionHtml ? profesionHtml + "<br>" : "") + datosProfesion);
            $('#tddocumento').html((documentoHtml ? documentoHtml + "<br>" : "") + datosidentificacion);
            $('#tdestadocivil').html((estadoCivilHtml ? estadoCivilHtml + "<br>" : "") + datosEstadoCivil);
            $('#tdedad').html((edadHtml ? edadHtml + "<br>" : "") + datosEdad);

            // Agregar una entrada oculta al formulario con el ID del usuario seleccionado
            var fila = '<tr class="selected" id="fila' + cont +
                    '"><td><input type="hidden" name="cliente_id[]" value="' +
                    cliente_id + '"></td><td><button type="button" class="eliminar" onclick="eliminar(' + cont + ')"><i class="fas fa-times"></i></button></td></tr>';
            cont++;
            $('#detalles').append(fila);

            // Agregar el ID del usuario seleccionado al arreglo de usuarios agregados
            addedUsers.push(cliente_id);

        } else {
            Swal.fire({
                icon: 'error',
                title: 'Lo siento',
                text: 'NO seleccionaste Nada ...',
            });
        }
    }
    // Función para eliminar una fila de la tabla y quitar el ID del usuario del arreglo de usuarios agregados
    function eliminar(id) {
    // Obtener el ID del usuario de la fila correspondiente
    var cliente_id = $('input[name="cliente_id[]"]').eq(id).val();

    // Eliminar la fila de la tabla
    $('#fila' + id).remove();

    // Quitar el ID del usuario del arreglo de usuarios agregados
    var index = addedUsers.indexOf(cliente_id);
    if (index !== -1) {
        addedUsers.splice(index, 1);
    }

    // Actualizar los valores en las celdas correspondientes
    var apellidos = $('#tdapellidos').html().split("<br>");
    var nombres = $('#tdnombres').html().split("<br>");
    var nacionalidad = $('#tdnacionalidad').html().split("<br>");
    var profesion = $('#tdprofesion').html().split("<br>");
    var documento = $('#tddocumento').html().split("<br>");
    var estadoCivil = $('#tdestadocivil').html().split("<br>");
    var edad = $('#tdedad').html().split("<br>");

    apellidos.splice(id, 1);
    nombres.splice(id, 1);
    nacionalidad.splice(id, 1);
    profesion.splice(id, 1);
    documento.splice(id, 1);
    estadoCivil.splice(id, 1);
    edad.splice(id, 1);

    $('#tdapellidos').html(apellidos.join("<br>"));
    $('#tdnombres').html(nombres.join("<br>"));
    $('#tdnacionalidad').html(nacionalidad.join("<br>"));
    $('#tdprofesion').html(profesion.join("<br>"));
    $('#tddocumento').html(documento.join("<br>"));
    $('#tdestadocivil').html(estadoCivil.join("<br>"));
    $('#tdedad').html(edad.join("<br>"));
    }
</script>
@notifyJs
@endpush