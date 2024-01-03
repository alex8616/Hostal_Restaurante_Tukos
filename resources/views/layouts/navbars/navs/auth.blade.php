<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <a class="navbar-brand" href="#" style="color: black; font-weight: bolder;">{{auth()->user()->name}} - <span id="hora-actual"></span></a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
    <span class="material-icons">menu</span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="material-icons">dashboard</i>
            <p class="d-lg-none d-md-block">
              {{ __('Stats') }}
            </p>
          </a>
        </li>
        <li class="nav-item dropdown">
            @include('notificaciones')
        </li>
        <li class="nav-item dropdown">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Cerrar Session') }} <i class="fa-solid fa-power-off"></i></a>
        </li>
      </ul>
    </div>
    <x:notify-messages/>
  </div>
</nav>
<script>
    function mostrarHoraActual() {
        var fecha = new Date();
        var hora = fecha.getHours();
        var minutos = fecha.getMinutes();
        var segundos = fecha.getSeconds();

        hora = (hora < 10 ? "0" : "") + hora;
        minutos = (minutos < 10 ? "0" : "") + minutos;
        segundos = (segundos < 10 ? "0" : "") + segundos;

        var horaActual = hora + ":" + minutos + ":" + segundos;

        document.getElementById("hora-actual").innerHTML = horaActual;
    }

    setInterval(mostrarHoraActual, 1000);
</script>
