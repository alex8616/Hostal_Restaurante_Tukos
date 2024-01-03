<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Reporte Pedido</title>
    <link href="minimal-table.css" rel="stylesheet" type="text/css">
  </head>
  <body>
  	<table style="width:100%;">
		<tr>
			<td>
				<img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/img/picwish.png'))) }}" width="100%">
			</td>
			<td style="width:60%;">
				<center><h2>REPORTE DE VENTAS POR FECHAS <strong style="color:red">{{$desde}}</strong> - <strong style="color:red">{{$hasta}}</strong> HOSTAL TUKO'S</h2></center>
			</td>
		</tr>
	</table>
    <table style="width:100%;">
      <tr>
        <th>ID</th>
        <th>HABITACION</th>
        <th>INGRESO-SALIDA</th>
        <th>HUESPEDES</th>
        <th>RECEPCIONISTA</th>
        <th>TOTAL</th>
      </tr>
		@foreach ($data as $datosHR)
			@if($TipodID == 'HospedajeID')
                <tr>
                <td style="text-align: center; width: 50px">
                  {{ $datosHR->id }}
                </td>
                <td scope="row" style="text-align: center; width: 40px;">
                    {{ $datosHR->Nombre_habitacion }}
                </td>
                <td scope="row" style="text-align: left">
                    I: {{ date($datosHR->ingreso_hospedaje) }}<br>
                    S: {{ date($datosHR->salida_hospedaje) }}
                </td>
                <td scope="row" style="text-align: left">
                @foreach($DetalleHospedajes as $DetalleHospedaje)
                    @if($DetalleHospedaje->hospedaje_habitacion_id == $datosHR->id)
                        - {{$DetalleHospedaje->Nombre_cliente}} {{$DetalleHospedaje->Apellido_cliente}}<br>
                    @endif
                @endforeach
                </td>     
                <td scope="row" style="text-align: left">
                    {{$datosHR->user}}                 
                </td>                           
                @if($datosHR->cortesia == 'NO')
                    <td scope="row">Bs. {{ number_format($datosHR->TotalGeneralHospedaje, 2) }}</td>
                @else
                    <td scope="row" style="background: #FF8F8F">Cortesia</td>
                @endif
            </tr>
            @else
                <tr>
                  <td style="text-align: center; width: 50px">
                    {{ $datosHR->id }}
                  </td>
                  <td scope="row" style="text-align: center; width: 90px;">
                      {{ $datosHR->Nombre_habitacion }}
                  </td>
                  <td scope="row" style="text-align: left">
                      I: {{ date($datosHR->ingreso_reserva) }}<br>
                      S: {{ date($datosHR->salida_reserva) }}
                  </td>
                  <td scope="row" style="text-align: left">
                    @foreach($DetalleReservas as $DetalleReserva)
                        @if($DetalleReserva->reserva_habitacion_id == $datosHR->id)
                            - {{$DetalleReserva->Nombre_cliente}} {{$DetalleHospedaje->Apellido_cliente}}<br>
                        @endif
                    @endforeach
                  </td>     
                  <td scope="row" style="text-align: left">
                      {{$datosHR->user}}                 
                  </td>                           
                  <td scope="row">Bs. {{ number_format($datosHR->TotalGeneralHospedaje_reserva, 2) }}</td>
              </tr>
            @endif
		@endforeach
		<tbody>
		<tfoot>
		      @if($TipodID == 'HospedajeID')
                <tr>
                  <td colspan="5">
                    <strong><p align="right" style="color: blue !important;">TOTAL INGRESOS:</p></strong>
                  </td>
                  <td>
                    @php
                        $total = 0;
                    @endphp
                
                    @foreach($data as $new)
                        @if($new->TotalGeneralHospedaje > 50)
                            @php
                                $total += $new->TotalGeneralHospedaje;
                            @endphp
                        @endif
                    @endforeach
                
                    <strong><p align="center" style="color: blue !important;">Bs. {{ number_format($total, 2) }}</p></strong>
                </td>

                </tr>
              @else
                <tr>
                  <td colspan="5">
                    <strong><p align="right" style="color: blue !important;">TOTAL INGRESOS:</p></strong>
                  </td>
                  <td>
                    <strong><p align="center" style="color: blue !important;">Bs. {{ number_format($data->sum('TotalGeneralHospedaje_reserva'), 2) }}</p></strong>
                  </td>
                </tr>
              @endif
		</tfoot>
    </table>
  </body>
</html>
<style>
    html {
      font-family: sans-serif;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border: 2px solid rgb(200,200,200);
      font-size: 0.7rem;
    }

    td, th {
      border: 1px solid rgb(190,190,190);
      padding: 10px 20px;
    }

    th {
      background-color: rgb(235,235,235);
    }

    td {
	  padding: 3;
      text-align: center;
    }

    tr:nth-child(even) td {
      background-color: rgb(250,250,250);
    }

    tr:nth-child(odd) td {
      background-color: rgb(245,245,245);
    }

    caption {
      padding: 10px;
    }
</style>