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
				<center><h2>REPORTE DE VENTAS POR HORAS <strong style="color:red">{{$desde}}</strong> - <strong style="color:red">{{$hasta}}</strong> RESTAURANTE TUKO'S</h2></center>
			</td>
		</tr>
	</table>
    <table style="width:100%;">
      <tr>
        <th>ID</th>
        <th>FECHA</th>
        <th>NOMBRES</th>
		<th>DIRECCIONES</th>
		<th>PLATOS</th>
        <th>TOTAL</th>
      </tr>
		@foreach ($data as $venta)
			<tr>
					<td style="text-align: center; width: 50px">
						{{ $venta->id }}
					</td>
					<td scope="row" style="text-align: center; width: 10px;">
						{{ date($venta->fecha_venta) }}
					</td>
						@if ($venta->cliente_id != 0)
							<td scope="row" style="text-align: left">{{ $venta->cliente->Nombre_cliente}} {{$venta->cliente->Apellidop_cliente}}</td>
							<td scope="row" style="text-align: left">{{ $venta->cliente->Direccion_cliente }}</td>
						@else
							<td style="text-align: left; width:70px;">
								@foreach ($tipoclientes as $tipocliente)
									@if($venta->tipo_cliente_id == $tipocliente->id)
										{{ $tipocliente->Nombre_cliente }}{{$tipocliente->Apellidop_cliente}}<br>
									@endif
								@endforeach
							</td>
							<td style="text-align: left; width:150px;">
							@php
								$aux = 0;
							@endphp
							@foreach ($tipoclientes as $tipocliente)
								
								@if($venta->tipo_cliente_id == $tipocliente->id && $aux == 0)
									{{ $tipocliente->Direccion_tipoclientes }} 
									<input type="hidden" name="" id="input" class="form-control" value="{{$aux++}}">
										
								@endif
							@endforeach
								
							</td>
						@endif
					<td style="text-align: left; width:150px;">
						@foreach($detallecomandas as $detallecomanda)
							@if($venta->id == $detallecomanda->comanda_id)
								- {{$detallecomanda->Nombre_plato}}<br>
							@endif
						@endforeach
					</td style="width:10px;">
					<td scope="row">Bs. {{ number_format($venta->total, 2) }}</td>
			</tr>
		@endforeach
		<tbody>
		<tfoot>
			<tr>
				<td colspan="5">
					<strong><p align="right" style="color: blue !important;">TOTAL INGRESOS:</p></strong>
				</td>
				<td>
					<strong><p align="center" style="color: blue !important;">Bs. {{ number_format($data->sum('total'), 2) }}</p></strong>
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