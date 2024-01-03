@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List')])
@section('content')
<br><br><hr>
<div class="header">
  <span class="header-text">CAJA MES {{ \Carbon\Carbon::parse($caja->fecha_registro)->locale('es')->isoFormat('MMMM \d\e\l Y') }} - TARJETAS</span>
  <nav class="dropdownmenu">
    <ul>      
      <li>
        <a href="#">CAJAS</a>
        <ul id="submenu">
          <li><a href="{{ route('admin.caja.registrar',$caja) }}" style="text-align: left">HOSTAL</a></li>
          <li><a href="{{ route('admin.caja.registrar_restaurante',$caja) }}" style="text-align: left">RESTAURANTE</a></li>
          <li><a href="{{ route('admin.caja.registrar_tarjeta',$caja) }}" style="text-align: left">TARJETAS</a></li>
          <li><a href="{{ route('admin.caja.registrar_deposito',$caja) }}" style="text-align: left">DEPOSITO</a></li>
        </ul>
      </li>
      <li>
        <a href="#">EXPORTAR</a>
        <ul id="submenu">
          <li><a href="{{ route('admin.caja.Cajapdf', $caja) }}" target="_blank">ARCHIVO PDF <i class="fa-solid fa-file-pdf"></i></a></li>
          <li><a href="{{ route('admin.caja.Cajaexcel', $caja) }}">ARCHIVO EXCEL <i class="fa-solid fa-file-excel"></i></a></li>
        </ul>
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

<div style="background: white; padding: 30px; margin: 15px;">
  <table class="table table-bordered shadow-lg mt-4 dt-responsive" id="categoria" style="width: 100%">
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
        <th class="col-head" scope="col" style="background: #277BC0; color: white"><center>Nª</center></th>
        <th class="col-head" scope="col" style="background: #277BC0; color: white"><center>Nombre</center></th>
        <th class="col-head" scope="col" style="background: #277BC0; color: white"><center>Codigo ATRIBUTO</center></th>
        <th class="col-head" scope="col" style="background: #277BC0; color: white"><center>Nombre ATRIBUTO</center></th>
        <th class="col-head" scope="col" style="background: #277BC0; color: white"><center>Descripcion</center></th>
        <th class="col-head" scope="col" style="background: #277BC0; color: white"><center>Fecha De Registro</center></th>
        <th class="col-head" scope="col" style="background: #277BC0; color: white"><center>Ingreso</center></th>
        <th class="col-head" scope="col" style="background: #277BC0; color: white"><center>Egreso</center></th>
        <th class="col-head" scope="col" style="background: #277BC0; color: white"><center>Sumatoria</center></th>
        <th class="col-head" scope="col" style="background: #277BC0; color: white"><center>Acciones</center></th>
      </tr>
    </thead>    
  </table>

  <div style="overflow-x: auto;">
    <table style="width: 100%">
      <tfoot id="my-tfoot">
        <tr>
          <td colspan="8"></td>
          <td colspan="2" style="background-color:#e95747; color:white;"><h4><strong>CAJA GRANDE: {{ $cajagrande }}</strong></h4></td>
        </tr>
        <tr>
          <td colspan="4" style="background-color:#70ca58; color:white"><h4><strong>INGRESO TOTAL: {{ $detalleIngreso }}</strong></h4></td>
          <td colspan="4" style="background-color:#e95747; color:white"><h4><strong>EGRESO TOTAL: {{ $detalleEgreso }}</strong></h4></td>
          <td colspan="2" style="background-color:#52abff; color:white"><h4><strong>TOTAL: {{$total}}</strong></h4></td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
