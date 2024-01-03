<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

<div class="modal fade bd-example-modal-lg" id="modelId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRAR CLIENTE NUEVO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <link href="assets/css/plugins.css" rel="stylesheet" type="text/css"/>
                        <form action="{{ url('/cliente') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="ubicacion">Ubicación:</label>
                                    <input class="form-control" type="text" id="ubicacion" name="ubicacion">
                                </div>
                            </div><br>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="ubicacion">latitude:</label>
                                    <input class="form-control" type="text" id="latitude" name="latitude">
                                </div>
                                <div class="col-md-6">
                                    <label for="ubicacion">longitude:</label>
                                    <input class="form-control" type="text" id="longitude" name="longitude">
                                </div>                
                            </div><br>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="ubicacion">Zona:</label>
                                    <input class="form-control" type="text" id="neighbourhood" name="neighbourhood">
                                </div>
                                <div class="col-md-6">
                                    <label for="ubicacion" class="is-required">Direccion:</label>
                                    <input class="form-control" type="text" id="address" name="address" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="ubicacion">N Domicilio:</label>
                                    <input class="form-control" type="text" id="NDireccion_cliente" name="NDireccion_cliente">
                                </div> 
                                <input class="form-control" type="text" id="zoom" name="zoom" hidden>                                     
                            </div><br>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="inputNombre" class="is-required">Nombres</label>
                                    <input type="text" class="form-control" id="Nombre_cliente" 
                                    name="Nombre_cliente" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Nombre_cliente') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputApellidop" class="is-required">Apellidos</label>
                                    <input type="text" class="form-control" id="Apellidop_cliente" 
                                    name="Apellidop_cliente" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Apellidop_cliente') }}" required>
                                </div>
                            </div><br>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="is-required">Numero De Celular</label>
                                    <input type="number" class="form-control" id="Celular_cliente" 
                                    name="Celular_cliente" value="{{ old('Celular_cliente') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail4">Fecha De Nacimiento</label>
                                    <input type="date" class="form-control" id="FechaNacimiento_cliente" name="FechaNacimiento_cliente">
                                </div>
                            </div><br>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="Nit_cliente">Nit o CI</label>
                                    <input type="text" class="form-control" id="Nit_cliente" name="Nit_cliente" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Nit_cliente') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail4">Correo Electronico</label>
                                    <input type="email" class="form-control" id="Correo_cliente" 
                                    name="Correo_cliente" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Correo_cliente') }}">
                                </div>
                            </div><br>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <center>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
                                        <button type="submit" class="btn btn-success" disabled>Registrar</button>
                                    </center>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col">
                        <!DOCTYPE html>
                        <html>
                        <head>
                        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
                                integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
                                crossorigin=""/>
                        <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
                                integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
                                crossorigin=""></script>
                        </head>
                        <body>
                        <div id="mapid" style="height: 500px;"></div>
                        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
                        <script>
                            const form = document.querySelector("form");
                            const ubicacionInput = document.querySelector("#ubicacion");
                            const latitudeInput = document.querySelector("#latitude");
                            const longitudeInput = document.querySelector("#longitude");
                            const addressInput = document.querySelector("#address");
                            const neighbourhoodInput = document.querySelector("#neighbourhood");

                            var marker;
                            var map = L.map('mapid').setView([-19.5807733, -65.7628557], 14);

                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
                                maxZoom: 18
                            }).addTo(map);

                            
                            ubicacionInput.addEventListener("keyup", function() {
                                const ubicacion = ubicacionInput.value;

                                if (!ubicacion) {
                                    latitudeInput.value = "";
                                    longitudeInput.value = "";
                                    addressInput.value = "";
                                    neighbourhood.value = "";
                                    if (marker) {
                                        map.removeLayer(marker);
                                        marker = null;
                                    }
                                    return;
                                }

                                axios.post("{{ route('hostal.habitacion.storepruebas') }}", {
                                        ubicacion: ubicacion
                                    })
                                    .then(function(response) {
                                        const data = response.data;
                                        latitudeInput.value = data.latitude;
                                        longitudeInput.value = data.longitude;
                                        if (marker) {
                                            map.removeLayer(marker);
                                        }
                                        marker = L.marker([data.latitude, data.longitude]).addTo(map);
                                        Math.min(data.zoom, map.options.maxZoom);
                                        marker.dragging.enable();
                                        marker.on('dragend', function(e) {
                                            latitudeInput.value = marker.getLatLng().lat;
                                            longitudeInput.value = marker.getLatLng().lng;
                                            axios.get("https://nominatim.openstreetmap.org/reverse", {
                                                params: {
                                                lat: latitudeInput.value,
                                                lon: longitudeInput.value,
                                                format: "json",
                                                addressdetails: 1
                                                }
                                            })
                                            .then(function(response) {
                                                const reverseData = response.data.address;
                                                addressInput.value = reverseData.road;
                                                neighbourhoodInput.value = reverseData.neighbourhood;
                                            });
                                        });

                                        
                                        axios.get("https://nominatim.openstreetmap.org/reverse", {
                                        params: {
                                            lat: data.latitude,
                                            lon: data.longitude,
                                            format: "json",
                                            addressdetails: 1
                                            }
                                        })
                                        .then(function(response) {
                                            const reverseData = response.data.address;
                                            addressInput.value = reverseData.road;
                                            neighbourhoodInput.value = reverseData.neighbourhood;
                                        });
                                    });
                            });

                            map.on("click", function(e) {
                                if (!ubicacionInput.value) {
                                    latitudeInput.value = e.latlng.lat;
                                    longitudeInput.value = e.latlng.lng;
                                    if (marker) {
                                        map.removeLayer(marker);
                                    }
                                    marker = L.marker(e.latlng).addTo(map);
                                    axios.get("https://nominatim.openstreetmap.org/reverse", {
                                    params: {
                                        lat: e.latlng.lat,
                                        lon: e.latlng.lng,
                                        format: "json",
                                        addressdetails: 1
                                        }
                                    })
                                    .then(function(response) {
                                        const reverseData = response.data.address;
                                        addressInput.value = reverseData.road;
                                        neighbourhoodInput.value = reverseData.neighbourhood;
                                    });
                                }
                            });    
                        </script>
                        </body>
                        </html>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
  .modal-dialog {
    max-width: 80% !important;
  }
  input:required {
       border: 1px solid red;
    }
</style>

<script>
    
    $(document).ready(function() {
    $('input').on('input', function() {
        if ($(this).val()) {
        $(this).css('border', '1px solid #ccc');
        } else {
        $(this).css('border', '1px solid red');
        }
    });
    });

    $(document).ready(function() {
    var inputs = $('input[required]');
    var submitButton = $('button[type="submit"]');

    submitButton.prop('disabled', true);

    inputs.on('change', function() {
        var allFilled = true;
        inputs.each(function() {
        if (!$(this).val()) {
            allFilled = false;
            return false;
        }
        });

        $('#address').change(function() {
            if ($(this).val()) {
            $(this).css('border', '1px solid #ccc');
            } else {
            $(this).css('border', '1px solid red');
            }
        });
        
        if (allFilled) {
        submitButton.prop('disabled', false);
        } else {
        submitButton.prop('disabled', true);
        }
    });
    });


</script>