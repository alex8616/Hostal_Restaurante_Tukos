<div class="sidebar" data-color="red" data-background-color="red" data-image="{{ asset('img/sidebar-2.jpg') }}">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <center>
      <a href="{{route('admin.empresa.index')}}" class="simple-text logo-normal">
        {{ __('TUKO`S LA CASA REAL') }}
      </a>
    </center>
  </div>
  @can('roles.index')
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('admin.comanda.index')}}">
          <i class="material-icons">storefront</i>
            <p>{{ __('RESTAURANTE - FULL') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('hostal.ClienteHostal.index')}}">
          <i class="material-icons">people_alt</i>
            <p>{{ __('CLIENTES') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('hostal.habitacion.index')}}">
          <i class="material-icons">bedroom_child</i>
            <p>{{ __('HABITACIONES') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('hostal.habitacion.fullcalendar')}}">
          <i class="material-icons">book_online</i>
            <p>{{ __('RESERVAS') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('hostal.habitacion.ServiciosIncluidos')}}">
          <i class="material-icons">room_service</i>
            <p>{{ __('SERVICIOS DIAROS') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('hostal.habitacion.ReservasLista')}}">
          <i class="material-icons">book_online</i>
            <p>{{ __('LISTA DE RESERVAS') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}" hidden>
        <a class="nav-link" href="{{route('hostal.habitacion.HospedajesLista')}}">
          <i class="material-icons">meeting_room</i>
            <p>{{ __('LISTA DE HOSPEDAJES') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('hostal.habitacion.CamaraHotelera')}}">
          <i class="material-icons">meeting_room</i>
            <p>{{ __('CAMARA HOTELERA') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('hostal.problemas.listproblem')}}">
          <i class="material-icons">meeting_room</i>
            <p>{{ __('PROBLEMAS') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('hostal.controlcamareria.index')}}">
          <i class="material-icons">meeting_room</i>
            <p>{{ __('CONTROL CAMARERIA') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('hostal.reportesHostal.index')}}">
          <i class="material-icons">query_stats</i>
            <p>{{ __('REPORTES HOTEL') }}</p>
        </a>
      </li>      
    </ul>
  </div>
  @endcan
</div>
