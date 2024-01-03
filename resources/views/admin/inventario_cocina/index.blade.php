
@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List')])

@section('content')
<br><br><hr>
<div class="row" style="margin: auto">
    <div class="col-md-4">                            
        <div class="container" style="background: white; width: 100%; margin: 0px; border-radius:5px; padding: 15px;">
            <div style="background: #4F4F4F;"><h5 style="font-size: 25px; color: white;"><center>REGISTRAR ACTIVO</center></h5></div>
            <form action="{{ route('admin.inventario_cocina.store') }}" method="POST" id="add-form" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-md-12">                            
                        <div class="form-group">
                            <label class="col-sm-12 col-form-label is-required" for="nombre">NOMBRE ARTICULO: </label><br>
                            <input type="text" name="Nombre_articulo" id="Nombre_articulo" class="otraclaseform"
                                tabindex="1" autofocus onkeyup=" javascript:this.value=this.value.toUpperCase();" required>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12 col-form-label is-required" for="inicio_caja">DESCRIPCION ARTICULO: </label><br>
                            <textarea class="otraclaseform" id="Descripcion_articulo" name="Descripcion_articulo" rows="5" cols="51" 
                                onkeyup="javascript:this.value=this.value.toUpperCase();" ></textarea>
                        </div> 
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-sm-12 col-form-label is-required" for="nombre">TOTAL CANTIDAD</label><br>
                                <input type="number" name="cantidad_total" id="cantidad_total" class="otraclaseform" required value="0" oninput="calcularTotal()" onfocus="if (this.value == 0) { this.value = ''; }" onblur="if (this.value == '') { this.value = 0; }" oninput="this.value = !!this.value ? Math.abs(this.value) : 0">
                            </div>
                            <div class="col-md-6">
                                <label id="labelphoto" class="col-sm-12 col-form-label is-required" for="nombre">PHOTOS</label><br>
                                <input type="file" name="images[]" id="images" class="otraclaseform" accept=".jpg,.jpeg">
                            </div> 
                        </div>                        
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
        <div class="table-responsive" style="background: white; width: 100%;border-radius:5px; padding: 10px;"><br>
            <a href="{{ route('inventario_cocina.articuloxportPDF') }}" class="button" target="_blank">
                <span><i class="fa-solid fa-file-pdf"></i></span> Exportar PDF
            </a><br><br>
            <table id="invetario-table" class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>PHOTO</th>
                    <th>ACTIVO</th>
                    <th>DESCRIPCION</th>
                    <th>BUENO</th>
                    <th>REGULAR</th>
                    <th>MALO</th>
                    <th>TOTAL</th>
                    <th>ACCIONES</th>
                </tr>
                </thead>
            </table>
        </div>  
    </div>
