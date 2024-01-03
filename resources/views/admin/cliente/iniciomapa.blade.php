@extends('adminlte::page')

@section('title', 'Restaurant')

@section('content_header')
<div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S</span><br>UBICACION DE LOS CLIENTES</h1>
</div>
@stop

@section('content')
<div class="form-group col-md-12 has-feedback">
            <div class="flex-center position-ref full-height">
                <div class="content">
                    <div id="mapa" style="width: 100%; height:600px">
                    </div>
                </div>
            </div>
        </div>
        <script>
            function initMap(){
                var center = {lat: -19.58341986454926, lng: -65.75655027805412};
                var lugares = [
                   /*  @foreach ($clientes as $victima)
                        [{{$victima->latidud}},{{$victima->longitud}}],    
                    @endforeach */
                ];
                var nombre = [
                    /* @foreach ($clientes as $victima)
                        [{{$victima->id}}],
                    @endforeach */
                ];

                var map = new google.maps.Map(document.getElementById('mapa'),{
                    zoom: 15,
                    center: center
                });

                const svgMarker = {
                    path: "M10.453 14.016l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
                    fillColor: "blue",
                    fillOpacity: 0.6,
                    strokeWeight: 0,
                    rotation: 0,
                    scale: 2,
                    anchor: new google.maps.Point(15, 30),
                };

                var square = {
                    path: 'M -2,-2 2,-2 2,2 -2,2 z', // 'M -2,0 0,-2 2,0 0,2 z',
                    strokeColor: '#F00',
                    fillColor: '#F00',
                    fillOpacity: 1,
                    scale: 5
                };
                for(i = 0; i < lugares.length; i++){
                    var location = new google.maps.LatLng(lugares[i][0],lugares[i][1])
                    var marker = new google.maps.Marker({
                        position: location,
                        title: 'VICTIMA',
                        label: `${i + 1}`,
                        draggable: false,
                        map: map,
                    });
                }
            }
            </script>
@stop

@section('content_top_nav_right')
<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-bell"></i>
        @if (count(auth()->user()->unreadNotifications))
        <span class="badge badge-warning">{{ count(auth()->user()->unreadNotifications) }}</span>
            
        @endif
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notifi">
    <span class="dropdown-header" >Notificaciones Sin Leer</span>
        @forelse (auth()->user()->unreadNotifications as $notification)
        <a href="{{ route('admin.pensionado.listpensionados') }}" class="dropdown-item">
        <i class="fa-solid fa-hand-pointer"></i> El Pensionado del cliente con <br><strong>{{ $notification->data['tipo'] }}</strong> se esta por terminar
        <span class="ml-3 float-right text-muted text-sm">{{ $notification->data['Fecha_Final'] }}</span>
        </a>
        @empty
            <span class="ml-3 float-right text-muted text-sm">Sin notificaciones por leer </span><br> 
        @endforelse
        <a href="{{ route('markAsRead') }}" class="dropdown-item dropdown-footer">Marcar Todos LEIDO</a>
        <div class="dropdown-divider"></div>
            <span class="dropdown-header">Notificaciones Leidas</span>
            @forelse (auth()->user()->readNotifications as $notification)
            <a href="{{ route('admin.pensionado.listpensionados') }}" class="dropdown-item">
            <i class="fa-solid fa-check-double"></i> pension {{ $notification->data['id'] }}
            <span class="ml-3 float-right text-muted text-sm">{{ $notification->data['id'], $notification->created_at->diffForHumans() }}</span>
            </a>
            @empty
            <span class="ml-3 float-right text-muted text-sm">Sin notificaciones leidas</span>
        @endforelse
    </div>
</li>
@endsection

@section('css')
    <link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@stop

@section('js')

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZfZFrJxVmMfX7uxTrFDkEF6WncPIAvUY&callback=initMap" ></script>
@stop


