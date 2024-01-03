<style>
    *{
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    }
    body{
        font-family: Helvetica;
        -webkit-font-smoothing: antialiased;
    }
    h2{
        text-align: center;
        font-size: 18px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: black;
        padding: 30px 0;
    }

    /* Table Styles */

    .table-wrapper{
        box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
    }

    .fl-table {
        border-radius: 5px;
        font-size: 14px;
        font-weight: normal;
        border: none;
        border-collapse: collapse;
        width: 100%;
        white-space: nowrap;
        background-color: white;
    }

    .fl-table td, .fl-table th {
        text-align: center;
        padding: 8px;
    }

    .fl-table td {
        border-right: 1px solid #f8f8f8;
        font-size: 13px;
    }

    .fl-table thead th {
        color: #ffffff;
        background: #FFA02E;
    }


    .fl-table thead th:nth-child(odd) {
        color: #ffffff;
        background: #324960;
    }

    .fl-table tr:nth-child(even) {
        background: #F8F8F8;
    }
    .title{
    text-align:center;
    }
    .title{
    text-align:center;
    color:#FFA02E;;
    font-size:4em;
    }
    .subtitle{
    text-align:center;
    color:#324960;
    font-size:16px;
    }
</style>
<hr>
<table style="width:90%;">
	<tr>
		<td><img id="logo" src="{{ base_path() . '/public/img/picwish.png' }}" width="100%"></td>
		<td style="width:60%;">
			@if ($tipoReportefactura == 0)
				<center><h1>REPORTE FACTURAS - RESTAURANTE TUKO'S</h1></center>
			@else
				<center><h1>REPORTE FACTURAS - POR FECHAS RESTAURANTE TUKO'S</h1></center>
			@endif
			@if ($tipoReportefactura != 0)
				<center>(Fecha Consulta: {{ $desdefact }} al {{ $hastafact }})</center>
			@else
				<center>(Fecha Consulta: {{ \Carbon\Carbon::now()->format('d-m-Y') }})</center>
			@endif
		</td>
	</tr>
</table>

<hr>
<div class="table-wrapper">
    <table class="fl-table">
        <thead>
            <tr>
                <th class="align:center"><strong>Nro FACTURA</strong></th>
                <th class="align:center"><strong>CODIGO CONTROL</strong></th>
                <th class="align:center"><strong>CI / NIT</strong></th>
                <th class="align:center"><strong>NOMBRE</strong></th>
                <th class="align:center"><strong>FECHA EMISION</strong></th>
                <th class="align:center"><strong>IMPORTE</strong></th>
                <th class="align:center"><strong>ESTADO</strong></th>
                <th class="align:center"><strong>CLAVE AUTORIZACION</strong></th>
                
            </tr>
        </thead>
        <tbody>
        @foreach ($datafactura as $data)
            <tr>
                <td style="text-align: center;">
                        {{ $data->numFactura }}
                </td>
                <td style="text-align: left;">{{$data->codigo_Control}}</td>
                <td style="text-align: left;">{{ $data->Nit_cliente }}</td>
                <td style="text-align: left;">{{ $data->Nombre_cliente }} {{ $data->Apellidop_cliente }}</td>
                <td scope="row" style="text-align: center;">
                    {{ \Carbon\Carbon::parse($data->fecha_Emision)->format('d-M-y') }}
                </td>
                <td scope="row">{{ $data->total }}</td>
                <td scope="row">{{ $data->estado }}</td>
                <td scope="row">{{ $data->autorizacion }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        </tfoot>
        </table>
</div>