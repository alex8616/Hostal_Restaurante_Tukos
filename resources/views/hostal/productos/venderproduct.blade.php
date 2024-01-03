<div class="modal fade bd-example-modal-sm" id="vender{{ $producto->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">VENDER PRODUCTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" style="height: 100%;">
                <div>
                <form method="POST" action="{{ route('vender', $producto->id) }}">
                @method('PUT')
                @csrf
                    <div class="form-row">
                        <label for="Nombre_categoria" style="text-align: right;"><strong style="color: black">{{$producto->Nombre_producto}}</strong>:</label>
                        <div class="col-md-12">
                            <input type="text" id="caja_id" name="caja_id" value="{{ $ultimo_registro->id }}" hidden>
                            <div class="form-group">
                                <label for="">Precio De Venta </label><br>
                                <input type="number" name="precio_venta" id="precio_venta" value="{{ $producto->Precio_producto }}" class="form-control">
                            </div><br>
                            <div class="form-group">
                                <label for="">Cantidad A Vender </label><br>
                                <input type="number" name="cantidad_venta" id="cantidad_venta" value="1" class="form-control">
                            </div>
                        </div>
                    </div><br>
                    <button id="submit-button" type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div> 

