@foreach($productos as $producto)
    <table class="table">
        <tr>
            <td colspan="6">KARDES PRODUCTOS</td>
        </tr>
        <tr>
            <td>PRODUCTOS:</td>
            <td>{{ $producto->Nombre_producto }}</td>
            <td></td>
            <td></td>
            <td>PRECIO:</td>
            <td>{{ $producto->Precio_producto }}</td>
        </tr>
        <tr>
            <th>FECHA DE INGRESO</th>
            <th>FECHA DE SALIDA</th>
            <th>ENTRADA</th>
            <th>SALIDA</th>
            <th>SALDO</th>
            <th>OBSERVACIONES</th>
        </tr>
        @php
            $saldo = $producto->Cantidad_producto;
            $ultimaFila = $producto->actualizarstocks->last();
            if ($ultimaFila) {
                $saldo += $ultimaFila->aumento;
            }
        @endphp
        @foreach($producto->actualizarstocks as $actualizarstock)
            <tr>
                <td><h3>{{ $actualizarstock->ActualizarStock }}</h3></td>     
                <td></td>
                <td>{{ $actualizarstock->aumento }}</td>
                <td></td>
                <td><p>{{ $saldo  }}</p></td>
                <td></td>   
            </tr>
            @foreach($producto->detalleproductos as $detalleproducto)
                @if($detalleproducto->created_at >= $actualizarstock->ActualizarStock)
                    <tr>
                        <td></td>
                        <td>
                            <p>{{ $detalleproducto->created_at }}</p>
                        </td>
                        <td></td>
                        <td><p>{{ $detalleproducto->cantidad }}</p></td>
                        @php
                            $saldo -= $detalleproducto->cantidad;
                        @endphp
                        <td><p>{{ $saldo }}</p></td>
                        <td></td>
                    </tr>
                @endif
            @endforeach
            @php
                $saldo += $actualizarstock->aumento;
            @endphp
        @endforeach
    </table>
    <div style="page-break-after:always;"></div>
@endforeach


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
