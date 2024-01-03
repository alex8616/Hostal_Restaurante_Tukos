<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRAR MESA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form action="{{ route('admin.mesa.crear') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-12 col-form-label is-required" for="nombre">Nombre o Numero De Mesa: </label>
                            <input type="text" name="Nombre_mesa" id="Nombre_mesa" value="{{ old('Nombre_mesa') }}" class="form-control"
                                tabindex="1" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 grid-margin stretch-card">
                                <button type="submit" class="btn btn-success" tabindex="4" style="width:100%;">Guardar </button>
                            </div>
                            <div class="col-md-6 grid-margin stretch-card">
                                <a href="{{ route('admin.categoria.index') }}" class="btn btn-danger" tabindex="4" style="width:100%;">Cancelar</a>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
