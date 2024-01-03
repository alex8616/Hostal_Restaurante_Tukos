@extends('layouts.main', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
@section('content')
<br>
    <form onsubmit="validar();" action="{{ route('hostal.habitacion.ProductoStore') }}" method="POST">
    @csrf
    <div class="row" style="margin:auto;">
        <div class="col-md-12">        
            <div class="card div_radius">
                <div class="alert alert--danger">
                    <input type="text" id="AdelantoHospedaje" name="AdelantoHospedaje" value="{{$hospedajes->Adelanto}}" style="color:black;" hidden>
                    <input  class="buton" type="button" id="boton_calc" value="Costo" hidden>
                    @if($hospedajes->Adelanto == 0)
                        <h3>El Cliente No Dejo Ningun Adelanto Y tiene Una Deuda TOTAL de <strong><input type="text" id="TotalGeneralHospedaje" name="TotalGeneralHospedaje" style="color:black; width: 90px;" readonly></strong>
                            <pre style="font-size: 13px; color:red;">"Nota el total se esta sumando servicios extra y venta de productos"</pre>
                        </h3>
                    @else
                        <h3>El Cliente Dejo Un Adelanto de <strong><input type="text" id="AdelantoHospedaje" name="AdelantoHospedaje" value="{{$hospedajes->Adelanto}}" style="color:black; width: 90px;" readonly></strong> 
                            Y tiene Una Deuda TOTAL de <strong><input type="text" id="TotalGeneralHospedaje" name="TotalGeneralHospedaje" style="color:black; width: 90px;" readonly></strong>
                            <pre style="font-size: 13px; color:red;">"Nota el total se esta sumando servicios extra y venta de productos"</pre>
                        </h3>
                    @endif
                </div>
                <style>
                    .alert {
                        margin:auto;
                        background: white;
                        width: 99%;
                        display: flex;
                        padding: 1rem;
                        align-items: center;
                        border-radius: 0.8rem;
                        border: 2px solid;
                        margin-top: 1rem;
                        position: relative;
                        box-shadow: 0px 5px 12px rgba(0, 0, 0, .04), 0px 12px 25px rgba(0, 0, 0, .07);
                        animation: transitionIn 200ms ease forwards;
                        transition: all 200ms ease;
                    }
                    .alert__message {
                        color: #677b7a;
                    }
                    .alert__close {
                        width: 1.3rem;
                        height: 1.3rem;
                        line-height: 1.3rem;
                        color: #677b7a;
                        text-align: center;
                        position: absolute;
                        top: 0.5rem;
                        right: 0.5rem;
                        cursor: pointer;
                        border-radius: 0.4rem;
                    }
                    .alert__close:hover, .alert__close:focus {
                        background: rgba(103, 123, 122, .2);
                    }
                    .alert__icon {
                        margin-right: 1rem;
                        width: 36px;
                        height: 36px;
                        animation: fade 500ms linear forwards;
                    }
                    .alert__icon-path {
                        stroke-dasharray: 1000;
                        stroke-dashoffset: 1000;
                        stroke-width: 4px;
                        animation: dash 1s ease forwards;
                    }
                    .alert__icon-path--type {
                        animation-delay: 300ms;
                        animation-duration: 5s;
                    }
                    .alert--success {
                        color: #39d7b3;
                        border-color: #39d7b3;
                    }
                    .alert--warning {
                        color: #ffba4b;
                        border-color: #ffba4b;
                    }
                    .alert--danger {
                        color: #ff4555;
                        border-color: #ff4555;
                    }
                    @keyframes dash {
                        from {
                            stroke-dashoffset: 1000;
                        }
                        to {
                            stroke-dashoffset: 0;
                        }
                    }
                </style>
                    <div class="form-row" style="margin: 10px;">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm table-hover __web-inspector-hide-shortcut__">
                                <tr>
                                    <th style="background:#D0D3D4; aling-text: center">
                                        <center>
                                            <button type="button" class="button button5" id="btnproducto" data-toggle="modal" data-target="#modelProducto">
                                                PRODUCTOS
                                            </button>
                                        </center>
                                    </th>
                                    <th style="background:#D0D3D4; aling-text: center">
                                        <center>
                                            <button type="button" class="button button5" id="btndesayuno" data-toggle="modal" data-target="#modelServicioDesayuno">
                                                DESAYUNO
                                            </button>                                   
                                        </center>
                                    </th>
                                    <th colspan="2" style="text-align: center; background:#D0D3D4;">INFORMACION DE PASAJEROS</th>
                                    <th style="background:#D0D3D4; aling-text: center">
                                        <center>
                                            <button type="button" class="button button5" id="btnlimpieza" data-toggle="modal" data-target="#modelServicioLimpieza">
                                                LIMPIEZA
                                            </button>
                                        </center>
                                    </th>
                                    <th style="background:#D0D3D4; aling-text: center">
                                        <center>
                                            <button type="button" class="button button5" data-toggle="modal" data-target="#modelServicio">
                                                SERVICIOS EXTRAS
                                            </button>
                                        </center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>C.I - PASSAPORT</th>
                                    <th>NOMBRE COMPLETA</th>
                                    <th>NACIONALIDAD</th>
                                    <th>PROFESION</th>
                                    <th>EDAD</th>
                                    <th>ESTADO CIVIL</th>
                                </tr>
                                @foreach($detalleshospedajes as $detalleshospedaje)
                                    @foreach($clientes as $cliente)
                                        @if($detalleshospedaje->cliente_id == $cliente->id && $detalleshospedaje->hospedaje_habitacion_id == $hospedajes->id)
                                        <input class="otraclase" id="hospedaje_habitacion_id" type="text" 
                                        name="hospedaje_habitacion_id" value="{{$detalleshospedaje->hospedaje_habitacion_id}}" hidden>
                                            <tr>
                                                <td>{{$cliente->Documento_cliente}}</td>
                                                <td>{{$cliente->Nombre_cliente}}</td>
                                                <td>{{$cliente->Nacionalidad_cliente}}</td>
                                                <td>{{$cliente->Profesion_cliente}}</td>
                                                <td>{{$cliente->Edad_cliente}}</td>
                                                <td>{{$cliente->EstadoCivil_cliente}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach 
                                <tr>
                                    <td colspan="6" style="align-content: center;">Puedes Añadir Hospedajes invitados haciendo click <a data-toggle="modal" data-target="#modelId" style="color:blue">!!AQUI!!</a> 
                                    @include('hostal.habitaciones.CrearHospedajeInvitado')
                                    </td>
                                </tr>
                                @if($contInvitado > 0)
                                    <table class="table table-bordered table-sm table-hover __web-inspector-hide-shortcut__">
                                        <tr>
                                            <th colspan="9" style="text-align: center; background:#D0D3D4;"><strong>INFORMACION DE CLIENTES INVITADOS</strong></th>
                                        </tr>
                                        <tr>
                                            <th>C.I - PASSAPORT</th>
                                            <th>NOMBRE COMPLETA</th>
                                            <th>NACIONALIDAD</th>
                                            <th>PROFESION</th>
                                            <th>EDAD</th>
                                            <th>ESTADO CIVIL</th>
                                            <th>INGRESO / SALIDA</th>
                                            <th>TOTAL</th>
                                            <th>PAGADO</th>
                                        </tr>
                                        <tbody id="tabla_venta_productos_temp"> 
                                            @foreach ($full_hospedajes as $full_hospedaje)
                                                @if($full_hospedaje->hospedaje_habitacion_id == $hospedajes->id)
                                                    @php
                                                        $invitado_total = $full_hospedaje->invitado_Total;
                                                        $pagado = $full_hospedaje->Pagado;
                                                    @endphp                                               
                                                    @foreach ($full_hospedaje->detalles as $index => $detalle)
                                                        @if($full_hospedaje->Pagado == 'NO')                                                    
                                                        <tr>
                                                            <td>{{ $detalle->Documento_cliente }}</td>
                                                            <td>{{ $detalle->Nombre_cliente }} - {{ $detalle->Apellido_cliente }}</td>
                                                            <td>{{ $detalle->Nacionalidad_cliente }}</td>
                                                            <td>{{ $detalle->Profesion_cliente }}</td>
                                                            <td>{{ $detalle->Edad_cliente }}</td>
                                                            <td>{{ $detalle->EstadoCivil_cliente }}</td>
                                                            <td>{{ $full_hospedaje->invitado_ingreso_hospedaje }}</td>
                                                            @if ($index === 0)
                                                                <td rowspan="{{ count($full_hospedaje->detalles) }}">{{ $invitado_total }}</td>
                                                                <td rowspan="{{ count($full_hospedaje->detalles) }}">{{ $pagado }}</td>
                                                            @endif                                                       
                                                        </tr>
                                                        @else
                                                        <tr>
                                                            <td><del>{{ $detalle->Documento_cliente }}</del></td>
                                                            <td><del>{{ $detalle->Nombre_cliente }} - {{ $detalle->Apellido_cliente }}</del></td>
                                                            <td><del>{{ $detalle->Nacionalidad_cliente }}</del></td>
                                                            <td><del>{{ $detalle->Profesion_cliente }}</del></td>
                                                            <td><del>{{ $detalle->Edad_cliente }}</del></td>
                                                            <td><del>{{ $detalle->EstadoCivil_cliente }}</del></td>
                                                            <td><del>{{ $full_hospedaje->invitado_ingreso_hospedaje }}</del></td>
                                                            @if ($index === 0)
                                                                <td rowspan="{{ count($full_hospedaje->detalles) }}"><del>{{ $invitado_total }}</del></td>
                                                                <td rowspan="{{ count($full_hospedaje->detalles) }}"><del>{{ $pagado }}</del></td>
                                                            @endif                                                        
                                                        </tr>
                                                        @endif
                                                    @endforeach
                                                @endif                                                    
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="text-align: right" colspan="9">TOTAL:  <input type="text" id="totalinvitado" name="totalinvitado" value="{{$total_invitados}}"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                @else
                                    <input type="text" id="totalinvitado" name="totalinvitado" value="0" hidden>
                                @endif                       
                                <table class="table table-bordered table-sm table-hover __web-inspector-hide-shortcut__">
                                    <tr>
                                        <th colspan="4" style="text-align: center; background:#D0D3D4;">INFORMACION DE HOSPEDAJE</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>{{$habitacion->Nombre_habitacion}}</strong> 
                                        </td>
                                        <td>
                                            <strong>PRECIO DE LA HABITACION: {{$habitacion->Precio_habitacion}} Bs.</strong>
                                        </td>
                                        <td>
                                            <strong>TIPO DE HABITACION: </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>INGRESO FECHA:</strong> {{ \Carbon\Carbon::parse($hospedajes->ingreso_hospedaje)->format('d-m-Y') }}
                                        </td>
                                        <td>
                                            <strong>INGRESO HORA:</strong> {{ \Carbon\Carbon::parse($hospedajes->created_at)->format('H:i a') }}
                                        </td>
                                        <td>
                                            <strong>SALIDA FECHA:</strong> {{ \Carbon\Carbon::parse($hospedajes->salida_hospedaje)->format('d-m-Y') }}
                                        </td>
                                        <td>
                                            <strong>TOTAL DIAS:</strong> {{$hospedajes->dias_hospedarse}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <strong>PROCEDENTE DE:</strong> {{$hospedajes->procedencia_hospedaje}}
                                        </td>
                                        <td colspan="2">
                                            <strong>DESTINO:</strong> {{$hospedajes->destino_hospedaje}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>PRECIO DE HABITACION:</strong> {{$hospedajes->Precio_habitacion}}
                                        </td>
                                        <td>
                                            @if($hospedajes->Adelanto > 0)
                                                <strong style="color:green">SE DEJO UN ADELANTO DE:</strong> {{$hospedajes->Adelanto}}
                                            @else
                                                <strong style="color:red">NO SE DEJO NINGUN ADELANTO</strong>
                                            @endif
                                        </td>
                                        <td>
                                            @if($hospedajes->PrecioRestante > 0)
                                                <strong style="color:red">DEUDA A PAGAR:</strong> {{$hospedajes->PrecioRestante}}
                                            @else
                                                <strong style="color:green">NO TIENE NINGUNA DEUDA</strong>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>TOTAL:</strong> <input type="text" id="totalhospedaje" name="totalhospedaje" value="{{$hospedajes->Total}}">
                                        </td>
                                    </tr>
                                </table>
                                <table class="table table-bordered table-sm table-hover __web-inspector-hide-shortcut__">
                                    <tr>
                                        <th colspan="7" style="text-align: center; background:#D0D3D4;"><strong>INFORMACION DE PRODUCTOS</strong></th>
                                    </tr>
                                    <tr>
                                        <th>N</th>
                                        <th>Producto Nombre</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Tipo Pago</th>
                                        <th>Sub Total</th>
                                    </tr>
                                    <tbody id="tabla_venta_productos_temp">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach($detalleshospedajes as $detalleshospedaje)
                                        @endforeach
                                        @foreach($detalleproductos as $detalleproducto)
                                            @if($hospedajes->id == $detalleproducto->hospedaje_habitacions)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$detalleproducto->Nombre_producto}}</td>
                                                <td>{{$detalleproducto->cantidad}}</td>
                                                <td>{{$detalleproducto->Precio_producto}}</td>
                                                <td>{{$detalleproducto->Tipo_pagado}}</td>
                                                <td>{{$detalleproducto->cantidad*$detalleproducto->Precio_producto}}</td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th style="text-align: right" colspan="6">TOTAL:  <input type="text" id="totalproduct" name="totalproduct" value="{{$hospedajes->TotalProducto}}"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <table class="table table-bordered table-sm table-hover __web-inspector-hide-shortcut__">
                                    <tr>
                                        <th colspan="7" style="text-align: center; background:#D0D3D4;"><strong>INFORMACION DE SERVICIOS</strong></th>
                                    </tr>
                                    <tr>
                                        <th>N</th>
                                        <th>Servicio</th>
                                        <th>Detalle</th>
                                        <th>Fecha</th>
                                        <th>Servicios Hospedaje</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Sub Total</th>
                                    </tr>
                                    <tbody id="tabla_venta_productos_temp">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach($detalleservicios as $detalleservicio)
                                            @if($hospedajes->id == $detalleservicio->hospedaje_habitacion_id)
                                                @if($detalleservicio->Incluye_servicio == 'SI')
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$detalleservicio->Nombre_servicio}}</td>
                                                    <td>{{$detalleservicio->FechaRegistro_servicio}}</td>
                                                    <td colspan="4" style="text-align: center;">INCLUYE EL HOSPEDAJE</td>
                                                </tr>
                                                @else
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$detalleservicio->Nombre_servicio}}</td>
                                                    <td>{{$detalleservicio->detalle}}</td>
                                                    <td>{{$detalleservicio->FechaRegistro_servicio}}</td>
                                                    <td>Servicio EXTRA</td>
                                                    <td>{{$detalleservicio->Precio_servicio}}</td>
                                                    <td>{{$detalleservicio->cantidad_servicio}}</td>
                                                    <td>{{$detalleservicio->cantidad_servicio*$detalleservicio->Precio_servicio}}</td>
                                                </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th style="text-align: right" colspan="8">TOTAL:  <input type="text" id="TotalServicioSum" name="TotalServicioSum" value="{{$hospedajes->TotalServicio}}"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </table>
                        </div>
                        @include('hostal.habitaciones.VenderProducto')
                        </form>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger btn-lg btn-block"data-toggle="modal" data-target="#TipoPago">
                            <strong style="font-size: 15px;">C O N C L U I R - H O S P E D A J E</strong>
                        </button>                
                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-lg" id="TipoPago" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document" style="height: 800px;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">METODO DE PAGO</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('updatehabitacion', $habitacion->id) }}">
                                        @method('PUT')
                                        @csrf
                                            <input type="text" id="caja_id" name="caja_id" value="{{ $ultimo_registro->id }}" hidden>
                                            <input type="text" id="habitacion_id" name="habitacion_id" value="{{$habitacion->id}}" hidden>
                                            <input type="text" id="TotalGeneralHospedaje2" name="TotalGeneralHospedaje2" style="color:black;" hidden>
                                            <input type="text" id="Hospedaje_id" name="Hospedaje_id" value="{{$hospedajes->id}}" hidden>
                                            <label for="">Tipo De Pago a Realizarse</label>
                                            <div class="payment-cards">
                                                <div class="payment-card">
                                                    <input type="radio" id="payment1" name="payment" value="EFECTIVO" style="pointer-events: none;" required>
                                                    <label for="payment1">
                                                        <svg id="svgmoney" width="256px" height="256px" viewBox="-4.56 -4.56 33.12 33.12" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" fill="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(1.1999999999999993,1.1999999999999993), scale(0.9)"><rect x="-4.56" y="-4.56" width="33.12" height="33.12" rx="16.56" fill="#ffffff" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g transform="translate(0 -1028.4)"> <g> <rect height="14" width="24" y="1031.4" x="0" fill="#16a085"></rect> <rect height="14" width="24" y="1032.4" x="-1.0962e-8" fill="#1abc9c"></rect> <path d="m5 1033.4c0.0001 0 0 0 0 0 0 2.2-1.7909 4-4 4v3.9c2.2091 0 4 1.8 4 4.1h14v-0.1c0-2.2 1.791-4 4-4v-3.9c-2.209 0-4-1.8-4-4h-14z" fill="#ecf0f1"></path> <path d="m16 11c0 2.761-1.791 5-4 5-2.2091 0-4-2.239-4-5 0-2.7614 1.7909-5 4-5 2.209 0 4 2.2386 4 5z" transform="translate(0 1028.4)" fill="#1abc9c"></path> </g> <path d="m10.281 1037.1 2.472-0.7h0.247v5c0 0.3 0.022 0.5 0.067 0.6 0.05 0.1 0.15 0.1 0.3 0.2h0.914v0.2h-3.82v-0.2h0.929c0.139-0.1 0.237-0.1 0.292-0.2s0.082-0.3 0.082-0.6v-3.2c0-0.5-0.025-0.7-0.075-0.9-0.035-0.1-0.1-0.1-0.195-0.2h-0.329c-0.185 0-0.442 0-0.772 0.1l-0.112-0.1" fill="#ecf0f1"></path> <g transform="matrix(1.9176 0 0 1.1179 18.509 -118.14)" fill="#ecf0f1"> <g transform="translate(-18.773 13.418)"> <path d="m40 5c-0.875 0-1.642 0.2021-2.188 0.5h-0.812v0.2812 0.1563 0.0625 0.0625 0.4375c0 0.8285 1.343 1.5 3 1.5s3-0.6715 3-1.5v-0.4375-0.0625-0.0625-0.1563-0.2812h-0.812c-0.546-0.2979-1.313-0.5-2.188-0.5z" transform="matrix(.52148 0 0 .89455 -9.6523 1024.7)" fill="#f39c12"></path> <path d="m42 7.5c0 0.8284-1.343 1.5-3 1.5s-3-0.6716-3-1.5 1.343-1.5 3-1.5 3 0.6716 3 1.5z" transform="matrix(.52148 0 0 .89455 -9.1309 1022.9)" fill="#f1c40f"></path> </g> <g fill="#ecf0f1"> <g transform="translate(-18.773 11.629)"> <path d="m40 5c-0.875 0-1.642 0.2021-2.188 0.5h-0.812v0.2812 0.1563 0.0625 0.0625 0.4375c0 0.8285 1.343 1.5 3 1.5s3-0.6715 3-1.5v-0.4375-0.0625-0.0625-0.1563-0.2812h-0.812c-0.546-0.2979-1.313-0.5-2.188-0.5z" transform="matrix(.52148 0 0 .89455 -9.6523 1024.7)" fill="#f39c12"></path> <path d="m42 7.5c0 0.8284-1.343 1.5-3 1.5s-3-0.6716-3-1.5 1.343-1.5 3-1.5 3 0.6716 3 1.5z" transform="matrix(.52148 0 0 .89455 -9.1309 1022.9)" fill="#f1c40f"></path> </g> <g transform="translate(-18.773 9.8401)"> <path d="m40 5c-0.875 0-1.642 0.2021-2.188 0.5h-0.812v0.2812 0.1563 0.0625 0.0625 0.4375c0 0.8285 1.343 1.5 3 1.5s3-0.6715 3-1.5v-0.4375-0.0625-0.0625-0.1563-0.2812h-0.812c-0.546-0.2979-1.313-0.5-2.188-0.5z" transform="matrix(.52148 0 0 .89455 -9.6523 1024.7)" fill="#f39c12"></path> <path d="m42 7.5c0 0.8284-1.343 1.5-3 1.5s-3-0.6716-3-1.5 1.343-1.5 3-1.5 3 0.6716 3 1.5z" transform="matrix(.52148 0 0 .89455 -9.1309 1022.9)" fill="#f1c40f"></path> </g> <g transform="translate(-18.773 8.0509)"> <path d="m40 5c-0.875 0-1.642 0.2021-2.188 0.5h-0.812v0.2812 0.1563 0.0625 0.0625 0.4375c0 0.8285 1.343 1.5 3 1.5s3-0.6715 3-1.5v-0.4375-0.0625-0.0625-0.1563-0.2812h-0.812c-0.546-0.2979-1.313-0.5-2.188-0.5z" transform="matrix(.52148 0 0 .89455 -9.6523 1024.7)" fill="#f39c12"></path> <path d="m42 7.5c0 0.8284-1.343 1.5-3 1.5s-3-0.6716-3-1.5 1.343-1.5 3-1.5 3 0.6716 3 1.5z" transform="matrix(.52148 0 0 .89455 -9.1309 1022.9)" fill="#f1c40f"></path> </g> <g transform="translate(-15.123 13.418)"> <path d="m40 5c-0.875 0-1.642 0.2021-2.188 0.5h-0.812v0.2812 0.1563 0.0625 0.0625 0.4375c0 0.8285 1.343 1.5 3 1.5s3-0.6715 3-1.5v-0.4375-0.0625-0.0625-0.1563-0.2812h-0.812c-0.546-0.2979-1.313-0.5-2.188-0.5z" transform="matrix(.52148 0 0 .89455 -9.6523 1024.7)" fill="#f39c12"></path> <path d="m42 7.5c0 0.8284-1.343 1.5-3 1.5s-3-0.6716-3-1.5 1.343-1.5 3-1.5 3 0.6716 3 1.5z" transform="matrix(.52148 0 0 .89455 -9.1309 1022.9)" fill="#f1c40f"></path> </g> <g transform="translate(-14.08 12.524)"> <path d="m40 5c-0.875 0-1.642 0.2021-2.188 0.5h-0.812v0.2812 0.1563 0.0625 0.0625 0.4375c0 0.8285 1.343 1.5 3 1.5s3-0.6715 3-1.5v-0.4375-0.0625-0.0625-0.1563-0.2812h-0.812c-0.546-0.2979-1.313-0.5-2.188-0.5z" transform="matrix(.52148 0 0 .89455 -9.6523 1024.7)" fill="#f39c12"></path> <path d="m42 7.5c0 0.8284-1.343 1.5-3 1.5s-3-0.6716-3-1.5 1.343-1.5 3-1.5 3 0.6716 3 1.5z" transform="matrix(.52148 0 0 .89455 -9.1309 1022.9)" fill="#f1c40f"></path> </g> <g transform="translate(-18.773 6.2618)"> <path d="m40 5c-0.875 0-1.642 0.2021-2.188 0.5h-0.812v0.2812 0.1563 0.0625 0.0625 0.4375c0 0.8285 1.343 1.5 3 1.5s3-0.6715 3-1.5v-0.4375-0.0625-0.0625-0.1563-0.2812h-0.812c-0.546-0.2979-1.313-0.5-2.188-0.5z" transform="matrix(.52148 0 0 .89455 -9.6523 1024.7)" fill="#f39c12"></path> <path d="m42 7.5c0 0.8284-1.343 1.5-3 1.5s-3-0.6716-3-1.5 1.343-1.5 3-1.5 3 0.6716 3 1.5z" transform="matrix(.52148 0 0 .89455 -9.1309 1022.9)" fill="#f1c40f"></path> </g> </g> </g> </g> </g></svg>
                                                        <p style="background: white; color: black; font-weight:bold; font-variant: small-caps;">. PAGO - EN - EFECTIVO .</p>
                                                    </label>
                                                </div>
                                                <div class="payment-card">
                                                    <input type="radio" id="payment2" name="payment" value="TARJETA" style="pointer-events: none;" required>
                                                    <label for="payment2">
                                                        <svg id="svgtarjeta" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-97.28 -97.28 706.56 706.56" xml:space="preserve" width="256px" height="256px" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(25.599999999999994,25.599999999999994), scale(0.9)"><rect x="-97.28" y="-97.28" width="706.56" height="706.56" rx="353.28" fill="#ffffff" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="11.264"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#FFDC64;" d="M441.379,229.517H335.448V476.69h105.931c4.875,0,8.828-3.953,8.828-8.828V238.345 C450.207,233.47,446.254,229.517,441.379,229.517z"></path> <rect x="379.586" y="229.517" style="fill:#5B5D6E;" width="35.31" height="247.172"></rect> <rect x="335.448" y="229.517" style="fill:#FFC850;" width="26.483" height="247.172"></rect> <path style="fill:#5B5D6E;" d="M308.966,512H97.103c-19.501,0-35.31-15.809-35.31-35.31V105.931c0-19.501,15.809-35.31,35.31-35.31 h211.862c19.501,0,35.31,15.809,35.31,35.31V476.69C344.276,496.191,328.467,512,308.966,512z"></path> <g> <path style="fill:#464655;" d="M105.931,476.69V105.931c0-19.501,15.809-35.31,35.31-35.31H97.103 c-19.501,0-35.31,15.809-35.31,35.31V476.69c0,19.501,15.809,35.31,35.31,35.31h44.138C121.74,512,105.931,496.191,105.931,476.69z "></path> <path style="fill:#464655;" d="M308.966,141.241H97.103c-4.879,0-8.828-3.953-8.828-8.828c0-4.875,3.948-8.828,8.828-8.828h211.862 c4.879,0,8.828,3.953,8.828,8.828C317.793,137.289,313.845,141.241,308.966,141.241z"></path> </g> <g> <path style="fill:#C7CFE2;" d="M207.448,335.448h-8.828c-9.751,0-17.655-7.904-17.655-17.655l0,0 c0-9.751,7.904-17.655,17.655-17.655h8.828c9.751,0,17.655,7.904,17.655,17.655l0,0 C225.103,327.544,217.199,335.448,207.448,335.448z"></path> <path style="fill:#C7CFE2;" d="M207.448,406.069h-8.828c-9.751,0-17.655-7.904-17.655-17.655l0,0 c0-9.751,7.904-17.655,17.655-17.655h8.828c9.751,0,17.655,7.904,17.655,17.655l0,0 C225.103,398.165,217.199,406.069,207.448,406.069z"></path> </g> <path style="fill:#FFDC64;" d="M207.448,476.69h-8.828c-9.751,0-17.655-7.904-17.655-17.655l0,0c0-9.751,7.904-17.655,17.655-17.655 h8.828c9.751,0,17.655,7.904,17.655,17.655l0,0C225.103,468.786,217.199,476.69,207.448,476.69z"></path> <g> <path style="fill:#C7CFE2;" d="M286.897,335.448h-8.828c-9.751,0-17.655-7.904-17.655-17.655l0,0 c0-9.751,7.904-17.655,17.655-17.655h8.828c9.751,0,17.655,7.904,17.655,17.655l0,0 C304.552,327.544,296.648,335.448,286.897,335.448z"></path> <path style="fill:#C7CFE2;" d="M286.897,406.069h-8.828c-9.751,0-17.655-7.904-17.655-17.655l0,0 c0-9.751,7.904-17.655,17.655-17.655h8.828c9.751,0,17.655,7.904,17.655,17.655l0,0 C304.552,398.165,296.648,406.069,286.897,406.069z"></path> </g> <path style="fill:#C8FF82;" d="M286.897,476.69h-8.828c-9.751,0-17.655-7.904-17.655-17.655l0,0c0-9.751,7.904-17.655,17.655-17.655 h8.828c9.751,0,17.655,7.904,17.655,17.655l0,0C304.552,468.786,296.648,476.69,286.897,476.69z"></path> <g> <path style="fill:#C7CFE2;" d="M128,335.448h-8.828c-9.751,0-17.655-7.904-17.655-17.655l0,0c0-9.751,7.904-17.655,17.655-17.655 H128c9.751,0,17.655,7.904,17.655,17.655l0,0C145.655,327.544,137.751,335.448,128,335.448z"></path> <path style="fill:#C7CFE2;" d="M128,406.069h-8.828c-9.751,0-17.655-7.904-17.655-17.655l0,0c0-9.751,7.904-17.655,17.655-17.655 H128c9.751,0,17.655,7.904,17.655,17.655l0,0C145.655,398.165,137.751,406.069,128,406.069z"></path> </g> <path style="fill:#FF507D;" d="M128,476.69h-8.828c-9.751,0-17.655-7.904-17.655-17.655l0,0c0-9.751,7.904-17.655,17.655-17.655H128 c9.751,0,17.655,7.904,17.655,17.655l0,0C145.655,468.786,137.751,476.69,128,476.69z"></path> <path style="fill:#B4E66E;" d="M300.138,167.724H105.931c-4.875,0-8.828,3.953-8.828,8.828V256c0,4.875,3.953,8.828,8.828,8.828 h194.207c4.875,0,8.828-3.953,8.828-8.828v-79.448C308.966,171.677,305.013,167.724,300.138,167.724z"></path> <polygon style="fill:#E4EAF8;" points="275.862,8.828 251.586,0 227.31,8.828 203.034,0 178.759,8.828 154.483,0 130.207,8.828 105.931,0 105.931,141.241 300.138,141.241 300.138,0 "></polygon> <path style="fill:#707487;" d="M264.828,105.931h-35.31c-4.879,0-8.828-3.953-8.828-8.828c0-4.875,3.948-8.828,8.828-8.828h35.31 c4.879,0,8.828,3.953,8.828,8.828C273.655,101.978,269.707,105.931,264.828,105.931z"></path> <g> <path style="fill:#7F8499;" d="M194.207,105.931h-52.966c-4.879,0-8.828-3.953-8.828-8.828c0-4.875,3.948-8.828,8.828-8.828h52.966 c4.879,0,8.828,3.953,8.828,8.828C203.034,101.978,199.086,105.931,194.207,105.931z"></path> <path style="fill:#7F8499;" d="M264.828,70.621h-17.655c-4.879,0-8.828-3.953-8.828-8.828s3.948-8.828,8.828-8.828h17.655 c4.879,0,8.828,3.953,8.828,8.828S269.707,70.621,264.828,70.621z"></path> <path style="fill:#7F8499;" d="M211.862,70.621h-17.655c-4.879,0-8.828-3.953-8.828-8.828s3.948-8.828,8.828-8.828h17.655 c4.879,0,8.828,3.953,8.828,8.828S216.742,70.621,211.862,70.621z"></path> </g> <path style="fill:#707487;" d="M158.897,70.621h-17.655c-4.879,0-8.828-3.953-8.828-8.828s3.948-8.828,8.828-8.828h17.655 c4.879,0,8.828,3.953,8.828,8.828S163.776,70.621,158.897,70.621z"></path> <rect x="105.931" y="123.586" style="fill:#D5DCED;" width="194.207" height="17.655"></rect> <g> <path style="fill:#C8FF82;" d="M199.769,243.242l34.878-52.318c1.58-2.37-0.119-5.545-2.967-5.545h-50.404 c-2.952,0-5.707,1.475-7.345,3.93l-34.915,52.373c-1.565,2.347,0.118,5.49,2.938,5.49h50.471 C195.377,247.172,198.133,245.697,199.769,243.242z"></path> <path style="fill:#C8FF82;" d="M243.907,243.242l34.879-52.318c1.58-2.37-0.119-5.545-2.967-5.545h-15.095 c-2.952,0-5.707,1.475-7.345,3.93l-34.915,52.373c-1.565,2.347,0.118,5.49,2.938,5.49h15.16 C239.514,247.172,242.271,245.697,243.907,243.242z"></path> </g> </g></svg>
                                                        <p style="background: white; color: black; font-weight:bold; font-variant: small-caps;">. PAGO - CON - TARJETA .</p>
                                                    </label>
                                                </div>
                                                <div class="payment-card">
                                                    <input type="radio" id="payment3" name="payment" value="DEPOSITO" style="pointer-events: none;" required>
                                                    <label for="payment3">
                                                        <svg id="svgdeposito" width="256px" height="256px" viewBox="-24.32 -24.32 176.64 176.64" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--noto" preserveAspectRatio="xMidYMid meet" fill="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(6.399999999999999,6.399999999999999), scale(0.9)"><rect x="-24.32" y="-24.32" width="176.64" height="176.64" rx="88.32" fill="#ffffff" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M64.64 3.84c-1.67.2-53.72 35.1-54.02 36.16c-.3 1.07-.42 12.19-.42 12.19l6.71 2.13l.03 8.84l3.59 7.35v31.07l-2.68 5.85l-7.35 2.17v5.26l-5.76 1.75s.08 4.51.08 5.26s.25 2.34 3.26 2.34s112.87-.51 113.98-.51s2.26-.22 2.32-2.21s-.06-4.8-.06-4.8l-5.58-2.76l-.02-4.41l-9.08-2.8l-2.19-6.2l.03-29.21l3.48-7.34l1.05-1.99v-7.9l5.85-2.21s.11-11.43-.06-11.76c-.15-.32-51.78-36.43-53.16-36.27z" fill="#cddfee"></path><path d="M15.33 42.32c-.31.77-.39 6.45-.11 6.73c.28.28 96.94.13 97.27-.14c.33-.27.38-6.44.22-6.82S85.3 23.1 85.3 23.1l-42.13.21c-.01 0-27.66 18.55-27.84 19.01z" fill="#94adbc"></path><path d="M4.74 116.63c-.09-.22 0-1.26 0-1.68s.4-.9 1.3-.9s115.14-.16 115.7-.14c1.41.05 2.36.35 2.5 1.25c.14.9.09 1.55.09 1.55l-119.59-.08z" fill="#94adbc"></path><path d="M118.73 109.53l-108.22.08s.04-1.11.04-1.49c0-.38.2-1 1.49-1s103.92-.39 104.8-.39s1.84.41 1.96 1.02s-.07 1.78-.07 1.78z" fill="#94adbc"></path><path fill="#94adbc" d="M108.26 102.83l-.8-2.34l-86.95-.02l-.65 2.61z"></path><path fill="#94adbc" d="M19.51 68.38l89.26.31l-1.28 2.62l-86.95.33z"></path><path d="M17.56 64.7s-.79-.57-.92-1.32c-.13-.75.22-1.19.22-1.19l95.16-.21s.36.74.05 1.26c-.31.53-1.19 1.01-1.19 1.01l-93.32.45z" fill="#94adbc"></path><path d="M10.2 52.19l107.67-.32s.07 1.03 0 1.46c-.06.43-.62.81-2.05.81h-1.43s-100.79.5-101.91.5s-1.92-.62-2.11-1.12c-.11-.33-.17-1.33-.17-1.33z" fill="#94adbc"></path><path fill="#657582" d="M18.01 45.03l22.65-15.29l1.52 15.59z"></path><path fill="#657582" d="M87.55 29.23l22.68 16H86.94z"></path><path fill="#54636e" d="M33.41 64.63l3.73-.01l2.92 7.01l-.27 28.86l-2.43 6.54l-4.34.01l-2.39-6.51l-.11-28.96z"></path><path fill="#54636e" d="M53.27 64.53l-3.71 6.94l.28 29.02l2.2 6.49l24.23-.1l2.18-6.39l.06-29.08l-2.83-6.99z"></path><path fill="#54636e" d="M91.37 64.35l3.29-.02l2.91 7.01l-.01 29.16l-1.69 6.32l-5.49.01l-1.68-6.33l-.13-29.13z"></path><path fill="#6ba4ae" d="M54.62 106.97V84.72l19.52.19l.04 22z"></path><path fill="#a5d0d7" d="M63.26 83.71l-.01 23.23l2.02-.01V84.05z"></path><path d="M54.62 85.78V80.2h19.52v5.58s-19.35-.17-19.52 0z" fill="#95acbc"></path><path d="M54.62 80.2h19.52s.08-1.74-1.73-1.91s-15.11-.03-16.23 0c-1.67.05-1.56 1.91-1.56 1.91z" fill="#ccdeed"></path><path d="M64.39 11.11c-14.49.09-25.96 11.55-25.47 26.04S52.7 61.83 64.39 61.74c12.27-.09 25.19-8.87 25.77-24.67c.59-15.79-12.71-26.05-25.77-25.96z" fill="#cddfee"></path><path d="M64.48 14.58c-12.13.08-21.84 10.03-21.43 22.65c.4 12.62 11.08 20.62 20.87 20.71c11.29.1 21.68-7.28 22.16-21.03s-10.67-22.4-21.6-22.33z" fill="#94adbc"></path><path d="M60.98 21.63s-.22-3.86.05-4.19c.27-.33 1.37-.33 3.5-.33c2.14 0 3.01 0 3.34.27s.16 4.49.16 4.49s2.9 1.09 4.71 2.49c1.92 1.48 3.29 3.45 3.18 3.78c-.11.33-3.94 3.67-4.49 3.56c-.55-.11-3.67-3.76-7.39-4c-5.91-.38-5.86 4.22-2.19 5.48c3.67 1.26 15.24 2.26 14.79 11.47c-.38 7.75-8.21 8.3-8.21 8.3s.22 2.9 0 3.07s-7.12.27-7.34-.05s-.05-3.29-.05-3.29s-3.07-.6-5.59-2.3c-2.52-1.7-4.33-3.94-4.38-4.22c-.05-.27 4.44-4.05 4.76-4.16s4.89 4.39 9.2 4.76c4.38.38 6.24-3.94.16-5.8c-6.08-1.86-13.25-3.45-12.92-11.06c.33-7.73 8.71-8.27 8.71-8.27z" fill="#024fac"></path></g></svg>
                                                        <p style="background: white; color: black; font-weight:bold; font-variant: small-caps;">. PAGO - CON - DEPOSITO .</p>
                                                    </label>
                                                    <input type="text" id="Ndeposito" name="Ndeposito" style="display: none;">
                                                </div>
                                            </div>                                
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">CONFIRMAR</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div> 
            </div>    
        </div>
    </div>
