<!--ventana para Update--->
<div class="modal fade" id="EditPlato{{ $plato->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title" style="text-align: center;">
                Actualizar Información
            </h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
    </div>


    <form action="{{ route('updateplato', $plato->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            {{ @method_field('PUT') }}
        <div class="modal-body" id="cont_modal">
            <div class="col-md-12">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNombre" class="is-required">Nombre Del Plato</label><br>
                        <input type="text" class="form-control" id="Nombre_plato" name="Nombre_plato"  
                        onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ $plato->Nombre_plato }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputApellidop" class="is-required">Precio del plato</label><br>
                        <input type="Number" class="form-control" id="Precio_plato" name="Precio_plato"  
                        onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ $plato->Precio_plato }}">
                    </div>
                </div>
                <div class="form-row">
                    <br>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputApellidom" class="is-required">Caracteristicas Del Plato</label>
                        <textarea class="form-control" id="Caracteristicas_plato" name="Caracteristicas_plato" 
                        rows="6" cols="51" onkeyup="javascript:this.value=this.value.toUpperCase();">{{ old('Caracteristicas_plato', $plato->Caracteristicas_plato) }}</textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputApellidom" class="is-required">Selecione A Que Categoria Pertenece:</label>
                        <select style="width:100%" id="categoria_id" size="6" name="categoria_id" class="form-select" aria-label="size 6 select example">
                            @foreach ($categorias as $categoria)
                                @if ($categoria->id == $plato->categoria_id)
                                    <option value="{{ $categoria->id }}"selected>{{ $categoria->Nombre_categoria }}</option>
                                @else
                                    <option value="{{ $categoria->id }}">{{ $categoria->Nombre_categoria }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="imagen">Imagen: </label>
                        <input type="file" name="imagen" id="imagen" class="form-control" tabindex="3" accept="image/*" onchange="loadFile(event)" class="form-control" tabindex="3">
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-md-6">
                                <img id="output">   
                            </div>
                        </div>
                    </div>
                    <script>
                        var loadFile = function(event) {
                            var output = document.getElementById('output');
                            output.src = URL.createObjectURL(event.target.files[0]);
                            output.onload = function() {
                            URL.revokeObjectURL(output.src) // free memory
                            }
                        };
                    </script>
                    <div class="form-group col-md-6">
                        <label for="inputApellidom">Seleccion De Menu</label>
                        <select style="width:100%" size="6" id="tipo" name="tipo" class="form-select">
                            <option value="Semanal" {{ old('tipo.0') == "Semanal" ? "selected" :""}}>Semanal</option>
                            <option value="Dominical" {{ old('tipo.0') == "Dominical" ? "selected" :""}}>Dominical</option>
                        </select>
                    </div>
                </div>              
                    <center>
                        <button type="submit" class="btn btn-danger">Cancelar</button>
                        <button type="submit" class="btn btn-success">Registrar</button>
                    </center>
                </div>
            </div>    
        </form>
    </div>
</div>
</div>
<!---fin ventana Update --->