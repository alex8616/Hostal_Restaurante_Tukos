@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List')])
@section('content')
<br><br><hr>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                Imprimir Formulario Asistencia
            </button>

            <!-- Modal -->
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
                      <div style="background: #4F4F4F;"><h5 style="font-size: 25px; color: white;"><center>REGISTRAR PERSONAL</center></h5></div>
                      <form action="{{ route('admin.personal.store') }}" method="POST" id="add-form" enctype="multipart/form-data">
                      @csrf
                          <div class="row">
                              <div class="col-md-12">  
                                  <input type="hidden" name="id" id="id" value="">
                                  <div class="form-group">
                                      <label class="col-sm-12 col-form-label is-required" for="nombre">NOMBRE COMPLETO: </label><br>
                                      <input type="text" name="Nombre_Completo" id="Nombre_Completo" class="otraclaseform"
                                          tabindex="1" autofocus onkeyup=" javascript:this.value=this.value.toUpperCase();" required>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-12 col-form-label is-required" for="inicio_caja">DNI: </label><br>
                                      <input type="text" name="Dni" id="Dni" class="otraclaseform"
                                          tabindex="1" autofocus onkeyup=" javascript:this.value=this.value.toUpperCase();" required>
                                  </div> 
                                  <div class="row">
                                      <div class="col-md-12">
                                          <label class="col-sm-12 col-form-label is-required" for="nombre">CARGO</label><br>
                                          <input type="text" name="Cargo" id="Cargo" class="otraclaseform"
                                          tabindex="1" autofocus onkeyup=" javascript:this.value=this.value.toUpperCase();" required>                                      </div>
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
                              <th>DNI</th>
                              <th>CARGO</th>                              
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
                        <input type="text" name="Edit_Nombre_Completo" id="Edit_Nombre_Completo" class="otraclaseform"
                            tabindex="1" autofocus onkeyup=" javascript:this.value=this.value.toUpperCase();" required>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label is-required" for="nombre">DNI: </label><br>
                        <input type="text" name="Edit_Dni" id="Edit_Dni" class="otraclaseform"
                            tabindex="1" autofocus onkeyup=" javascript:this.value=this.value.toUpperCase();" required>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label is-required" for="nombre">CARGO: </label><br>
                        <input type="text" name="Edit_Cargo" id="Edit_Cargo" class="otraclaseform"
                            tabindex="1" autofocus onkeyup=" javascript:this.value=this.value.toUpperCase();" required>
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
        "ajax": "{{ route('personal.data') }}",
        "columns": [
            {data: 'id'},
            {data: 'Nombre_Completo'},
            {data: 'Dni'},
            {data: 'Cargo'},
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
            url: "{{ route('personal.edit', ['id' => ':id']) }}".replace(':id', id),
            data: {
                'id': id
            },
            success: function(data) {
                console.log(data)
                $('#id').val(data.id);
                $('#Edit_Nombre_Completo').val(data.Nombre_Completo);
                $('#Edit_Dni').val(data.Dni);
                $('#Edit_Cargo').val(data.Cargo);
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
                'Edit_Nombre_Completo': $('#Edit_Nombre_Completo').val(),
                'Edit_Dni': $('#Edit_Dni').val(),
                'Edit_Cargo': $('#Edit_Cargo').val(),
            };
            console.log(data)
            $.ajax({
                type: 'put',
                url: "{{ route('updatepersonal', ['id' => ':id']) }}".replace(':id', $('input[name=id]').val()),
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

    //eliminar fila table
    function confirmDelete(id) {
      if (confirm('¿Estás seguro de que quieres eliminar este registro?')) {
        $.ajax({
          type: 'delete',
          url: "{{ route('eliminarpersonal', ['id' => ':id']) }}".replace(':id', id),
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(data) {
            $('#personal-table').DataTable().ajax.reload();
            toastr.success(data.message, "Mensaje de éxito", {"iconClass": 'toast-success'});
          },
          error: function(xhr, textStatus, errorThrown) {
            toastr.error('<i class="fas fa-exclamation-circle"></i> Error: No se ha podido eliminar los datos.', 'Error');
          }
        });
      }
    }

</script>  
@notifyJs
@endpush