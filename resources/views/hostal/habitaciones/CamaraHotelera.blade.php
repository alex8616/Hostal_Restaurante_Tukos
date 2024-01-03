<body>
@foreach ($dias_por_mes as $mes => $fechas)
    @foreach ($fechas as $fecha => $datos_fecha)  
    <div class="table-users" style="margin: auto;">
        <table cellspacing="0">
            <tbody>
                <tr>
                    <th colspan="9"> 
                        <P style="font-size: 20px;">PARTE DE PASAJEROS: HOSTAL TUKOS "LA CASA REAL"</P>
                    </th>
                </tr>
                <tr>
                    <th>NOMBRE Y APELLIDOS</th>
                    <th>EDAD</th>
                    <th>NACIONALIDAD</th>
                    <th>PROFESION</th>
                    <th>ESTADO</th>
                    <th>PROCEDENCIA</th>
                    <th>DOCUMENTO PASSAPORTE</th>
                    <th>OTORGADO</th>
                    <th>PIEZA</th>
                </tr>
                @if (empty($datos_fecha['ingresaron']))
                    <tr style="height: 18%;">
                        <td style="background: #C9F4AA; font-size: 15px;"" colspan="9">
                            <center>INGRESARON</center>
                        </td>                    
                    </tr>
                    <tr style="height: 18%;">
                        <td colspan="9" style="height: 18%; font-size: 15px;"">
                            SIN NOVEDAD
                        </td>
                    </tr>
                @else
                    <tr style="background: #C9F4AA; font-size: 15px;"">
                        <td colspan="9">
                            <center>INGRESARON</center>
                        </td>
                    </tr>
                    @foreach ($datos_fecha['ingresaron'] as $ingresaron)
                    <tr style="height: 18%;">                    
                        <td>{{$ingresaron['Nombre']}} {{$ingresaron['Apellido']}}</td>      
                        <td>{{$ingresaron['Edad']}}</td>     
                        <td>{{$ingresaron['Nacionalidad']}}</td>  
                        <td>{{$ingresaron['Profesion']}}</td>   
                        <td>{{$ingresaron['Estado']}}</td>
                        <td>{{$ingresaron['Procedencia']}}</td>  
                        <td>{{$ingresaron['Documento']}}</td> 
                        <td>{{$ingresaron['Nacionalidad']}}</td>  
                        <td><center>{{$ingresaron['Habitacion']}}</center></td>       
                    </tr>
                    @endforeach
                @endif
                @if (empty($datos_fecha['quedaron']))
                    <tr>
                        <td style="background: #0081C9; font-size: 15px;"" colspan="9">
                            <center>QUEDARON</center>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9" style="height: 18%; font-size: 15px;"">
                            SIN NOVEDAD
                        </td>
                    </tr>
                @else
                    <tr>
                        <td style="background: #0081C9; font-size: 15px;"" colspan="9">
                            <center>QUEDARON</center>
                        </td>
                    </tr>
                    @foreach ($datos_fecha['quedaron'] as $quedaron)
                    <tr>
                        <td>{{$quedaron['Nombre']}} {{$quedaron['Apellido']}}</td>  
                        <td>{{$quedaron['Edad']}}</td>     
                        <td>{{$quedaron['Nacionalidad']}}</td>  
                        <td>{{$quedaron['Profesion']}}</td>   
                        <td>{{$quedaron['Estado']}}</td>
                        <td>{{$quedaron['Procedencia']}}</td>  
                        <td>{{$quedaron['Documento']}}</td> 
                        <td>{{$quedaron['Nacionalidad']}}</td>  
                        <td><center>{{$quedaron['Habitacion']}}</center></td>   
                    </tr>
                    @endforeach
                @endif
                @if (empty($datos_fecha['salieron']))
                    <tr>
                        <td style="background: #FA7070; font-size: 15px;"" colspan="9">
                            <center>SALIERON</center>                        
                        </td>                    
                    </tr>
                    <tr>
                        <td colspan="9" style="height: 18%; font-size: 15px;">
                            SIN NOVEDAD
                        </td>
                    </tr>
                @else
                    <tr>
                        <td style="background: #FA7070; font-size: 15px;"" colspan="9">
                            <center>SALIERON</center>
                        </td>
                    </tr>
                    @foreach ($datos_fecha['salieron'] as $salieron)
                    <tr>
                        <td>{{$salieron['Nombre']}} {{$salieron['Apellido']}}</td>      
                        <td>{{$salieron['Edad']}}</td>     
                        <td>{{$salieron['Nacionalidad']}}</td>  
                        <td>{{$salieron['Profesion']}}</td>   
                        <td>{{$salieron['Procedencia']}}</td>
                        <td>{{$salieron['Nombre']}}</td>  
                        <td>{{$salieron['Documento']}}</td> 
                        <td>{{$salieron['Nacionalidad']}}</td>  
                        <td><center>{{$salieron['Habitacion']}}</center></td>   
                    </tr>
                    @endforeach
                @endif  
            <tbody>   
                <tr style="border: 1px solid #000000; margin: 0px">
                    <td colspan="9" style="text-align: right;">
                        <p style="font-size: 14px;">POTOSI - {{$fecha}}</p>
                    </td>
                </tr>
            </tfoot>                              
        </table>
        </div>
        <div style="page-break-after:always;"></div>
    @endforeach
@endforeach
</body>
<style>
    .header {
        color: white;
        font-size: 1.5em;
        padding: 1rem;
        text-align: center;
        text-transform: uppercase;
    }
    img {
        border-radius: 50%;
        height: 60px;
        width: 60px;
    }
    .table-users {
        border: 1px solid #000000;
        border-radius: 10px;
        margin: 5px;
        overflow: hidden;
        width: 100%;
        font-size: 0.6rem;        
    }
    table{
        border: 1px solid #000000;
        border-radius: 10px;
    }
    table th, table td {
        color: #000000;
        padding: 9px;
    }
    table th{
        border-bottom: 1px solid #000000;
        color: #000000;
        padding: 9px;
    }
    table td {
        border-right: 1px solid #000000;
        text-align: center;
        vertical-align: middle;
    }
    table td:last-child {
        font-size: 0.95em;
        line-height: 1.4;
        text-align: left;
    }
    table th {
        border-right: 1px solid #000000;
        font-weight: 300;
    }
</style>