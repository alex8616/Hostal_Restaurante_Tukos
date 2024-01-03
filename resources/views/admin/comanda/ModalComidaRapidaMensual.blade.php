<!-- Modal -->
<div class="modal fade" id="ReporteComidaRapidaMensual" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">REPORTE POR MES DE COMIDA RAPIDA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.comanda.ReporteComidaRapidaMes') }}" method="get" target="_blank">
                @csrf
                <div class="form-row">
                    <div class="col-md-12">
                        <label for="">SELECCIONA EL MES</label>
                        <input class="form-control" type="month" id="monthID" name="monthID">
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-success" tabindex="4" style="width: 100%;" >CONSULTAR </button> 
                </form>
            </div>
        </div>
    </div>
</div>
<!-- FIN - Modal -->