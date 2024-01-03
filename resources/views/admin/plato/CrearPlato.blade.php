<div class="modal fade bd-example-modal-lg" id="modelId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRAR PLATO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/plato') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNombre" class="is-required">Nombre Del Plato</label><br>
                            <input type="text" class="form-control" id="Nombre_plato" name="Nombre_plato"  onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Nombre_plato') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputApellidop" class="is-required">Precio del plato</label><br>
                            <input type="Number" class="form-control" id="Precio_plato" name="Precio_plato"  onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Precio_plato') }}">
                        </div>
                    </div><br>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputApellidom" class="is-required">Caracteristicas Del Plato</label>
                            <textarea class="form-control" id="Caracteristicas_plato" name="Caracteristicas_plato" rows="5" cols="51  " onkeyup="javascript:this.value=this.value.toUpperCase();" ></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputApellidom" class="is-required">Selecione A Que Categoria Pertenece:</label>
                            <select style="width:100%" id="categoria_id" size="5" name="categoria_id" class="form-select" aria-label="size 6 select example">
                            <option value="" >Seleccione Una De las Opciones</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id}}" {{ old('Nombre_categoria') == $categoria->id ? "selected" :""}} >{{ $categoria->Nombre_categoria}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><br>
                    <div class="form-row">
                    <div class="col-md-12">
                        <label for="logo" class="is-required">Logo</label><br>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="imagen" id="imagen" accept="image/*" onchange="loadFile(event)" class="form-control" tabindex="3">
                            <label class="custom-file-label" for="validatedCustomFile">Click Para Seleccionar Imagen...</label>
                            <div class="invalid-feedback">Example invalid custom file feedback</div>
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
            </div>
            <div class="modal-footer">
                    <center>
                        <button type="submit" class="btn btn-danger">Cancelar</button>
                        <button type="submit" class="btn btn-success">Registrar</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>