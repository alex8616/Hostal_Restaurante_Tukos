@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
@section('content')
<br><br><hr>
<svg width="1600" height="700" xmlns="http://www.w3.org/2000/svg">
        <image href="/img/plano.jpeg" x="0" y="-600" width="1600px" height="2000px" />
    </svg>
    <div class="seat-map">
        <div class="grid"></div>
        @foreach($mesas as $mesa)
            <div class="seat available" data-id="{{ $mesa->id }}" style="left: {{ $mesa->posicion_x }}px; top: {{ $mesa->posicion_y }}px; background: {{ $mesa->reservafestivales->isEmpty() ? 'red' : 'green' }}">
                {{ $mesa->Nombre_mesa }}
                <span style="color: red">{{ $mesa->Cantidad_persona }}</span>
            </div>

            <!-- Modal para cada mesa -->
            @if(!$mesa->reservafestivales->isEmpty())
                <div class="modal fade" id="modal-{{ $mesa->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $mesa->id }}-title" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-{{ $mesa->id }}-title">Información de la mesa: {{ $mesa->Nombre_mesa }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p style="font-size: 19px;"><strong>NOMBRE DE LA RESERVA: </strong>{{ $mesa->reservafestivales[0]->Nombre_reserva }}</p>
                                <p style="font-size: 19px;"><strong>MESA ASIGNADA: </strong>{{ $mesa->Nombre_mesa }}</p>
                                <p style="font-size: 19px;"><strong>CANTIDAD DE PERSONAS: </strong>{{ $mesa->reservafestivales[0]->Cantidad_persona }}</p>
                                @if( $mesa->reservafestivales[0]->Adeltanto_reserva > 0)
                                    <p style="font-size: 19px;"><strong>ADELANTO: </strong>{{ $mesa->reservafestivales[0]->Adeltanto_reserva }}</p>
                                @else
                                    <p style="font-size: 19px; color: red"><strong>ADELANTO: </strong>Nose Dejo Ningun Adelanto</p>    
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    // Obtener el elemento del div de la mesa por su data-id
                    var mesaDiv = document.querySelector('[data-id="{{ $mesa->id }}"]');

                    // Agregar un event listener al div de la mesa para abrir el modal al hacer clic
                    mesaDiv.addEventListener('click', function() {
                        var modalId = "modal-{{ $mesa->id }}";
                        var modal = document.getElementById(modalId);
                        $(modal).modal('show');
                    });
                </script>
            @endif
        @endforeach

    </div>
    <button onclick="habilitarEdicion()">Editar</button>
    <button onclick="guardarPosiciones()">Guardar</button>
@endsection
<!-- CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 
<style>
    body {
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
    }

    .seat {
        position: absolute;
        width: 95px;
        height: 15px;
        background-color: gray;
        margin: 5px;
        border-radius: 15%;
        cursor: pointer;
        padding: 5px;
        color: white;
    }

    .available {
        background-color: green;
    }

    .selected {
        background-color: blue;
    }
    rect {
        fill: lightgray;
        stroke: black;
        stroke-width: 1;
        cursor: pointer;
    }

    rect:hover {
        fill: gray;
    }

    .grid {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        background-image: 
            linear-gradient(rgba(0, 0, 0, 0.1) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 0, 0, 0.1) 1px, transparent 1px);
        background-size: 100px 100px;
        z-index: -1;
        opacity: 0.5;
        display: none;
    }

    .show-grid .grid {
        display: block;
    }

    .seat {
        width: 90px;
        height: 70px;
        background-color: lightblue;
        border: 1px solid gray;
        text-align: center;
        line-height: 70px;
        cursor: move;
    }
</style>
@notifyCss
@push('js')
<!-- JavaScript -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.8/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.8/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/interactjs@1.10.11"></script>
<script>
    var edicionHabilitada = false;

    function habilitarEdicion() {
        edicionHabilitada = !edicionHabilitada;
        mostrarRejilla();
    }

    function mostrarRejilla() {
        if (edicionHabilitada) {
            var grid = document.querySelector('.grid');
            grid.style.display = 'block';
        } else {
            var grid = document.querySelector('.grid');
            grid.style.display = 'none';
        }
    }
</script>
<script>
    interact('.seat')
        .draggable({
            onstart: function (event) {
                if (!edicionHabilitada) {
                    event.preventDefault();
                    return;
                }
            },
            onmove: function (event) {
                if (!edicionHabilitada) {
                    event.preventDefault();
                    return;
                }

                var target = event.target;
                var x = parseFloat(target.style.left) || 0;
                var y = parseFloat(target.style.top) || 0;
                var dx = event.dx;
                var dy = event.dy;

                var svg = document.querySelector('svg');
                var svgWidth = parseFloat(svg.getAttribute('width'));
                var svgHeight = parseFloat(svg.getAttribute('height'));

                var newX = x + dx;
                var newY = y + dy;

                // Restringir el movimiento dentro de los límites del SVG
                if (newX < 0) {
                    newX = 0;
                } else if (newX + target.offsetWidth > svgWidth) {
                    newX = svgWidth - target.offsetWidth;
                }

                if (newY < 0) {
                    newY = 0;
                } else if (newY + target.offsetHeight > svgHeight) {
                    newY = svgHeight - target.offsetHeight;
                }

                target.style.left = newX + 'px';
                target.style.top = newY + 'px';
            },

            onend: function (event) {
                var target = event.target;
                var x = parseFloat(target.style.left) || 0;
                var y = parseFloat(target.style.top) || 0;

                console.log('Posición del asiento:', x, y);
            }
        });
</script>
<script>
    function guardarPosiciones() {
        var mesas = [];
        var seatElements = document.getElementsByClassName('seat');
        for (var i = 0; i < seatElements.length; i++) {
            var seat = seatElements[i];
            var id = seat.getAttribute('data-id');
            var x = parseFloat(seat.style.left) || 0;
            var y = parseFloat(seat.style.top) || 0;
            if (x !== 0 || y !== 0) {
                mesas.push({
                    id: id,
                    posicion_x: x,
                    posicion_y: y
                });
            }
        }

        // Enviar los datos al controlador mediante una petición AJAX
        var url = "{{ route('admin.festival.guardarPosiciones') }}";
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ mesas: mesas })
        })
            .then(response => response.json())
            .then(data => {
                alert('Las posiciones se guardaron correctamente.');
                var grid = document.querySelector('.grid');
                grid.style.display = 'none';
            })
            .catch(error => {
                alert('Error al guardar las posiciones. Por favor, inténtalo nuevamente.');
            });
    }
</script>
@notifyJs
@endpush
    

    
