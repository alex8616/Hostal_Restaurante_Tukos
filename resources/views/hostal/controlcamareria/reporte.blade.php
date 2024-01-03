<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Planilla De Asistencia</title>
    <link href="minimal-table.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    @php
      $i=1;
    @endphp
    <table id="cabezera">
      <tr>
        <td>
          <div style="text-align: center; width: 100px">
          <strong>HOSTAL TUKO'S</strong><br>
          "LA CASA REAL" <br>
          POTOSI - BOLIVIA <br>
          </div>
        </td>
        <td style="text-align: right;"></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align: center;"><strong style="font-size: 20px;">CONTROL CAMARERIA ( {{ strtoupper($mes) }} - {{ $anio }})</strong></td>
      </tr>
        <tr>
            <td style="font-size: 13px;">
                <strong></strong>     
            </td>            
        </tr>
    </table>
    <table id="tbplanilla">
        <thead>
            <tr>
                <th>Día</th>
                @foreach($habitaciones as $habitacione)
                    <th>Hab. {{ $habitacione->id }}</th>
                @endforeach
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $fila)
                <tr>
                    <td style="width: 70px">{{ $fila['fecha'] }}</td>
                    @foreach ($habitaciones as $habitacion)
                        <td>{{ $fila["habitacion_{$habitacion->id}"] }}</td>
                    @endforeach
                    <td>{{ $fila['observacion'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>Donde <strong>"T" : </strong> Limpieza Total De La Habitacion</p>
    <p>Donde <strong>"P" : </strong> Limpieza Parcial De La Habitacion</p>
    <p>Donde <strong>"MG" : </strong> Limpieza Mano De Gato De La Habitacion</p>
  </body>
</html>
<style>
    html {
      font-family: sans-serif;
      margin-top: 20px;
      margin-bottom: 5px;
      margin-left: 25px;
      margin-right: 25px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border: 2px solid black;
      font-size: 0.7rem;
    }

    td, th {
      border: 1px solid black;
      padding: 1px 3px;
    }

    th {
      background-color: #80C2FF;
    }

    td {
	    padding: 5px;
    }

    caption {
      padding: 10px;
    }
    #cabezera td{
      border: none;
    }
    #cabezera{
      border: none;
    }
</style>
