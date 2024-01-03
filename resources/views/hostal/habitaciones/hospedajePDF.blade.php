<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!--Author      : @arboshiki-->
<div id="invoice">

    <div class="toolbar hidden-print">
        <hr>
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <div class="row">
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <h3 class="to">                            
                            <table class="table" style="font-size: 11px;">
                                <tr scope="col" style="text-align:left;">
                                    <th style="background-color: #4597d5;  border: 1px solid;">Nombre Completo</th>
                                    <th style="background-color: #4597d5;  border: 1px solid;">C.I / Passaporte</th>
                                    <th style="background-color: #4597d5;  border: 1px solid;">N Celular</th>
                                    <th style="background-color: #4597d5;  border: 1px solid;">Profesion</th>
                                    <th style="background-color: #4597d5;  border: 1px solid;">Edad</th>
                                    <th style="background-color: #4597d5;  border: 1px solid;">Estado Civil</th>
                                </tr>
                                @foreach($clientes as $cliente)
                                    @foreach($detallehospedajes as $detallehospedaje)
                                        @if($cliente->id == $detallehospedaje->cliente_id)
                                        <tr>
                                            <td>
                                                {{$cliente->Nombre_cliente}}<br>
                                            </td>
                                            <td>
                                                {{$cliente->Documento_cliente}}<br>
                                            </td>
                                            <td>
                                                79431192
                                            </td>
                                            <td>
                                                {{$cliente->Profesion_cliente}}<br>
                                            </td>
                                            <td>
                                                {{$cliente->Edad_cliente}}<br>
                                            </td>
                                            <td>                                                    
                                                {{$cliente->EstadoCivil_cliente}}<br>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </table>
                        </h3>                   
                    </div><br>
                    <div class="col invoice-details">
                        <h1 class="invoice-id">{{$hospedajes->Nombre_habitacion}} - 
                            {{$hospedajes->CategoriaHabitacion}}
                        </h1>
                        <table id="newtable" style="font-size: 14px;">
                            <tr style="background: red;">
                                <td>
                                    <strong>Procedencia:</strong> {{$hospedajes->procedencia_hospedaje}}
                                    <br><br><strong>Destino:</strong> {{$hospedajes->destino_hospedaje}}
                                </td>
                                <td colspan="" style="width: 300px;">
                                </td>
                                <td>
                                    <strong>Fecha Ingreso:</strong> {{$hospedajes->ingreso_hospedaje}}
                                    <br><br><strong>Fecha Salida:</strong> {{$hospedajes->salida_hospedaje}}
                                </td>
                            </tr>                           
                        </table>
                    </div>
                </div>
                @php
                    $i=1;
                @endphp
                <table class="table" style="font-size: 13px;">
                    <thead>
                        <tr>
                            <th scope="col" colspan="2" style="background-color: #4597d5; border: 1px solid; text-align:left;"># Habitacion</th>
                            <th style="background-color: #4597d5; border: 1px solid; text-align:left;"># Noches</th>
                            <th style="background-color: #4597d5; border: 1px solid; text-align:left;">Precio Noche</th>
                            <th style="background-color: #4597d5; border: 1px solid; text-align:left;">Total</th>                
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2">{{$hospedajes->Nombre_habitacion}}</td>
                            <td>{{intval($hospedajes->dias_hospedarse)}}</td>
                            <td>{{$hospedajes->Precio_habitacion}}</td>
                            <th style="background-color: #243763; border: 1px solid;">{{$hospedajes->Total}}</th>
                        </tr>
                        <tr>
                            <th scope="col" style="background-color: #4597d5; border: 1px solid;">Nombre Servicio</th>
                            <th scope="col" style="background-color: #4597d5; border: 1px solid;">Cant. De Servicios</th>
                            <th scope="col" style="background-color: #4597d5; border: 1px solid;">Precio Unitario</th>
                            <th scope="col" style="background-color: #4597d5; border: 1px solid;">Incluye Servicio</th>
                            <th scope="col" style="background-color: #4597d5; border: 1px solid;">Total</th>                
                        </tr>
                        <tr>
                            <td>Desayuno</td>
                            <td>{{$NDesayuno}}</td>
                            <td>S/N</td>
                            <td>SI</td>
                            <th style="background-color: #4597d5; border: 1px solid;">S/N</th>
                        </tr>
                        <tr>
                            <td>Limpieza</td>
                            <td>{{$NLimpieza}}</td>
                            <td>S/N</td>
                            <td>SI</td>
                            <th style="background-color: #4597d5; border: 1px solid;">S/N</th>
                        </tr>
                            @foreach($detalleservicios as $detalleservicio)
                                @if($detalleservicio->hospedaje_habitacion_id == $hospedajes->hospedaje_habitacion_id && $detalleservicio->Incluye_servicio == 'NO')
                                <tr>
                                    <td>{{$detalleservicio->Nombre_servicio}}</td>
                                    <td>{{$detalleservicio->cantidad_servicio}}</td>
                                    <td>{{$detalleservicio->Precio_servicio}}</td>
                                    <td>{{$detalleservicio->Incluye_servicio}}</td>
                                    <th style="background-color: #243763; border: 1px solid;">{{$detalleservicio->cantidad_servicio * $detalleservicio->Precio_servicio}}</th>
                                </tr>
                                @endif
                            @endforeach
                        @if($NProducto > 0)
                        <tr>
                            <th scope="col" style="background-color: #4597d5; border: 1px solid;">Nombre producto</th>
                            <th scope="col" style="background-color: #4597d5; border: 1px solid;">Producto Pagado</th>
                            <th scope="col" style="background-color: #4597d5; border: 1px solid;">Cant. De Producto</th>
                            <th scope="col" style="background-color: #4597d5; border: 1px solid;">Precio Unitario</th>
                            <th scope="col" style="background-color: #4597d5; border: 1px solid;">Total</th>                
                        </tr>
                        @foreach($productos as $producto)
                            @if($producto->hospedaje_habitacion_id == $hospedajes->hospedaje_habitacion_id && $producto->Tipo_pagado == 'Por Paga')
                            <tr>
                                <td>{{$producto->Nombre_producto}}</td>
                                <td>{{$producto->Tipo_pagado}}</td>
                                <td>{{$producto->cantidad}}</td>
                                <td>{{$producto->Precio_venta}}</td>
                                <th style="background-color: #243763; border: 1px solid;">{{$producto->cantidad * $producto->Precio_venta}}</th>
                            </tr>
                            @endif
                            @if($producto->hospedaje_habitacion_id == $hospedajes->hospedaje_habitacion_id && $producto->Tipo_pagado == 'Pagado')
                            <tr>
                                <td>{{$producto->Nombre_producto}}</td>
                                <td>{{$producto->Tipo_pagado}}</td>
                                <td>{{$producto->cantidad}}</td>
                                <td>{{$producto->Precio_venta}}</td>
                                <th style="background-color: #4597d5; border: 1px solid;">S/N</th>
                            </tr> 
                            @endif
                        @endforeach
                        @endif
                        @if($hospedajes->Adelanto == 0)
                        <tr>
                            <th colspan="4" style="background-color: #243763;"><center>TOTAL GENERAL</center></th>
                            <th style="background-color: #243763; border: 1px solid;">{{$hospedajes->TotalGeneralHospedaje}}</th>
                        </tr>
                        @else                        
                        <tr>
                            <th style="background-color: #243763; border: 1px solid;">TOTAL GENERAL: {{$hospedajes->TotalGeneralHospedaje}}</th>
                            <th style="background-color: #243763; border: 1px solid;">ADELANTO: {{$hospedajes->Adelanto}}</th>
                            <th colspan="2" style="background-color: #243763; border: 1px solid;">TOTAL DEUDA: </th>
                            <th style="background-color: #243763; border: 1px solid;">{{$hospedajes->TotalGeneralHospedaje - $hospedajes->Adelanto}}</th>
                        </tr>
                        @endif                            
                    </tbody>
                </table>
                    
                </footer><br>
                <div class="notices">
                    <div>Reccecionado por:</div>
                    <div class="notice">{{ Auth::user()->name }} - {{ Auth::user()->email }}</div>
                </div>
            </main>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>
