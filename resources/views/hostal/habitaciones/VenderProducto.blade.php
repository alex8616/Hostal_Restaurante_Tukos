<div class="modal fade bd-example-modal-lg" id="modelProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">VENDER PRODUCTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
        <form  action="{{ route('hostal.habitacion.ProductoStore') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body" style="all: unset; margin: 35px;">
                            <input class="otraclase" id="hospedaje_habitacion_id" type="text" 
                            name="hospedaje_habitacion_id" value="{{$hospedajes->id}}" hidden>
                            <div class="container" style="all: unset;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="inputNombre"  class="is-required">Nombre Del Producto</label>
                                        <input class="otraclase" id="seach_product" type="text" 
                                        name="seach_product" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                        <input class="otraclase" id="producto_id" type="text" 
                                        name="producto_id" hidden>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="Precio_producto">Precio Producto</label>
                                        <input class="otraclase" name="Precio_producto" 
                                        id="Precio_producto" type="text">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="Precio_producto">Stock Producto</label>
                                        <input class="otraclase" name="Stock_producto" 
                                        id="Stock_producto" type="text">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="Precio_producto">Cantidad</label>
                                        <input class="otraclase" name="Cantidad" 
                                        id="cantidad" type="text">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="Precio_producto">Pago</label><br>
                                        <select class="otraclase" size="2" aria-label="Default select example" id="tippagado" name="tippagado">
                                            <option value="Pagado">Pago Al Contado</option>
                                            <option value="Por Paga">Pago Pendiente</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4"><br>
                                        <button type="button" id="agregar_product" class="btn btn-default btn-block btn1" style="width:98%;">
                                            <span>Agregar</span>
                                        </button>
                                    </div>
                                </div>                                        
                                <div class="row"  style="margin: 10px;">
                                    <table class="table table-bordered table-sm table-hover __web-inspector-hide-shortcut__" id="detalles">
                                        <thead>
                                            <tr>
                                                <th colspan="7" style="text-align: center; background:#D0D3D4;">PRODUCTOS A VENDERSE</th>
                                            </tr>
                                            <tr>
                                                <th>N</th>
                                                <th>Producto Nombre</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Tipo Pago</th>
                                                <th>Sub Total</th>
                                                <th scope="col"><i class="fas fa-trash-alt" style="width: 5px;"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabla_venta_productos_temp">
                                        </tbody>
                                        <tfooter>
                                            <tr>
                                                <td colspan="7">
                                                    <p align="right"><span align="right" id="total_pagar_html">Bs 0.00</span>
                                                        <input  name="total" id="total_pagar" hidden>
                                                    </p>
                                                </td>
                                            </tr>
                                        </tfooter>
                                    </table>
                                </div>
                                <div class="row">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" id="submitButton" class="btn btn-dark">
                                    <i class="fas fa-check-circle text-success"></i>
                                        Aceptar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                                        
            </div>
        </form>
        </div>
        </div>
    </div>
</div>
<style>
    /*Input FORM*/
    .otraclase{
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .otraclase:focus {
        border-color: #4d94ff;
        box-shadow: 0 0 0 0.25rem rgba(77, 148, 255, 0.25);
    }

    .otraclaseform{
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .otraclaseform:focus {
        border-color: #4d94ff;
        box-shadow: 0 0 0 0.25rem rgba(77, 148, 255, 0.25);
    }
    /*FIN input*/
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
<script>
document.getElementById("submitButton").addEventListener("click", function(){
  document.getElementById("submitButton").style.display = "none";
});
</script>