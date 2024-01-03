<div class="modal fade" id="ReportePedidosDiario" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">REPORTE DIARIO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.comanda.TukoRangeFecha') }}">
                    <input type="date" id="InicioDate" name="InicioDate">
                    <input type="date" id="FinDate" name="FinDate">
                    <button type="submit">enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- FIN - Modal -->