<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mapa de Asientos</title>
    <style>
        body {
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
        }

        .seat {
            position: absolute;
            width: 35px;
            height: 20px;
            background-color: gray;
            margin: 5px;
            border-radius: 15%;
            cursor: pointer;
            padding: 10px;
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
    </style>
</head>
<body>
    <svg width="1600" height="500" xmlns="http://www.w3.org/2000/svg">
        <rect width="10" height="1500" x="0" fill="#008d46"/>
        <rect width="1600" height="10" x="0" fill="#008d46"/>
        <rect width="10" height="1500" x="1590" y="0" fill="#008d46"/>
        
        <rect width="300" height="10" x="0" y="490" fill="#008d46"/>
        /*ventanas*/
        <rect width="100" height="0.1" x="300" y="490" fill="#008d46"/>
        <rect width="100" height="0.1" x="300" y="495" fill="#008d46"/>
        <rect width="100" height="0.2" x="300" y="500" fill="#008d46"/>

        <rect width="100" height="10" x="400" y="490" fill="#008d46"/>
        
        <rect width="150" height="10" x="600" y="490" fill="#008d46"/>
        <rect width="10" height="350" x="650" y="0" fill="#008d46"/>
        /*ventanas*/
        <rect width="80" height="0.1" x="750" y="490" fill="#008d46"/>
        <rect width="80" height="0.1" x="750" y="495" fill="#008d46"/>
        <rect width="80" height="0.2" x="750" y="500" fill="#008d46"/>        
        
        <rect width="80" height="10" x="830" y="490" fill="#008d46"/>
        /*ventanas*/
        <rect width="80" height="0.1" x="910" y="490" fill="#008d46"/>
        <rect width="80" height="0.1" x="910" y="495" fill="#008d46"/>
        <rect width="80" height="0.2" x="910" y="500" fill="#008d46"/>

        <rect width="80" height="10" x="990" y="490" fill="#008d46"/>
        /*ventanas*/
        <rect width="80" height="0.1" x="1070" y="490" fill="#008d46"/>
        <rect width="80" height="0.1" x="1070" y="495" fill="#008d46"/>
        <rect width="80" height="0.2" x="1070" y="500" fill="#008d46"/>

        <rect width="80" height="10" x="1150" y="490" fill="#008d46"/>
        /*ventanas*/
        <rect width="80" height="0.1" x="1230" y="490" fill="#008d46"/>
        <rect width="80" height="0.1" x="1230" y="495" fill="#008d46"/>
        <rect width="80" height="0.2" x="1230" y="500" fill="#008d46"/>

        <rect width="150" height="10" x="1310" y="490" fill="#008d46"/>
        
        <rect width="20" height="10" x="1570" y="490" fill="#008d46"/>

        <rect width="150" height="0.1" x="1460" y="499" fill="#008d46"/>
        <rect width="1" height="100" x="1460" y="400" fill="#008d46"/>

        <path d="M1460,400 Q1520,400 1520,500" fill="none" stroke="black"/>
        <path d="M1520,500 Q1520,400 1570,400" fill="none" stroke="black"/>

        <rect width="1" height="100" x="500" y="400" fill="#008d46"/>
        <rect width="1" height="100" x="600" y="400" fill="#008d46"/>

        <path d="M500,400 Q550,400 550,500" fill="none" stroke="black"/>
        <path d="M550,500 Q550,400 600,400" fill="none" stroke="black"/>
        <rect width="100" height="0.1" x="500" y="499" fill="#008d46"/>

        <rect width="1" height="100" x="1570" y="400" fill="#008d46"/>
        /*habitacion adentro */
        <rect width="10" height="300" x="1300" fill="#008d46"/>
        <rect width="300" height="10" x="1360" y="290" fill="#008d46"/>
        <rect width="300" height="0.1" x="1300" y="300" fill="#008d46"/>
        <path d="M1310,200 Q1360,200 1360,300" fill="none" stroke="black"/>

        
    </svg>
    <div class="seat-map">
        @foreach($mesas as $mesa)            
            <div 
                class="seat available" 
                data-id="{{ $mesa->id }}" 
                style="left: {{ $mesa->posicion_x }}px; top: {{ $mesa->posicion_y }}px;">
                # {{ $mesa->id }}
            </div>
        @endforeach
    </div>
    <button onclick="habilitarEdicion()">Editar</button>
    <button onclick="guardarPosiciones()">Guardar</button>
    <script src="https://cdn.jsdelivr.net/npm/interactjs@1.10.11"></script>
    <script>
        var edicionHabilitada = false;

        function habilitarEdicion() {
            edicionHabilitada = true;
        }
    </script>

    <script>
        interact('.seat')
            .draggable({
                onstart: function(event) {
                    if (!edicionHabilitada) {
                        event.preventDefault();
                        return;
                    }
                },
                onmove: function(event) {
                    if (!edicionHabilitada) {
                        event.preventDefault();
                        return;
                    }

                    var target = event.target;
                    var x = parseFloat(target.style.left) || 0;
                    var y = parseFloat(target.style.top) || 0;
                    var dx = event.dx;
                    var dy = event.dy;

                    target.style.left = x + dx + 'px';
                    target.style.top = y + dy + 'px';
                },
                onend: function(event) {
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
            console.log(mesas);
        })
        .catch(error => {
            console.error(error);
        });
    }
</script>