</div>

<div class="modal fade" id="modelServicio" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="height: 440px">
            <div class="modal-header">
                <h5 class="modal-title">Servicio Extra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form action="{{ route('hostal.habitacion.ServicioStore') }}" method="POST">
            @csrf
            <div class="modal-body">                
                <input class="otraclase" id="hospedaje_habitacion_id" type="text" 
                        name="hospedaje_habitacion_id" value="{{$hospedajes->id}}" hidden>
                <input type="text" id="user_id" name="user_id" value="{{Auth::user()->id}}" hidden>
                <div class="form-row" style="margin: 10px;">
                    <div class="col-md-6">
                        <label for="inputNombre"  class="is-required">Nombre Del Servicio</label><br>
                        <select class="otraclase" name="servicio_hostals_id" id="servicio_hostals_id" size="7">
                            @foreach($servicios as $servicio)
                                <option value="{{$servicio->id}}">{{$servicio->Nombre_servicio}}</option>
                            @endforeach    
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="FechaRegistro_servicio_extra">Detalle . .</label>
                        <textarea class="otraclase" type="datetime" id="detalle" name="detalle" cols="100" rows="6"></textarea>
                    </div>
                </div>
                <div class="form-row" style="margin: 10px;">
                    <div class="col-md-3" hidden>
                        <label for="FechaRegistro_servicio_extra">Fecha Registro</label>
                        <input class="otraclase" type="datetime" id="FechaRegistro_servicio_extra" name="FechaRegistro_servicio_extra" value="<?php echo date("Y-m-d H:i:s") ?>" readonly>
                    </div><br>
                    <div class="col-md-4">
                        <label for="cantidad_servicio_extra">Cantidad</label>
                        <input class="otraclase" type="text" id="cantidad_servicio_extra" name="cantidad_servicio_extra" oninput="sum()">
                    </div>
                    <div class="col-md-4">
                        <label for="Precio_servicio_extra">Precio Servicio</label>
                        <input class="otraclase" type="text" id="Precio_servicio_extra" name="Precio_servicio_extra" oninput="sum()">
                    </div>
                    <div class="col-md-4">
                        <label for="TotalServicio_extra">Total A Pagar</label>
                        <input class="otraclase" type="text" id="TotalServicio_extra" name="TotalServicio_extra">
                        <script>
                            try {function sum() {
                                var a1 = document.getElementById('cantidad_servicio_extra').value; 
                                var a2 = document.getElementById('Precio_servicio_extra').value;                                   
                                var a3 = document.getElementById('TotalServicio_extra');                                     
                                var a4 = a1 * a2;
                                console.log(a2);
                                a3.value = a4;
                                }
                            } catch (error) { throw error; }
                        </script>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" size="2" aria-label="Default select example" id="Incluye_servicio" name="Incluye_servicio" hidden>
                            <option value="Incluye El Hospedaje">Incluye El Hospedaje</option>
                            <option value="NO" selected>Servicio Extra</option>
                        </select>
                    </div>
                </div>
                <div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="venta_productos_realizada" class="btn btn-dark">
                        <i class="fas fa-check-circle text-success"></i>
                        Aceptar
                    </button>
                </div>
                </div>
            </div>
            
            </form>
        </div>
    </div>
