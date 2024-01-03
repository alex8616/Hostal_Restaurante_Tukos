<?php
$medidaTicket = 180;
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
        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
            margin: 0 auto;
        }
        td.precio {
            text-align: center;
            font-size: 11px;
            width: 60px;
        }
        td.cantidad {
            font-size: 11px;
            text-align: center;
        }
        td.producto {
            text-align: center;
        }
        
        td.preciototal{
            text-align: center;
            font-size: 11px;
            width: 100px;
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
            max-width: inherit;
            width: inherit;
        }
        * {
            margin: 0;
            padding: 5px;
        }
        .ticket {
            margin: 0;
            padding: 0;
        }
        body {
            text-align: center;
		} 
        #divPadre {
            text-align:center;
        }
        #divHijo {
            margin:0px auto;
        }
    </style>
</head>
<body>
    <div id="divPadre">
        <div id="divHijo">
            <h1>RESTAURANT TUKO'S</h1>
            <h2>Ticket de venta {{ $festival->id }} - {{ \Carbon\Carbon::parse($festival->Fecha_conclusion)->format('d-m-Y H:i a') }}</h2>
        </div>
        <div style="text-align: left;">
            <p><strong> Nombre: </strong>{{ $festival->Nombre_reserva }}<strong> N Personas: </strong>{{ $festival->Cantidad_persona }}</p>
        </div>
        <div class="ticket centrado">
            <table>
                <thead>
                    <tr class="centrado">
                        <th class="cantidad">CANT</th>
                        <th class="cantidad">COMENTARIO</th>
                        <th class="producto">PRODUCTO</th>
                        <th class="precio">P. Unit</th>
                        <th class="">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detallefestivales as $detallefestivale)
                        @if($festival->id == $detallefestivale->reservafestival_id)
                        <tr>
                            <td class="cantidad">{{ $detallefestivale->cantidad }}</td>
                            <td class="cantidad">{{ $detallefestivale->comentario }}</td>
                            <td class="producto">
                                @if ($detallefestivale->combo)
                                    {{ Str::ucfirst($detallefestivale->combo->Nombre_combo) }}
                                @endif
                            </td>
                            <td class="precio">Bs. {{ $detallefestivale->precio_venta }}</td>
                            <td class="preciototal"><strong>Bs. {{  number_format($detallefestivale->precio_venta * $detallefestivale->cantidad, 2) }}</strong></td>
                        </tr> 
                        @endif
                    @endforeach
                </tbody>
                <tr>
                    <td colspan="4" style="text-align: right;">
                        <strong>TOTAL CONSUMO:</strong><br>
                        <strong>SE DEJO ADELANTO DE:</strong><br>
                        <strong>TOTAL A PAGAR:</strong>
                    </td>
                    <td colspan="1" class="precio" style="text-align: left;">
                        <strong>Bs. {{ number_format($festival->Total_reserva, 2) }}</strong><br>
                        <strong>Bs. {{ number_format($festival->Adeltanto_reserva, 2) }}</strong><br>
                        <strong>Bs. {{ (number_format($festival->Adeltanto_reserva, 2) -  number_format($festival->Total_reserva, 2))*-1 }}</strong><br>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <center>
        <p class="centrado">¡GRACIAS POR SU PREFERENCIA!
    </center>
</body>
</html>