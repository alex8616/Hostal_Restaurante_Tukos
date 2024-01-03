<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRAR CATEGORIA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form action="{{ route('admin.categoria.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-12 col-form-label is-required" for="nombre">Nombre Categoría: </label><br>
                            <input type="text" name="Nombre_categoria" id="Nombre_categoria" value="{{ old('Nombre_categoria') }}" class="form-control"
                                tabindex="1" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                            @if ($errors->has('Nombre_categoria'))
                                    <span class="error text-danger">{{ $errors->first('Nombre_categoria') }}</span>
                            @endif
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
