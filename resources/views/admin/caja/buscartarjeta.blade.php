@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List')])

@section('content')
<br><br><hr>		
  @include('admin.caja.tab_sider')
  <div class="container-fluid">
      <div class="main-wrapper">
          <div class="table-card">
            <table class="table table-bordered shadow-lg mt-4 dt-responsive" id="categoria">
              <colgroup>
                      <col class="table-col1">
                      <col class="table-col2">
                      <col class="table-col3">
                      <col class="table-col4">
                      <col class="table-col5">
                      <col class="table-col6">
                  </colgroup>
                  <thead class="table-head" title="Click to sort">
                      <tr class="table-row">
                        <th class="col-head" scope="col"><center>Nª</center></th>
                        <th class="col-head" scope="col"><center>Nombre</center></th>
                        <th class="col-head" scope="col"><center>Codigo ATRIBUTO</center></th>
                        <th class="col-head" scope="col"><center>Nombre ATRIBUTO</center></th>
                        <th class="col-head" scope="col"><center>Descripcion</center></th>
                        <th class="col-head" scope="col"><center>Fecha De Registro</center></th>
                        <th class="col-head" scope="col"><center>Ingreso</center></th>
                        <th class="col-head" scope="col"><center>Egreso</center></th>
                        <th class="col-head" scope="col"><center>Acciones</center></th>
                      </tr>
                  </thead>
                  <tbody class="table-body">
                          @php
                              $i=1;
                          @endphp
                          @foreach ($detallecajas as $detallecaja)
                          <tr class="table-row">
                              <td class="cell" style="font-size: 14px;"><center>{{ $detallecaja->id }}</center></td>
                              <td class="cell" style="font-size: 14px;">{{ ($detallecaja->Nombre) }}</td>
                              <td class="cell" style="font-size: 14px;">{{ ($detallecaja->Codigo_caja) }}</td>
                              <td class="cell" style="font-size: 14px;">{{ ($detallecaja->Nombre_Articulo) }}</td>
                              <td class="cell" style="font-size: 14px;">{{ ($detallecaja->Articulo_description) }}</td>
                              <td class="cell" style="font-size: 14px;"><center>{{ ($detallecaja->Fecha_registro) }}</center></td>
                              <td class="cell" style="font-size: 14px;"><center>{{ ($detallecaja->Ingreso) }}</center></td>
                              <td class="cell" style="font-size: 14px;"><center>{{ ($detallecaja->Egreso) }}</center></td>
                              <td class="cell" style="font-size: 14px;">
                                  <center>
                                  <form action="{{ route('caja.destroydetallecaja', $detallecaja->id) }}" method="POST" class="eliminar-form">
                                      @method('DELETE')
                                      @csrf
                                      <ul class="wrapper" style="height: 50px; display: inline-flex;">
                                        <li class="icon facebook" data-toggle="modal" style="padding:4%" data-target="#EditDetalleCaja{{ $detallecaja->id }}">
                                          <span class="tooltip" style="font-size: 10px;">EDITAR</span>
                                          <span><i class="fa-solid fa-arrow-up-right-from-square"></i></span>
                                        </li>
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
                            @include('admin.caja.EditDetalleCaja')
                      @endforeach
                  </tbody>          
            </table>
          </div> <!-- /.container -->
      </div>
  </div>
@endsection

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"></link>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/caja/registrar_tarjeta.css')}}" rel="stylesheet" type="text/css"/>  
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 
@notifyCss

@push('js')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.8/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.8/js/responsive.bootstrap4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
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
            "searching": false,
            bInfo: false,
            bPaginate: false,
        });
    });
</script>
@notifyJs
@endpush