</div>
@include('hostal.habitaciones.ServicioDesayuno')
@include('hostal.habitaciones.ServicioLimpieza')

@endsection
@notifyCss
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/bottonfooder.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/>
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
    .ServicioStoree {
        overflow-x: auto;
    }

    #svgmoney {
        width: 160px;
        height: 120px;
    }

    #svgtarjeta{
        width: 160px;
        height: 120px;
    }

    #svgdeposito{
        width: 160px;
        height: 120px;
    }

    .payment-cards {
        display: flex;
        justify-content: space-between;
    }

    .payment-card {
        background-image: url('/img/black3.jpeg');
        background-size: cover; /* ajusta el tamaño de la imagen al div */
        background-position: center center; /* centra la imagen en el div */
        width: 45%;
        display: flex;
        align-items: center;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 10px;
        cursor: pointer;
        margin: 10px; /* auto para centrar horizontalmente */
        justify-content: center; /* centrar horizontalmente */
        align-items: center; /* centrar verticalmente */
        flex-direction: column; /* agregar dirección de columna para apilar los elementos verticalmente */
    }

    .payment-card input[type="radio"] {
    display: none;
    }

    .payment-card label {
    margin-left: 5px;
    }

    .payment-card {
    border: 1px solid #ccc;
    padding: 10px;
    transition: border-color 0.2s ease-in-out;
    }

    .payment-card.selected {
    border-color: #0d6efd;
    border-width: 2px;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
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
    .linea {
        margin:0px 20px;
        width:30%;    
        border-top:1px solid #999;
        position: relative;
        top:10px;
        float:left;
    }

    .leyenda {
        float:left;
    }
    .button5{
        border: none;
        color: black;
        padding: 8px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
        border-radius: 20px;
    }
    .button5 {
    background-color: white;
    color: black;
    border: 2px solid #555555;
    }

    .button5:hover {
    background-color: #555555;
    color: white;
    }
    .ui-menu .ui-menu-item a {
    font-size: 12px;
    }
    .ui-autocomplete {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1510 !important;
    float: left;
    display: none;
    min-width: 160px;
    width: 160px;
    padding: 4px 0;
    margin: 2px 0 0 0;
    list-style: none;
    background-color: #ffffff;
    border-color: #ccc;
    border-color: rgba(0, 0, 0, 0.2);
    border-style: solid;
    border-width: 1px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -webkit-background-clip: padding-box;
    -moz-background-clip: padding;
    background-clip: padding-box;
    *border-right-width: 2px;
    *border-bottom-width: 2px;
    }
    .ui-menu-item > a.ui-corner-all {
        display: block;
        padding: 3px 15px;
        clear: both;
        font-weight: normal;
        line-height: 18px;
        color: #555555;
        white-space: nowrap;
        text-decoration: none;
    }
    .ui-state-hover, .ui-state-active {
        color: #ffffff;
        text-decoration: none;
        background-color: #0088cc;
        border-radius: 0px;
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        background-image: none;
    }
</style>
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="http://momentjs.com/downloads/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
<script>
    var ah = document.getElementById("AdelantoHospedaje");
    var th = document.getElementById("totalhospedaje");
    var tp = document.getElementById("totalproduct");
    var ci = document.getElementById("totalinvitado");
    var ts = document.getElementById("TotalServicioSum");
    var ih = document.getElementById("invitado_Total");
    var boton_de_calcular = document.getElementById("boton_calc");
    boton_de_calcular.addEventListener("click", res);
    function res() {
        var totales = ((th.value*1) + (tp.value*1) + (ts.value*1) + (ci.value*1))-ah.value;
        var totalgeneral = ((th.value*1) + (tp.value*1) + (ts.value*1) + (ci.value*1));
        var SumTotalFull = ((th.value*1) + (tp.value*1) + (ts.value*1));
        document.getElementById("TotalGeneralHospedaje").value=totales.toFixed(2);
        document.getElementById("TotalGeneralHospedaje2").value=totalgeneral.toFixed(2);
    }
    var tiempo = 1000;
    // intervalo
    var interval = setInterval(function() {
    $('#boton_calc').trigger('click');
    }, tiempo);
</script>
<script type="text/javascript">
    var path_producto = "{{ route('autocompletehostalproducto') }}";
    $( "#seach_product" ).autocomplete({
        source: function( request, response ) {
        $.ajax({
            url: path_producto,
            type: 'GET',
            dataType: "json",
            data: {
            search: request.term
            },
            success: function( data ) {
                response( data );
            },
            error: function () {
                response([]); }
        });
        },
        select: function (event, ui) {
        $('#seach_product').val(ui.item.label);
        $('#producto_id').val(ui.item.id);
        $('#Precio_producto').val(ui.item.Precio_producto);
        $('#Stock_producto').val(ui.item.Stock_producto);
        console.log(ui.item); 
        return false;
        }
    });
</script>
<script>
    $(document).ready(function() {
        $("#agregar_product").click(function() {
            agregar_product();
        });
    });

    var cont_product = 1;
    total = 0;
    subtotal = [];
    $("#guardar").hide();

    function agregar_product() {
        datosIdProducto = document.getElementById('producto_id').value.split('_');
        datosNombreProduct = document.getElementById('seach_product').value.split('_');
        datosPrecioProduct = document.getElementById('Precio_producto').value.split('_');
        datosStockProduct = document.getElementById('Stock_producto').value.split('_');
        datosTipoPagoProduct = $("#tippagado").val();
        cantidad = $("#cantidad").val();
        producto_id = datosIdProducto[0];
        console.log(datosTipoPagoProduct);
        producto = $("#producto_id option:selected").text();
            if (producto_id != "" && cantidad != "" && cantidad > 0 && datosPrecioProduct != "") {
                if (parseInt(datosStockProduct) >= parseInt(cantidad)) {
                    subtotal[cont_product] = (cantidad * datosPrecioProduct);
                    total = total + subtotal[cont_product];
                    var fila = '<tr id="fila' + cont_product +
                        '"><td>'+ cont_product +'</td> <td><input type="hidden" name="datosIdProducto[]" value="' +
                        datosIdProducto + '">' + datosNombreProduct + '</td> <td> <input type="hidden" name="cantidad[]" value="' +
                        cantidad + '"> <input type="number" value="' + cantidad +
                        '" class="form-control" disabled> <input type="hidden" name="datosStockProduct[]" value="' +
                        datosStockProduct + '"> <input type="number" value="' + datosStockProduct +
                        '" class="form-control" disabled hidden> </td><td> <input type="hidden" name="datosPrecioProduct[]" value="' +
                        parseFloat(datosPrecioProduct).toFixed(2) + '"> <input class="form-control" type="number" value="' +
                        parseFloat(datosPrecioProduct).toFixed(2) + 
                        '" disabled> </td> <td> <input type="hidden" name="datosTipoPagoProduct[]" value="' +
                        datosTipoPagoProduct + '"> <input type="text" value="' + datosTipoPagoProduct +
                        '" class="form-control" disabled> </td> <td align="right">Bs ' + parseFloat(subtotal[cont_product]).toFixed(
                            2) + '</td><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar_product(' + cont_product +
                        ');"><i class="fa fa-trash-alt"></i></button></td></tr>';
                    cont_product++;
                    limpiar_product();
                    totales_product();
                    $('#detalles').append(fila);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lo siento',
                        text: 'La cantidad a vender supera el stock.',
                    })
                }
            }else {
            Swal.fire({
                icon: 'error',
                title: 'Lo siento',
                text: 'NO seleccionaste Nada ...',
            })
        }
    }

    function limpiar_product() {
        $("#cantidad").val("");
        $("#producto_id").val("");
        $("#seach_product").val("");
        $("#Stock_producto").val("");
        $("#Precio_producto").val("");
    }
    function totales_product() {
        $("#total").html("Bs " + total.toFixed(2));
        total_pagar = total;
        $("#total_pagar_html").html("Bs " + total_pagar.toFixed(2));
        $("#total_pagar").val(total_pagar.toFixed(2));
    }

    function eliminar_product(index) {
        total = total - subtotal[index];
        total_pagar_html = total;
        $("#total").html("Bs" + total);
        $("#total_pagar_html").html("Bs" + total_pagar_html.toFixed(2));
        $("#total_pagar").val(total_pagar_html.toFixed(2));
        $("#fila" + index).remove();
        evaluar();
    }
