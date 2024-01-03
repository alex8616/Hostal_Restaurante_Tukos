@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
@section('content')
<br><br><hr>
<div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning">
                <div class="row">
                    <div class="col-lg-9 col-md-12">
                        <p style="color:white; font-size:20px; font-weight: bold;">C O M A N D A S</p>
                    </div>
                    <div class="col-lg-3 col-md-12">
                    <div class="d-flex flex-wrap">
                        <button type="button" class="btn btn-danger mb-2 mr-2" id="openModalBtn" data-toggle="modal" data-target="#selectedIdsModal" disabled>
                        Deliveri
                        </button>
                        <a href="{{ route('admin.comanda.create') }}" class="btn btn-secondary mb-2 mr-2">Añadir</a>
                        <a href="{{ route('admin.comanda.listapedidos') }}" class="btn btn-secondary mb-2">Pedidos</a>
                    </div>
                    </div>
                </div>
            </div>
          <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered shadow-lg mt-4 dt-responsive" id="categoria">
                    <colgroup>
                        <col class="table-col1">
                        <col class="table-col2">
                        <col class="table-col3">
                        <col class="table-col4">
                        <col class="table-col5">
                        <col class="table-col6">
                        <col class="table-col7">
                    </colgroup>
                    <thead class="table-head" title="Click to sort">
                        <tr class="table-row">
                            <th class="col-head" scope="col"><center></center></th>
                            <th class="col-head" scope="col"><center>ID</center></th>
                            <th class="col-head" scope="col"><center>FECHA DE REGISTRO</center></th>
                            <th class="col-head" scope="col"><center>CLIENTE</center></th>
                            <th class="col-head" scope="col"><center>TOTAL</center></th>
                            <th class="col-head" scope="col"><center>ESTADO</center></th>
                            <th class="col-head" scope="col"><center>ACCION</center></th>                            
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        @php
                        $i=1;
                        @endphp
                        @foreach ($comandas as $comanda)
                        <tr class="table-row">
                            <td class="cell" style="font-size: 14px; text-align: center;">
                                @if($comanda->isDelivered == true)
                                    <i class="fa-solid fa-check"></i>
                                @elseif($comanda->estado == 'TRUE')
                                    <i class="fa-solid fa-check-double"></i>
                                @else
                                    <input type="checkbox" name="selectedComandas[]" value="{{ $comanda->id }}" /> 
                                @endif
                            </td>
                            <td class="cell" style="font-size: 14px;"><center>{{ $comanda->id }}</center></td>
                            <td class="cell" style="font-size: 14px;">{{ \Carbon\Carbon::parse($comanda->fecha_venta)->format('d-m-Y H:i a') }}</td>
                            @if ($comanda->cliente_id != 0)
                            <td class="cell" style="font-size: 14px;">
                                {{ $comanda->cliente->Nombre_cliente }}
                                {{ $comanda->cliente->Apellidop_cliente }}
                                {{ $comanda->cliente->Apellidom_cliente }}
                            </td>
                            @else
                            <td class="cell" style="font-size: 14px;">
                                @foreach ($tipoclientes as $tipocliente)
                                @if($comanda->tipo_cliente_id == $tipocliente->id)
                                {{ $tipocliente->Nombre_tipoclientes }} <br>
                                @endif
                                @endforeach
                            </td>
                            @endif
                            <td class="cell" style="font-size: 14px;"><center>Bs. {{ number_format($comanda->total, 2) }}</center></td>
                            @if ($comanda->estado == 'FALSE' && $comanda->isDelivered == 'true')
                            <td class="cell" style="font-size: 14px;">
                                <center>
                                <a href="#" style="color: black;">
                                    <span style="background-color: #068FFF; color:white; padding: 5px">Deliveri</span>
                                </a>
                                </center>
                            </td>
                            @elseif($comanda->estado == 'FALSE')
                            <td class="cell" style="font-size: 14px;">
                                <center>
                                <a href="{{ route('cambio.estado.comanda', $comanda) }}" style="color: black;" onclick="mostrarAlerta('{{ route('cambio.estado.comanda', $comanda) }}')">
                                    <span style="background-color: #FF5454; color:white; padding: 5px">Pendiente</span>
                                </a>
                                </center>
                            </td>
                            @else
                            <td class="cell" style="font-size: 14px;">
                                <center><span style="background-color: #ABFF32; padding: 5px">Confirmado</span></center>
                            </td>
                            @endif
                            <td class="cell" style="font-size: 14px;">
                                <center>
                                    <form action="{{ route('admin.comanda.destroy', $comanda) }}" method="POST" class="eliminar-form">
                                        @method('DELETE')
                                        @csrf
                                        <ul class="wrapper" style="height: 50px; display: inline-flex;">
                                            <li class="icon facebook" style="padding: 4%" data-toggle="modal" data-target="#MostrarPdf{{ $comanda->id }}">
                                                <span class="tooltip" style="font-size: 10px;">IMPRIMIR</span>
                                                <span><i class="fa-solid fa-print"></i></span>
                                            </li>
                                            @include('admin.comanda.MostrarPdf')
                                            <button>
                                                <li class="icon youtube" type="submit">
                                                    <span class="tooltip" style="font-size: 10px;">ELIMINAR</span>
                                                    <span><i class="fa-solid fa-trash" type="submit"></i></span>
                                                </li>
                                            </button>
                                        </ul>
                                    </form>
                                </center>
                            </td>                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<!-- Add the modal element -->