</div>


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
                <pre style="color: red; margin-left: 10px;">* Nota noce puede editar los valores que estan de color <input type="color" value="#F0EEED"></pre>
                <div class="col-md-6">
                    <input type="hidden" name="id" id="id" value="">
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label is-required" for="nombre">NOMBRE ARTICULO: </label><br>
                        <input type="text" name="Edit_Nombre_articulo" id="Edit_Nombre_articulo" class="otraclaseform"
                            tabindex="1" autofocus onkeyup=" javascript:this.value=this.value.toUpperCase();" required>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label is-required" for="inicio_caja">DESCRIPCION ARTICULO: </label><br>
                        <textarea class="otraclaseform" id="Edit_Descripcion_articulo" name="Edit_Descripcion_articulo" rows="5" cols="51" 
                            onkeyup="javascript:this.value=this.value.toUpperCase();" ></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-12 col-form-label is-required" for="nombre">TOTAL ACTIVO</label>
                                    <input type="number" name="edit_cantidad_total_request" id="edit_cantidad_total_request" class="otraclaseform" style="background: #F0EEED" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-12 col-form-label is-required" for="nombre">BUENO</label>
                                    <input type="number" name="edit_valor_bueno" id="edit_valor_bueno" class="otraclaseform" style="background: #F0EEED" disabled>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label is-required" for="nombre">REGULAR</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="number" name="edit_valor_malo" id="edit_valor_malo" class="otraclaseform" style="background: #F0EEED" disabled>
                            </div>
                            <div class="col-md-6">
                                <input type="number" name="edit_valor_malo_request" id="edit_valor_malo_request" class="otraclaseform" required value="0" onfocus="if (this.value == 0) { this.value = ''; }" onblur="if (this.value == '') { this.value = 0; }" oninput="this.value = !!this.value ? Math.abs(this.value) : 0">
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label is-required" for="nombre">MALO</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="number" name="edit_valor_dañado" id="edit_valor_dañado" class="otraclaseform" style="background: #F0EEED" disabled>
                            </div>
                            <div class="col-md-6">
                                <input type="number" name="edit_valor_dañado_request" id="edit_valor_dañado_request" class="otraclaseform" required value="0" onfocus="if (this.value == 0) { this.value = ''; }" onblur="if (this.value == '') { this.value = 0; }" oninput="this.value = !!this.value ? Math.abs(this.value) : 0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label is-required" for="nombre">FOTOS ACTUALES: </label><br>
                        <div id="label_actuales"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label id="labelphotoupdate" class="col-sm-12 col-form-label is-required" for="nombre">FOTOS A CAMBIARSE:</label><br>
                        <input type="file" name="imageupdates[]" id="imageupdates" class="otraclaseform"  multiple>
                        <span id="nota_imagenes_cambiadas" style="color:red; display:none;">* Nota todos las imagenes serán reemplazados por las siguientes ..</span>
                        <div id="label_cambiarse"></div>
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

<div class="modal fade bd-example-modal-sm" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Cantidad De Activos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" name="id" id="id" value="">
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label is-required" for="nombre">
                            DEL ACTIVO
                            <span id="add_nombre_request" name="add_nombre_request" style="color: black"></span>
                            TIENES UNA CANTIDAD TOTAL DE 
                            <span id="add_cantidad_total_request" name="add_cantidad_total_request" style="color: black"></span>                             
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-form-label is-required" for="nombre">TOTAL CANTIDAD</label><br>
                        <input type="number" name="add_cantidad_total_enviar" id="add_cantidad_total_enviar" class="otraclaseform" required value="0" oninput="calcularTotal()" onfocus="if (this.value == 0) { this.value = ''; }" onblur="if (this.value == '') { this.value = 0; }" oninput="this.value = !!this.value ? Math.abs(this.value) : 0">
                    </div>   
                    <p style="color:red;">*se sumara a la cantidad total anterior</p>
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

<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Imagenes Del Activo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img id="largeImage" class="d-block w-100" src="" alt="Imagen">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="" alt="Imagen">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="" alt="Imagen">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Siguiente</span>
                    </a>
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
    #labelphoto {
    cursor: pointer;
    display: block;
    text-align: center;
    color: #828f94;
    background: #fff;
    border-radius: 4px;
    min-height: 80px;
    max-width: 300px;
    border: 2px dashed #e0dfd5;
    position: relative;
    }
    [type="file"] {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }
    #labelphoto.close {
    line-height: 1em;
    font-size: 16px;
    padding: 10px;
    position: absolute;
    top: 0;
    right: 0;
    cursor: pointer;
    font-style: normal;
    }
    #labelphotoS.filename {
    font-size: 20px;
    line-height: 140px;
    }

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
    // obtener elementos del DOM
    const label = document.getElementById('labelphoto');
    const input = document.getElementById('images');
    const preview = document.getElementById('preview');

    // agregar evento onclick a la etiqueta
    label.onclick = () => {
    input.click(); // simular clic en el elemento de entrada de archivo
    };

    // agregar evento onchange al elemento de entrada de archivo
    input.onchange = () => {
    // obtener número de archivos seleccionados
    const numFiles = input.files.length;

    // actualizar contenido de etiqueta con número de archivos seleccionados
    label.innerHTML = `PHOTOS (${numFiles} selected)`;

    // mostrar vista previa de las imágenes
    preview.innerHTML = ""; // vaciar el contenido de preview
    for (let i = 0; i < numFiles; i++) {
        const file = input.files[i];
        const imageType = /^image\//;
        if (!imageType.test(file.type)) {
        continue;
        }
        const img = document.createElement("img");
        img.classList.add("obj");
        img.file = file;
        img.style.width = "100px";
        img.style.display = "inline-block";
        img.style.margin = "10px";
        img.style.borderRadius = "10px";
        preview.appendChild(img);
        const reader = new FileReader();
        reader.onload = (function(aImg) {
        return function(e) {
            aImg.src = e.target.result;
        };
        })(img);
        reader.readAsDataURL(file);
    }
    };
