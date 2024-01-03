<div wire:ignore.self class="modal fade" id="bajaArticuloModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Comfirma Si Quieres Dar De Baja</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-4 pb-4">
                <h2>Estas Seguro Que Quieres dar de baja el ARTICULO?</h2><br>
                <p style="color: #FF4040">Nota: el articulo se dara de baja permanentemente.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary" wire:click="cerrarModal()" data-dismiss="modal" aria-label="Close">Cancelar</button>
                <button class="btn btn-sm btn-danger" wire:click="cambio_de_estado()">Si! Dar De Baja</button>
            </div>
        </div>
    </div>
</div>