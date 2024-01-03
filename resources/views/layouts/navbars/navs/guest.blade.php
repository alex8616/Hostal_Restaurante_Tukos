<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
  <div class="container">
    <div class="navbar-wrapper">
      <a class="navbar-brand" href="{{ route('login') }}">LOGIN - TUKO'S LA CASA REAL RESTAURANT</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="material-icons">menu</span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="material-icons">dashboard</i> {{ __('Dashboard') }}
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'register' ? ' active' : '' }}">
          <a onclick="mostrar()"class="nav-link">
            <script>
                function mostrar(){
                    swal.fire('No Tienes Acceso Para Registrar Inicia Sesion');
                }
            </script>
            <i class="material-icons">person_add</i> {{ __('Register') }}
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'login' ? ' active' : '' }}">
          <a href="{{ route('login') }}" class="nav-link">
            <i class="material-icons">fingerprint</i> {{ __('Login') }}
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->