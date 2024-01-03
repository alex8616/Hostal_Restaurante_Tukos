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
                <h5 class="modal-title" id="exampleModalLabel">REGISTRAR MENU DEL DIA {{now()}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
                <div class="modal-body">
                    <form action="{{ url('/menu') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="orders-chart-legend" class="orders-chart-legend">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-9">
                                                        <div>
                                                            <label for="seach">Plato</label>
                                                            <div class="container">
                                                                <input class="typeahead form-control" id="search" type="text">
                                                                <input class="typeahead form-control" id="Nombre_plato" type="text" hidden>
                                                                <input class="typeahead form-control" id="id_plato" type="text" hidden>
                                                                <input class="typeahead form-control" id="Precio_plato" type="text" hidden>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2"><br>
                                                        <button type="button" class="btn btn-success" id="agregar">
                                                            <i class="zmdi zmdi-plus-square zmdi-hc-2x"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="detalles" class="table table-striped col-md-12 table-bordered shadow-lg">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th style="width: 100px;" class="text-center">Quitar</th>
                                                <th class="text-center">Plato</th>
                                                <th class="text-center">Precio</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <center>
                                        <button type="submit" id="guardar" class="btn btn-success">Registrar</button>
                                        <a href="{{ route('admin.menu.index') }}" class="btn btn-danger">Cancelar</a>
                                    </center>
                                </div>
                            </div>                                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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

    function agregar() {
        datosProducto = document.getElementById('id_plato').value.split('_');
        datosNombre = document.getElementById('Nombre_plato').value.split('_');
        datosPrecio = document.getElementById('Precio_plato').value.split('_');

        id_plato = datosProducto[0];

        
        articulo = $("#id_plato option:selected").text();
        if (id_plato != "") {
                var fila = '<tr class="selected" id="fila' + cont +
                    '"><td class="text-center"><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont +
                    ');"><i class="zmdi zmdi-close"></i></button></td> <td><input type="hidden" name="id_plato[]" value="' +
                    id_plato + '">' + datosNombre + '</td><td class="text-center"><input type="hidden" value="' +
                    id_plato + '">' + datosPrecio + ' Bs' + '</td></tr>';
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
