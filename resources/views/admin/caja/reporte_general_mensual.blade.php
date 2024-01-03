<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f7f7f7;
        margin: 0;
        padding: 0;
        margin: 10%;
    }

    h1 {
        font-size: 20px;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        font-size: 12px;
    }

    table, th, td {
        border: 1px solid #ccc;
        font-size: 12px;
    }

    th, td {
        padding: 6px;
    }

    th {
        background-color: #333;
        color: #fff;
    }

    .table-wrapper {
        margin-bottom: 20px;
    }

    span.note {
        color: red;
        font-style: italic;
    }

    /* Estilos para la primera tabla */
    .first-table {
        background-color: #fff; /* Fondo blanco para la primera tabla */
    }

    /* Estilos para las tablas adicionales */
    .compact-table {
        font-size: 12px; /* Tamaño de fuente más pequeño para tablas adicionales */
        border-collapse: collapse;
    }

    .compact-table th {
        background-color: #333;
        color: #fff;
    }

    .compact-table tr:nth-child(even) {
        background-color: #f7f7f7;
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

@foreach($cajasWithSum as $detalle)
    <h2>REPORTE GENERAL MES {{ $detalle['caja']['fecha_registro'] }}</h2> 
    <table class="table-wrapper">
        <tr>
            <td>Codigo</td>
            <td>INGRESOS</td>
            <td>EGRESOS</td>
            <td>SUB TOTAL</td>
        </tr>
        <tr>
            <td>hostal</td>
            <td style="vertical-align: top; border-collapse: collapse; padding: 0; margin: 0">
                <table style="vertical-align: top; border-collapse: collapse; padding: 0; margin: 0; padding-bottom: 0">
                    @foreach ($detalle['$IngresoHostal'] as $ingreso)
                    <tr>
                        <td  style="font-size: 8px; padding: 0; padding-left: 5px; padding-right: 5px;">
                            {{ $ingreso['Nombre_articulo'] }}

                        </td>
                        <td  style="font-size: 8px; padding: 0; padding-left: 5px; padding-right: 5px;">
                            {{ $ingreso['total'] }}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </td>
            <td style="vertical-align: top; border-collapse: collapse; padding: 0; margin: 0;"> 
                <table style="vertical-align: top; border-collapse: collapse; padding: 0; margin: 0; padding-bottom: 0">
                    @foreach ($detalle['$EgresoHostal'] as $egreso)
                    <tr>
                        <td style="font-size: 8px; padding: 0; padding-left: 5px; padding-right: 5px;">
                            {{ $egreso['Nombre_articulo'] }}

                        </td>
                        <td  style="font-size: 8px; padding: 0; padding-left: 5px; padding-right: 5px;">
                            {{ $egreso['total'] }}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </td>
            <td>sin nada</td>
        </tr>
        <tr>
            <td>hostal</td>
            <td>{{$detalle['caja']['caja_hostal_ingreso'] }}</td>
            <td>{{$detalle['caja']['caja_hostal_egreso'] }}</td>
            @php
                $Rh = $detalle['caja']['caja_hostal_ingreso'] - $detalle['caja']['caja_hostal_egreso']
            @endphp
            <td>{{$Rh}}</td>
        </tr>
        <tr>
            <td>Caja Grande</td>
            <td>{{ $detalle['$CajaGrandeHostal'] }}</td>
            <td>{{ $detalle['$CajaGrandeHostal'] }}</td>
            <td></td>
        </tr>
        <tr>
            <td style="background: #86B8F5;">TOTAL HOSTAL</td>
            @php
                $hI = $detalle['caja']['caja_hostal_ingreso'] + $detalle['$CajaGrandeHostal'];
                $hE = $detalle['caja']['caja_hostal_egreso'] - $detalle['$CajaGrandeHostal'];
            @endphp
            <td style="background: #86B8F5;">{{$hI}}</td>
            <td style="background: #86B8F5;">{{$hE}}</td>
            <td style="background: #86B8F5;">{{$hI - $hE}}</td>
        </tr>
        <tr>
            <td>Restaurante</td>
            <td style="vertical-align: top; border-collapse: collapse; padding: 0; margin: 0; padding-bottom: 0">
                <table style="vertical-align: top; border-collapse: collapse; padding: 0; margin: 0; padding-bottom: 0">
                    @foreach ($detalle['$IngresoRestaurante'] as $ingreso)
                    <tr>
                        <td  style="font-size: 8px; padding: 0; padding-left: 5px; padding-right: 5px;">
                            {{ $ingreso['Nombre_articulo'] }}

                        </td>
                        <td  style="font-size: 8px; padding: 0; padding-left: 5px; padding-right: 5px;">
                            {{ $ingreso['total'] }}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </td>
            <td style="vertical-align: top; border-collapse: collapse; padding: 0; margin: 0; padding-bottom: 0">
                <table style="vertical-align: top; border-collapse: collapse; padding: 0; margin: 0; padding-bottom: 0">
                    @foreach ($detalle['$EgresoRestaurante'] as $egreso)
                    <tr>
                        <td style="font-size: 8px; padding: 0; padding-left: 5px; padding-right: 5px;">
                            {{ $egreso['Nombre_articulo'] }}

                        </td>
                        <td  style="font-size: 8px; padding: 0; padding-left: 5px; padding-right: 5px;">
                            {{ $egreso['total'] }}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </td>
            <td>sin nada</td>
        </tr>
        <tr>
            <td>Restaurante</td>
            <td>{{$detalle['caja']['caja_restaurante_ingreso'] }}</td>
            <td>{{$detalle['caja']['caja_restaurante_egreso'] }}</td>
            @php
                $Rr = $detalle['caja']['caja_restaurante_ingreso'] - $detalle['caja']['caja_restaurante_egreso']
            @endphp
            <td>{{$Rr}}</td>
        </tr>
        <tr>
            <td>Caja Grande</td>
            <td>{{$detalle['$CajaGrandeRestaurante'] }}</td>
            <td>{{$detalle['$CajaGrandeRestaurante'] }}</td>
            <td></td>
        </tr>
        <tr>
            <td style="background: #86B8F5;">TOTAL RESTAURANTE</td>
            @php
                $rI = $detalle['caja']['caja_restaurante_ingreso'] + $detalle['$CajaGrandeRestaurante'];
                $rE = $detalle['caja']['caja_restaurante_egreso'] - $detalle['$CajaGrandeRestaurante'];
            @endphp
            <td style="background: #86B8F5;">{{$rI}}</td>
            <td style="background: #86B8F5;">{{$rE}}</td>
            <td style="background: #86B8F5;">{{$rI - $rE}}</td>
        </tr>
        
        <tr>
            <td>Tarjetas</td>
            <td style="vertical-align: top; border-collapse: collapse; padding: 0; margin: 0">
                <table style="vertical-align: top; border-collapse: collapse; padding: 0; margin: 0; padding-bottom: 0">
                    @foreach ($detalle['$IngresoTarjeta'] as $ingreso)
                    <tr>
                        <td  style="font-size: 8px; padding: 0; padding-left: 5px; padding-right: 5px;">
                            {{ $ingreso['Nombre_articulo'] }}

                        </td>
                        <td  style="font-size: 8px; padding: 0; padding-left: 5px; padding-right: 5px;">
                            {{ $ingreso['total'] }}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </td>
            <td style="vertical-align: top; border-collapse: collapse; padding: 0; margin: 0">
                <table style="vertical-align: top; border-collapse: collapse; padding: 0; margin: 0; padding-bottom: 0">
                    @foreach ($detalle['$EgresoTarjeta'] as $egreso)
                    <tr>
                        <td style="font-size: 8px; padding: 0; padding-left: 5px; padding-right: 5px;">
                            {{ $egreso['Nombre_articulo'] }}

                        </td>
                        <td  style="font-size: 8px; padding: 0; padding-left: 5px; padding-right: 5px;">
                            {{ $egreso['total'] }}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </td>
            <td>sin nada</td>
        </tr>
        
        <tr>
            <td style="background: #86B8F5;">Total Tarjetas</td>
            <td style="background: #86B8F5;">{{$detalle['caja']['caja_tarjetas_ingreso'] }}</td>
            <td style="background: #86B8F5;"></td>
            <td style="background: #86B8F5;">{{$detalle['caja']['caja_tarjetas_ingreso'] }}</td>
        </tr>
        
        <tr>
            <td>Depositos</td>
            <td style="vertical-align: top; border-collapse: collapse; padding: 0; margin: 0">
                <table style="vertical-align: top; border-collapse: collapse; padding: 0; margin: 0; padding-bottom: 0">
                    @foreach ($detalle['$IngresoDeposito'] as $ingreso)
                    <tr>
                        <td  style="font-size: 8px; padding: 0; padding-left: 5px; padding-right: 5px;">
                            {{ $ingreso['Nombre_articulo'] }}

                        </td>
                        <td  style="font-size: 8px; padding: 0; padding-left: 5px; padding-right: 5px;">
                            {{ $ingreso['total'] }}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </td>
            <td style="vertical-align: top; border-collapse: collapse; padding: 0; margin: 0">
                <table style="vertical-align: top; border-collapse: collapse; padding: 0; margin: 0; padding-bottom: 0">
                    @foreach ($detalle['$EgresoDeposito'] as $egreso)
                    <tr>
                        <td style="font-size: 8px; padding: 0; padding-left: 5px; padding-right: 5px;">
                            {{ $egreso['Nombre_articulo'] }}

                        </td>
                        <td  style="font-size: 8px; padding: 0; padding-left: 5px; padding-right: 5px;">
                            {{ $egreso['total'] }}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </td>
            <td>sin nada</td>
        </tr>
        
        <tr>
            <td style="background: #86B8F5;">Total Depositos</td>
            <td style="background: #86B8F5;">{{$detalle['caja']['caja_depositos_ingreso'] }}</td>
            <td style="background: #86B8F5;"></td>
            <td style="background: #86B8F5;">{{$detalle['caja']['caja_depositos_ingreso'] }}</td>
        </tr>
        
        <tr>
            <td style="background: #42D958;">TOTAL PARCIAL</td>
            @php
                $Tg1 = $hI+$detalle['caja']['caja_tarjetas_ingreso'] +$rI+$detalle['caja']['caja_depositos_ingreso'];
                $Tg2 = $hE+$rE;
                $Tgn = $Tg1-$Tg2;
            @endphp
            <td style="background: #42D958;">{{$Tg1}}</td>
            <td style="background: #42D958;">{{$Tg2}}</td>
            <td style="background: #42D958;">{{$Tgn}}</td>
        </tr>
        <tr>
            <td style="background: #FF6969;">Gastos Administrativos (Sueldos)</td>
            <td style="background: #FF6969;"></td>
            <td style="background: #FF6969;">{{ $detalle['caja']['caja_sueldo'] }}</td>
            <td style="background: #FF6969;">{{ $detalle['caja']['caja_sueldo'] }}</td>
        </tr>
        <tr>
            <td>UTILIDAD NETA</td>
            <td>{{$Tg1}}</td>
            <td>{{$Tg2 + $detalle['caja']['caja_sueldo']}}</td>
            <td>{{$Tgn - $detalle['caja']['caja_sueldo'] }}</td>
        </tr>
    </table>
    

<span style="color: red">*Nota: el monto general total nose esta considerando los gatos de DEPOSITO o TARJETA*</span>

<div style="page-break-after: always;"></div>
@endforeach