</script>
<script>
    // obtener elementos del DOM
    const divlabel = document.getElementById('labelphotoupdate');
    const divinput = document.getElementById('imageupdates');
    const divpreview = document.getElementById('label_cambiarse');

    // agregar evento onclick a la etiqueta
    divlabel.onclick = () => {
    divinput.click(); // simular clic en el elemento de entrada de archivo
    };

    // agregar evento onchange al elemento de entrada de archivo
    divinput.onchange = () => {
    // obtener número de archivos seleccionados
    const numFiles = divinput.files.length;

    // actualizar contenido de etiqueta con número de archivos seleccionados
    divlabel.innerHTML = `PHOTOS (${numFiles} selected)`;

    // mostrar nota si hay imágenes seleccionadas
    if (numFiles > 0) {
        $('#nota_imagenes_cambiadas').show();
    } else {
        $('#nota_imagenes_cambiadas').hide();
    }
    // mostrar vista previa de las imágenes
    divpreview.innerHTML = ""; // vaciar el contenido de preview
    for (let i = 0; i < numFiles; i++) {
        const file = divinput.files[i];
        const imageType = /^image\//;
        if (!imageType.test(file.type)) {
        continue;
        }
        const img = document.createElement("img");
        img.classList.add("obj");
        img.file = file;
        img.style.width = "100px";
        img.style.display = "inline-block";
        img.style.margin = "10px";
        img.style.borderRadius = "10px";
        divpreview.appendChild(img);
        const reader = new FileReader();
        reader.onload = (function(aImg) {
        return function(e) {
            aImg.src = e.target.result;
        };
        })(img);
        reader.readAsDataURL(file);
    }
    };
