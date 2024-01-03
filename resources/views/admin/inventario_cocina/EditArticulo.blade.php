<!--ventana para Update--->
<div class="modal fade" id="EditArticulo{{ $articulo->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

    <form method="POST" action="{{ route('updateinventarioarticulo', $articulo->id) }}">
    @method('PUT')
    @csrf
        <div class="modal-body" id="cont_modal"> 
            <div class="form-row">
            <div class="modal-body" id="cont_modal" style="width: 50%;">
                <div class="form-group">
                    <label for="Nombre_Articulo" class="col-form-label">Nombre De Codigo:</label><br>
                    <input type="text" name="Nombre_articulo" class="form-control" value="{{ $articulo->Nombre_articulo }}" 
                    onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Nombre_articulo') }}" required="true">
                </div>
                <div class="form-group">
                    <label for="Nombre" class="col-form-label">Descripcion:</label><br>
                    <input type="text" id="Descripcion_articulo" name="Descripcion_articulo" class="form-control" value="{{ $articulo->Descripcion_articulo }}" 
                    onkeyup="javascript:this.value=this.value.toUpperCase();" required="true">
                </div>
                <div class="form-group">
                    <label for="Nombre" class="col-form-label">Cantidad:</label><br>
                    <input type="text" id="Cantidad_articulo" name="Cantidad_articulo" class="form-control" value="{{ $articulo->Cantidad_articulo }}" 
                    onkeyup="javascript:this.value=this.value.toUpperCase();" required="true">
                </div>
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