@include('admin.caja.CrearDetalleCajaTarjetas')

  <!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-row">
                    <div class="col-md-12">
                        <input type="hidden" name="id" id="id" value="">
                        <input class="typeahead form-control" name="edit_caja_id" id="edit_caja_id" type="text" value="{{$caja->id}}" hidden>
                        <input type="text" value="2" id="edit_codigo_caja_id" name="edit_codigo_caja_id" hidden><br>
                        <p style="font-size: 80px; font-family: Alfa Slab One; text-align: center;">HOSTAL</p>
                    </div>
                    
                </div><br>
                <div class="form-row">
                    <div class="col-md-12">
                        <label for="inputNombre" class="is-required">DESCRIPCION</label>
                        <textarea class="form-control" name="edit_Articulo_description" id="edit_Articulo_description" onkeyup="javascript:this.value=this.value.toUpperCase();" required></textarea>                           
                    </div>
                    <div class="col-md-12"><br>
                        <label for="">FACTURA</label><br>
                        <label id="label1"> <input class="form-radio" type="radio" name="edit_Factura" id="edit_Factura" value="Con_Factura" onchange="mostrarInputEdit()"> SI </label>                                                              
                        <label id="label2"> <input class="form-radio" type="radio" name="edit_Factura" id="edit_Factura" value="Sin_Factura" onchange="ocultarInputEdit()"> NO </label>
                        <div id="edit_input-container">
                            <input class="form-control" type="text" id="edit_otra_respuesta" name="edit_otra_respuesta" placeholder="N Factura">
                        </div>  
                    </div>
                </div><br>
                <div class="form-row" style="margin:auto;">
                    <div class="form-group col-md-6">
                        <label for="inputNombre" class="is-required">INGRESO</label><br>
                        <input class="form-control" name="edit_Ingreso" id="edit_Ingreso" type="number" value="0.00">                                    
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputApellidop" class="is-required">EGRESO</label><br>
                        <input class="form-control" name="edit_Egreso" id="edit_Egreso" type="number" value="0.00">                                                      
                    </div>
                </div>                            
            </div>
            <div class="col-md-6">
                <label for="">Selecione Atributo:</label>
                <select class="form-select" name="edit_articulo_caja_id" size="16" id="edit_articulo_caja_id" style="width:100%" required>                           
                    <option value="" selected disabled>Ninguna Seleccion</option>
                    @foreach ($articulos as $articulo)
                            <option value="{{ $articulo->id }}"> 
                                    {{ $articulo->Nombre_Articulo }} 
                            </option>
                    @endforeach
                </select>
            </div>
            <input class="typeahead form-control"  name="edit_Fecha_registro" id="edit_Fecha_registro" type="text" value={{ \Carbon\Carbon::now('America/La_Paz')}}>                   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>

@endsection
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
  $('.dt-responsive tbody').on('mouseover', 'tr', function () {
      $(this).addClass('highlight');
  }).on('mouseout', 'tr', function () {
      $(this).removeClass('highlight');
  });
