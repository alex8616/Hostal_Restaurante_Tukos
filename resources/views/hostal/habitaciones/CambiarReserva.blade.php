<!-- Modal -->
<div class="modal fade" id="CambiarHabitacion{{ $reservashabitacione->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Cambiar De Habitacion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="myForm" action="{{ route('hostal.habitacion.CambiarReserva', $reservashabitacione) }}">
                        <div class="form-row">
                            <strong>HUESPED: </strong> 
                            @foreach($clientes as $cliente)
                                @if($cliente->id == $reservashabitacione->cliente_id)
                                    {{ $cliente->Nombre_cliente }}  {{ $cliente->Celular_cliente }}
                                @endif
                            @endforeach                                           
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="col-md-6" style="text-align: left;">
                                <strong>INGRESO:</strong> {{ date('Y-m-d', strtotime($reservashabitacione->ingreso_reserva)) }} 
                            </div>
                            <div class="col-md-6" style="text-align: left;">
                                <strong>SALIDA:</strong> {{ date('Y-m-d', strtotime($reservashabitacione->salida_reserva)) }}                          
                            </div>                                              
                        </div>
                        <hr>                                                                
                        <input type="text" id="txtid">
                        <input type="text" id="id_res" name="id_res" value="{{$reservashabitacione->id}}" hidden>
                        <div class="form-row">
                            <div class="col-md-5" style="text-align: left;">
                                <p class="nombreHabitacion" style="font-size: 16px; color:#000000">{{$habitacione->Nombre_habitacion}}</p>
                            </div>
                            <div class="col-md-2">
                                <label for="">a</label>
                            </div>
                            <div class="col-md-5" style="text-align: left;">
                            <select name="habitacion_id" id="habitacion_id">
                                <option value="" disabled selected>Seleccione una habitación</option>
                                @foreach($cambiarhabitaciones as $cambiarhabitacione)
                                    <option value="{{ $cambiarhabitacione->id }}">{{ $cambiarhabitacione->Nombre_habitacion }}</option>
                                @endforeach
                            </select>
                            </div>                                              
                        </div>                                                               
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btncerrar" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" id="submit-button" class="btn btn-primary" disabled>Save</button>
            </div>
            </form>
        </div>
    </div>
</div>  