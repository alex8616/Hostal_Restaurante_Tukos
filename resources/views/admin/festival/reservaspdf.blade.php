<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Reservas</title>
    <link href="minimal-table.css" rel="stylesheet" type="text/css">
  </head>
  <body>
  	<table style="width:100%;">
	<tr>
		<td style="width:60%;">
            <center>
                <h1>RESERVAS PARA {{$festival->nombre_festival}}</h1>               
            </center>
		</td>
	</tr>
	</table>
    <table>
      <tr>
        <th>#</th>
        <th>NOMBRE CLIENTE</th>
        <th style="width: 20px;">CANTIDAD PERSONA</th>
        <th>N MESA </th>
        <th>ADELANTO</th>
        <th>CELULAR</th>
        <th>HORA</th>
      </tr>
        @php
            $i=1;
        @endphp
		@foreach ($reservas as $datos)
            <tr>
                <td style="text-align: center;">{{ $i++ }}</td>
                <td style="text-align: left">{{ $datos->Nombre_reserva }}</td>
                <td>{{ $datos->Cantidad_persona }}</td>
                <td scope="row" style="text-align: center;">
                    @foreach($mesas as $mesa)
                        @if($mesa->id == $datos->mesa_festivale_id)
                            {{ $mesa->Nombre_mesa }}
                        @endif
                    @endforeach
                </td>
                <td scope="row" style="text-align: center">{{$datos->Adeltanto_reserva}}</td>
                <td scope="row" style="text-align: center">{{$datos->Celular_reserva}}</td>
                <td scope="row" style="text-align: center">{{$datos->Hora_reserva}}</td>
            </tr>
		@endforeach
    </table>
     <div style="page-break-after:always;"></div>
    @foreach ($reservas as $datos)
        {{ $datos->Nombre_reserva }}<br>
        @foreach($mesas as $mesa)
            @if($mesa->id == $datos->mesa_festivale_id)
                {{ $mesa->Nombre_mesa }}
            @endif
        @endforeach
        <div style="page-break-after:always;"></div>
	@endforeach
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