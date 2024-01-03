<style>
    html {
      font-family: sans-serif;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border: 2px solid rgb(200,200,200);
      letter-spacing: 1px;
      font-size: 0.6rem;
    }

    td, th {
      border: 1px solid rgb(190,190,190);
      padding: 10px 20px;
    }

    th {
      background-color: rgb(235,235,235);
    }

    td {
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

<table style="width:101%;">
	<tr>
		<td><img id="logo" src="{{ base_path() . '/public/img/picwish.png' }}" width="100%">
		<td style="width:60%;" class="text-center">
			<h1 class="title">REPORTE CAJAS <h6 class="subtitle">reporte del mes {{ \Carbon\Carbon::parse($caja->fecha_registro)->locale('es')->isoFormat(' MMMM \d\e\l Y') }}</h6></h1>
		</td>
	</tr>
</table>

<div class="table-wrapper">
    <table class="fl-table" style="width: 100%;">
        <thead>
        <tr>
            <th class="text-center">
                <strong>Nª</strong>
            </th>
            <th class="text-center">
                <strong>Nombre</strong>
            </th>
            <th class="text-center">
                <strong>Nombre Articulo</strong>
            </th>
            <th>
                <strong>Descripcion</strong>
            </th>
            <th class="text-center">
                <strong>Fecha De Registro</strong>
            </th>
            <th class="text-center">
                <strong>Ingreso</strong>
            </th>
            <th class="text-center">
                <strong>Egreso</strong>
            </th>
            <th>
                <strong>Factura</strong>
            </th>
        </tr>
        </thead>
        <tbody>
        @php
            $i=1;
        @endphp
        @foreach ($detallecajas as $detallecaja)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ ($detallecaja->Nombre) }}</td>
            <td>{{ ($detallecaja->Nombre_Articulo) }}</td>
            <td>{{ ($detallecaja->Articulo_description) }}</td>
            <td style="width: 80px;">{{ $detallecaja->created_at->toDateString()}}</td>
            <td>{{ ($detallecaja->Ingreso) }}</td>
            <td>{{ ($detallecaja->Egreso) }}</td>
            @if($detallecaja->Factura == 'Con_Factura')
                <td>SI</td>
            @else
                <td>NO</td> 
            @endif
        </tr>
        @endforeach
        @if($detallecajas->count() > 0)
            @php
            $in = $detallecaja->sum('ingreso');
            $eg = $detallecaja->sum('egreso');
            $val = (float)$in - (float)$eg;
            @endphp
        <tr>
            <td colspan="3" class="text-center" style="background-color:#FFA02E; color:white">INGRESO TOTAL: {{ $detalleIngreso }}</td>
            <td colspan="3" class="text-center" style="background-color:#FFA02E; color:white">EGRESO TOTAL: {{ $detalleEgreso }}</td>
            <td colspan="4" class="text-center" style="background-color:#324960; color:white">TOTAL: {{$total}}</td>
        </tr>
        @else
        @endif   
        <tbody>
    </table>
</div>
