
<!-- @foreach ($dias_por_mes as $mes => $dias)
    <h2>{{ $mes }}</h2>
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Ingresaron</th>
                <th>Quedaron</th>
                <th>Salieron</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dias as $dia => $datos)
                <tr>
                    <td>{{ $dia }}</td>
                    <td>{{ implode(',', $datos['ingresaron']) }}</td>
                    <td>{{ implode(',', $datos['quedaron']) }}</td>
                    <td>{{ implode(',', $datos['salieron']) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endforeach -->