</script>
<script>
    document.getElementById("venta_productos_realizada").addEventListener("click", function(){
        document.getElementById("venta_productos_realizada").style.display = "none";
    });
</script>
<script>
  $(document).ready(function() {
    // Manejar el evento de cambio de selección de pago
    $('input[type="radio"][name="payment"]').change(function() {
      // Remover la clase "selected" de todas las tarjetas de pago
      $('.payment-card').removeClass('selected');
      // Agregar la clase "selected" al div de la tarjeta seleccionada
      $(this).closest('.payment-card').addClass('selected');
    });
  });
</script>
<script>
      const payment3 = document.getElementById('payment3');
      const inputToShow = document.getElementById('Ndeposito');

      payment3.addEventListener('change', function() {
        if (payment3.checked) {
          inputToShow.style.display = 'block';
        } else {
          inputToShow.style.display = 'none';
        }
      });
</script>
<script>
    $("#add_employee_form").submit(function(e) {
    e.preventDefault(); // Agrega esta línea para evitar que se envíe el formulario y se recargue la página
    
    const fd = new FormData($('#add_employee_form')[0]);
    const submitBtn = $(this).find('button[type="submit"]');
    
    submitBtn.text('Adding...');
    
        $.ajax({
            url: '{{ route('store') }}',
            method: 'post',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
            if (response.status == 200) {
                // Aquí obtienes los datos del cliente que acabas de agregar
                const cliente_id = response.cliente.id;
                const identificacion = response.cliente.Documento_cliente;
                const nombre = response.cliente.Nombre_cliente;
                const nacionalidad = response.cliente.Nacionalidad_cliente;
                const profesion = response.cliente.Profesion_cliente;
                const edad = response.cliente.Edad_cliente;
                const estado_civil = response.cliente.EstadoCivil_cliente;
                
                // Creas una nueva fila con los datos del cliente
                const fila = '<tr class="selected" id="fila' + cont +
                    '"><td class="text-center">' + cont + '</td><td><input type="hidden" name="cliente_id[]" value="' +
                    cliente_id + '">' + identificacion +'</td><td><input type="hidden" name="" value="' +
                    nombre + '">' + nombre +'</td><td><input type="hidden" name="" value="' +
                    nacionalidad + '">' + nacionalidad +'</td><td><input type="hidden" name="" value="' +
                    profesion + '">' + profesion +'</td><td><input type="hidden" name="" value="' +
                    edad + '">' + edad +'</td><td><input type="hidden" name="" value="' +
                    estado_civil + '">' + estado_civil +'</td><td class="text-center"><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont +
                    ');"><i class="zmdi zmdi-close"></i></button></td></tr>';
                
                cont++;
                // Agregas la fila a la tabla
                $('#detalles_cliente').append(fila);
                
                // Agregas el ID del cliente a la lista de clientes agregados
                addedUsers.push(cliente_id);
                
                // Agregar la clase "nueva-fila" a la fila recién agregada
            $('#detalles_cliente tr:last').addClass('nueva-fila');

            // Después de 5 segundos, eliminar la clase "nueva-fila" de la fila
            setTimeout(function() {
                $('#detalles_cliente tr:last').removeClass('nueva-fila');
            }, 5000);

                // esconder los inputs
                $("#form_cliente").hide();
                
                toastr.options = {
                    "backgroundColor": '#009944',
                    "positionClass": "toast-top-right",
                    "closeButton": true,
                    "progressBar": true,
                    "timeOut": "5000"
                };
                toastr.success("Se ha Agregado a la tabla Correctamente.", "Mensaje de éxito", {
                    "iconClass": 'toast-success'
                }); 
            }
        },
        complete: function() {
            $("#add_employee_form").fadeIn();
            submitBtn.text('Submit');
        }
    });
    $("#add_employee_form").fadeOut();
        vaciar(); // Llamada a la función vaciar() para esconder los inputs
    });
