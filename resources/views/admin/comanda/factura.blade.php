<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link href="css/bootstrap.css" rel="stylesheet" />
		<div class="container">
			<div class="row">
		        <div class="col-xs-6 text-right">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                        <table style="width: 100%;">
                            <tr>
                                <td class="text-left" style="width: 250px;">
                                    <h1><a href=" ">
                                        <img id="logo" src="{{ base_path().'/public/img/picwish.png' }}" width="80%"> 
                                    </a></h1>
                                </td>
                                <td class="text-left" style="width: 160px;">
                                    <h5>PROPIETARIO :</h5>
                                    <h5>NIT :</h5>
                                    <h5>FACTURA N°:</h5>
                                    <h5>COD. AUTORIZACI&Oacute;N : </h5>
                                </td>
                                <td class="text-left" style="width: 250px;">
                                    <h5> 
                                        <a href="#">{{$empresas->Empresa_Propietario}}</a>
                                    </h5>
                                    <h5> 
                                        <a href="#">{{$empresas->Empresa_Nit}}</a>
                                    </h5>
                                    <h5>
                                    <?php 
                                        function zero_fill ($valor, $long = 0){
                                            return str_pad($valor, $long, '0', STR_PAD_LEFT);
                                        }
                                    ?>
                                        <a href="#"><?php echo zero_fill($factura->numFactura, 4)?></a>
                                    </h5> 
                                    <h5> 
                                        <a href="#">98756232598756232111115965955</a>
                                    </h5>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
			<hr />
            <h1 style="text-align: center;">FACTURA</h1>
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                    <div class="panel-body">
                        <table style="width: 90%;">
                        <tr>
                            <td>
                                <h5>NOMBRE / RAZON SOCIAL : </h5>
                                <h5>NIT/CI :</h5>
                                <h5>DIRECCION :</h5>
                            </td>
                            <td>
                                <h5>
                                    <a href="#">
                                        {{$factura->comanda->cliente->Nombre_cliente}}
                                        {{$factura->comanda->cliente->Apellidop_cliente}}
                                    </a>
                                </h5>
                                <h5>
                                    <a href="#">{{$factura->comanda->cliente->Nit_cliente}}</a>
                                </h5>
                                <h5>
                                    <a href="">{{$factura->comanda->cliente->Direccion_cliente}}<br>
                                    </a>
                                </h5>
                            </td>
                            <td>
                                <h5>FECHA : </h5>
                                <h5><br></h5>
                                <h5><br></h5>
                            </td>
                            <td>
                                <h5>
                                    @php
                                        $date = $factura->fecha_Emision;
                                    @endphp
                                    <a href="#">{{$date->format('Y-m-d')}}</a>
                                </h5>
                                <h5>
                                    <a href="#">{{$date->toTimeString();}}</a>
                                </h5>
                                <h5>
                                    <br>
                                </h5>
                            </td>
                        </tr>
                        
                        </table>
                    </div>
                </div>
            </div>	
		</div>
<pre></pre>
<table class="table table-bordered">
	<thead >
		<tr >
			<th style="text-align: center;">
				<h4>Cantidad</h4>
			</th>
			<th style="text-align: center;">
				<h4>Producto</h4>
			</th>
			<th style="text-align: center;">
				<h4>Precio unitario</h4>
			</th>
			<th style="text-align: center;">
				<h4>Total</h4>
			</th>
		</tr>
	</thead>
	<tbody>
        @foreach ($facturas as $detallecomanda)
        <tr>
            <td style="text-align: center;">{{ $detallecomanda->cantidad }}</td>
            <td class="producto"><a href="#">{{ Str::ucfirst($detallecomanda->Nombre_plato) }}</a></td>
            <td class=" text-right">Bs. {{ $detallecomanda->precio_venta }}</td>
            <td class=" text-right">Bs. {{  number_format($detallecomanda->precio_venta * $detallecomanda->cantidad, 2) }}</td>
        </tr>
        @endforeach
		<tr >
            <td colspan="2"><a href="#">Son: {{$numtext}}</a><br></td>
			<td style="text-align: right;"><strong>Total Bs.</strong></td>
			<td style="text-align: right;"><a href="#" ><strong>Bs. {{ number_format($factura->comanda->total, 2) }}</strong></a></td>
		</tr>
	</tbody>
</table>
<pre style="padding: 0px;">
    <strong class="text-center">Codigo De Control: {{$factura->codigo_Control}}</strong><br>
</pre>
		
    <div class="row">
    <div class="col-xs-6 text-right">
        <div class="panel panel-default">
        <div class="panel-heading">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 500px;">
                        <p style="text-align: center; font-size: 12px;">
                            <strong>
                                "ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAIS. EL USO ILICITO DE ESTA SERA SANCIONADO DE ACUERDO A LA LEY"<br>
                            </strong>
                            <span>
                                "Ley N° 453: los medios de comunicacion deben promover el respeto de los derechos de los usuarios y consumidores"
                            </span>
                        </p>
                    </td>
                    <td style="width: 200px; text-align: center;">
                        <h1><a href=" ">
                              <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate($factura->QR)) !!} "/>
                        </a></h1>
                    </td><br>
                </tr>
            </table>
        </div>
    </div>
</div>
</div>
</div>

</head>
<body>
	
</body>
</html> 