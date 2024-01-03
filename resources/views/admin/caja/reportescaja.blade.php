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

<table style="width:100%;">
	<tr>
		<td><img id="logo" src="{{ base_path() . '/public/img/picwish.png' }}" width="100%">
		<td style="width:60%;" class="text-center">
    <center><h1 style="color:black; font-size:15px">BUSQUEDA PERSONALIZADA CAJAS TUKO'S ({{ $desde }} - {{ $hasta }})</h1> </center>
		</td>
	</tr>
</table>

<div class="table-wrapper">
<table class="fl-table" style="width: 100%;">
      <thead class=" text-primary">
          <th class="text-center">
            <strong>ID</strong>
          </th>
          <th class="text-center">
            <strong>Codigo Atributo</strong>
          </th>
          <th class="text-center">
            <strong>Nombre De Atributo</strong>
          </th>
          <th class="text-center">
            <strong>Descripcion</strong>
          </th>
          <th class="text-center">
            <strong>Ingreso</strong>
          </th>
          <th class="text-center">
            <strong>Egreso</strong>
          </th>
          <th class="text-center">
            <strong>Fecha De Registro</strong>
          </th>
        </thead>
        <tbody>
            @php
                $i=1;
            @endphp
            @if($detallecajas->count() > 0)
              @foreach ($detallecajas as $caja)
              <tr>
                  <td class="text-center">{{ $i++ }}</td>
                  <td>{{ ($caja->Codigo_caja) }}</td>
                  <td>{{ ($caja->Nombre_Articulo) }}</td>
                  <td>{{ ($caja->Articulo_description) }}</td>
                  <td>{{ ($caja->Ingreso) }}</td>
                  <td>{{ ($caja->Egreso) }}</td>
                  <td>{{ ($caja->fecha_registro) }}</td>
              </tr>
              @endforeach
            @endif
        </tbody>
        <tfoot>
          <tr>
            <td colspan="7"><br></td>
          </tr>
        </tfoot>
    </table>
    @if($detallecajas->count() > 0)
        @php
          $in = $detallecajas->sum('Ingreso');
          $eg = $detallecajas->sum('Egreso');
          $val = (float)$in - (float)$eg;
        @endphp
        <br><br>
      <table style="width:100%">
        <tr>
          <td class="text-center" style="background-color:#70ca58; width:100px; padding: 0px; color:white"><h2 style="font-size: 10px;"><strong>INGRESO TOTAL: {{ $in }}</strong></h2> </td>
          <td class="text-center" style="background-color:#e95747; width:100px; color:white"><h2 style="font-size: 10px;"><strong>EGRESO TOTAL: {{ $eg }}</strong></h2></td>
          <td class="text-center" style="background-color:#52abff; width:100px; color:white"><h2 style="font-size: 10px;"><strong>TOTAL: {{$val}}</strong></h2></td>
        </tr>
      </table>
      <div class="container">
      @else
            <span>Nose Encontro LO Que Buscaba .. </span>
      @endif
</div>