</script>
<script type="text/javascript">
    var path_cliente = "{{ route('autocompletehostalcliente') }}";
    $( "#Documento_cliente" ).autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: path_cliente,
                type: 'GET',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function( data ) {
                    response( data );
                },
                error: function () {
                    response([]); }
                });
            },
            select: function (event, ui) {
                $('#Documento_cliente').val(ui.item.Documento_cliente);
                $('#cliente_id').val(ui.item.id);
                $('#Nombre_cliente').val(ui.item.Nombre_cliente);
                $('#Apellido_cliente').val(ui.item.Apellido_cliente);
                $('#Nacionalidad_cliente').val(ui.item.Nacionalidad_cliente);
                $('#Profesion_cliente').val(ui.item.Profesion_cliente);
                $('#Edad_cliente').val(ui.item.Edad_cliente);
                $('#EstadoCivil_cliente').val(ui.item.EstadoCivil_cliente);
                agregar();
                return false;
            },
            response: function(event, ui) {
                if (!ui.content.length) {
                    $("#form_cliente").show();                    
                } else {
                    $("#form_cliente").hide();
                }
            }
    });

    $(document).ready(function() {
        $('#Documento_cliente').on('input', function() {
            if ($(this).val() === '') {
                $('#cliente_id').val('');
                $('#Nombre_cliente').val('');
                $('#Apellido_cliente').val('');
                $('#Nacionalidad_cliente').val('');
                $('#Profesion_cliente').val('');
                $('#Edad_cliente').val('');
                $('#EstadoCivil_cliente').val('');
                $("#form_cliente").hide();
            }
        });
    });
