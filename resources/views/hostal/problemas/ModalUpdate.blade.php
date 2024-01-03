
<!-- Modal -->
<div class="modal fade" id="Solucionar{{$problema->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form action="{{ route('hostal.problemas.update', $problema->id) }}" method="post" enctype="multipart/form-data" id="formulario-updateproblema">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="titulo">Como Se Dio La Solucion al PROBLEMA?</label>
                            <textarea id="descripcion" name="descripcion" class="form-control" rows="6"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger">Close</button>
                    <button type="submit" class="btn btn-primary guardar" id="guardar">Save</button>
                    </div>
            </form>
        </div>
    </div>
</div>