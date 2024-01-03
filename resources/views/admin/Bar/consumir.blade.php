@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<br><br><hr>
<div class="row" style="margin: 20px">
<div class="col-md-6">
    <table class="table">
        <tr>
            <th>id</th>
            <th>PRODUCTO</th>
            <th>CANT</th>
            <th>PRECIO</th>
            <th>TOTAL</th>
        </tr>
        @foreach($ultimoRegistro->detallecomandamesas as $detalle)
            <tr>
                <th>{{ $detalle->id }}</th>
                @foreach ($allplatos as $plato)
                    @if($plato->id == $detalle->plato_id)
                        <th>{{ $plato->Nombre_plato }}</th>
                    @endif
                @endforeach
                <th>{{ $detalle->cantidad }}</th>
                <th>{{ $detalle->precio_venta  }}</th>
                <th>{{ $detalle->cantidad * $detalle->precio_venta }}</th>
            </tr>
        @endforeach
        <tr style="background: blue;">
            <th colspan="4" style="color:white"> TOTAL DEUDA A PAGARSE: </th>
            <th style="color:white; font-size: 18px">{{ $totalsum }}</th>
        </tr>
    </table>
  </div>
  <div class="col-md-6">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelId" style="width: 100%;">
        Add Menu
    </button>
    <table id="tabla-ventas" class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aquí se agregarán las filas de ventas -->
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4">Total a pagar:</th>
                <th id="total-pagar">0</th>
            </tr>
        </tfoot>
    </table>
    <button id="registrar-btn" class="btn btn-success" style="width: 100%">Registrar</button>
  </div>
</div>


<form action="{{ route('bar.concluirventa') }}" method="get">
    <input type="text" value="{{$id}}" id="input-id" name="idmesa" hidden>
    <input type="text" value="{{$IdComanda}}" id="input-IdComanda" name="idcomanda" hidden>
    @csrf
    <center>
        <button type="submit" class="btn btn-danger" style="width: 98%;" id="concluir-venta-btn">CONCLUIR VENTA</button>
    </center>
