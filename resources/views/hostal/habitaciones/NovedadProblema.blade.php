@extends('layouts.main', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
@section('content')
<br><br>
<div style="margin: auto;">
    <div class="modal-body" style="height: 90%;" style="position: relative;">
        <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
        <form action="{{ route('hostal.habitacion.StoreNovedadProblema') }}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="form-row">
                <div class="col-md-6">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
                </div>
                <div class="col-md-6">
                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="">Controles</label>
                            <button onclick="seleccionarTodo(event)">Seleccionar todo</button>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="opcion1">Opción 1</label>
                                        <input type="checkbox" id="opcion1" name="opciones[]" value="opcion1">
                                    </div>
                                    <div class="form-group">
                                        <label for="opcion2">Opción 2</label>
                                        <input type="checkbox" id="opcion2" name="opciones[]" value="opcion2">
                                    </div>
                                    <div class="form-group">
                                        <label for="opcion3">Opción 3</label>
                                        <input type="checkbox" id="opcion3" name="opciones[]" value="opcion3">
                                    </div>
                                    <div class="form-group">
                                        <label for="opcion2">Opción 4</label>
                                        <input type="checkbox" id="opcion2" name="opciones[]" value="opcion2">
                                    </div>
                                    <div class="form-group">
                                        <label for="opcion3">Opción 5</label>
                                        <input type="checkbox" id="opcion3" name="opciones[]" value="opcion3">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="opcion1">Opción 1</label>
                                        <input type="checkbox" id="opcion1" name="opciones[]" value="opcion1">
                                    </div>
                                    <div class="form-group">
                                        <label for="opcion2">Opción 2</label>
                                        <input type="checkbox" id="opcion2" name="opciones[]" value="opcion2">
                                    </div>
                                    <div class="form-group">
                                        <label for="opcion3">Opción 3</label>
                                        <input type="checkbox" id="opcion3" name="opciones[]" value="opcion3">
                                    </div>
                                    <div class="form-group">
                                        <label for="opcion2">Opción 4</label>
                                        <input type="checkbox" id="opcion2" name="opciones[]" value="opcion2">
                                    </div>
                                    <div class="form-group">
                                        <label for="opcion3">Opción 5</label>
                                        <input type="checkbox" id="opcion3" name="opciones[]" value="opcion3">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="opcion1">Opción 1</label>
                                        <input type="checkbox" id="opcion1" name="opciones[]" value="opcion1">
                                    </div>
                                    <div class="form-group">
                                        <label for="opcion2">Opción 2</label>
                                        <input type="checkbox" id="opcion2" name="opciones[]" value="opcion2">
                                    </div>
                                    <div class="form-group">
                                        <label for="opcion3">Opción 3</label>
                                        <input type="checkbox" id="opcion3" name="opciones[]" value="opcion3">
                                    </div>
                                    <div class="form-group">
                                        <label for="opcion2">Opción 4</label>
                                        <input type="checkbox" id="opcion2" name="opciones[]" value="opcion2">
                                    </div>
                                    <div class="form-group">
                                        <label for="opcion3">Opción 5</label>
                                        <input type="checkbox" id="opcion3" name="opciones[]" value="opcion3">
                                    </div>
                                </div>
                            </div>                            
                        </div>
                        <div class="col-md-12">
                        <label for="">Llaves</label>
                            <button onclick="seleccionarTodoLlave(event)">Seleccionar todo</button>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="opcion1">Opción 1</label>
                                        <input type="checkbox" id="opcion1" name="llaves[]" value="opcion1">
                                    </div>
                                    <div class="form-group">
                                        <label for="opcion2">Opción 2</label>
                                        <input type="checkbox" id="opcion2" name="llaves[]" value="opcion2">
                                    </div>
                                    <div class="form-group">
                                        <label for="opcion3">Opción 3</label>
                                        <input type="checkbox" id="opcion3" name="llaves[]" value="opcion3">
                                    </div>
                                    <div class="form-group">
                                        <label for="opcion2">Opción 4</label>
                                        <input type="checkbox" id="opcion2" name="llaves[]" value="opcion2">
                                    </div>
                                    <div class="form-group">
                                        <label for="opcion3">Opción 5</label>
                                        <input type="checkbox" id="opcion3" name="llaves[]" value="opcion3">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="opcion1">Opción 1</label>
                                        <input type="checkbox" id="opcion1" name="llaves[]" value="opcion1">
                                    </div>
                                    <div class="form-group">
                                        <label for="opcion2">Opción 2</label>
                                        <input type="checkbox" id="opcion2" name="llaves[]" value="opcion2">
                                    </div>
                                    <div class="form-group">
                                        <label for="opcion3">Opción 3</label>
                                        <input type="checkbox" id="opcion3" name="llaves[]" value="opcion3">
                                    </div>
                                    <div class="form-group">
                                        <label for="opcion2">Opción 4</label>
                                        <input type="checkbox" id="opcion2" name="llaves[]" value="opcion2">
                                    </div>
                                    <div class="form-group">
                                        <label for="opcion3">Opción 5</label>
                                        <input type="checkbox" id="opcion3" name="llaves[]" value="opcion3">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="opcion1">Opción 1</label>
                                        <input type="checkbox" id="opcion1" name="llaves[]" value="opcion1">
                                    </div>
                                    <div class="form-group">
                                        <label for="opcion2">Opción 2</label>
                                        <input type="checkbox" id="opcion2" name="llaves[]" value="opcion2">
                                    </div>
                                    <div class="form-group">
                                        <label for="opcion3">Opción 3</label>
                                        <input type="checkbox" id="opcion3" name="llaves[]" value="opcion3">
                                    </div>
                                    <div class="form-group">
                                        <label for="opcion2">Opción 4</label>
                                        <input type="checkbox" id="opcion2" name="llaves[]" value="opcion2">
                                    </div>
                                    <div class="form-group">
                                        <label for="opcion3">Opción 5</label>
                                        <input type="checkbox" id="opcion3" name="llaves[]" value="opcion3">
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-12">
                            <label for="">Otros</label>
                        </div>
                        <div class="col-md-12">
                            <label for="">Tanques</label>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="opcion1">TANQUE 1</label>
                                        <input type="range" min="0" max="100" step="1" value="50" name="porcentaje" id="porcentaje" oninput="actualizarPorcentaje()">
                                        <span id="porcentaje-valor"></span>%
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="opcion1">TANQUE 2</label>
                                        <input type="range" min="0" max="100" step="1" value="50" name="porcentaje" id="porcentaje" oninput="actualizarPorcentaje()">
                                        <span id="porcentaje-valor"></span>%
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="opcion1">TANQUE 3</label>
                                        <input type="range" min="0" max="100" step="1" value="50" name="porcentaje" id="porcentaje" oninput="actualizarPorcentaje()">
                                        <span id="porcentaje-valor"></span>%
                                    </div>
                                </div>
                            </div> 
                        </div>                                               
                    </div>
                </div>
            </div>
            
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" id="submitBtn" class="btn btn-primary">Guardar Cambios</button>                
        </form>
        </div>
    </div>
</div>
@endsection
@notifyCss
<!-- Importar los archivos necesarios de SimpleMDE -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
@push('js')
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
<script>
    var simplemde = new SimpleMDE({
        element: document.getElementById("descripcion"),
    });
</script>
<script>
    function seleccionarTodo(event) {
    event.preventDefault(); // detiene el comportamiento por defecto del botón
    var checkboxes = document.querySelectorAll('input[type="checkbox"][name="opciones[]"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = true;
    });
    }
</script>
<script>
    function seleccionarTodoLlave(event) {
    event.preventDefault(); // detiene el comportamiento por defecto del botón
    var checkboxes = document.querySelectorAll('input[type="checkbox"][name="llaves[]"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = true;
    });
    }
</script>
<script>
    function actualizarPorcentaje() {
    var slider = document.getElementById("porcentaje");
    var output = document.getElementById("porcentaje-valor");
    output.innerHTML = slider.value;
    }
</script>
@notifyJs
@endpush