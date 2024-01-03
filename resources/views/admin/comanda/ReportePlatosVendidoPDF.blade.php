<body>
<h3>EN LAS FECHAS SELECCIONADAS DESDE {{$desde}} HASTA {{$hasta}}</h3>
<table style="width: 100%">
    <tr>
        <th colspan="4">CANTIDAD DE PLATOS MAS VENDIDOS</th>
    </tr>
    @php
        $i = 1;
        $columnCount = 2;
    @endphp
    @foreach ($cantidadPlatos as $plato => $cantidad)
        @if ($i % $columnCount === 1)
            <tr>
        @endif
        <td>{{ $plato }}</td>
        <td>{{ $cantidad }}</td>
        @if ($i % $columnCount === 0)
            </tr>
        @endif
        @php
            $i++;
        @endphp
    @endforeach
    @if (($i - 1) % $columnCount !== 0)
        </tr>
    @endif
</table>
</body>
<style>
    table {
      width: 100%;
      border-collapse: collapse;
      border: 2px solid black;
      font-size: 0.6rem;
      border: 1px solid #000000;
      padding: 5px;
    }

    td, th {
      border: 1px solid rgb(190,190,190);
      padding: 5px 10px;
      margin: 0;
    }

    th {
      background-color: rgb(235,235,235);
    }

    td {
	  padding: 2px;      
    }

    tr:nth-child(even) td {
      background-color: white;
      padding: 5px;
    }

    tr:nth-child(odd) td {
      background-color: white;
      padding: 5px;
    }

    caption {
      padding: 5px;
    }
</style>