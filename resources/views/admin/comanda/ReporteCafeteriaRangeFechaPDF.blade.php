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
            <style>
                .texto {
                    font-size: 46px;
                    line-height: 46px;
                    vertical-align: middle;
                    font-weight: 500;
                }
            </style>
            <div class="texto">C A F E T E R I A</div>
			<center><h1>REPORTE DE VENTAS <br> DESDE {{$desde}} HASTA {{$hasta}} RESTAURANTE TUKO'S</h1></center>
		</td>
	</tr>
	</table>
    <table>
      <tr>
        <th>ID</th>
        <th>FECHA</th>
        <th>NOMBRES</th>
		<th>DIRECCIONES</th>
		<th>PLATOS</th>
        <th>TOTAL</th>
      </tr>
	  	@php
			$i=1;
		@endphp
		@foreach ($data as $venta)
			<tr>
				<td style="text-align: center;">
						{{ $i++ }}
				</td>
				<td scope="row" style="text-align: center;">
					{{ date($venta->fecha_venta) }}
				</td>
					@if ($venta->cliente_id != 0)
						<td scope="row" style="text-align: left">{{ $venta->cliente->Nombre_cliente}} {{$venta->cliente->Apellidop_cliente}}</td>
						<td scope="row" style="text-align: left; width:20px;">{{ $venta->cliente->Direccion_cliente }}</td>
					@else
						<td style="text-align: left">
							@foreach ($tipoclientes as $tipocliente)
								@if($venta->tipo_cliente_id == $tipocliente->id)
									{{ $tipocliente->Nombre_cliente }}{{$tipocliente->Apellidop_cliente}}<br>
								@endif
							@endforeach
							</td>
							<td style="text-align: left">
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
				<td style="text-align: left">
					@foreach($detallecomandas as $detallecomanda)
						@if($venta->id == $detallecomanda->comanda_id)
							- {{$detallecomanda->Nombre_plato}}<br>
						@endif
					@endforeach
				</td>
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
