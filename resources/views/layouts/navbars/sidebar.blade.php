<div class="sidebar" data-color="" data-background-color="black" data-image="{{ asset('img/sidebar-4.jpg') }}">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="{{route('admin.empresa.index')}}" class="simple-text logo-normal">
      {{ __('TUKO`S LA CASA REAL') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
    @can('roles.index')
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('calendar.index')}}">
          <i class="material-icons">event</i>
            <p>{{ __('Eventos - Calendario') }}</p>
        </a>
      </li>
      @endcan
      @can('roles.index')
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('admin.bar.index')}}">
          <i class="material-icons">event</i>
            <p>{{ __('BAR-TUKOS') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('admin.festival.index')}}">
          <i class="material-icons">event</i>
            <p>{{ __('FESTIVAL-SEMANAL') }}</p>
        </a>
      </li>
      @endcan
      @can('roles.index')
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('hostal.producto.index')}}">
          <i class="material-icons">conveyor_belt</i>
            <p>{{ __('KARDEX') }}</p>
        </a>
      </li>
      @endcan
      @if(auth()->user()->hasRole('limpieza'))

      @else      
        <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
          <a class="nav-link" href="{{route('hostal.habitacion.index')}}">
            <i class="material-icons">event</i>
              <p>{{ __('HOSTAL - FULL') }}</p>
          </a>
        </li>
      @endif
      @can('roles.index')
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('admin.cliente.index')}}">
          <i class="material-icons">people_alt</i>
            <p>{{ __('CLIENTES') }}</p>
        </a>
      </li>
      @endcan
      @can('roles.index')
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('admin.pensionado.index')}}">
          <i class="material-icons">people_alt</i>
            <p>{{ __('PENSIONADOS') }}</p>
        </a>
      </li>
      @endcan
      @can('roles.index')
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('admin.categoria.index')}}">
          <i class="material-icons">category</i>
            <p>{{ __('CATEGORIAS') }}</p>
        </a>
      </li>
      @endcan
      @can('roles.index')
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('admin.plato.index')}}">
          <i class="material-icons">restaurant_menu</i>
            <p>{{ __('PLATOS') }}</p>
        </a>
      </li>
      @endcan
      @can('roles.index')
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('admin.menu.index')}}">
          <i class="material-icons">restaurant_menu</i>
            <p>{{ __('MENUS') }}</p>
        </a>
      </li>
      @endcan
      @can('roles.index')
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('admin.caja.index')}}">
          <i class="material-icons">real_estate_agent</i>
            <p>{{ __('CAJAS') }}</p>
        </a>
      </li>
      @endcan
      @if(auth()->user()->hasRole('limpieza'))
        <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
          <a class="nav-link" href="{{route('hostal.controlcamareria.index')}}">
            <i class="material-icons">meeting_room</i>
              <p>{{ __('CONTROL CAMARERIA') }}</p>
          </a>
        </li>
      @else
        <li class="nav-item{{ $activePage == 'icons' ? ' active' : '' }}">
          <a class="nav-link" href="{{route('admin.comanda.index')}}">
            <i class="material-icons">bubble_chart</i>
            <p>{{ __('COMANDAS - PEDIDO') }}</p>
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'icons' ? ' active' : '' }}">
          <a class="nav-link" href="{{route('admin.comandamesa.index')}}">
            <i class="material-icons">bubble_chart</i>
            <p>{{ __('COMANDAS -  MESA') }}</p>
          </a>
        </li>
      @endif
      @can('roles.index')
      <li class="nav-item{{ $activePage == 'icons' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('admin.comanda.facturas')}}">
          <i class="material-icons">bubble_chart</i>
          <p>{{ __('FACTURAS') }}</p>
        </a>
      </li>
      @endcan
      @can('roles.index')
      <li class="nav-item{{ $activePage == 'map' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('admin.inventario_cocina.index')}}">
          <i class="material-icons">location_ons</i>
            <p>{{ __('INVENTARIO COCINA') }}</p>
        </a>
      </li>
      @endcan
      @can('roles.index')
      <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
        <a class="nav-link" href="{{route('admin.ambiente.index')}}">
          <i class="material-icons">notifications</i>
          <p>{{ __('RESERVACIONES') }}</p>
        </a>
      </li>
      @endcan
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
          <p>{{ __('USUARIOS Y ROLES') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExample">
          <ul class="nav">
          @can('roles.index')
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('admin.users.index')}}">
                <span class="sidebar-mini"> NEW </span>
                <span class="sidebar-normal">{{ __('USUARIOS') }} </span>
              </a>
            </li>
          @endcan
          @can('roles.index')
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('admin.roles.index')}}">
                <span class="sidebar-mini"> ROL </span>
                <span class="sidebar-normal">{{ __('ROLES') }} </span>
              </a>
            </li>
          @endcan
          </ul>
        </div>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/ex2.png"></i>
          <p>{{ __('REPORTES') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExample">
          <ul class="nav">             
          @can('roles.index')
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('comanda.reporteFull')}}">
                <span class="sidebar-mini"> PE </span>
                <span class="sidebar-normal">{{ __('REPORTES') }} </span>
              </a>
            </li>
          @endcan
          @can('roles.index')
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('admin.caja.reportesfull')}}">
                <span class="sidebar-mini"> ES </span>
                <span class="sidebar-normal"> {{ __('REPORTES CAJAS') }} </span>
              </a>
            </li>
          @endcan
          @can('roles.index')
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('home-dashboard')}}">
                <span class="sidebar-mini"> ES </span>
                <span class="sidebar-normal"> {{ __('ESTADISTICAS') }} </span>
              </a>
            </li>
          @endcan
          <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
            <i><img style="width:25px" src="{{ asset('material') }}/img/ex2.png"></i>
            <p>{{ __('PLANILLAS') }}
              <b class="caret"></b>
            </p>
          </a>
          @can('roles.index')
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{route('admin.personal.index')}}">
                <span class="sidebar-mini"> PL </span>
                <span class="sidebar-normal"> {{ __('Imprimir') }} </span>
              </a>
            </li>
          @endcan
          </ul>
        </div>
      </li>
    </ul>
  </div>
</div>
