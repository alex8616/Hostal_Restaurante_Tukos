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
    }

    /* Table Styles */

    .table-wrapper{
        box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
    }

    .fl-table td, .fl-table th {
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
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 
<table style="width:90%;">
	<tr>
		<td><img id="logo" src="{{ base_path() . '/public/img/picwish.png' }}" width="100%"></td>
		<td style="width:60%;">
				<center><h1 style="color:#FFA02E; font-size:45px">REPORTE CAJAS TUKO'S</h1></center>
		</td>
	</tr>
</table>
<hr>
<div class="table-wrapper">
    <table class="fl-table" style="width: 100%;">
            @foreach($detallecajas as $detallecaja)    
            @endforeach               
            @foreach ($cajas as $caja)
            <tr style="background-color: #6A95FF;"> 
              <th>Fecha De Caja</th>
              <th>Codigo</th>
              <th>Ingresos</th>
              <th>Egresos</th> 
              <th>Sub Total</th> 
            </tr> 
            <tr> 
              <th rowspan="4" style="width: 250px;">
                Mes de {{ \Carbon\Carbon::parse($caja->fecha_registro)->locale('es')->isoFormat(' MMMM \d\e\l Y') }}<br>
                <center>({{ \Carbon\Carbon::parse($caja->fecha_registro)->format('d-m-Y') }})</center>
              </th> 
              <th>Hostal</th>
              <td>{{ $caja->caja_hostal_ingreso }}</td> 
              <td>{{ $caja->caja_hostal_egreso }}</td> 
              <td>{{ $caja->caja_hostal_ingreso - $caja->caja_hostal_egreso }}</td>
            </tr>
            <tr>
              <th>Restaurante</th> 
              <td>{{ $caja->caja_restaurante_ingreso }}</td> 
              <td>{{ $caja->caja_restaurante_egreso }}</td> 
              <td>{{ $caja->caja_restaurante_ingreso - $caja->caja_restaurante_egreso }}</td> 
            </tr> 
            <tr> 
              <th>Tarjetas</th>
              <td>{{ $caja->caja_tarjetas_ingreso }}</td  > 
              <td>0.00</td> 
              <td>{{ $caja->caja_tarjetas_ingreso }}</td> 
            </tr>
            <tr> 
              <th>Depositos</th>
              <td>{{ $caja->caja_depositos_ingreso }}</td  > 
              <td>0.00</td> 
              <td>{{ $caja->caja_depositos_ingreso }}</td> 
            </tr>
            <tr>
              <th style="border: 0px;"></th>
              <th style="border: 0px;"></th>
              <th style="border: 0px;"></th>
              <th style="background-color: #B2C0FF;">Total: </th>
              <th style="background-color: #B2C0FF;"> {{ $caja->total }}</th>
            </tr>
            <tr>
              <th style="border: 0px;"></th>
              <th style="border: 0px;"></th>
              <th style="border: 0px;"></th>
              <th style="border: 0px;"></th>
              <th style="border: 0px;"></th>
            </tr>
            @endforeach
    </table>
</div>
