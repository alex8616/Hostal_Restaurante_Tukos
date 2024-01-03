<!-- Modal -->
<div class="modal fade" id="ReportePedidosRangoFecha" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">REPORTE DE N FECHA A N FECHA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.comanda.ReportePedidosRangeFecha') }}" target="_blank">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="">DESDE</label>
                            <input class="form-control" type="date" id="PedidosInicioDate" name="PedidosInicioDate">
                        </div>
                        <div class="col-md-6">
                            <label for="">HASTA</label>
                            <input class="form-control" type="date" id="PedidosFinalDate" name="PedidosFinalDate">
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