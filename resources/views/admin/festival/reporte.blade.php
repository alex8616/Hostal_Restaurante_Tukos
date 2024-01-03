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
                <h1>REPORTE RESERVAS {{$festival->nombre_festival}}</h1>               
            </center>
		</td>
	</tr>
	</table>
  <table>
    <tr>
      <th>ID</th>
      <th>CLIENTE</th>
      <th>PRODUCTO</th>
      <th>FECHA</th>
      <th>TOTAL</th>
    </tr>
    @php
      $i=1;
    @endphp
    @foreach ($festival->registrofestivales as $datos)
      <tr>
          <td style="text-align: center;">{{ $i++ }}</td>
          <td scope="row" style="text-align: center;">Clientes En General</td>
          <td>
              @foreach ($detallefestivales as $detallefestivale)
                  @if($datos->id == $detallefestivale->registrofestival_id)
                      @if ($detallefestivale->combo)
                          {{ Str::ucfirst($detallefestivale->combo->Nombre_combo) }} <br>
                      @endif
                  @endif
              @endforeach
          </td>
          <td scope="row" style="text-align: left">{{$datos->fecha_venta}}</td>
          <td scope="row">Bs. {{ number_format($datos->total, 2) }}</td>
      </tr>
    @endforeach
    <tbody>
    <tfoot>
      <tr>
          <td colspan="4">
              <strong><p align="right" style="color: blue !important;">TOTAL INGRESOS:</p></strong>
          </td>
          <td>
              <strong><p align="center" style="color: blue !important;">Bs. {{ $total }}</p></strong>
          </td>
      </tr>
    </tfoot>
  </table>
    <br>
    <table>
    <tr>
      <th>ID</th>
      <th>CLIENTE</th>
      <th>PRODUCTO</th>
      <th>FECHA</th>
      <th>TOTAL</th>
    </tr>
    @php
      $i=1;
    @endphp
    @foreach ($festival->reservafestivales as $datos)
      <tr>
          <td style="text-align: center;">{{ $i++ }}</td>
          <td scope="row" style="text-align: center;">{{ $datos->Nombre_reserva}}</td>
          <td>
              @foreach ($detallefestivales as $detallefestivale)
                  @if($datos->id == $detallefestivale->reservafestival_id)
                      @if ($detallefestivale->combo)
                          {{ Str::ucfirst($detallefestivale->combo->Nombre_combo) }} <br>
                      @endif
                  @endif
              @endforeach
          </td>
          <td scope="row" style="text-align: left">{{$datos->Fecha_registro}}</td>
          <td scope="row">Bs. {{ number_format($datos->Total_reserva, 2) }}</td>
      </tr>
    @endforeach
    <tbody>
    <tfoot>
      <tr>
          <td colspan="4">
              <strong><p align="right" style="color: blue !important;">TOTAL INGRESOS:</p></strong>
          </td>
          <td>
              <strong><p align="center" style="color: blue !important;">Bs. {{ $total2 }}</p></strong>
          </td>
      </tr>
    </tfoot>
  </table>
    <br>
    <table>
      <tr>
        <th>#</th>
        <th>PRODUCTO</th>
        <th>CANTIDAD VENDIDA</th>
      </tr>
        @php
            $i=1;
        @endphp
		@foreach ($cantidaddetalleFestivales as $cantidaddetalleFestivale)
            <tr>
                <td style="text-align: center;">{{ $i++ }}</td>
                <td scope="row" style="text-align: center;">{{ $cantidaddetalleFestivale->combo->Nombre_combo }}</td>
                <td scope="row">{{ $cantidaddetalleFestivale->total_cantidad }}</td>
            </tr>
		@endforeach
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