</script>
<script>
    //llenar datos la tabla 
    $('#categoria').DataTable({
        dom: '<"row"<"col-sm-6"l><"col-sm-6"f>>tip',
        language: {
            lengthMenu: 'Mostrar _MENU_ Pagina'
        },
        "ordering": false,
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Mostrar todos"]],
        "pageLength": 20, // Set the number of records per page to 20
        "ajax": "{{ route('detallecaja.datatarjetas', ['caja' => $caja->id]) }}",
        "createdRow": function(row, data, dataIndex) {
            if (data.Articulo_description.includes("CAJA CERRADA")) {
                var cell = $(row).find('td:first');
                cell.css({
                    'background-color': 'red',
                    'color': 'white'
                }).attr('colspan', 10).text(data.Articulo_description);
                cell.nextAll().remove();
            }
        },
        "columns": [
            {data: 'cont'},
            {data: 'Nombre'},
            {data: 'Codigo_caja'},
            {data: 'Nombre_Articulo'},
            {data: 'Articulo_description'},
            {data: 'Fecha_registro'},
            {data: 'Ingreso'},
            {data: 'Egreso'},
            {
                data: 'sum',
                createdCell: function (td, cellData, rowData, row, col) {
                    if (col === 8) { // la columna "sum" es la novena columna (índice 8)
                      $(td).css({
                          'background-color': '#277BC0',
                          'color': 'white',
                          'text-align': 'center'
                      });
                    }
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return '<ul class="wrapper" style="height: 50px; display: inline-flex;">'+
                            '<li class="icon facebook btn-edit" data-id="'+data.id+'">'+
                              '<span class="tooltip" style="font-size: 10px;">EDITAR</span>'+
                              '<span><i class="fa-solid fa-arrow-up-right-from-square"></i></span>'+
                            '</li>'+
                            '<button>'+
                            '<li class="icon youtube btn-delete" data-id="'+data.id+'">'+
                                '<span class="tooltip" style="font-size: 10px;">ELIMINAR</span>'+
                                '<span><i class="fa-solid fa-trash"></i></span>'+
                            '</li>'+
                            '</button>'+
                          '</ul>';
                }
            }
        ],
        error : function() {
            alert("Nothing Data");
        }
    });

    //Insertar a la tabla
    $(document).ready(function() {
      $('#add-form').on('submit', function(e) {
          e.preventDefault();
          var formData = $(this).serialize();
          $.ajax({
              url: $(this).attr('action'),
              type: 'POST',
              data: formData,
              success: function(data) {
                // Obtener la página actual antes de recargar los datos
                var currentPage = $('#categoria').DataTable().page();
                // Recargar los datos de la tabla
                $('#categoria').DataTable().ajax.reload(function(){
                  // Volver a la página actual después de que se hayan recargado los datos
                  $('#categoria').DataTable().page(currentPage).draw(false);
                });
                $('#modelId').modal('hide');
                $('#modelId form').trigger('reset'); // Agregado para vaciar el formular

                // Actualiza el tfoot
                $('#my-tfoot').html(`<tr>
                    <td colspan="8"></td>
                    <td colspan="2" style="background-color:#e95747; color:white;"><h4><strong>CAJA GRANDE: ${data.totals.cajagrande}</strong></h4></td>
                </tr>
                <tr>
                    <td colspan="4" style="background-color:#70ca58; color:white"><h4><strong>INGRESO TOTAL: ${data.totals.detalleIngreso}</strong></h4></td>
                    <td colspan="4" style="background-color:#e95747; color:white"><h4><strong>EGRESO TOTAL: ${data.totals.detalleEgreso}</strong></h4></td>
                    <td colspan="2" style="background-color:#52abff; color:white"><h4><strong>TOTAL: ${data.totals.total}</strong></h4></td>
                </tr>`);
                toastr.success("Se ha registrado con éxito.", "Mensaje de éxito", {
                  "iconClass": 'toast-success'
                });
                
                var table = $('#categoria').DataTable();
                var index = table.column(0).data().indexOf(data.id);
                if (table.rows().nodes().length > 0) {
                  table.rows({ page: 'current' }).nodes().each(function(node, idx) {
                      if (idx === index) {
                          $(node).addClass('highlight-row');
                          setTimeout(function() {
                              $(node).removeClass('highlight-row');
                              table.page(Math.floor(index / table.page.len())).draw('page');
                          }, 3000); // 3000 ms = 3 segundos
                      }
                  });
                }
              },
              error: function(xhr, status, error) {
                toastr.error('<i class="fas fa-exclamation-circle"></i> Error: No se a podido registrar llene todo el formulario.', 'Error');  
              }
          });
      });
    });

    //eliminar fila table
    $('#categoria').on('click', '.btn-delete', function () {
      var id = $(this).data('id');
        Swal.fire({
            title: '¿Estás seguro que deseas eliminar esta fila?',
            text: "Esta acción no se puede deshacer",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('caja.destroydetallecajaTarjetas',['detallecaja' => ':id']) }}".replace(':id', id),
                    method: 'DELETE',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        // Obtener la página actual antes de recargar los datos
                        var currentPage = $('#categoria').DataTable().page();
                        // Recargar los datos de la tabla
                        $('#categoria').DataTable().ajax.reload(function(){
                          // Volver a la página actual después de que se hayan recargado los datos
                          $('#categoria').DataTable().page(currentPage).draw(false);
                        });

                        // Actualiza el tfoot
                        $('#my-tfoot').html(`<tr>
                            <td colspan="8"></td>
                            <td colspan="2" style="background-color:#e95747; color:white;"><h4><strong>CAJA GRANDE: ${data.totals.cajagrande}</strong></h4></td>
                        </tr>
                        <tr>
                            <td colspan="4" style="background-color:#70ca58; color:white"><h4><strong>INGRESO TOTAL: ${data.totals.detalleIngreso}</strong></h4></td>
                            <td colspan="4" style="background-color:#e95747; color:white"><h4><strong>EGRESO TOTAL: ${data.totals.detalleEgreso}</strong></h4></td>
                            <td colspan="2" style="background-color:#52abff; color:white"><h4><strong>TOTAL: ${data.totals.total}</strong></h4></td>
                        </tr>`);
                        toastr.options = {
                            "backgroundColor": '#009944',
                            "positionClass": "toast-top-right",
                            "closeButton": true,
                            "progressBar": true,
                            "timeOut": "5000"
                        };
                        toastr.success("Se ha Eliminado Correctamente.", "Mensaje de éxito", {
                            "iconClass": 'toast-success'
                        });   
                    },
                    error: function() {
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut",
                            "iconClasses": {
                                error: 'toast-error'
                            }
                        }

                        toastr.error('<i class="fas fa-exclamation-circle"></i> Error: No se a podido Eliminar.', 'Error');
                    }
                });
            }
        });
    });

    //editar la tabla modal
    $(document).on('click', '.btn-edit', function() {
      var id = $(this).data('id');
      $.ajax({
          type: 'get',
          url: "{{ route('detallecaja.edit', ['id' => ':id']) }}".replace(':id', id),
          data: {
              'id': id
          },
          success: function(data) {
              $('#modalEdit').find('input[name="nombre"]').val(data.nombre);
              $('#id').val(data.id);
              $('#edit_caja_id').val(data.caja_id);
              $('#edit_Articulo_description').val(data.Articulo_description);
              $('#edit_articulo_caja_id').val(data.articulo_caja_id);
              $('#edit_Fecha_registro').val(data.Fecha_registro);
              $('#edit_Ingreso').val(data.Ingreso);
              $('#edit_Egreso').val(data.Egreso);
              if (data.Factura == "Con_Factura") {
                $('#label1 input[type="radio"]').prop("checked", true);
                $('input[name=edit_otra_respuesta]').show();
                $('input[name=edit_otra_respuesta]').val(data.NFactura);
              } else {
                $('#label2 input[type="radio"]').prop("checked", true);
                $('input[name=edit_otra_respuesta]').hide();
                $('input[name=edit_otra_respuesta]').val("");
              }
              // Agregar código para mostrar el input cuando se cambia de "Sin_Factura" a "Con_Factura"
              $('input[name="edit_Factura"]').change(function(){
                  if($(this).val() == "Con_Factura"){
                    $('input[name=edit_otra_respuesta]').show();
                  } else {
                    $('input[name=edit_otra_respuesta]').hide();
                    $('input[name=edit_otra_respuesta]').val("");
                  }
              });
              $('#modalEdit').modal('show');
          },

          error: function() {
              alert("Error al recibir los datos");
          }
    });

    //actualizar los datos de la tabla y modal
    $("#modalEdit .btn-primary").off('click').on("click", function() {
          $.ajax({
              type: 'put',
              url: "{{ route('detallecaja.updateTarjetas', ['id' => ':id']) }}".replace(':id', $('input[name=id]').val()),
              data: {
                  '_token': "{{ csrf_token() }}",
                  'caja_id': $('input[name=caja_id]').val(),
                  'Articulo_description': $('textarea[name=edit_Articulo_description]').val(),
                  'Factura': $('input[name=edit_Factura]:checked').val(),
                  'NFactura': $('input[name=edit_otra_respuesta]').val(),
                  'articulo_caja_id': $('#edit_articulo_caja_id').val(),
                  'Fecha_registro': $('input[name=edit_Fecha_registro]').val(),
                  'Ingreso': $('input[name=edit_Ingreso]').val(),
                  'Egreso': $('input[name=edit_Egreso]').val(),
              },
              success: function(data) {
                  console.log(data);
                  // Obtener la página actual antes de recargar los datos
                  var currentPage = $('#categoria').DataTable().page();
                  // Recargar los datos de la tabla
                  $('#categoria').DataTable().ajax.reload(function(){
                    // Volver a la página actual después de que se hayan recargado los datos
                    $('#categoria').DataTable().page(currentPage).draw(false);
                  });
                  $('#modalEdit').modal('hide');
                  $('#modalEdit form').trigger('reset'); // Agregado para vaciar el formulario

                  // Actualiza el tfoot
                  $('#my-tfoot').html(`<tr>
                      <td colspan="8"></td>
                      <td colspan="2" style="background-color:#e95747; color:white;"><h4><strong>CAJA GRANDE: ${data.totals.cajagrande}</strong></h4></td>
                  </tr>
                  <tr>
                      <td colspan="4" style="background-color:#70ca58; color:white"><h4><strong>INGRESO TOTAL: ${data.totals.detalleIngreso}</strong></h4></td>
                      <td colspan="4" style="background-color:#e95747; color:white"><h4><strong>EGRESO TOTAL: ${data.totals.detalleEgreso}</strong></h4></td>
                      <td colspan="2" style="background-color:#52abff; color:white"><h4><strong>TOTAL: ${data.totals.total}</strong></h4></td>
                  </tr>`);
                  toastr.options = {
                    "backgroundColor": '#009944',
                    "positionClass": "toast-top-right",
                    "closeButton": true,
                    "progressBar": true,
                    "timeOut": "5000"
                  };
                  toastr.success("Se ha Actualizado la informacion con éxito.", "Mensaje de éxito", {
                    "iconClass": 'toast-success'
                  });           
              },
              error: function() {
                toastr.options = {
                  "closeButton": true,
                  "debug": false,
                  "newestOnTop": false,
                  "progressBar": true,
                  "positionClass": "toast-top-right",
                  "preventDuplicates": false,
                  "onclick": null,
                  "showDuration": "300",
                  "hideDuration": "1000",
                  "timeOut": "5000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut",
                  "iconClasses": {
                    error: 'toast-error'
                  }
                }

                toastr.error('<i class="fas fa-exclamation-circle"></i> Error: No se a podido actualizar los datos.', 'Error');
              }
          });
      });
    });
