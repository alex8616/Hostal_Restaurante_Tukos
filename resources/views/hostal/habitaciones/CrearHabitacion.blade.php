<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">CREAR HABITACION NUEVA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
                <form onsubmit="validar();" action="{{ route('hostal.habitacion.store') }}" method="POST">
                @csrf
                <div class="row" style="margin: 4px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="motivo">Nombre Habitacion</label><br>
                            <input type="text" name="Nombre_habitacion" id="Nombre_habitacion" value="{{ old('Nombre_habitacion') }}" class="form-control"
                                tabindex="1" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                        </div>
                    </div>
                </div><br>
                <div class="row" style="margin: 4px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="motivo">Detalle Habitacion</label><br>
                            <textarea class="form-control" id="Detalle_habitacion" name="Detalle_habitacion" 
                            rows="5" cols="51  " onkeyup="javascript:this.value=this.value.toUpperCase();" ></textarea>
                        </div>
                    </div>
                </div><br>
                <div class="row" style="margin: 4px;">                            
                    <div class="col-md-5">
                        <label for="precio">Precio Habitacion</label>
                        <input id="Precio_habitacion" name="Precio_habitacion" type="text" class="form-control" oninput="calculate()" onkeyup="PasarValor();" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button id="submitButton" type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
        </div>
    </div>
</div>
<script>
    $('.select2').select2({
        width: '100%',
        allowClear: false
    });
</script>
<script>
    var input = document.getElementById("Precio_habitacion");
    input.addEventListener("input", function(e){
        if(!input.value.match(/^\d+$/)) {
            input.style.backgroundColor = "red";
        } else {
            input.style.backgroundColor = "";
        }
    });
    input.addEventListener("focus", function(e){
        input.style.backgroundColor = "";
    });
</script>
<script>
    var input = document.getElementById("inputNumber");
    var submitButton = document.getElementById("submitButton");
    input.addEventListener("input", function(e){
        if(isNaN(input.value)) {
            input.style.borderColor = "red";
            submitButton.disabled = true;
        } else {
            input.style.borderColor = "";
            submitButton.disabled = false;
        }
    });
    input.addEventListener("focus", function(e){
        input.style.borderColor = "";
    });
</script>