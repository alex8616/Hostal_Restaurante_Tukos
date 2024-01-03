<div class="modal fade bd-example-modal-lg" id="modelId" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRAR CLIENTE NUEVO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                    <div class="col-md-12">
                        <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
                        <form action="{{ route('hostal.ClienteHostal.storelist') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="inputNombre"  class="is-required">Documento del Cliente</label>
                                    <input class="typeahead form-control" id="Documento_cliente" type="text" 
                                    name="Documento_cliente" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="col-md-8">
                                    <label for="Nombre_cliente">Nombre Completo</label>
                                    <input class="typeahead form-control" name="Nombre_cliente" 
                                    id="Nombre_cliente" type="text" required>
                                </div>
                            </div><br>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label  class="is-required">Nacionalidad</label><br>
                                    <select class="form-control select2" id="Nacionalidad_cliente" name="Nacionalidad_cliente" required>
                                    <option disabled selected>Seleccione Un Pais</option>
                                        @foreach ($countries['countries'] as $country)
                                            <option value="{{ $country['nationality'] }}">{{ $country['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="EstadoCivil_cliente">Estado Civil</label><br>
                                    <select class="form-control select2" id="EstadoCivil_cliente" name="EstadoCivil_cliente" required>
                                        <option disabled selected>Seleccione Estado Civil</option>
                                        <option value="Soltero(a)">Soltero(a)</option>
                                        <option value="Casado(a)">Casado(a)</option>
                                        <option value="Viudo(a)">Viudo(a)</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="Profesion_cliente">Profesion</label>
                                    <input class="typeahead form-control" name="Profesion_cliente" 
                                    id="Profesion_cliente" type="text" required>
                                </div>
                            </div><br>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="fechaNacimiento">Fecha De Nacimiento</label>
                                    <input class="typeahead form-control" name="fechaNacimiento" 
                                    id="fechaNacimiento" type="date" required onchange="calculateAge()">
                                </div>
                                <div class="col-md-2">
                                    <label for="Edad_cliente"  class="is-required">Edad</label>
                                    <input class="typeahead form-control" id="Edad_cliente" type="text" 
                                    name="Edad_cliente" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="Celular_cliente"  class="is-required">Numero Celular</label>
                                    <input class="typeahead form-control optional" id="Celular_cliente" type="text" 
                                    name="Celular_cliente">
                                </div>
                            </div>
                            <hr>
                            <center>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
                                <button type="submit" id="submitBtn" class="btn btn-success">Registrar</button>
                            </center>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function calculateAge() {
        var birthday = new Date(document.getElementById("fechaNacimiento").value);
        var today = new Date();
        var age = today.getFullYear() - birthday.getFullYear();
        if ( today.getMonth() < birthday.getMonth() || 
            ( today.getMonth() === birthday.getMonth() && today.getDate() < birthday.getDate() )) {
            age--;
        }
        document.getElementById("Edad_cliente").value = age;
    }
</script>
<script>
    $('#Documento_cliente').on('blur', function() {
    var documento = $(this).val();
    $.ajax({
        url: 'validar-documento',
        type: 'GET',
        data: { documento: documento },
        success: function(data) {
        if (data == 'existe') {
            Swal.fire({
                    icon: 'error',
                    title: 'C.I / Passaporte',
                    text: 'EL DOCUMENTO YA EXITE NO SE PUEDE VOLVER A REGISTRAR',
                })
            $('#Documento_cliente').val('');
        }
        }
    });
    });
</script>
