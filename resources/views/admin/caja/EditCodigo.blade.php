<!--ventana para Update--->
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 
<div class="modal fade" id="editCodigo{{ $codigo->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

    <form method="POST" action="{{ route('updatecodigo', $codigo->id) }}">
    @method('PUT')
    @csrf
        <div class="modal-body" id="cont_modal">
            <div class="form-group">
            <label for="Nombre" class="col-form-label">Nombre De Codigo:</label><br>
            <input type="text" name="Nombre" class="form-control" value="{{ $codigo->Nombre }}" 
             onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Nombre') }}" required="true">
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