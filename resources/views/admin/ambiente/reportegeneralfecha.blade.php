<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Reporte Pedidos</title>
    <link href="minimal-table.css" rel="stylesheet" type="text/css">
  </head>
  <body>
  	<table style="width:100%;">
	<tr>
		<td><img id="logo" src="{{ base_path() . '/public/img/picwish.png' }}" width="100%"></td>
		<td style="width:60%;">

                <center>
                    <h1>REPORTE RESERVAS</h1>
                    <h2>Por Rango De Fechas</h2>
                    <h2 style="color:red">{{$desde}} - {{$hasta}}</h2>
                </center>
		</td>
	</tr>
	</table>
    @foreach($ambientes as $ambiente)
    <caption>REPORTE RESERVAS DE AMBIENTE - {{$ambiente->Nombre_Ambiente}}</caption>
    <table>
      <tr>
        <th>ID</th>
        <th>CLIENTE</th>
        <th>MOTIVO RESERVA</th>
        <th>FECHA</th>
        <th>HORAS</th>
		<th>DESCRIPCION DETALLE</th>
        <th>TOTAL</th>
      </tr>
        @php
            $i=1;
        @endphp
            @foreach ($data as $reserva)
                    @if($reserva->ambiente_id == $ambiente->id)
                    <tr>
                        <td style="text-align: center;">{{ $i++ }}</td>
                        <td scope="row" style="text-align: center;">{{ $reserva->cliente }}</td>
                        <td scope="row" style="text-align: left">{{$reserva->motivo}}</td>
                        <td scope="row" style="text-align: left">{{ $reserva->fecha }}</td>
                        <td scope="row" style="text-align: left">{{$reserva->hora_inicio}} - {{$reserva->hora_fin}}</td>
                        <td style="text-align: left">
                            @foreach($detallereservas as $detallereserva)
                                @if($reserva->id == $detallereserva->reserva_id)
                                    - {{$detallereserva->descripcion_refrigerio}}<br>
                                @endif
                            @endforeach
                        </td>
                        <td scope="row">Bs. {{ number_format($reserva->total, 2) }}</td>
                    </tr>
                    @endif
            @endforeach
		<tbody>
        <tfoot>
            <tr>
                <th colspan="7"></th>
            </tr>
        </tfoot>
    </table><br><br>
    @endforeach
    <table>
        <tfoot>
            <tr>
                <td style="width: 80%;">
                    <strong><p align="right" style="color: blue !important;">TOTAL INGRESOS:</p></strong>
                </td>
                <td>
                    <strong><p align="center" style="color: blue !important;">Bs. {{ number_format($reserva->sum('total'), 2) }}</p></strong>
                </td>
            </tr>
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
	  padding: 2;
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