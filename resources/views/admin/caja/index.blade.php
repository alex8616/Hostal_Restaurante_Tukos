@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<br><br><br><hr>		
<div class="header">
  <span class="header-text" style="margin-left: 35px">C A J A S</span>
  <nav class="dropdownmenu">
    <ul>      
      <li>
        <a href="#">CAJAS</a>
      </li>
      <li><a data-toggle="modal" data-target="#modelIdBuscarCaja">BUSQUEDA PERSONALIZADA</a></li>
      <li>
        <a href="{{route('admin.caja.reportesfull')}}" target="_blank">REPORTE GENERAL</a>
      </li>
      <li>
        <a data-toggle="modal" data-target="#ModalMensual">REPORTE MENSUAL</a>
      </li>
      <li>
        <a href="#">CONFIGURACION</a>
        <ul id="submenu">
          <li><a href="{{route('admin.caja.codigo')}}" style="text-align: left">CODIGO</a></li>
          <li><a href="{{route('admin.caja.articulos')}}" style="text-align: left">ATRIBUTO</a></li>
        </ul>
      </li>
      <li><a data-toggle="modal" data-target="#modelId">AÑADIR</a></li>
    </ul>
  </nav>
</div>

<div class="modal fade" id="ModalMensual" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.caja.estadoResultado') }}">
      <div class="modal-body">
                <input type="date" class="form-control" id="InicioFecha" name="InicioFecha">
                <input type="date" class="form-control" id="FinalFecha" name="FinalFecha">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

<section class="wrapper" style="margin-top: -30px">
  <div class="container-fostrap">
      <div class="content">
          <div class="container">
              <div class="row">
                @foreach ($cajas as $caja)
                  <div class="col-xs-12 col-sm-4">
                      <div class="card card-block">
                      <form action="{{ route('caja.destroycaja', $caja) }}" method="POST" class="eliminar-form">
                          @method('DELETE')
                          @csrf
                      </form>
                        <h5 class="card-title mt-3 mb-3">
                          <center>CAJA DEL MES <strong>{{ \Carbon\Carbon::parse($caja->fecha_registro)->locale('es')->isoFormat(' MMMM \d\e\l Y') }}</strong>
                        </center></h5><hr>
                        <table style="padding: 2500px;">
                          <tr>
                            <td class="text-center" style="padding-top:10px;"><span class="material-icons" style="font-size:50px">H</span></td>
                            <td class="text-center" style="padding-top:10px;"><span class="material-icons" style="font-size:50px">R</span></td>
                            <td class="text-center" style="padding-top:10px;"><span class="material-icons" style="font-size:50px">T</span></td>
                            <td class="text-center" style="padding-top:10px;"><span class="material-icons" style="font-size:50px">D</span></td>
                          </tr>
                          <tr>
                            <td class="text-center" style="padding-bottom:10px;">{{$caja->caja_hostal_ingreso-$caja->caja_hostal_egreso}}</td>
                            <td class="text-center" style="padding-bottom:10px;">{{$caja->caja_restaurante_ingreso-$caja->caja_restaurante_egreso}}</td>
                            <td class="text-center" style="padding-bottom:10px;">{{$caja->caja_tarjetas_ingreso}}</td>
                            <td class="text-center" style="padding-bottom:10px;">{{$caja->caja_depositos_ingreso}}</td>
                          </tr>
                          <tr>                            
                            <td class="text-center" colspan="2" style="background:#E9E9E9; padding:10px;">EFECTIVO {{$caja->total_sum}}</td>
                            <td class="text-center" colspan="2" style="background:#E9E9E9; padding:10px;">TOTAL {{$caja->total}}</td>
                          </tr>
                        </table>
                        <a href="{{ route('admin.caja.registrar', $caja) }}"
                            class="btn btn-success">INGRESAR
                        </a>
                    </div>
                  </div>
                @endforeach
              </div>
              <div>
              </div>
          </div>
      </div>
  </div>
