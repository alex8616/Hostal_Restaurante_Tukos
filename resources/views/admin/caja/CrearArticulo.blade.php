<div class="modal fade bd-example-modal-lg" id="modelId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRAR ARTICULO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <form action="{{ route('admin.caja.storearticulo') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="Nombre_Articulo" class="is-required">NOMBRE ARTICULO</label><br>
                                    <input class="typeahead form-control" id="Nombre_Articulo" name="Nombre_Articulo" type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Nombre') }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Codigo_caja" class="is-required">CODIGO</label><br>
                                    <input class="typeahead form-control" id="Codigo_caja" name="Codigo_caja" type="text" readonly>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-6 grid-margin stretch-card">
                                    <button type="submit" class="btn btn-success" tabindex="4" style="width: 100%;">Guardar </button>
                                </div>
                                <div class="col-md-6 grid-margin stretch-card">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close" style="width: 100%;">Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 
@notifyCss

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.11/lodash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        function zfill(number, width) {
            var numberOutput = Math.abs(number); /* Valor absoluto del número */
            var length = number.toString().length; /* Largo del número */ 
            var zero = "0"; /* String de cero */  
            
            if (width <= length) {
                if (number < 0) {
                    return ("-" + numberOutput.toString()); 
                } else {
                    return numberOutput.toString(); 
                }
            } else {
                if (number < 0) {
                    return ("-" + (zero.repeat(width - length)) + numberOutput.toString()); 
                } else {
                    return ((zero.repeat(width - length)) + numberOutput.toString()); 
                }
            }
        }

        function createRandomString(length) {
            var chars = "ABCDEFGHIJKLMNOPQRSTUFWXYZ"
            var pwd = _.sampleSize(chars, length || 12)  // lodash v4: use _.sampleSize
            return pwd.join("")
        }
        const NombreCodigo = document.getElementById("Nombre_Articulo");
        const CodigoGenerate = document.getElementById("Codigo_caja");
        NombreCodigo.addEventListener("change", () => {
            CodigoGenerate.value = NombreCodigo.value.substr(0, 1)+createRandomString(2)+'-'+zfill(Math.floor(Math.random() * 999), 3);
        })
    </script>
    @notifyJs
@endpush