@extends('layouts.main', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
@section('content')
<br><br><hr>
<div class="worko-tabs" style="width: 96%; margin: auto;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header card-header-warning">
                <table style="width:100%">
                    <tr>
                        <td><h4 class="card-title">LISTA DE clienteS</h4></td>
                        <td></td>
                        <td style="text-align: right;">
                            <a class="btn btn-danger mb-2 mr-2" href="#" id="addnew" type="button" data-toggle="modal" data-target="#modelId">
                                Add New <i class="fa-sharp fa-solid fa-plus"></i>
                            </a> 
                        </td>                           
                    </tr>
                    </table>
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
                            </colgroup>
                            <thead class="table-head" title="Click to sort">
                                <tr class="table-row">
                                <th class="col-head" scope="col"><center>#</center></th>
                                <th class="col-head" scope="col"><center>IMAGE</center></th>
                                <th class="col-head" scope="col"><center>Nombre Completo</center></th>                                    
                                <th class="col-head" scope="col"><center>C.I / Passaport</center></th>
                                <th class="col-head" scope="col"><center>N Celular</center></th>
                                <th class="col-head" scope="col"><center>Nacionalidad</center></th>
                                <th class="col-head" scope="col"><center>Profesion</center></th>
                                <th class="col-head" scope="col"><center>Estado Civil</center></th>
                                <th class="col-head" scope="col"><center>Edad</center></th>
                                <th class="col-head" scope="col"><center>ACCION</center></th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                                @php
                                    $i=1;
                                @endphp
                                @foreach($clientes as $cliente)
                                    <tr class="table-row">
                                        <td class="cell" style="font-size: 14px;"><center>{{ $i++ }}</center></td>
                                        
                                        <td class="cell" style="font-size: 14px;">
    @if($cliente->imagenes)
        @foreach(json_decode($cliente->imagenes, true) ?? [] as $index => $imagen)
            <img class="cliente-imagen" src="{{ asset('storage/uploads/' . $imagen) }}" style="max-height: 50px;" data-bs-cliente="{{ $cliente->id }}" data-bs-index="{{ $index }}">
        @endforeach
    @else
        NO
    @endif
</td>

<!-- Modal para mostrar todas las imágenes -->
<div id="cliente-modal" class="modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div id="cliente-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-indicators"></div>
                <<div class="carousel-inner"></div>
                <button class="carousel-control-prev" type="button" data-bs-target="#cliente-carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#cliente-carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>

                                        <td class="cell" style="font-size: 14px;">
                                            {{$cliente->Nombre_cliente}}                                           
                                        </td>
                                        <td class="cell" style="font-size: 14px;">
                                            {{$cliente->Documento_cliente}}
                                        </td>                                            
                                        <td class="cell" style="font-size: 14px;">
                                            {{$cliente->Celular_cliente}}
                                        </td>
                                        <td class="cell" style="font-size: 14px; text-align: center;">
                                            {{$cliente->Nacionalidad_cliente}}                                  
                                        </td>
                                        <td style="text-align: center;">
                                            {{$cliente->Profesion_cliente}}
                                        </td>
                                        <td>                                            
                                            {{$cliente->EstadoCivil_cliente}}
                                        </td>
                                        <td>                                            
                                            {{$cliente->Edad_cliente}}
                                        </td>
                                        <td class="cell" style="font-size: 14px;">
                                            <center>                                                               
                                                <ul class="wrapper" style="height: 50px; display: inline-flex;">
                                                    <li class="icon spetie" style="padding:4%">
                                                        <span class="tooltip" style="font-size: 10px;">MOSTRAR</span>
                                                        <a href="{{ route('hostal.ClienteHostal.InformacionCliente', $cliente) }}" style="all: unset;">
                                                          <span><i class="fa-brands fa-readme"></i></span>
                                                        </a>
                                                    </li>
                                                    
                                                    <button class="myButton">
                                                    <li class="icon youtube">
                                                        <span class="tooltip" style="font-size: 10px;">ELIMINAR</span>
                                                        <span><i class="fa-solid fa-trash" ></i></span>
                                                    </li>
                                                    </button>                                                                    
                                                </ul>
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
</div>
<hr>
@include('hostal.clientes.CrearCliente')
@endsection
@notifyCss
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/caja/registrar.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 
<style>
    /* Estilos para el modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.9);
    }

    .modal-content {
        margin: auto;
        display: block;
        max-width: 700px;
    }

    /* Estilos para el botón de cierre */
    .close {
        color: white;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* Estilos para el carrusel */
    .carousel {
        display: flex;
        flex-direction: row;
        overflow-x: auto;
    }

    .carousel img {
        max-height: 500px;
        margin-right: 10px;
    }
</style>
@push('js')
@notifyJs
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $('.select2').select2({
        width: '100%',
        allowClear: false
    });
</script>
<script>
    $(document).ready(function(){
        $("#submitBtn").attr("disabled", "disabled");
        $('.form-control').on("keyup change", function(){
            var complete = true;
            $('.form-control').each(function(){
                if(!$(this).hasClass("optional") && !$(this).val()){
                    complete = false;
                    return false;
                }
            });
            if(complete){
                $("#submitBtn").removeAttr("disabled");
            }else{
                $("#submitBtn").attr("disabled", "disabled");
            }
        });
    });

</script>
<script>
    toastr.options.timeOut = 10000;
    toastr.options.toastClass = 'custom-toast-style';
    toastr.options.backgroundColor = 'red';

    let buttons = document.getElementsByClassName("myButton");
    for (let button of buttons) {
        button.addEventListener("click", function() {
            toastr.error("No Tienes Permiso Para ELIMINAR");
        });
    }
</script>
<script>
   // Obtener el modal y el botón de cierre
var modal = document.getElementById("cliente-modal");
var span = document.getElementsByClassName("close")[0];

// Obtener el carrusel y las imágenes
var carousel = document.getElementById("cliente-carousel");

// Agregar un evento click a cada imagen
var imagenes = document.getElementsByClassName("cliente-imagen");
for (var i = 0; i < imagenes.length; i++) {
    imagenes[i].addEventListener("click", function() {
        // Obtener el identificador del cliente y el índice de la imagen seleccionada
        var clienteId = this.getAttribute("data-bs-cliente");
        var index = parseInt(this.getAttribute("data-bs-index"));

        // Filtrar las imágenes correspondientes al cliente
        var imagenesCliente = Array.from(document.getElementsByClassName("cliente-imagen")).filter(function(img) {
            return img.getAttribute("data-bs-cliente") === clienteId;
        });

        // Agregar las imágenes al carrusel
        var carouselIndicators = carousel.querySelector(".carousel-indicators");
        var carouselInner = carousel.querySelector(".carousel-inner");
        carouselIndicators.innerHTML = "";
        carouselInner.innerHTML = "";
        for (var j = 0; j < imagenesCliente.length; j++) {
            var img = document.createElement("img");
            img.setAttribute("src", imagenesCliente[j].getAttribute("src"));
            img.setAttribute("class", "d-block w-100");
            if (j === index) {
                img.classList.add("active");
            }
            carouselInner.appendChild(img);

            var indicator = document.createElement("button");
            indicator.setAttribute("type", "button");
            indicator.setAttribute("data-bs-target", "#cliente-carousel");
            indicator.setAttribute("data-bs-slide-to", j.toString());
            if (j === index) {
                indicator.classList.add("active");
            }
            carouselIndicators.appendChild(indicator);
        }

        // Inicializar el carrusel
        $('#cliente-carousel').carousel({
            interval: false
        });

        // Mostrar el modal
        modal.style.display = "block";
    });
}


</script>
@endpush


