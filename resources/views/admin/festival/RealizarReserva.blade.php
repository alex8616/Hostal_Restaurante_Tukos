@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
@section('content')
<br><br><hr>
<div class="container-fluid" style="margin-top: -40px">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <table>
                <tr>
                    <td style="text-align: center;">
                        <form action="{{route('admin.festival.reservaspdf')}}" target="_blank">
                            <input type="text" id="festival_id" name="festival_id" value="{{ $festival->id }}" hidden>
                            <button type="submit" href="{{ route('admin.festival.reservaspdf') }}" target="_blank" class="btn btn-success" style="width: 100%;">EXPORTAR PDF</button>
                        </form>
                    </td>
                    <td style="text-align: center;">
                        <form action="{{route('admin.festival.tarjeta')}}" target="_blank">
                            <input type="text" id="festival_id" name="festival_id" value="{{ $festival->id }}" hidden>
                            <button type="submit" href="{{ route('admin.festival.tarjeta') }}" target="_blank" class="btn btn-success" style="width: 100%;">TARJETA PDF</button>
                        </form>
                    </td>
                    <td style="text-align: center;">
                        <form action="{{route('admin.festival.croquismap')}}" target="_blank">
                            <input type="text" id="festival_id" name="festival_id" value="{{ $festival->id }}" hidden>
                            <button type="submit" href="{{ route('admin.festival.croquismap') }}" target="_blank" class="btn btn-secundary" style="width: 100%;">MAPA DE MESAS</button>
                        </form>
                    </td>
                </tr>
            </table>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                            <form action="{{ route('admin.personal.AsistenciaHoja') }}" method="get" target="_blank">
                                @csrf
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label for="">SELECCIONA EL MES</label><br>
                                            <input type="month" id="AsistenciaMes" name="AsistenciaMes">
                                        </div>
                                    </div>
                                <br>
                                <button type="submit" class="btn btn-success" tabindex="4" style="width: 100%;" >CONSULTAR </button> 
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-4">                            
                  <div class="container" style="background: white; width: 100%; margin: 0px; border-radius:5px; padding: 15px;">
                      <div style="background: #4F4F4F;"><h5 style="font-size: 25px; color: white;"><center>REGISTRAR RESERVA PARA {{ $festival->nombre_festival }}</center></h5></div>
                      <form action="{{ route('admin.festival.reservastore') }}" method="POST" id="add-form" enctype="multipart/form-data">
                      @csrf
                          <div class="row">
                              <div class="col-md-12">  
                                  <input type="text" id="festival_id" name="festival_id" value="{{ $festival->id }}" hidden>
                                  <div class="form-group">
                                      <label class="col-sm-12 col-form-label is-required" for="Nombre_reserva">NOMBRE COMPLETO: </label><br>
                                      <input type="text" name="Nombre_reserva" id="Nombre_reserva" class="otraclaseform"
                                          tabindex="1" autofocus onkeyup=" javascript:this.value=this.value.toUpperCase();" required>
                                  </div>
                                  <div class="row">
                                        <div class="col-md-5">
                                          <label class="col-sm-12 col-form-label is-required" for="nombre">CELULAR</label><br>
                                          <input type="number" name="Celular_reserva" id="Celular_reserva" class="otraclaseform">                                      
                                        </div>
                                        <div class="col-md-7">
                                            <label class="col-sm-12 col-form-label is-required" for="tipo_pago">HORA</label>
                                            <input type="text" name="Hora_reserva" id="Hora_reserva" class="otraclaseform">  
                                        </div>
                                  </div>
                                  <div class="form-group">
                                        <label class="col-sm-12 col-form-label is-required" for="mesa_id">SELECCIONE UNA MESA</label>
                                        <select name="mesa_id" id="mesa_id" class="otraclaseform">
                                            @foreach($mesas as $mesa)
                                                <option value="{{ $mesa->id }}">{{ $mesa->Nombre_mesa }}</option>
                                            @endforeach
                                        </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-12 col-form-label is-required" for="inicio_caja">CANTIDAD PERSONAS: </label><br>
                                      <input type="number" name="Cantidad_persona" id="Cantidad_persona" class="otraclaseform" required>
                                  </div> 
                                  <div class="row">
                                        <div class="col-md-5">
                                          <label class="col-sm-12 col-form-label is-required" for="nombre">ADELANTO</label><br>
                                          <input type="number" name="Adeltanto_reserva" id="Adeltanto_reserva" class="otraclaseform" required>                                      
                                        </div>
                                        <div class="col-md-7">
                                            <label class="col-sm-12 col-form-label is-required" for="tipo_pago">TIPO DE PAGO</label>
                                            <select name="tipo_pago" id="tipo_pago" class="otraclaseform">
                                                <option value="EFECTIVO">EFECTIVO</option>
                                                <option value="TARJETA">TARJETA</option>
                                                <option value="DEPOSITO">DEPOSITO</option>
                                            </select>
                                        </div>
                                  </div><br>
                              </div>
                          </div>
                          <div id="preview"></div>
                          <div class="row">
                              <div class="col-md-6 grid-margin stretch-card">
                                  <button type="submit" class="btn btn-success" tabindex="4" style="width: 100%;">Registrar </button>
                              </div>
                              <div class="col-md-6 grid-margin stretch-card">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close" style="width: 100%;">Cancelar</button>
                              </div>
                          </div>
                      </form> 
                  </div>
              </div>
              <div class="col-md-8">
                  <div class="container" style="background: white; width: 100%; margin: 0px; border-radius:5px"><br>
                      <table id="personal-table" class="table table-striped">
                          <thead>
                          <tr>
                              <th>ID</th>
                              <th>NOMBRE</th>
                              <th>CELULAR</th>
                              <th>HORA</th>
                              <th># MESA</th>
                              <th>CANTIDAD</th>
                              <th>ADELANTO</th>                              
                              <th>ACCIONES</th>
                          </tr>
                          </thead>
                      </table>
                  </div>  
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade bd-example-modal-sm" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" name="id" id="id" value="">
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label is-required" for="nombre">NOMBRE COMPLETO: </label><br>
                        <input type="text" name="Edit_Nombre_reserva" id="Edit_Nombre_reserva" class="otraclaseform"
                            tabindex="1" autofocus onkeyup=" javascript:this.value=this.value.toUpperCase();" required>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label is-required" for="nombre">CANTIDAD: </label><br>
                        <input type="number" name="Edit_Cantidad_persona" id="Edit_Cantidad_persona" class="otraclaseform" required>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label is-required" for="nombre">ADELANTO: </label><br>
                        <input type="number" name="Edit_Adeltanto_reserva" id="Edit_Adeltanto_reserva" class="otraclaseform" required>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label is-required" for="Edit_mesa_id">SELECCIONE UNA MESA</label>
                        <select name="Edit_mesa_id" id="Edit_mesa_id" class="otraclaseform">
                            @foreach($mesas as $mesa)
                                <option value="{{ $mesa->id }}">{{ $mesa->Nombre_mesa }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-success" style="width: 100%;">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/caja/registrar.css')}}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<style>
    /*Input FORM*/
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
    /*FIN input*/
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
    }
    .imagen-articulo {
        display: inline-block;
        width: 110px;
        border: 1px solid #ccc;
        margin-right: 10px;
        border-radius: 10px;
    }
