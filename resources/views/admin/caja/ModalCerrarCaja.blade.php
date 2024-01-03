<div class="modal fade" id="modalcerrarcaja" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">CERRAR CAJA</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p style="color: red;">* Nota: Una vez que registres el cierre de CAJA ya no se podra borrar ni editar, <strong>¿Estas seguro/a de cerrar la Caja?</strong> *</p>
            <form id="add-form" action="{{ route('admin.caja.storedetallecajacerrar') }}" method="POST" id="">
            @csrf
                <input class="typeahead form-control" name="caja_id" id="caja_id" type="text" value="{{$caja->id}}" hidden>
                <button type="submit" class="btn btn-danger" tabindex="4" style="width: 100%;">Cerrar Caja</button>
            </form>
        </div>
        </div>
    </div>
</div>