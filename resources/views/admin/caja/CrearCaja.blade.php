<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRAR CAJA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form action="{{ route('admin.caja.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-12 col-form-label is-required" for="nombre">FECHA - MES REGISTRO: </label><br>
                            <input type="date" name="fecha_registro" id="fecha_registro" class="form-control"
                                tabindex="1" autofocus onkeyup=" javascript:this.value=this.value.toUpperCase();" required readonly>
                        </div>
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
</div>
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 
@push('js')
    <script>
        function obtenerNombreMes (numero) {
            let miFecha = new Date();
            if (0 < numero && numero <= 12) {
                miFecha.setMonth(numero - 1);
                return new Intl.DateTimeFormat('es-ES', { month: 'long'}).format(miFecha);
            } else {
                return null;
            }
        }

        window.onload = function(){
        var fecha = new Date(); //Fecha actual
        var mes = fecha.getMonth()+1; //obteniendo mes
        var dia = fecha.getDate(); //obteniendo dia
        var ano = fecha.getFullYear(); //obteniendo año
        if(dia<10)
            dia='0'+dia; //agrega cero si el menor de 10
        if(mes<10)
            mes='0'+mes //agrega cero si el menor de 10
            document.getElementById('fecha_registro').value=ano+"-"+mes+"-"+"01";
            document.getElementById('total').value=obtenerNombreMes(mes);
        }
    </script>
    @notifyJs
@endpush