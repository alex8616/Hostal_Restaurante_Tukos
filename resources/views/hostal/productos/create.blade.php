<div class="modal fade bd-example-modal-lg" id="CreateProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRAR PRODUCTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" style="height: 100%;">
                <div>
                <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
                <form action="{{ url('/producto') }}" method="post" enctype="multipart/form-data" class="registrar-form">
                @csrf
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="">Nombre Producto</label>
                            <input class="form-control" type="text" id="Nombre_producto" name="Nombre_producto" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">Detalle Producto</label>
                            <input class="form-control" type="text" id="Detalle_producto" name="Detalle_producto" required>
                        </div>
                    </div><br>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="">Precio</label>
                            <input class="form-control" type="number" id="Precio_producto" name="Precio_producto" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">Categoria</label><br>
                            <select name="Categoria_producto" id="Categoria_producto" class="form-control">
                                <option value="GASEOSAS">Gaseosas</option>
                                <option value="BEBIDADAS ALCHOLICAS">Bebidas Alcholicas</option>
                            </select>
                        </div>
                        <div class="col-md-4" hidden>
                            <label for="">Cantidad</label>
                            <input class="form-control" type="number" id="Stock_producto" name="Stock_producto" value="0" required>
                        </div>
                        <div class="col-md-4" hidden>
                            <label for="">Fecha Registro</label>
                            <input class="form-control" value="<?php echo date('Y-m-d'); ?>" type="date" id="FechaRegistro_producto" name="FechaRegistro_producto">
                        </div>                                              
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secundary" data-dismiss="modal">Close</button>
                        <button type="submit" id="submitBtn" class="btn btn-primary">Guardar Cambios</button>                
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  $(document).ready(function(){
    $("#submitBtn").attr("disabled", "disabled");

    $('.form-control').on("input", function(){
        var complete = true;
        $('.form-control').each(function(){
        if($(this).prop("required") && !$(this).val()){
            complete = false;
            return false;
        }
        });

        if(complete){
        $("#submitBtn").removeAttr("disabled");
        }else{
        $("#submitBtn").attr("disabled", "disabled");
        }
    });
  });
</script>
