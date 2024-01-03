<div class="modal fade" id="EditReserva{{ $reserva->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color:black">Completar Pago</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('updatereserva', $reserva->id) }}">
                @method('PUT')
                @csrf
                <div class="form-row"><br>
                    <div class="form-group col-md-6">
                        <label for="">Precio Del Flete Salon</label><br>
                        <input class="form-control" type="number" value="{{ $reserva->precio }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Monto Refrigerio - Detalle</label><br>
                        <input class="form-control" type="number" value="{{ $reserva->total - $reserva->precio }}" disabled>
                    </div>
                </div><br><br>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">Total Acumulado Pagar</label><br>
                        <input class="form-control" type="number" value="{{ $reserva->total }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Adelanto Dado:</label><br>
                        <input class="form-control" type="number" value="{{ $reserva->adelanto }}" disabled>
                    </div>
                </div><br><br>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="deuda_pagar">Monto a Pagar Aun</label><br>
                        <input class="form-control" type="number" value="{{ $reserva->deuda_pagar }}" disabled>
                        <input class="form-control" id="deuda_pagar" name="deuda_pagar" type="number" value="0" hidden>
                        <input class="form-control" id="adelanto" name="adelanto" type="number" value="{{$reserva->adelanto + $reserva->deuda_pagar}}" hidden>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Completar Deudas</button>
        </div>
        </form> 
    </div>
</div>
