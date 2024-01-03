
<div class="modal fade bd-example-modal-lg" id="modelId" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">REGISTRAR DETALLE {{now()}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <div class="modal-body">
            <form id="add-form" action="{{ route('admin.caja.storedetallecajaTarjetas') }}" method="POST" id="">
                @csrf                    
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="col-md-12">
                                <input class="typeahead form-control" name="caja_id" id="caja_id" type="text" value="{{$caja->id}}" hidden>
                                <input type="text" value="3" id="codigo_caja_id" name="codigo_caja_id" hidden><br>
                                <p style="font-size: 80px; font-family: Alfa Slab One; text-align: center;">TARJETAS</p>
                            </div>
                            
                        </div><br>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label for="inputNombre" class="is-required">DESCRIPCION</label>
                                <textarea class="form-control" name="Articulo_description" id="Articulo_description" onkeyup="javascript:this.value=this.value.toUpperCase();" required></textarea>                           
                            </div>
                            <div class="col-md-12"><br>
                                <label for="">FACTURA</label><br>
                                <label id="label1"> <input class="form-radio" type="radio" name="Factura" id="Factura" value="Con_Factura" onchange="mostrarInput()"> SI </label>                                                              
                                <label id="label2"> <input class="form-radio" type="radio" name="Factura" id="Factura" value="Sin_Factura" onchange="ocultarInput()" checked> NO </label>
                                <div id="input-container" style="display: none">
                                    <input class="form-control" type="text" id="otra_respuesta" name="otra_respuesta" placeholder="N Factura">
                                </div>  
                            </div>
                        </div><br>
                        <div class="form-row" style="margin:auto;">
                            <div class="form-group col-md-6">
                                <label for="inputNombre" class="is-required">INGRESO</label><br>
                                <input class="form-control" name="InputIngreso" id="InputIngreso" type="number" value="0.00">                                    
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputApellidop" class="is-required">EGRESO</label><br>
                                <input class="form-control" name="InputEgreso" id="InputEgreso" type="number" value="0.00">                                                      
                            </div>
                            <div class="form-row" style="margin:auto;">
                                <div class="form-group col-md-12">
                                    <label for="inputNombre" class="is-required">FECHA REGISTRO</label><br>
                                    <input class="form-control" name="fecha_registro" id="fecha_registro" type="datetime-local" value="0.00">                                    
                                </div>
                            </div>
                        </div>                            
                    </div>
                    <div class="col-md-6">
                        <label for="">Selecione Atributo:</label>
                        <select class="form-select" name="articulo_caja_id" size="16px" id="articulo_caja_id" style="width:100%" required>                           
                            <option value="" selected disabled>Ninguna Seleccion</option>
                            @foreach ($articulos as $articulo)
                                    <option value="{{ $articulo->id }}"> 
                                            {{ $articulo->Nombre_Articulo }} 
                                    </option>
                            @endforeach
                        </select>
                    </div>
                </div><br>
                <div class="row" style="text-align: center;">
                    <div class="col-md-6 grid-margin stretch-card">
                        <button type="submit" class="btn btn-success" tabindex="4" style="width: 50%;">Guardar </button>
                    </div>
                    <div class="col-md-6 grid-margin stretch-card">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close" style="width: 50%;">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<style>
.form-control{
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
.form-select{
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
#label1 {
    position: relative;
    padding-left: 25px; /* añadimos un padding a la izquierda para acomodar el icono */
    margin-right: 50px; /* añadimos un margen a la derecha para separar los radio buttons */
}
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

</style>
<script>
function mostrarInput() {
    document.getElementById("input-container").style.display = "block";
}

function ocultarInput() {
    document.getElementById("input-container").style.display = "none";
    document.getElementById("otra_respuesta").value = "";
}
</script>
<script>
// Selecciona el campo de entrada
const InputIngreso = document.getElementById('InputIngreso');

// Establece el valor predeterminado en cero y borra al hacer clic
InputIngreso.addEventListener('click', function() {
    if (InputIngreso.value === '0.00') {
        InputIngreso.value = '';
    }
});

// Escucha el evento blur
InputIngreso.addEventListener('blur', function() {
    // Si el valor es vacío, establece el valor en cero con dos decimales
    if (InputIngreso.value === '') {
        InputIngreso.value = '0.00';
    }
    // Si el valor es un número, conviértelo a una cadena con dos decimales
    else if (!isNaN(InputIngreso.value)) {
        InputIngreso.value = parseFloat(InputIngreso.value).toFixed(2);
    }
});
</script>
<script>
// Selecciona el campo de entrada
const InputEgreso = document.getElementById('InputEgreso');

// Establece el valor predeterminado en cero y borra al hacer clic
InputEgreso.addEventListener('click', function() {
    if (InputEgreso.value === '0.00') {
        InputEgreso.value = '';
    }
});

// Escucha el evento blur
InputEgreso.addEventListener('blur', function() {
    // Si el valor es vacío, establece el valor en cero con dos decimales
    if (InputEgreso.value === '') {
        InputEgreso.value = '0.00';
    }
    // Si el valor es un número, conviértelo a una cadena con dos decimales
    else if (!isNaN(InputEgreso.value)) {
        InputEgreso.value = parseFloat(InputEgreso.value).toFixed(2);
    }
});
</script>  