</script>
<script>
    $(document).ready(function() {
        $('#invetario-table').DataTable({
            responsive: true,
            serverSide: true,
            ajax: '{{ route('inventario_cocina.data') }}',
            columns: [
                { data: 'id' },
                {
                    data: 'photos_articulo',
                    render: function(data, type, row) {
                        var photos = data;
                        var html = '';
                        for (var i = 0; i < photos.length; i++) {
                            if (i == 0) {
                                html += '<img class="img-thumbnail" data-toggle="modal" data-target="#imageModal" data-imgsrc="' + photos[i] + '" src="' + photos[i] + '" style="height: 50px; margin-right: 5px; cursor:pointer;">';
                            } else {
                                html += '<img class="img-thumbnail additional-img" data-imgsrc="' + photos[i] + '" src="' + photos[i] + '" style="display:none;">';
                            }
                        }
                        return html;
                    }
                },
                { data: 'Nombre_articulo' },
                { data: 'Descripcion_articulo' },
                { data: 'Buen_Estado' },
                { data: 'Mal_Estado' },
                { data: 'Daniado_Estado' },
                { data: 'Total_articulo' },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<ul class="wrapper" style="height: 50px; display: inline-flex;">'+
                                '<li class="icon facebook btn-add" data-id="'+data.id+'">'+
                                '<span class="tooltip" style="font-size: 10px;">ACTUALIZAR TOTAL</span>'+
                                '<span><i class="fa-solid fa-plus"></i></span>'+
                                '</li>'+
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
            ordering: false,
        });
        // Show large image in modal on click
        $('#invetario-table').on('click', 'img.img-thumbnail', function() {
            var imgSrc = $(this).data('imgsrc');
            var photos = $(this).closest('tr').find('img.img-thumbnail').map(function() {
                return $(this).data('imgsrc');
            }).get();
            var modal = $('#imageModal');
            var modalImg = modal.find('.modal-body #largeImage');
            var modalCarouselIndicators = modal.find('.modal-body .carousel-indicators');
            var modalCarouselInner = modal.find('.modal-body .carousel-inner');

            modalCarouselIndicators.empty();
            modalCarouselInner.empty();

            for (var i = 0; i < photos.length; i++) {
                var indicatorClass = (i == 0) ? 'active' : '';
                var carouselClass = (i == 0) ? 'carousel-item active' : 'carousel-item';
                modalCarouselIndicators.append('<li data-target="#imageModal" data-slide-to="' + i + '" class="' + indicatorClass + '"></li>');
                modalCarouselInner.append('<div class="' + carouselClass + '"><img class="d-block w-100" src="' + photos[i] + '"></div>');
            }

            modalImg.attr('src', imgSrc);
                modal.modal('show');
        });
        // Clear modal on close
        $('#imageModal').on('hide.bs.modal', function (event) {
            var modalCarouselIndicators = $(this).find('.modal-body .carousel-indicators');
            var modalCarouselInner = $(this).find('.modal-body .carousel-inner');
            var modalImg = $(this).find('.modal-body #largeImage');
            modalCarouselIndicators.empty();
            modalCarouselInner.empty();
            modalImg.attr('src', '');
        });
        // Show large image in modal on click
        $('#invetario-table').on('click', 'img', function() {
            var photos = $(this).closest('tr').find('img.img-thumbnail').map(function() {
                return $(this).data('imgsrc');
            }).get();
            var index = $(this).index();
            var modalImg = $('#imageModal').find('.carousel-inner');
            var indicators = $('#imageModal').find('.carousel-indicators');

            // clear existing images and indicators
            modalImg.empty();
            indicators.empty();

            // create new images and indicators based on data
            for (var i = 0; i < photos.length; i++) {
            var active = (i === index) ? 'active' : '';
            modalImg.append('<div class="carousel-item ' + active + '"><img class="d-block w-100" src="' + photos[i] + '"></div>');
            indicators.append('<li data-target="#imageModal" data-slide-to="' + i + '" class="' + active + '"></li>');
        }
        // show modal
        $('#imageModal').modal('show');
        });
        // set first image on modal show
        $('#imageModal').on('show.bs.modal', function() {
            var modalImg = $(this).find('.carousel-inner img:first-child');
            $('#imageModal').find('.carousel-indicators li:first-child').addClass('active');
            modalImg.addClass('active');
        });
    });

    //Insertar a la tabla
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
                    $('#invetario-table').DataTable().ajax.reload();
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

    //editar la tabla modal
    $(document).on('click', '.btn-edit', function() {
        var id = $(this).data('id');
        $.ajax({
            type: 'get',
            url: "{{ route('articulos.edit', ['id' => ':id']) }}".replace(':id', id),
            data: {
                'id': id
            },
            success: function(data) {
                console.log(data);
                $('#id').val(data.id);
                $('#Edit_Nombre_articulo').val(data.Nombre_articulo);
                $('#Edit_Descripcion_articulo').val(data.Descripcion_articulo);
                $('#edit_valor_bueno').val(data.Buen_Estado);
                $('#edit_valor_malo').val(data.Mal_Estado);
                $('#edit_valor_dañado').val(data.Daniado_Estado);
                $('#edit_cantidad_total_request').val(data.Total_articulo);

                var photos_actuales = JSON.parse(data.photos_articulo);

                $('#label_actuales').empty();
                $('#label_cambiarse').empty();
                $('#label_cambiarse').html('');
                $('#modalEdit').on('hide.bs.modal', function () {
                    $('#imageupdates').val(null);
                    $('#label_cambiarse').empty();
                    $('#labelphotoupdate').html('PHOTOS');
                });

                for (var i = 0; i < photos_actuales.length; i++) {
                    $('#label_actuales').append('<img src="' + photos_actuales[i] + '" class="imagen-articulo">');
                }                

                $('#modalEdit').modal('show');
            },
            error: function() {
                alert("Error al recibir los datos");
            }
        });

        var imagenes_base64 = [];

        $("#imageupdates").on("change", function() {
            encodeImageFileAsURL(this);
        });

        function encodeImageFileAsURL(element) {
            for (var i = 0; i < element.files.length; i++) {
                var file = element.files[i];
                var reader = new FileReader();
                reader.onload = function(event) {
                    imagenes_base64.push(event.target.result);
                };
                reader.readAsDataURL(file);
            }
        }
        
        ///actualizar datos    
        $("#modalEdit .btn-success").off('click').on("click", function() {
            console.log(imagenes_base64)
            var data = {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'Edit_Nombre_articulo': $('input[name=Edit_Nombre_articulo]').val(),
                'Edit_Descripcion_articulo': $('textarea[name=Edit_Descripcion_articulo]').val(),
                'Edit_Buen_Estado_request': $('input[name=edit_valor_bueno_request]').val(),
                'Edit_Mal_Estado_request': $('input[name=edit_valor_malo_request]').val(),
                'Edit_Daniado_Estado_request': $('input[name=edit_valor_dañado_request]').val(),
                'edit_cantidad_total_request': $('input[name=edit_cantidad_total_request]').val(),
                'id': $('input[name=id]').val(),
                'imagenes_base64': imagenes_base64
            };
            $.ajax({
                type: 'put',
                url: "{{ route('updateinventarioarticulo', ['id' => ':id']) }}".replace(':id', $('input[name=id]').val()),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify(data),
                contentType: 'application/json',
                success: function(data) {
                    console.log(data)
                    $('#invetario-table').DataTable().ajax.reload();
                    $('#modalEdit').modal('hide');
                    $('#modalEdit form').trigger('reset');
                    $('#edit_valor_bueno_request').val('0');
                    $('#edit_valor_malo_request').val('0');
                    $('#edit_valor_dañado_request').val('0');
                    toastr.options = {
                        "backgroundColor": '#009944',
                        "positionClass": "toast-top-right",
                        "closeButton": true,
                        "progressBar": true,
                        "timeOut": "5000"
                    };
                    if (data.hasOwnProperty('message')) {
                        toastr.success(data.message, "Mensaje de éxito", {"iconClass": 'toast-success'});
                    } else if (data.hasOwnProperty('error')) {
                        toastr.error(data.error, 'Error');
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    toastr.error('<i class="fas fa-exclamation-circle"></i> Error: No se ha podido actualizar los datos.', 'Error');
                }
            });
        });
    });

    //add la tabla modal
    $(document).on('click', '.btn-add', function() {
        var id = $(this).data('id');
        $.ajax({
            type: 'get',
            url: "{{ route('articulos.edit', ['id' => ':id']) }}".replace(':id', id),
            data: {
                'id': id
            },
            success: function(data) {
                $('#id').val(data.id);
                $('#add_cantidad_total_request').text(data.Total_articulo);
                $('#add_nombre_request').text(data.Nombre_articulo);
                $('#modalAdd').modal('show');
            },

            error: function() {
                alert("Error al recibir los datos");
            }
        });

        ///actualizar datos    
        $("#modalAdd .btn-success").off('click').on("click", function() {
          $.ajax({
              type: 'put',
              url: "{{ route('updateinventarioarticulototal', ['id' => ':id']) }}".replace(':id', $('input[name=id]').val()),
              data: {
                  '_token': "{{ csrf_token() }}",
                  'add_cantidad_total_enviar': $('input[name=add_cantidad_total_enviar]').val(),
              },
              success: function(data) {
                  console.log(data);
                  $('#invetario-table').DataTable().ajax.reload();
                  $('#modalAdd').modal('hide');
                  $('#modalAdd form').trigger('reset');
                  $('#add_cantidad_total_enviar').val('0');
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
@notifyJs
@endpush
