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
            width: 80px;
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
            <h2>Ticket de venta {{ $comanda->id }}</h2>
            <h2>{{ \Carbon\Carbon::parse($comanda->fecha_venta)->format('d-m-Y H:i a') }}</h2>            
                @if ($comanda->cliente_id != 0)
                    <strong> Nombre: </strong>
                            {{ $comanda->cliente->Nombre_cliente }} 
                            {{ $comanda->cliente->Apellidop_cliente }}<p> 
                    <strong> Direccion: </strong>{{ $comanda->cliente->Direccion_cliente }}
                @else
                    @foreach ($tipoclientes as $tipocliente)  
                    @endforeach
                    <h2>{{ $tipocliente->Nombre_tipoclientes }} Nombres:</h2>
                    @foreach ($tipoclientes as $tipocliente)
                    <p>{{ $tipocliente->Nombre_cliente }}
                            {{ $tipocliente->Apellidop_cliente }}</p>
                    @endforeach
                    <strong> Direccion: </strong>{{ $tipocliente->Direccion_tipoclientes }}
                @endif
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
                    @foreach ($detallecomandas as $detallecomanda)
                        <tr>
                            <td class="cantidad">{{ $detallecomanda->cantidad }}</td>
                            <td class="cantidad">{{ $detallecomanda->comentario }}</td>
                            <td class="producto">{{ Str::ucfirst($detallecomanda->plato->Nombre_plato) }}</td>
                            <td class="precio">Bs. {{ $detallecomanda->precio_venta }}</td>
                            <td class="preciototal"><strong>Bs. {{  number_format($detallecomanda->precio_venta * $detallecomanda->cantidad, 2) }}</strong></td>
                        </tr>
                    @endforeach
                </tbody>
                <tr>
                    <td class="cantidad"></td>
                    <td class="cantidad"></td>
                    <td colspan="2">
                        <strong>TOTAL A PAGAR</strong>
                    </td>
                    <td class="precio">
                    <strong>Bs. {{ number_format($comanda->total, 2) }}</strong>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <center>
        <p class="centrado">¡GRACIAS POR SU COMPRA!
    </center>
</body>

</html>