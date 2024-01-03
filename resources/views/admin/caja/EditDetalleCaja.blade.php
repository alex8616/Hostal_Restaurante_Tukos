<!--ventana para Update--->
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 
<div class="modal fade" id="EditDetalleCaja{{ $detallecaja->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header" style="background-color: #563d7c !important;">
            <h6 class="modal-title" style="color: #fff; text-align: center;">
                Actualizar Información {{$detallecaja->id}}
            </h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
    </div>

    <form method="POST" action="{{ route('updatedetallecaja', $detallecaja->id) }}">
    @method('PUT')
    @csrf
        <div class="modal-body" id="cont_modal"> 
        <div class="form-row">              
                <div class="form-group col-md-12">
                    <input class="typeahead form-control" name="caja_id" id="caja_id" type="text" value="{{$caja->id}}" hidden>
                    <select class="form-control" data-live-search="true" name="codigo_caja_id2" id="codigo_caja_id2" lang="es">                        
                        @foreach ($codigos as $codigo)
                            @if ($codigo->id == $detallecaja->codigo_caja_id)
                                <option value="{{ $codigo->id }}" selected> 
                                            {{ $codigo->Nombre }} 
                                </option>
                            @else
                                <option value="{{ $codigo->id }}"> 
                                            {{ $codigo->Nombre }} 
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div><br>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <select class="form-control" data-live-search="true" name="articulo_caja_id2" id="articulo_caja_id2" lang="es">                        
                        @foreach ($articulos as $articulo)
                            @if ($articulo->id == $detallecaja->articulo_caja_id)
                                <option value="{{ $articulo->id }}" selected> 
                                        {{ $articulo->Nombre_Articulo }} 
                                </option>
                            @else
                                <option value="{{ $articulo->id }}"> 
                                        {{ $articulo->Nombre_Articulo }} 
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div><br>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="Nombre" class="col-form-label">Descripcion:</label><br>
                    <input type="text" id="Articulo_description" name="Articulo_description" class="form-control" value="{{ $detallecaja->Articulo_description }}" 
                    onkeyup="javascript:this.value=this.value.toUpperCase();" required="true">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputNombre" class="is-required">Factura</label><br>
                    <select style="width:100%" id="Factura" size="2" name="Factura" class="form-select">
                        <option value="Con_Factura" {{ $detallecaja->Factura == "Con_Factura" ? "selected" :""}}>Con Factura</option>
                        <option value="Sin_Factura" {{ $detallecaja->Factura  == "Sin_Factura" ? "selected" :""}}>Sin Factura</option>
                    </select>            
                </div>
            </div><br>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="Nombre" class="col-form-label">Ingreso:</label><br>
                    <input type="text" name="Ingreso" id="Ingreso" class="form-control" value="{{ $detallecaja->Ingreso }}" 
                    onkeyup="javascript:this.value=this.value.toUpperCase();" required="true">
                </div>
                <div class="form-group col-md-6">
                    <label for="Nombre" class="col-form-label">Egreso:</label><br>
                    <input type="text" name="Egreso" id="Egreso" class="form-control" value="{{ $detallecaja->Egreso }}" 
                    onkeyup="javascript:this.value=this.value.toUpperCase();" required="true">                   
                </div>
                <div class="form-group col-md-6">
                    <label for="Nombre" class="col-form-label">Fecha:</label><br>
                    <input type="datetime" name="Fecha_registro" id="Fecha_registro" class="form-control" value="{{ $detallecaja->Fecha_registro }}" 
                    onkeyup="javascript:this.value=this.value.toUpperCase();" required="true">                   
                </div>
            </div><br>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>
    </form>

    </div>
</div>
</div>
<!---fin ventana Update --->