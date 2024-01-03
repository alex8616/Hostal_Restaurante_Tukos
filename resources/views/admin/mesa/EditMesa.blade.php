<!--ventana para Update--->
<div class="modal fade" id="editMesa{{ $mesa->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header" style="background-color: #563d7c !important;">
            <h6 class="modal-title" style="color: #fff; text-align: center;">
                Actualizar Información
            </h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
    </div>

    <form method="POST" action="{{ route('updatemesa', $mesa->id) }}">
    @method('PUT')
    @csrf
        <div class="modal-body" id="cont_modal">
            <div class="form-group">
            <label for="Nombre_mesa" class="col-form-label">Nombre o Numero De Mesa:</label>
            <input type="text" name="Nombre_mesa" class="form-control" value="{{ $mesa->Nombre_mesa }}" 
             onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Nombre_cliente') }}" required="true">
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>
    </form>

    </div>
</div>
</div>
<!---fin ventana Update --->