</script>
<script>
    //Arreglo para almacenar los ID de los usuarios agregados a la tabla
    var addedUsers = [];

    $(document).ready(function() {
        $("#agregar").click(function() {
            agregar();
        });
    });

    var cont = 1;

    function agregar() {
        datosProducto = document.getElementById('cliente_id').value.split('_');
        datosclienteid = document.getElementById('cliente_id').value.split('_');
        datosidentificacion = document.getElementById('Documento_cliente').value.split('_');
        datosNombre = document.getElementById('Nombre_cliente').value.split('_');
        datosNacionalidad = document.getElementById('Nacionalidad_cliente').value.split('_');
        datosProfesion = document.getElementById('Profesion_cliente').value.split('_');
        datosEdad = document.getElementById('Edad_cliente').value.split('_');
        datosEstadoCivil = document.getElementById('EstadoCivil_cliente').value.split('_');

        cliente_id = datosProducto[0];

        cliente = $("#cliente_id option:selected").text();

        //Comprobar si el ID del usuario seleccionado ya se encuentra en el arreglo de usuarios agregados
        if (addedUsers.indexOf(cliente_id) != -1) {
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

                toastr.error('<i class="fas fa-exclamation-circle"></i> Error: No se puede agregar en la tabla por que ya esta en la tabla.', 'Error');
              
                return;
            }
            if (cliente_id != "") {
            var fila = '<tr class="selected" id="fila' + cont +
                '"><td class="text-center">' + cont + '</td><td><input type="hidden" name="cliente_id[]" value="' +
                cliente_id + '">' + datosidentificacion +'</td><td><input type="hidden" name="" value="' +
                Nombre_cliente + '">' + datosNombre +'</td><td><input type="hidden" name="" value="' +
                Nacionalidad_cliente + '">' + datosNacionalidad +'</td><td><input type="hidden" name="" value="' +
                Profesion_cliente + '">' + datosProfesion +'</td><td><input type="hidden" name="" value="' +
                Edad_cliente + '">' + datosEdad +'</td><td><input type="hidden" name="" value="' +
                EstadoCivil_cliente + '">' + datosEstadoCivil +'</td><td class="text-center"><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont +
                ');"><i class="zmdi zmdi-close"></i></button></td></tr>';
            cont++;
            $('#detalles_cliente').append(fila);
            vaciar();
            //Agregar el ID del usuario seleccionado al arreglo de usuarios agregados
            addedUsers.push(cliente_id);
            
            // Agregar la clase "nueva-fila" a la fila recién agregada
            $('#detalles_cliente tr:last').addClass('nueva-fila');

            // Después de 5 segundos, eliminar la clase "nueva-fila" de la fila
            setTimeout(function() {
                $('#detalles_cliente tr:last').removeClass('nueva-fila');
            }, 5000);

            toastr.options = {
                "backgroundColor": '#009944',
                "positionClass": "toast-top-right",
                "closeButton": true,
                "progressBar": true,
                "timeOut": "5000"
            };
            toastr.success("Se ha Agregado a la tabla Correctamente.", "Mensaje de éxito", {
                "iconClass": 'toast-success'
            }); 
        } else {
        Swal.fire({
            icon: 'error',
            title: 'Lo siento',
            text: 'NO seleccionaste Nada ...',
            });
        }
    }
    function eliminar(index) {
        datosProducto = document.getElementById('cliente_id').value.split('_');
        cliente_id = datosProducto[0];
        $("#fila" + index).remove();
        addedUsers.splice(addedUsers.indexOf(cliente_id), 1); // Eliminar el ID del usuario del arreglo
    }
    function vaciar() {
        $("#Documento_cliente").val("");
        $("#cliente_id").val("");
        $("#Nombre_cliente").val("");
        $("#Apellido_cliente").val("");
        $("#Nacionalidad_cliente").val("");
        $("#Profesion_cliente").val("");
        $("#Edad_cliente").val("");
        $("#EstadoCivil_cliente").val("");
    }
