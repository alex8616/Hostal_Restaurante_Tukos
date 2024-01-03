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

<div class="modal fade bd-example-modal-lg" id="modelId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRAR PENSIONADOS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
                <div class="modal-body">
                    <form action="{{ url('/tipopensionado') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nombre" class="col-sm-12 col-form-label is-required">Nombre De Pension</label><br>
                                <input type="text" name="Nombre_tipoclientes" id="Nombre_tipoclientes" value="{{ old('Nombre_tipoclientes') }}" 
                                    class="form-control" tabindex="1" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nombre" class="col-sm-12 col-form-label is-required">Direccion De Pension</label><br>
                                <input type="text" name="Direccion_tipoclientes" id="Direccion_tipoclientes" value="{{ old('Direccion_tipoclientes') }}" 
                                    class="form-control" tabindex="1" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                             </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputNombre" class="col-sm-12 col-form-label is-required">Fecha Inicio</label><br>
                                <input type="date" class="form-control" id="Fecha_Inicio" name="Fecha_Inicio" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputApellidop" class="col-sm-12 col-form-label is-required">Fecha Final</label><br>
                                <input type="date" class="form-control" id="Fecha_Final" name="Fecha_Final" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputApellidom" class="col-sm-12 col-form-label is-required">Tipo De Pension</label><br>
                                <select id="tipo" name="tipo"  size="5" class="form-select" style="width: 100%;" required>
                                    <option value="Basico" {{ old('tipo.0') == "Basico" ? "selected" :""}}>Basico</option>
                                    <option value="Familiar" {{ old('tipo.0') == "Familiar" ? "selected" :""}}>Familiar</option>
                                    <option value="Empresarial" {{ old('tipo.0') == "Empresarial" ? "selected" :""}}>Empresarial</option>
                                    <option value="Restaurante" {{ old('tipo.0') == "Restaurante" ? "selected" :""}}>Restaurante</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="seach_cliente" class="col-sm-12 col-form-label is-required">Cliente</label><br>
                                <div class="container">
                                    <input class="typeahead form-control" id="seach_cliente" type="text" required>
                                    <input class="typeahead form-control" id="cliente_id" name="cliente_id" type="text" hidden>
                                    <div class="form-row">
                                        <center>
                                            <button type="button" class="btn btn-success" id="agregar" >
                                                <span>Agregar a la lista</span>
                                            </button>
                                        </center>
                                        <div class="form-group col-md-6">
                                            <input class="typeahead form-control" id="Apellidop_cliente" type="text" readonly hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="detalles" class="table table-striped col-md-12 table-bordered shadow-lg">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="text-center">N°</th>
                                    <th class="text-center">Cliente Agregado</th>
                                    <th class="text-center">Quitar</th>
                                </tr>
                            </thead>
                        </table>
                        <center>
                            <button type="submit" id="guardar" class="btn btn-success">Registrar</button>
                            <a href="{{ route('admin.pensionado.index') }}" class="btn btn-danger">Cancelar</a>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">
    var path_cliente = "{{ route('autocompletecliente') }}";

    $( "#seach_cliente" ).autocomplete({
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
            }
        });
        },
        select: function (event, ui) {
        $('#seach_cliente').val(ui.item.label);
        $('#cliente_id').val(ui.item.id);
        $('#Apellidop_cliente').val(ui.item.Apellidop_cliente);
        console.log(ui.item); 
        return false;
        }
    });
</script>
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
        datosclienteid = document.getElementById('cliente_id').value.split('_');
        datosNombre = document.getElementById('seach_cliente').value.split('_');
        datosApellidop = document.getElementById('Apellidop_cliente').value.split('_');

        cliente_id = datosProducto[0];

        cliente = $("#cliente_id option:selected").text();
        if (cliente_id != "") {
                var fila = '<tr class="selected" id="fila' + cont +
                    '"><td class="text-center">' + datosclienteid + '</td><td><input type="hidden" name="cliente_id[]" value="' +
                    cliente_id + '">' + datosNombre +'</td><td class="text-center"><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont +
                    ');"><i class="zmdi zmdi-close"></i></button></td></tr>';
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