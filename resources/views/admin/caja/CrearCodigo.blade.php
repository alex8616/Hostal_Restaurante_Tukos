<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 
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
                <h5 class="modal-title" id="exampleModalLabel">REGISTRAR CODIGO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <form action="{{ route('admin.caja.storecodigo') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="Nombre" class="is-required">NOMBRE ARTICULO</label><br>
                                    <input class="typeahead form-control" id="Nombre" name="Nombre" type="text" 
                                    onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Nombre') }}">
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
        const NombreCodigo = document.getElementById("Nombre");
        const CodigoGenerate = document.getElementById("Codigo_caja");
        NombreCodigo.addEventListener("change", () => {
            CodigoGenerate.value = NombreCodigo.value.substr(0, 1)+createRandomString(2)+'-'+zfill(Math.floor(Math.random() * 999), 3);
        })
    </script>
    @notifyJs
@endpush