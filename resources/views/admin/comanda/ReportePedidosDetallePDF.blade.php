<body>
@foreach ($days as $day)    
    <h2>{{ ucwords(\Carbon\Carbon::parse($day['date'])->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y')) }}</h2>

    <!--Tabla De PEDIDOS-->
    <table>
        <thead>
            <tr>
                <th colspan="5" style="background: black; color: white;">PEDIDOS</th>
            </tr>
            <tr>
                <th>ID</th>
                <th>NOMBRES CLIENTES</th>
                <th>DIRECCIONES</th>
                <th>PLATOS</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($day['comandas'] as $comanda)
                <tr>
                    <td><center>{{ $comanda->id }}</center></td>
                    @if($comanda->cliente_id != NULL)
                        @foreach($clientes as $cliente)
                            @if($cliente->id == $comanda->cliente_id)
                            <td>                       
                                {{ $cliente->Nombre_cliente }} {{ $cliente->Apellidop_cliente }}                            
                            </td>
                            <td>
                                {{ $cliente->Direccion_cliente }}
                            </td>
                            @endif
                        @endforeach
                    @else                         
                        <td>
                            @foreach($tipoclientes as $tipocliente)
                                @if($tipocliente->tipo_id == $comanda->tipo_cliente_id)                       
                                    {{ $tipocliente->Nombre_cliente }} {{ $tipocliente->Apellidop_cliente }}<br>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($tipoclientes as $tipocliente)
                                @if($tipocliente->tipo_id == $comanda->tipo_cliente_id)                       
                                    {{ $tipocliente->Direccion_cliente }}<br>
                                @endif
                            @endforeach
                        </td>
                    @endif
                    <td>{{ $comanda->platos }}</td>
                    <td><center>{{ $comanda->total }}</center></td>
                </tr>                    
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">TOTAL DIA</td>
                <td><center>{{ $day['total'] }}</center></td>
            </tr>
        </tfoot>
    </table>
    
    <!--Tabla De MESAS-->
    <table>
        <thead>
            <tr>
                <th colspan="5" style="background: black; color: white;">MESAS</th>
            </tr>
            <tr>
                <th>ID</th>
                <th>N DE MESA</th>
                <th>DIRECCION</th>
                <th>PLATOS</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($day['comandamesas'] as $comandamesa)
                <tr>
                    <td><center>{{ $comandamesa->id }}</center></td>                                          
                    @foreach($mesas as $mesa)
                        @if($mesa->id == $comandamesa->mesa_id)
                        <td>                       
                            {{ $mesa->Nombre_mesa }}
                        </td>
                        @endif
                    @endforeach
                    <td>RESTAURANTE</td>
                    <td>{{ $comandamesa->platosmesas }}</td>
                    <td><center>{{ $comandamesa->total }}</center></td>
                </tr>                    
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">TOTAL DIA</td>
                <td><center>{{ $day['totalmesas'] }}</center></td>
            </tr>
        </tfoot>
    </table>

    <!--Tabla De TUKOMANAS-->
    <table>
        <thead>
            <tr>
                <th colspan="5" style="background: black; color: white;">TUKOMANAS</th>
            </tr>
            <tr>
                <th>ID</th>
                <th>CLIENTE</th>
                <th>DIRECCION</th>
                <th>PLATOS</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($day['TukoManas'] as $TukoMana)
                <tr>
                    <td><center>{{ $TukoMana->id }}</center></td>                                          
                    @foreach($clientes as $cliente)
                        @if($cliente->id == $TukoMana->cliente_id)
                        <td>                       
                            {{ $cliente->Nombre_cliente }} {{ $cliente->Apellidop_cliente }}                            
                        </td>
                        <td>
                            {{ $cliente->Direccion_cliente }}
                        </td>
                        @endif
                    @endforeach
                    <td>{{ $TukoMana->platos }}</td>
                    <td><center>{{ $TukoMana->total }}</center></td>
                </tr>                    
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">TOTAL DIA</td>
                <td><center>{{ $day['totaltukomanas'] }}</center></td>
            </tr>
        </tfoot>
    </table>

     <!--Tabla De CAFETERIA-->
     <table>
        <thead>
            <tr>
                <th colspan="5" style="background: black; color: white;">CAFETERIA</th>
            </tr>
            <tr>
                <th>ID</th>
                <th>CLIENTE</th>
                <th>DIRECCION</th>
                <th>PLATOS</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($day['cafeterias'] as $cafeteria)
                <tr>
                    <td><center>{{ $cafeteria->id }}</center></td>                                          
                    @foreach($clientes as $cliente)
                        @if($cliente->id == $cafeteria->cliente_id)
                        <td>                       
                            {{ $cliente->Nombre_cliente }} {{ $cliente->Apellidop_cliente }}                            
                        </td>
                        <td>
                            {{ $cliente->Direccion_cliente }}
                        </td>
                        @endif
                    @endforeach
                    <td>{{ $cafeteria->platos }}</td>
                    <td><center>{{ $cafeteria->total }}</center></td>
                </tr>                    
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">TOTAL DIA</td>
                <td><center>{{ $day['totalcafeterias'] }}</center></td>
            </tr>
        </tfoot>
    </table>

     <!--Tabla De COMIDARAPIDA-->
     <table>
        <thead>
            <tr>
                <th colspan="5" style="background: black; color: white;">COMIDA RAPIDA</th>
            </tr>
            <tr>
                <th>ID</th>
                <th>N DE MESA</th>
                <th>DIRECCION</th>
                <th>PLATOS</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($day['comidarapidas'] as $comidarapida)
                <tr>
                    <td><center>{{ $comidarapida->id }}</center></td>                                          
                    @foreach($clientes as $cliente)
                        @if($cliente->id == $comidarapida->cliente_id)
                        <td>                       
                            {{ $cliente->Nombre_cliente }} {{ $cliente->Apellidop_cliente }}                            
                        </td>
                        <td>
                            {{ $cliente->Direccion_cliente }}
                        </td>
                        @endif
                    @endforeach
                    <td>{{ $comidarapida->platos }}</td>
                    <td><center>{{ $comidarapida->total }}</center></td>
                </tr>                    
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">TOTAL DIA</td>
                <td><center>{{ $day['totalcomidarapida'] }}</center></td>
            </tr>
        </tfoot>
    </table>

    <!--Tabla De INFORMACION COMPLETA-->
    <table>
        <thead>
            <tr>
                <th colspan="2" style="background: black; color: white;">INFORME GENERAL</th>
            </tr>
            <tr>
                <th>CONSUMO PEDIDOS Y MESAS</th>
                <th>CONSUMO TUKOMANAS</th>                
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <center><span style="color: red;">"Nota es este apartado se esta contando los Pedidos y Mesas"</span></center>
                    <p>Total Ventas del día: {{ $day['comandasDia'] + $day['comandaMesaDia'] }}</p>
                    <p>Total De Platos Vendidos Al Dia:</p>
                    <ul>
                        @foreach ($day['platosContados'] as $plato => $cantidad)
                            <li>{{ $plato }}: {{ $cantidad }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <p>Total Ventas del día: {{ $day['tukomanasDia'] }}</p>
                    <p>Total De Platos Vendidos Al Dia:</p>
                    <ul>
                        @foreach ($day['platosTukomanas'] as $plato => $cantidad)
                            <li>{{ $plato }}: {{ $cantidad }}</li>
                        @endforeach
                    </ul>
                </td>                
            </tr>
            <tr>
                <th>CONSUMO CAFETERIA</th>
                <th>CONSUMO COMIDA RAPIDA</th>
            </tr>
            <tr>
                <td>
                    <p>Total Ventas del día: {{ $day['cafeteriasDia'] }}</p>
                    <p>Total De Platos Vendidos Al Dia:</p>
                    <ul>
                        @foreach ($day['cafeteriaContados'] as $plato => $cantidad)
                            <li>{{ $plato }}: {{ $cantidad }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <p>Total Ventas del día: {{ $day['comidarapidasDia'] }}</p>
                    <p>Total De Platos Vendidos Al Dia:</p>
                    <ul>
                        @foreach ($day['comidarapidaContados'] as $plato => $cantidad)
                            <li>{{ $plato }}: {{ $cantidad }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        </tbody>
    </table>  
    <div style="page-break-after:always;"></div>
@endforeach
<h3>EN LAS FECHAS SELECCIONADAS DESDE {{$desde}} HASTA {{$hasta}}</h3>
<table style="width: 35%">
    <tr>
        <td>PEDIDOS</td>
        <td style="text-align: right;">{{$totalPedidosAux}} Bs.</td>
    </tr>
    <tr>
        <td>MESAS</td>
        <td style="text-align: right;">{{$totalMesasAux}} Bs.</td>
    </tr>
    <tr>
        <td>TUKOMANAS</td>
        <td style="text-align: right;">{{$totalTukomanasAux}} Bs.</td>
    </tr>
    <tr>
        <td>CAFETERIA</td>
        <td style="text-align: right;">{{$totalCafeteriaAux}} Bs.</td>
    </tr>
    <tr>
        <td>COMIDA RAPIDA</td>
        <td style="text-align: right;">{{$totalComidaRapidaAux}} Bs.</td>
    </tr>
    <tr>
        <td style="color:black; font-weight: bold;">SUMATORIA</td>
        <td style="text-align: right; color:black; font-weight: bold;">{{$totalventas}} Bs.</td>
    </tr>
</table>
<table style="width: 60%">
    <tr>
        <td>PEDIDOS</td>
        <td style="text-align: right;">{{$totalPedidosAux}} Bs.</td>
    </tr>
    <tr>
        <td>MESAS</td>
        <td style="text-align: right;">{{$totalMesasAux}} Bs.</td>
    </tr>
    <tr>
        <td>TUKOMANAS</td>
        <td style="text-align: right;">{{$totalTukomanasAux}} Bs.</td>
    </tr>
    <tr>
        <td>CAFETERIA</td>
        <td style="text-align: right;">{{$totalCafeteriaAux}} Bs.</td>
    </tr>
    <tr>
        <td>COMIDA RAPIDA</td>
        <td style="text-align: right;">{{$totalComidaRapidaAux}} Bs.</td>
    </tr>
    <tr>
        <td style="color:black; font-weight: bold;">SUMATORIA</td>
        <td style="text-align: right; color:black; font-weight: bold;">{{$totalventas}} Bs.</td>
    </tr>
</table>

 <div style="page-break-after:always;"></div>

<table>
    <tr>
        <th colspan="6">CANTIDAD DE PLATOS DE FECHA SELECCIONADO</th>
    </tr>
    @php
        $platosContadosTotalChunks = array_chunk($platosContadosTotal, 3, true);
    @endphp
    
    @foreach($platosContadosTotalChunks as $chunk)
        <tr>
            @foreach($chunk as $nombrePlato => $cantidad)
                <td>{{ $nombrePlato }}</td>
                <td>{{ $cantidad }}</td>
            @endforeach
            
            @if(count($chunk) < 3)
                <td colspan="{{ 3 - count($chunk) }}"></td>
            @endif            
        </tr>
    @endforeach
</table>
</body>
<style>
    table {
      width: 100%;
      border-collapse: collapse;
      border: 2px solid black;
      font-size: 0.7rem;
      border: 1px solid #000000;
      padding: 15px;
    }

    td, th {
      border: 1px solid rgb(190,190,190);
      padding: 10px 20px;
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
      padding: 10px;
    }

    tr:nth-child(odd) td {
      background-color: white;
      padding: 10px;
    }

    caption {
      padding: 10px;
    }
</style>