</style>
@notifyCss
@push('js')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    //llenar datos la tabla 
    $('#personal-table').DataTable({
        dom: '<"row"<"col-sm-6"l><"col-sm-6"f>>tip',
        language: {
            lengthMenu: 'Mostrar _MENU_ Pagina'
        },
        "ordering": false,
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Mostrar todos"]],
        "ajax": {
            url: "{{ route('festival.reservadata', ['festival' => $festival->id]) }}",
            type: "GET",
        },
        "columns": [
            {data: 'id'},
            {data: 'Nombre_reserva'},
            {data: 'Celular_reserva'},
            {data: 'Hora_reserva'},
            {data: 'Nombre_mesa'},
            {data: 'Cantidad_persona'},
            {data: 'Adeltanto_reserva'},
            {
                data: null,
                render: function(data, type, row) {
                return '<ul class="wrapper" style="height: 50px; display: inline-flex;">'+
                    '<li class="icon facebook btn-edit" data-id="'+data.id+'">'+
                    '<span class="tooltip" style="font-size: 10px;">EDITAR</span>'+
                    '<span><i class="fa-solid fa-arrow-up-right-from-square"></i></span>'+
                    '</li>'+
                    '<li class="icon youtube btn-delete" data-id="'+data.id+'" onclick="confirmDelete('+data.id+')">'+
                    '<span class="tooltip" style="font-size: 10px;">ELIMINAR</span>'+
                    '<span><i class="fa-solid fa-trash"></i></span>'+
                    '</li>'+
                    '</ul>';
                }
            }
        ],
        error : function() {
            alert("Nothing Data");
        }
    });
    ///agregar a tabla
    $(document).ready(function() {
        $('#add-form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    // Recargar los datos de la tabla
                    $('#personal-table').DataTable().ajax.reload();
                    $('#add-form').trigger('reset');
                    preview.innerHTML = "";
                    toastr.success("Se ha registrado con éxito.", "Mensaje de éxito", {
                        "iconClass": 'toast-success'
                    });
                },
                error: function(xhr, status, error) {
                    toastr.error('<i class="fas fa-exclamation-circle"></i> Error: No se a podido registrar llene todo el formulario.', 'Error');  
                }
            });
        });
    });
    //editar datos
    $(document).on('click', '.btn-edit', function() {
        var id = $(this).data('id');
        console.log(id)
        $.ajax({
            type: 'get',
            url: "{{ route('festival.edit', ['id' => ':id']) }}".replace(':id', id),
            data: {
                'id': id
            },
            success: function(data) {
                console.log(data)
                $('#id').val(data.id);
                $('#Edit_Nombre_reserva').val(data.Nombre_reserva);
                $('#Edit_Cantidad_persona').val(data.Cantidad_persona);
                $('#Edit_Adeltanto_reserva').val(data.Adeltanto_reserva);
                $('#Edit_mesa_id').val(data.mesa_id);
                $('#modalEdit').modal('show');
            },
            error: function() {
                alert("Error al recibir los datos");
            }
        });
        ///actualizar datos    
        $("#modalEdit .btn-success").off('click').on("click", function() {
            var data = {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'Edit_Nombre_reserva': $('#Edit_Nombre_reserva').val(),
                'Edit_Cantidad_persona': $('#Edit_Cantidad_persona').val(),
                'Edit_Adeltanto_reserva': $('#Edit_Adeltanto_reserva').val(),
                'Edit_mesa_id': $('#Edit_mesa_id').val(),
            };
            console.log(data)
            $.ajax({
                type: 'put',
                url: "{{ route('updatereservafestival', ['id' => ':id']) }}".replace(':id', $('input[name=id]').val()),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify(data),
                contentType: 'application/json',
                success: function(data) {
                    $('#modalEdit').modal('hide');
                    $('#modalEdit form').trigger('reset');
                    $('#personal-table').DataTable().ajax.reload();
                    toastr.success(data.message, "Mensaje de éxito", {"iconClass": 'toast-success'});
                },
                error: function(xhr, textStatus, errorThrown) {
                    toastr.error('<i class="fas fa-exclamation-circle"></i> Error: No se ha podido actualizar los datos.', 'Error');
                }
            });
        });
    });
</script>  
@notifyJs
@endpush
