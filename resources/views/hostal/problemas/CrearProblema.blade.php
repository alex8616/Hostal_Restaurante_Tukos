<div class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="modalproblem">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 100%; margin:auto">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Problema</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form action="{{ route('hostal.problemas.store') }}" method="post" enctype="multipart/form-data" id="formulario-problema">
            @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="titulo">TITULO:</label>
                            <input class="form-control" id="titulo" name="titulo" type="text">
                        </div>
                    </div><br>
                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="descripcion">DESCRIPCION DETALLADO DEL PROBLEMA:</label>
                            <textarea id="descripcion" name="descripcion" class="form-control" rows="6"></textarea>
                        </div>
                    </div><br>
                    <div class="form-row">
                        <div class="col-md-12">
                            <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
                            <label for="descripcion">TIPO DE PROBLEMA:</label><br>
                            <div class="col-md-12 col-12" style="display: inline-block;">
                                <label class="new-control new-checkbox new-checkbox-text checkbox-success">
                                    <input type="radio" class="new-control-input" name="tipoproblema" value="LEVE">
                                    <span class="new-control-indicator"></span><span class="new-chk-content">LEVE</span>
                                </label>

                                <label class="new-control new-checkbox new-checkbox-text checkbox-warning">
                                    <input type="radio" class="new-control-input" name="tipoproblema" value="MEDIO">
                                    <span class="new-control-indicator"></span><span class="new-chk-content">MEDIO</span>
                                </label>

                                <label class="new-control new-checkbox new-checkbox-text checkbox-danger">
                                    <input type="radio" class="new-control-input" name="tipoproblema" value="CRITICO">
                                    <span class="new-control-indicator"></span><span class="new-chk-content">CRITICO</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