</section>
@include('admin.caja.BuscarCaja')
@include('admin.caja.CrearCaja')
@endsection
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/bottonfooder.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 
<style>
  /* Estilos para pantallas más pequeñas table FOOT */
  @media screen and (max-width: 480px) {
    #my-tfoot td {
      display: block;
      width: 100%;
      text-align: center;
    }

    #my-tfoot td h4 {
      margin: 10px 0;
    }
  }
  #categoria td:nth-child(1) {
    text-align: center;
  }

  /*table color hover mouse*/
   .menu-container {
      margin-bottom: 20px;
  }

  .menu-container a {
      font-size: 18px;
      color: #52abff;      
  }

  .menu-container a.active {
      text-decoration: none;
      border: solid 1px;
      font-weight: bold; 
  }
  
  .dt-responsive tr:hover {
      background-color: #87CEFA;
      cursor: pointer;
  }

  /*BUTONS STYLO */
  .wrapper .icon {
      position: relative;
      background: #ffffff;
      border-radius: 50%;
      margin: 10px;
      width: 40px;
      height: 40px;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
      cursor: pointer;
      transition: all 0.2s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .wrapper .tooltip {
      position: absolute;
      top: 0;
      font-size: 5px;
      background: #ffffff;
      color: #ffffff;
      padding: 5px 8px;
      border-radius: 5px;
      box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
      opacity: 0;
      pointer-events: none;
      transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .wrapper .tooltip::before {
      position: absolute;
      content: "";
      height: 8px;
      width: 8px;
      background: #ffffff;
      bottom: -3px;
      left: 50%;
      transform: translate(-50%) rotate(45deg);
      transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .wrapper .icon:hover .tooltip {
      top: -45px;
      opacity: 1;
      visibility: visible;
      pointer-events: auto;
    }

    .wrapper .icon:hover span,
    .wrapper .icon:hover .tooltip {
      text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.1);
    }

    .wrapper .facebook:hover,
    .wrapper .facebook:hover .tooltip,
    .wrapper .facebook:hover .tooltip::before {
      background: #1877F2;
      color: #ffffff;
    }

    .wrapper .youtube:hover,
    .wrapper .youtube:hover .tooltip,
    .wrapper .youtube:hover .tooltip::before {
      background: #CD201F;
      color: #ffffff;
    }

    .wrapper .spetie:hover,
    .wrapper .spetie:hover .tooltip,
    .wrapper .spetie:hover .tooltip::before {
      background: #f4a300;
      color: #ffffff;
    }
  /*FIN BUTONS STYLO */
  /* Reset styles for lists and list items */
  .header,
  .dropdownmenu ul,
  .dropdownmenu li {
    margin: 0;
    padding: 0;
    list-style: none;
  }

  /* Header styles */
  .header {
    display: flex; /* Use flexbox */
    justify-content: space-between; /* Distribute items horizontally */
    align-items: center; /* Center items vertically */
    background: #FFFFFF; /* Set background color for the header (white) */
    padding: 10px; /* Add some padding around the header text */
  }

  .header-text {
    color: #333333; /* Set the text color for the header (dark gray) */
    font-weight: bold;
  }

  /* Main menu styles */
  .dropdownmenu ul {
    background: #FFFFFF; /* Set background color for the menu (white) */
    width: 100%;
  }

  .dropdownmenu li {
    float: left;
    position: relative;
  }

  .dropdownmenu a {
    background: #FFFFFF; /* Set background color for the menu items (white) */
    color: #333333; /* Set the text color for the menu items (dark gray) */
    display: block;
    font: bold 14px/40px sans-serif; /* Slightly larger font size */
    padding: 0 20px; /* Increase horizontal padding */
    text-align: center;
    text-decoration: none;
    transition: background 0.25s ease, color 0.25s ease; /* Add color transition */
    
    /* Add border styles */
    border-left: 1px solid #CCCCCC; /* Left border */
    border-right: 1px solid #CCCCCC; /* Right border */
  }

  /* Hover and Click styles for menu items */
  .dropdownmenu li:hover a,
  .dropdownmenu li a:focus {
    background: #E6E6E6; /* Lighten background on hover and click */
    color: #007bff; /* Set text color to blue on hover and click */
  }

  /* Submenu styles */
  #submenu {
    opacity: 0;
    position: absolute;
    top: 50px; /* Adjusted top position to make it look better */
    visibility: hidden;
    z-index: 1;
    background: #FFFFFF; /* Set background color for the submenu (white) */
    width: 200px; /* Adjusted width */
    border-radius: 4px; /* Rounded corners for a modern look */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5); /* Add a subtle shadow */
  }

  li:hover #submenu {
    opacity: 1;
    top: 40px; /* Slightly adjust top position on hover */
    visibility: visible;
  }

  #submenu li {
    float: none;
    width: 100%;
  }

  #submenu a {
    background-color: #FFFFFF; /* Set background color for submenu items (white) */
  }

  #submenu a:hover {
    background: #E6E6E6; /* Lighten background on hover */
    color: #007bff; /* Set text color to blue on hover */
  }

  /* Responsive styles */
  @media screen and (max-width: 480px) {
    .header {
      flex-direction: column; /* Change to vertical layout */
      align-items: flex-start; /* Align items to the left */
    }

    .header-text {
      margin-bottom: 10px; /* Add margin below the header text */
    }

    .dropdownmenu {
      margin-top: 0; /* Remove margin between the header text and the menu */
    }

    .dropdownmenu ul {
      display: flex;
      flex-wrap: wrap;      
    }

    .dropdownmenu li {
      width: 100%;        
    }
  }

</style>
@notifyCss

@push('js')
{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.8/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.8/js/responsive.bootstrap4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>

    <script>
        $('.eliminar-form').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Quieres eliminar?',
                text: "El registro se eliminara definitivamente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>
    @if (session('delete') == 'ok')
        <script>
            Swal.fire(
                'Eliminar!',
                'Se Eliminó el registro.',
                'success'
            )
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $('#categoria').DataTable({
                responsive: true,
                autoWidth: false,
                "bSort" : false,
                "language": {
                    "lengthMenu": "Mostrar registro por página",
                    "zeroRecords": "No se encontro registro",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "search": "Buscar",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente"
                    },
                    "infoEmpty": "No hay registros",
                    "infoFiltered": "(Filtrado de _MAX_ registros totales)"
                },
                "lengthMenu": [
                    [4, 10, 50, -1],
                    [5, 10, 50, "All"]
                ]

            });
        });
    </script>
    @notifyJs
@endpush