</script>
<script>
    // Selecciona el campo de entrada
    const InputIngreso = document.getElementById('Ingreso');

    // Establece el valor predeterminado en cero y borra al hacer clic
    InputIngreso.addEventListener('click', function() {
        if (InputIngreso.value === '0.00') {
            InputIngreso.value = '';
        }
    });

    // Escucha el evento blur
    InputIngreso.addEventListener('blur', function() {
        // Si el valor es vacío, establece el valor en cero con dos decimales
        if (InputIngreso.value === '') {
            InputIngreso.value = '0.00';
        }
        // Si el valor es un número, conviértelo a una cadena con dos decimales
        else if (!isNaN(InputIngreso.value)) {
            InputIngreso.value = parseFloat(InputIngreso.value).toFixed(2);
        }
    });
</script>
<script>
    // Selecciona el campo de entrada
    const InputEgreso = document.getElementById('Egreso');

    // Establece el valor predeterminado en cero y borra al hacer clic
    InputEgreso.addEventListener('click', function() {
        if (InputEgreso.value === '0.00') {
            InputEgreso.value = '';
        }
    });

    // Escucha el evento blur
    InputEgreso.addEventListener('blur', function() {
        // Si el valor es vacío, establece el valor en cero con dos decimales
        if (InputEgreso.value === '') {
            InputEgreso.value = '0.00';
        }
        // Si el valor es un número, conviértelo a una cadena con dos decimales
        else if (!isNaN(InputEgreso.value)) {
            InputEgreso.value = parseFloat(InputEgreso.value).toFixed(2);
        }
    });
</script>  
@notifyJs
@endpush