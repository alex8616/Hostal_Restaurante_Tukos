@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
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
                        <td><h4 class="card-title">LISTA DE PRODUCTOS</h4></td>
                        <td></td>
                        <td style="text-align: right;">
                            <a class="btn btn-danger mb-2 mr-2" href="{{route('hostal.producto.create')}}" data-toggle="modal" data-target="#CreateProduct">
                                Add Product <i class="fa-sharp fa-solid fa-plus"></i>
                            </a>
                            <a class="btn btn-danger mb-2 mr-2" href="{{route('hostal.productos.kardexpdf')}}" target="_blank">
                                Ver Kardex <i class="fa-sharp fa-solid fa-plus"></i>
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
                                <th class="col-head" scope="col"><center>PRODUCTO</center></th>                                    
                                <th class="col-head" scope="col"><center>FECHA REGISTRO</center></th>
                                <th class="col-head" scope="col"><center>STOCK</center></th>
                                <th class="col-head" scope="col"><center>Pre. VENTA</center></th>
                                <th class="col-head" scope="col"><center>Stock Date</center></th>
                                <th class="col-head" scope="col"><center>ACCION</center></th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($productos as $producto)
                                    <tr class="table-row">
                                        <td class="cell" style="font-size: 14px;"><center>{{ $i++ }}</center></td>
                                        <td class="cell" style="font-size: 14px;">
                                            <svg height="60px" width="60px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle style="fill:#324A5E;" cx="256" cy="256" r="256"></circle> <path style="fill:#2B3B4E;" d="M497.89,339.977L331.424,173.511h-26.993l-1.231,84.413l-84.413-84.413h-28.943v106.694 l-60.552,80.305l150.39,150.39C381.233,501.582,465.61,432.969,497.89,339.977z"></path> <path style="fill:#FFD15D;" d="M210.742,203.335h-15.226c-5.251,0-9.525-4.272-9.525-9.523v-15.227c0-5.251,4.272-9.523,9.525-9.523 h15.226c5.251,0,9.525,4.272,9.525,9.523v15.227C220.267,199.063,215.995,203.335,210.742,203.335z M195.517,176.175 c-1.329,0-2.41,1.081-2.41,2.41v15.227c0,1.329,1.081,2.41,2.41,2.41h15.226c1.329,0,2.41-1.081,2.41-2.41v-15.227 c0-1.329-1.081-2.41-2.41-2.41H195.517z"></path> <path style="fill:#F9B54C;" d="M229.323,285.787h-52.388c-8.795,0-15.638-7.646-14.667-16.386l8.849-79.646h64.024l8.849,79.646 C244.962,278.142,238.118,285.787,229.323,285.787z"></path> <path style="fill:#FFD15D;" d="M323.379,203.335h-15.226c-5.251,0-9.525-4.272-9.525-9.523v-15.227c0-5.251,4.272-9.523,9.525-9.523 h15.226c5.251,0,9.525,4.272,9.525,9.523v15.227C332.903,199.063,328.632,203.335,323.379,203.335z M308.153,176.175 c-1.329,0-2.41,1.081-2.41,2.41v15.227c0,1.329,1.081,2.41,2.41,2.41h15.226c1.329,0,2.41-1.081,2.41-2.41v-15.227 c0-1.329-1.081-2.41-2.41-2.41H308.153z"></path> <path style="fill:#FC6F58;" d="M341.959,285.787h-52.388c-8.795,0-15.638-7.646-14.667-16.386l8.849-79.646h64.021l8.849,79.646 C357.597,278.142,350.754,285.787,341.959,285.787z"></path> <path style="fill:#FFFFFF;" d="M355.556,370.64H156.444c-23.564,0-42.667-19.103-42.667-42.667l0,0 c0-23.564,19.103-42.667,42.667-42.667h199.111c23.564,0,42.667,19.103,42.667,42.667l0,0 C398.222,351.537,379.12,370.64,355.556,370.64z"></path> <path style="fill:#E6F3FF;" d="M355.556,285.306h-100.13v85.333h100.13c23.564,0,42.667-19.103,42.667-42.667 S379.12,285.306,355.556,285.306z"></path> <g> <circle style="fill:#84DBFF;" cx="157.737" cy="327.973" r="28.444"></circle> <circle style="fill:#84DBFF;" cx="223.246" cy="327.973" r="28.444"></circle> </g> <g> <circle style="fill:#31BAFD;" cx="288.754" cy="327.973" r="28.444"></circle> <circle style="fill:#31BAFD;" cx="354.263" cy="327.973" r="28.444"></circle> </g> </g></svg>                                         
                                        </td>
                                        <td class="cell" style="font-size: 14px;">
                                            {{ $producto->Nombre_producto }} <br>                                           
                                        </td>
                                        <td class="cell" style="font-size: 14px;">
                                            {{ $producto->FechaRegistro_producto }}
                                        </td>                                            
                                        <td class="cell" style="font-size: 14px; text-align: center;">
                                            {{$producto->Stock_producto}}                                    
                                        </td>
                                        <td style="text-align: center;">
                                            {{$producto->Precio_producto}}
                                        </td>
                                        <td>                                            
                                            @foreach($updateproductos as $otros)
                                            @endforeach
                                            @foreach($updateproductos as $update)
                                                @if($update->producto_id == $producto->id)
                                                        {{ $update->ActualizarStock }}<br>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="cell" style="font-size: 14px;">
                                            <center>                                                               
                                                <ul class="wrapper" style="height: 50px; display: inline-flex;">
                                                    <li class="icon facebook" style="padding:4%" data-toggle="modal" data-target="#Actualizar{{ $producto->id }}">
                                                        <span class="tooltip" style="font-size: 10px;">AGREGAR_STOCK</span>
                                                        <span><i class="fa-sharp fa-solid fa-plus"></i></span>
                                                    </li>
                                                    @include('hostal.productos.actualizarproduct')
                                                    <li class="icon facebook" style="padding:4%" data-toggle="modal" data-target="#vender{{ $producto->id }}">
                                                        <span class="tooltip" style="font-size: 10px;">VENDER_PRODUCTO</span>
                                                        <span><i class="fa-sharp fa-solid fa-cart-shopping"></i></span>
                                                    </li>
                                                    @include('hostal.productos.venderproduct')
                                                    <li class="icon facebook" style="padding:4%" data-toggle="modal" data-target="#MostrarPdf{{ $producto->id }}">
                                                        <span class="tooltip" style="font-size: 10px;">DETALLE</span>
                                                        <span><i class="fa-solid fa-print"></i></span>
                                                    </li>
                                                    @include('hostal.productos.MostrarPdf')
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
@include('hostal.productos.create')
@endsection
@notifyCss
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/caja/registrar.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 
@push('js')
@notifyJs
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
@endpush


