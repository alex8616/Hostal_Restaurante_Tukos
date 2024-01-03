<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f7f7f7;
        margin: 0;
        padding: 0;
    }

    h1 {
        font-size: 24px;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        font-size: 14px;
    }

    table, th, td {
        border: 1px solid #ccc;
    }

    th, td {
        padding: 6px;
        text-align: center;
    }

    th {
        background-color: #333;
        color: #fff;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }

    .table-wrapper {
        margin-bottom: 20px;
    }

    .highlight {
        background-color: #86B8F5;
        color: #fff;
    }

    .highlight-green {
        background-color: #42D958;
        color: #fff;
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
        margin-bottom: 10px;
        font-size: 12px; /* Tamaño de fuente más pequeño para tablas adicionales */
        border-collapse: collapse;
    }

    .compact-table th, .compact-table td {
        border: none;
        padding: 4px 8px;
    }

    .compact-table th {
        background-color: #333;
        color: #fff;
    }

    .compact-table tr:nth-child(even) {
        background-color: #f7f7f7;
    }
</style>

<h1>REPORTE GENERAL SOBRE LAS CAJAS</h1>
<table class="table-wrapper">
    <tr>
        <td>CODIGOS</td>
        <td>INGRESOS</td>
        <td>EGRESOS</td>
        <td>SUB TOTAL</td>
    </tr>
    <tr>
        <td>hostal</td>
        <td>{{$caja->caja_hostal_ingreso}}</td>
        <td>{{$caja->caja_hostal_egreso}}</td>
        @php
            $Rh = $caja->caja_hostal_ingreso - $caja->caja_hostal_egreso
        @endphp
        <td>{{$Rh}}</td>
    </tr>
    <tr>
        <td>Caja Grande</td>
        <td>{{$CajaGrandeHostal}}</td>
        <td>{{$CajaGrandeHostal}}</td>
        <td></td>
    </tr>
    <tr>
        <td style="background: #86B8F5;">TOTAL HOSTAL</td>
        @php
            $hI = $caja->caja_hostal_ingreso + $CajaGrandeHostal;
            $hE = $caja->caja_hostal_egreso - $CajaGrandeHostal
        @endphp
        <td style="background: #86B8F5;">{{$hI}}</td>
        <td style="background: #86B8F5;">{{$hE}}</td>
        <td style="background: #86B8F5;">{{$hI - $hE}}</td>
    </tr>
    <tr>
        <td>Restaurante</td>
        <td>{{$caja->caja_restaurante_ingreso}}</td>
        <td>{{$caja->caja_restaurante_egreso}}</td>
        @php
            $Rr = $caja->caja_restaurante_ingreso - $caja->caja_restaurante_egreso
        @endphp
        <td>{{$Rr}}</td>
    </tr>
    <tr>
        <td>Caja Grande</td>
        <td>{{$CajaGrandeRestaurante}}</td>
        <td>{{$CajaGrandeRestaurante}}</td>
        <td></td>
    </tr>
    <tr>
        <td style="background: #86B8F5;">TOTAL RESTAURANTE</td>
        @php
            $rI = $caja->caja_restaurante_ingreso + $CajaGrandeRestaurante;
            $rE = $caja->caja_restaurante_egreso - $CajaGrandeRestaurante
        @endphp
        <td style="background: #86B8F5;">{{$rI}}</td>
        <td style="background: #86B8F5;">{{$rE}}</td>
        <td style="background: #86B8F5;">{{$rI - $rE}}</td>
    </tr>
    <tr>
        <td>Tarjetas</td>
        <td>{{$caja->caja_tarjetas_ingreso}}</td>
        <td></td>
        <td>{{$caja->caja_tarjetas_ingreso}}</td>
    </tr>
    <tr>
        <td>Depositos</td>
        <td>{{$caja->caja_depositos_ingreso}}</td>
        <td></td>
        <td>{{$caja->caja_depositos_ingreso}}</td>
    </tr>
    <tr>
        <td>TOTAL PARCIAL</td>
        @php
            $Tg1 = $hI+$caja->caja_tarjetas_ingreso+$rI+$caja->caja_depositos_ingreso;
            $Tg2 = $hE+$rE
        @endphp
        <td>{{$Tg1}}</td>
        <td>{{$Tg2}}</td>
        <td>{{$Tg1-$Tg2}}</td>
    </tr>
</table>
<table>
    <tr>
        <td>DOLARES </td>
        <td>{{$caja->DolarHostal}} $.</td>
    </tr>
    <tr>
        <td>Dolares a Bolivianos</td>
        <td>{{$caja->DolarHostal * 6.91}} Bs.</td>
    </tr>
    <tr>
        <td>TOTAL GENERAL</td>
        <td>{{$Tg1-$Tg2 + ($caja->DolarHostal * 6.91) }} Bs.</td>
    </tr>
</table>

<span style="color: red">*Nota: el monto general total nose esta considerando los gatos de DEPOSITO o TARJETA*</span>

<div style="page-break-after: always;"></div>

<table style="margin: 0px; padding: 0px; font-size: 12px; text-align: left">
        @foreach ($diasDelMes as $dia)
        <tr>
            <td colspan="2">
                <h3>Registro CAJA del día {{ $dia->format('Y-m-d') }}</h3>
            </td>
        </tr>
        ty
        @foreach ($registrosPorDia[$dia->format('Y-m-d')] as $registro)
                <tr>
                    <td style="width: 250px;">
                        <p>{{ $registro->Nombre_Articulo }}</p>
                    </td>
                    <td style="background: white;">
                        <p>Descripcion: {{ $registro->Articulo_description }}</p>
                        @if($registro->Ingreso > 0)
                            <p>Ingreso: {{ $registro->Ingreso }}</p>
                        @else 
                            <p>Egreso: {{ $registro->Egreso }}</p>
                        @endif
                    </td>
                </tr>        
        @endforeach
    @endforeach
</table>

