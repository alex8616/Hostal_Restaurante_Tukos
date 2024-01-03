<div class="modal fade bd-example-modal-lg" id="adddetalle{{ $festivale->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"  style="height: 90%;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TICKET</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" style="height: 100%;">
            <form action="{{ route('admin.festival.addreservafestival') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                        <input type="text" id="caja_id" name="caja_id" value="{{ $ultimo_registro->id }}" hidden>
                        <input type="text" id="id_reserva" name="id_reserva" value="{{ $festivale->id }}" hidden>
                        <input type="text" id="festival_id" name="festival_id" value="{{ $festival->id }}" hidden>
                            <select name="id_plato" id="id_plato" class="form-select custom-select" size="6" style="width: 100%;" required>
                                <option value="" data-icon="fa-solid fa-bowl-rice" disabled selected hidden>Buscar Plato</option>
                                <center><optgroup label="C O M B O S" class="column"></center>
                                    @foreach ($combos as $index => $combo)
                                    @if ($combo->Nombre_categoria == 'combo')
                                        <option value="{{ $combo->id }}">
                                        {{ $combo->Nombre_combo }}
                                        </option>
                                    @endif
                                    @endforeach
                                </optgroup>
                                <center><optgroup label="G A S E O S A S / J U G O S" class="column"></center>
                                    @foreach ($combos as $index => $combo)
                                    @if ($combo->Nombre_categoria == 'gaseosas')
                                        <option value="{{ $combo->id }}">
                                        {{ $combo->Nombre_combo }}
                                        </option>
                                    @endif
                                    @endforeach
                                </optgroup>
                            </select>
                            </div>
                        </div>                        
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" class="form-control" name="cantidad" id="cantidad" aria-describedby="helpId" min="0" max="100" required>
                    </div>
                    <div class="col-md-3">
                        <label for="Precio_plato">Precio de venta</label>
                        <input type="number" class="form-control" name="Precio_plato" id="Precio_plato" aria-describedby="helpId" required>
                    </div>
                    <div class="col-md-6">
                        <label for="comentario">Comentario</label>
                        <textarea class="form-control" name="comentario" id="comentario" rows="1"></textarea>
                    </div>
                </div>
                <button type="submit">
                    <i class="fas fa-check-circle text-success" style="background: white;"></i>
                    <span style="font-size: 15px;">Registrar</span>
                </button>
            </form> 
            </div>
        </div>
    </div>
</div>