</script>
<script>
    function removeRedBorder(input) {
        input.classList.remove('red-border');
    }

    function checkInputValue() {
        const inputs = document.querySelectorAll('.validate-input');
        for (let i = 0; i < inputs.length; i++) {
            const input = inputs[i];
            if (input.value) {
                input.classList.remove('red-border');
            } else {
                input.classList.add('red-border');
            }
        }
    }

</script>
<script>
    function calcularEdad() {
    var fechaNacimiento = new Date(document.getElementById("FechaNacimiento").value);
    var fechaActual = new Date();
    var edad = fechaActual.getFullYear() - fechaNacimiento.getFullYear();
    if (fechaActual.getMonth() < fechaNacimiento.getMonth() || 
        (fechaActual.getMonth() == fechaNacimiento.getMonth() && fechaActual.getDate() < fechaNacimiento.getDate())) {
        edad--;
    }
    document.getElementById("Edad_cliente").value = edad;
    }
</script>
<script>
    const fileInput = document.getElementById('file-input');
    const imagePreview = document.getElementById('image-preview');

    fileInput.addEventListener('change', function() {
    imagePreview.innerHTML = ''; // Limpiar vista previa de imágenes

    // Recorrer todas las imágenes cargadas
    for (let i = 0; i < fileInput.files.length; i++) {
        const file = fileInput.files[i];

        // Crear objeto URL para la imagen cargada
        const imageUrl = URL.createObjectURL(file);

        // Crear un elemento de imagen para la vista previa
        const image = document.createElement('img');
        image.src = imageUrl;

        // Agregar la imagen a la vista previa
        imagePreview.appendChild(image);
    }
    });
    image.addEventListener('load', function() {
        URL.revokeObjectURL(imageUrl);
    });
</script>
/*Sacar Valor Del Select*/
<script>
    function PreciCategoria() {
        var select = document.getElementById("CategoriaHabitacion_reserva");
        var input = document.getElementById("Precio_habitacion_reserva");
        switch (select.value) {
            case 'SIMPLE':
                input.value = 100;
                break;
            case 'DOBLE':
                input.value = 200;
                break;
            case 'TRIPLE':
                input.value = 300;
                break;
            case 'MATRIMONIAL':
                input.value = 400;
                break;
            default:
                input.value = 0;
                break;
        }
    }
</script>
<script>
    const input = document.getElementById('salida_reserva');
    const select = document.getElementById('CategoriaHabitacion_reserva');
    const error = document.getElementById('select-error');

    select.addEventListener('change', function() {
        if (select.value === '') {
            input.disabled = true;
        } else {
            input.disabled = false;
        }
    });

    input.addEventListener('click', function() {
        if (select.value === '') {
            error.style.display = 'block';
            select.classList.add('border-rojo');
        } else {
            error.style.display = 'none';
            select.classList.remove('border-rojo');
        }
    });
</script>
@notifyJs
@endpush