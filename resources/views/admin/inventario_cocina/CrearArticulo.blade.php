<div class="modal fade bd-example-modal-lg" id="modelId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRAR ARTICULO A INVENTARIO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="{{ route('admin.inventario_cocina.store') }}" method="POST">
                    @csrf
                        <div class="row">
                            <div class="col-md-6">                            
                                <div class="form-group">
                                    <label class="col-sm-12 col-form-label is-required" for="nombre">NOMBRE ARTICULO: </label><br>
                                    <input type="text" name="Nombre_articulo" id="Nombre_articulo" class="form-control"
                                        tabindex="1" autofocus onkeyup=" javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 col-form-label is-required" for="inicio_caja">DESCRIPCION ARTICULO: </label><br>
                                    <textarea class="form-control" id="Descripcion_articulo" name="Descripcion_articulo" rows="5" cols="51" 
                                        onkeyup="javascript:this.value=this.value.toUpperCase();" ></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 col-form-label is-required" for="nombre">TOTAL-CANTIDAD ARTICULO: </label><br>
                                    <input type="number" name="Cantidad_articulo" id="Cantidad_articulo" class="form-control"
                                        tabindex="1" autofocus onkeyup=" javascript:this.value=this.value.toUpperCase();" required>
                                </div>                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-12 col-form-label is-required" for="nombre">BUEN ESTADO</label><br>
                                    <input type="number" name="valor_bueno" id="valor_bueno" class="form-control" required>
                                </div> 
                                <div class="form-group">
                                    <label class="col-sm-12 col-form-label is-required" for="nombre">MAL ESTADO</label><br>
                                    <input type="number" name="valor_malo" id="valor_malo" class="form-control" required>
                                </div> 
                                <div class="form-group">
                                    <label class="col-sm-12 col-form-label is-required" for="nombre">DAÑADO</label><br>
                                    <input type="number" name="valor_dañado" id="valor_dañado" class="form-control" required>
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 grid-margin stretch-card">
                                <button type="submit" class="btn btn-success" tabindex="4" style="width: 100%;">Guardar </button>
                            </div>
                            <div class="col-md-6 grid-margin stretch-card">
                                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close" style="width: 100%;">Cancelar</button>
                            </div>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>


