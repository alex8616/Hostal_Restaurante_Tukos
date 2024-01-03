<div class="modal fade" id="CambiarHabitacionHospedaje{{ $hospedajehabitacione->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
                    <form id="myForm" action="{{ route('hostal.habitacion.CambiarHospedaje', $hospedajehabitacione->id) }}">
                        <div class="form-row">
                            <strong>HUESPED: </strong> 
                            @foreach($clientes as $cliente)
                                @if($cliente->id == $hospedajehabitacione->cliente_id)
                                    {{ $cliente->Nombre_cliente }}  {{ $cliente->Celular_cliente }}
                                @endif
                            @endforeach                                           
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="col-md-6" style="text-align: left;">
                                <strong>INGRESO:</strong> {{ date('Y-m-d', strtotime($hospedajehabitacione->ingreso_hospedaje)) }} 
                            </div>
                            <div class="col-md-6" style="text-align: left;">
                                <strong>SALIDA:</strong> <input type="date" id="salidainput" name="salidainput" value="{{ date('Y-m-d', strtotime($hospedajehabitacione->salida_hospedaje)) }}">                          
                            </div>                                              
                        </div>
                        <hr>                                                                
                        <input type="text" id="id_hospedaje" name="id_hospedaje" value="{{$hospedajehabitacione->id}}" hidden>
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