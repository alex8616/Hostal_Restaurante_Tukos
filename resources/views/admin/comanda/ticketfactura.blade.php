<?php
$medidaTicket = 310;

?>
<!DOCTYPE html>
<html>

<head>

    <style>
        * {
            font-size: 12px;
            font-family: 'DejaVu Sans', serif;
        }

        h1 {
            font-size: 18px;
        }

        .ticket {
            margin: 2px;
        }

        
        #contenido {
            border-top: 1px solid black;
            border-collapse: collapse;
            margin: 0 auto;
            width: 94%;
        }

        td.precio {
            text-align: center;
            font-size: 11px;
            border-top: 1px solid black;
            border-collapse: collapse;
            margin: 0 auto;
            width: 94%;
        }

        td.cantidad {
            font-size: 11px;
            border-top: 1px solid black;
            border-collapse: collapse;
            margin: 0 auto;
            width: 94%;
        }

        td.producto {
            text-align: center;
            border-top: 1px solid black;
            border-collapse: collapse;
            margin: 0 auto;
            width: 94%;
        }

        th {
            text-align: center;
        }


        .centrado {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: <?php echo $medidaTicket ?>px;
            max-width: <?php echo $medidaTicket ?>px;
        }

        img {
            
        }

        * {
            margin: 0;
        }

        .ticket {
            margin: 10;
            padding: 0;
        }

        body {
            text-align: center;
		}
        hr.new2 {
        border-top: 1px dashed red;
        }
    </style>
</head>

<body>
    <div class="ticket centrado">
        <strong>{{$empresas->Empresa_Nombre}}</strong>
        <p>{{$empresas->Empresa_Direccion}}</p>
        <p>TELEFONO: {{$empresas->Empresa_Telefono}}</p>
        <p>POTOSI - BOLVIA</p>
        <strong>F A C T U R A</strong>
        -----------------------------------------------------------------
        <table>
            <tr>
                <td align="right">
                    <strong>NIT: </strong><br>
                    <strong>No. FACTURA:</strong><br>
                    <strong>No. AUTORIZACION: </strong><br>
                </td>
                <td>
                    {{$empresas->Empresa_Nit}}<br>
                    <?php 
                        function zero_fill ($valor, $long = 0){
                            return str_pad($valor, $long, '0', STR_PAD_LEFT);
                        }
                    ?>
                    <?php echo zero_fill($factura->numFactura, 4)?><br>
                    {{$codigoventa->autorizacion}}
                </td>
            </tr>
        </table>
        -----------------------------------------------------------------
        <strong>VENTA</strong>
        <table>
            <tr>
                <td>
                 @php
                    $date = $factura->fecha_Emision;
                 @endphp
                    <strong>FECHA: </strong>
                </td>
                <td>
                    {{$date->format('Y-m-d')}}
                </td>
                <td align="left">
                    <strong>HORA:</strong>
                </td>
                <td>
                    {{$date->toTimeString();}}
                </td>
            </tr>
            <tr>
                <td align="left">
                    <strong>NOMBRE: </strong><br>
                    <strong>NIT/CI: </strong><br>
                </td>
                <td colspan="3">
                    {{$factura->comanda->cliente->Nombre_cliente}} {{$factura->comanda->cliente->Apellidop_cliente}}<br>
                    {{$factura->comanda->cliente->Nit_cliente}}<br>
                </td>
            </tr>
        </table>
        <br><table id="contenido">
            <thead>
                <tr class="centrado">
                    <th class="cantidad">CANT</th>
                    <th class="producto">PRODUCTO</th>
                    <th class="precio">PRECIO</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($facturas as $detallecomanda)
                <tr>
                    <td class="cantidad" align="center">{{ $detallecomanda->cantidad }}</td>
                    <td class="producto">{{ Str::ucfirst($detallecomanda->Nombre_plato) }}</td>
                    <td class="precio">Bs. {{ $detallecomanda->precio_venta }}</td>
                </tr>
            @endforeach
            </tbody>
            <tr>
                <td class="cantidad"></td>
                <td class="producto">
                    <strong>TOTAL: </strong>
                </td>
                <td class="precio">
				    Bs. {{ number_format($factura->comanda->total, 2) }}
                </td>
            </tr>
        </table><br>
        <p style="text-align:left"><strong>SON: </strong>{{$numtext}}</p>
        <p style="text-align:left"><strong>CODIGO DE CONTROL:</strong> {{$factura->codigo_Control}}</p>
        <p style="text-align:left"><strong>FECHA LIMITE DE EMISION:</strong> {{$factura->fecha_limite}}</p><br>
        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(90)->generate($factura->QR)) !!}"/><br><br>
        <p>"ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAIS. EL USO ILICITO DE ESTA SERA SANCIONADO DE ACUERDO A LA LEY"</p>
        <p>LEY 453: "EL PROVEEDOR DEBE BRINDAR ATENCION SIN DISCRIMINACION, CON RESPETO, CALIDEZ Y CORDIALIDAD A LOS USUARIOS Y CONSUMIDORES"</p>
        -----------------------------------------------------------------
        <p class="centrado"><strong>¡GRACIAS POR SU COMPRA!</strong>
        -----------------------------------------------------------------
    </div>
</body>

</html>