<div class="modal fade" id="selectedIdsModal" tabindex="-1" role="dialog" aria-labelledby="selectedIdsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selectedIdsModalLabel">Selected IDs</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deliveryForm" action="{{ route('admin.comanda.deliveri') }}" method="POST">
            @csrf
            <div class="modal-body">               
                <p id="selectedIds" style="color:black; font-size:20px; font-weight: bold;"></p>
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <label for="comments">Observacion:</label><br>
                        <select id="observacion" name="observacion" class="otraclaseform" required>
                            <option value="" disabled selected>Seleccione Al Deliveri</option>
                            <option value="Alejandro Flores">Alejandro Flores</option>
                            <option value="Sergio Flores">Sergio Flores</option>
                            <option value="Antonio Flores">Antonio Flores</option>
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <label for="quantity">Cambios:</label>
                        <input type="number" class="otraclaseform" name="cambios" id="cambios" placeholder="Enter quantity" min="1" step="1" required>
                    </div>
                </div>            
            </div>
            <hr>
            <div class="modal-foot d-flex justify-content-end" style="padding-right: 15px">
                <button type="button" class="btn btn-outline-danger mr-2" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-outline-secondary ml-2">Enviar</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/caja/registrar.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 
<style>
    /*fin color de borde formulario register*/
    .otraclase{
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .otraclase:focus {
        border-color: #4d94ff;
        box-shadow: 0 0 0 0.25rem rgba(77, 148, 255, 0.25);
    }
    .otraclaseform{
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .otraclaseform:focus {
        border-color: #4d94ff;
        box-shadow: 0 0 0 0.25rem rgba(77, 148, 255, 0.25);
    }
    /*form control final input*/
</style>
@notifyCss
@push('js')
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
            bInfo: false,
            bPaginate: false,
            "bSort": false,
            "searching": false, // Disable search bar
            "language": {
                "lengthMenu": "Mostrar registro por página",
                "zeroRecords": "No se encontro registro",
                "info": "Mostrando la página _PAGE_ de _PAGES_",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Siguiente"
                },
                "infoEmpty": "No hay registros",
                "infoFiltered": "(Filtrado de _MAX_ registros totales)"
            },
        });
    });
</script>
<script>
    function mostrarAlerta(url) {
        event.preventDefault(); // Previene el comportamiento predeterminado del enlace

        Swal.fire({
            title: 'Confirmación',
            text: '¿Estás seguro de confirmar la comanda? una vez confirmada la comanda se registrará en cajas RESTAURANTE.',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url; // Redirige a la URL del enlace original
            }
        });
    }
</script>
<script>
    // Get references to the elements
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const openModalBtn = document.getElementById('openModalBtn');
    const modal = document.getElementById('selectedIdsModal');
    const selectedIdsText = document.getElementById('selectedIds');
    const deliveryForm = document.getElementById('deliveryForm');
    const selectedClientsNames = [];
    // Event listener for checkboxes
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedIds);
    });

    function updateSelectedIds() {
        // Get the selected IDs
        const selectedIds = Array.from(checkboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        // Update the modal content with the selected IDs
        selectedIdsText.textContent = selectedIds.join(', ');

        // Show/hide the button based on whether at least one checkbox is checked
        if (selectedIds.length > 0) {
            openModalBtn.removeAttribute('disabled');
        } else {
            openModalBtn.setAttribute('disabled', 'disabled');
        }

        // Set the selected IDs as a comma-separated value in a hidden input field of the form
        const selectedIdsInput = document.createElement('input');
        selectedIdsInput.setAttribute('type', 'hidden');
        selectedIdsInput.setAttribute('name', 'selectedIds');
        selectedIdsInput.setAttribute('value', selectedIds.join(','));
        deliveryForm.appendChild(selectedIdsInput);
    }
</script>
@notifyJs
@endpush