<style>
    
    .invoice {
        position: relative;
        background-color: #FFF;
        min-height: 680px;
    }

    .invoice header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #3989c6
    }

    .invoice .company-details {
        text-align: right
    }

    .invoice .company-details .name {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .invoice-to {
        text-align: left
    }

    .invoice .invoice-to .to {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .invoice-details {
        text-align: right
    }

    .invoice .invoice-details .invoice-id {
        margin-top: 0;
        color: #3989c6
    }

    .invoice main .thanks {
        margin-top: -100px;
        font-size: 2em;
        margin-bottom: 50px
    }

    .invoice main .notices {
        padding-left: 6px;
        border-left: 6px solid #3989c6
    }

    .invoice main .notices .notice {
        font-size: 1.2em
    }

    .invoice table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
    }

    .invoice table td,.invoice table th {
        padding: 8px;
        background: #eee;
        border-bottom: 1px solid #fff
    }

    .invoice table th {
        white-space: nowrap;
        font-weight: 400;
        font-size: 16px
    }

    .invoice table td h3 {
        margin: 0;
        font-weight: 400;
        color: #3989c6;
        font-size: 1.2em
    }

    .invoice table .qty,.invoice table .total,.invoice table .unit {
        text-align: right;
        font-size: 1.2em
    }

    .invoice table .no {
        color: #fff;
        font-size: 1.6em;
        background: #3989c6
    }

    .invoice table .unit {
        background: #ddd
    }

    .invoice table .total {
        background: #3989c6;
        color: #fff
    }

    .invoice table tbody tr:last-child td {
        border: none
    }

    .invoice table tfoot td {
        background: 0 0;
        border-bottom: none;
        white-space: nowrap;
        text-align: right;
        padding: 10px 20px;
        font-size: 1.2em;
        border-top: 1px solid #aaa
    }

    .invoice table tfoot tr:first-child td {
        border-top: none
    }

    .invoice table tfoot tr:last-child td {
        color: #3989c6;
        font-size: 1.4em;
        border-top: 1px solid #3989c6
    }

    .invoice table tfoot tr td:first-child {
        border: none
    }

    .invoice footer {
        width: 100%;
        text-align: center;
        color: #777;
        border-top: 1px solid #aaa;
        padding: 8px 0
    }

    @media print {
        .invoice {
            font-size: 11px!important;
            overflow: hidden!important
        }

        .invoice footer {
            position: absolute;
            bottom: 10px;
            page-break-after: always
        }

        .invoice>div:last-child {
            page-break-before: always
        }
    }
    table tr th{ 
        background-color: red;   
        color: white;
    }
</style>