</form>
<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#comida-rapida">
                            <span class="tab-text" style="color: black; font-size: 15px">Comida Rápida</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#bebidas">
                            <span class="tab-text" style="color: black; font-size: 15px">Bebidas</span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <!-- Comida Rápida -->
                    <div class="tab-pane fade show active" id="comida-rapida">
                        <input type="text" class="form-control buscar-input" placeholder="Buscar...">
                        <div class="platos-container">
                            @foreach ($platos as $plato)
                                <div class="plato-card">
                                    <h3>{{ $plato->Nombre_plato }}</h3>
                                    <p>Precio: <span class="precio">{{ $plato->Precio_plato }}</span></p>
                                    <div class="cantidad-container">
                                        <button class="menos-btn">-</button>
                                        <input type="number" class="cantidad" value="1">
                                        <button class="mas-btn">+</button>
                                    </div>
                                    <button class="agregar-btn" data-id="{{ $plato->id }}">Agregar</button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Bebidas -->
                    <div class="tab-pane fade" id="bebidas">
                        <input type="text" class="form-control buscar-input" placeholder="Buscar...">
                        <div class="bebidas-container">
                            @foreach ($bebidas as $bebida)
                                <div class="bebida-card">
                                    <h3>{{ $bebida->Nombre_plato }}</h3>
                                    <p>Precio: <span class="precio">{{ $bebida->Precio_plato }}</span></p>
                                    <div class="cantidad-container">
                                        <button class="menos-btn">-</button>
                                        <input type="number" class="cantidad" value="1">
                                        <button class="mas-btn">+</button>
                                    </div>
                                    <button class="agregar-btn" data-id="{{ $bebida->id }}">Agregar</button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<!-- CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    .modal-dialog.modal-lg.modal-dialog-centered {
        width: 50%; /* Cambiar el valor para ajustar el tamaño deseado */
        max-width: 100%;
        margin: auto;
    }
    /* Estilos para los botones de incremento y decremento en la sección de bebidas */
    .bebida-card .cantidad-container {
        display: flex;
        align-items: center;
    }

    .bebida-card .cantidad-container input {
        width: 40px;
        text-align: center;
    }

    .bebida-card .cantidad-container button {
        width: 25px;
        height: 25px;
        background-color: #f1f1f1;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }

    .bebida-card .cantidad-container button:hover {
        background-color: #e0e0e0;
    }

    .bebida-card .cantidad-container button:active {
        background-color: #d3d3d3;
    }
    /* Estilos para los botones de incremento y decremento */
    .cantidad-container {
    display: flex;
    align-items: center;
    }

    .cantidad-container input {
    width: 40px;
    text-align: center;
    }

    .cantidad-container button {
    width: 25px;
    height: 25px;
    background-color: #f1f1f1;
    border: none;
    cursor: pointer;
    font-size: 14px;
    }

    .cantidad-container button:hover {
    background-color: #e0e0e0;
    }

    .cantidad-container button:active {
    background-color: #d3d3d3;
    }


    .nav-link.active .tab-text {
        font-weight: bold; /* Estilo de fuente para pestaña activa */
        text-decoration: underline; /* Subrayado para pestaña activa */
    }

    .platos-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-gap: 10px;
    }

    .plato-card {
    background-color: #f5f5f5;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .plato-card h3 {
    font-size: 18px;
    margin-bottom: 10px;
    }

    .plato-card p {
    font-size: 14px;
    margin-bottom: 5px;
    }

    /* Media query para pantallas de celular */
    @media (max-width: 767px) {
    .platos-container {
        grid-template-columns: 1fr;
    }
    }

    .bebidas-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-gap: 10px;
    }

    .bebida-card {
    background-color: #f5f5f5;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .bebida-card h3 {
    font-size: 18px;
    margin-bottom: 10px;
    }

    .bebida-card p {
    font-size: 14px;
    margin-bottom: 5px;
    }

    /* Media query para pantallas de celular */
    @media (max-width: 767px) {
    .bebidas-container {
        grid-template-columns: 1fr;
    }
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    // Evento click del botón "CONCLUIR VENTA"
    $('#concluir-venta-btn').click(function(event) {
        event.preventDefault();

        // Mostrar SweetAlert de confirmación
        Swal.fire({
            title: '¿Deseas concluir la venta?',
            showCancelButton: true,
            confirmButtonText: 'Sí',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                // Enviar el formulario
                $('form').submit();
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Controlador de eventos para el campo de búsqueda
        $('.buscar-input').keyup(function() {
            var textoBusqueda = $(this).val().toLowerCase(); // Obtener el texto de búsqueda y convertirlo a minúsculas

            // Filtrar los elementos de la lista según el texto de búsqueda
            $('.plato-card:visible, .bebida-card:visible').each(function() {
                var nombrePlato = $(this).find('h3').text().toLowerCase(); // Obtener el nombre del plato y convertirlo a minúsculas

                // Mostrar u ocultar el elemento según si coincide con el texto de búsqueda
                if (nombrePlato.includes(textoBusqueda)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Evento click del botón "más"
        $(document).on('click', '.mas-btn', function() {
            var input = $(this).siblings('.cantidad');
            var cantidad = parseInt(input.val());
            input.val(cantidad + 1);
        });

        // Evento click del botón "menos"
        $(document).on('click', '.menos-btn', function() {
            var input = $(this).siblings('.cantidad');
            var cantidad = parseInt(input.val());
            if (cantidad > 1) {
                input.val(cantidad - 1);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
    verificarTabla();
  // Evento click del botón "Agregar"
  $('.agregar-btn').click(function() {
    var card = $(this).closest('.plato-card, .bebida-card');
    var id = $(this).data('id');
    var nombre = card.find('h3').text();
    var precio = parseFloat(card.find('.precio').text());
    var cantidad = parseInt(card.find('.cantidad').val());
    var total = precio * cantidad;

    var fila = '<tr>' +
      '<td>' + id + '</td>' +
      '<td>' + nombre + '</td>' +
      '<td>' + cantidad + '</td>' +
      '<td>' + precio + '</td>' +
      '<td>' + total + '</td>' +
      '<td><button class="quitar-btn">Quitar</button></td>' +
      '</tr>';

    // Verificar si el plato ya existe en la tabla
    var platoExistente = false;
    $('#tabla-ventas tbody tr').each(function() {
      var platoId = parseInt($(this).find('td:eq(0)').text());
      if (platoId === id) {
        platoExistente = true;
        var platoCantidad = parseInt($(this).find('td:eq(2)').text());
        var platoTotal = parseFloat($(this).find('td:eq(4)').text());

        // Incrementar la cantidad y actualizar el total
        platoCantidad += cantidad;
        platoTotal = platoCantidad * precio;

        $(this).find('td:eq(2)').text(platoCantidad);
        $(this).find('td:eq(4)').text(platoTotal);
        return false; // Salir del bucle each
      }
    });

    // Si el plato no existe en la tabla, agregar una nueva fila
    if (!platoExistente) {
      $('#tabla-ventas tbody').append(fila);
    }

    // Calcular y mostrar el total a pagar
    var totalPagar = 0;
    $('#tabla-ventas tbody tr').each(function() {
      var filaPrecio = parseFloat($(this).find('td:eq(4)').text());
      totalPagar += filaPrecio;
    });

    $('#total-pagar').text(totalPagar);
    toastr.options = {
    positionClass: 'toast-top-right', // Posición del mensaje toast
    closeButton: true, // Mostrar botón de cierre
    progressBar: true // Mostrar barra de progreso
    };
    toastr.success('Se Añadio a la lista', '¡Éxito!');
    $('#modelId').modal('hide');
    verificarTabla();
  });

  // Evento click del botón "Quitar"
  $(document).on('click', '.quitar-btn', function() {
    $(this).closest('tr').remove();

    // Calcular y mostrar el total a pagar
    var totalPagar = 0;
    $('#tabla-ventas tbody tr').each(function() {
      var filaPrecio = parseFloat($(this).find('td:eq(4)').text());
      totalPagar += filaPrecio;
    });

    $('#total-pagar').text(totalPagar);
    verificarTabla();
  });
  
  // Verificar si la tabla tiene datos y habilitar/deshabilitar el botón "Registrar"
  function verificarTabla() {
    var tabla = $('#tabla-ventas');
    var totalFilas = tabla.find('tbody tr').length;

    if (totalFilas > 0) {
      $('#registrar-btn').prop('disabled', false);
    } else {
      $('#registrar-btn').prop('disabled', true);
    }
  }

  // Evento click del botón "Registrar"
$('#registrar-btn').click(function() {
  // Mostrar SweetAlert de confirmación
  Swal.fire({
    title: '¿Deseas registrar los datos?',
    showCancelButton: true,
    confirmButtonText: 'Sí',
    cancelButtonText: 'No'
  }).then((result) => {
    if (result.isConfirmed) {
      var ventas = [];
      var id = $('#input-id').val();
      var IdComanda = $('#input-IdComanda').val();

      $('#tabla-ventas tbody tr').each(function() {
        var idPlato = parseInt($(this).find('td:eq(0)').text());
        var nombre = $(this).find('td:eq(1)').text();
        var cantidad = parseInt($(this).find('td:eq(2)').text());
        var precio = parseFloat($(this).find('td:eq(3)').text());
        var total = parseFloat($(this).find('td:eq(4)').text());

        ventas.push({
          id: idPlato,
          nombre: nombre,
          cantidad: cantidad,
          precio: precio,
          total: total
        });
      });

      // Enviar los datos al servidor mediante AJAX
      var datos = {
        id: id,
        IdComanda: IdComanda,
        ventas: ventas
      };
      var csrfToken = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
        url: '/registrar-ventasbar',
        method: 'POST',
        data: JSON.stringify(datos),
        contentType: 'application/json',
        headers: {
          'X-CSRF-TOKEN': csrfToken
        },
        success: function(response) {
          // Manejar la respuesta del servidor
          console.log(response);
          Swal.fire('Datos registrados', '', 'success').then(() => {
            window.location.reload();
          });
        },
        error: function(xhr, status, error) {
          // Manejar el error en la petición AJAX
          console.log(error);
          Swal.fire('Error', 'Ocurrió un error al registrar los datos', 'error');
        }
      });
    }
  });
});
});

</script>
@notifyJs
@endpush
    

    
