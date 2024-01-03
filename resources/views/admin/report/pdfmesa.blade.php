<style>
    body{
    color: #2e323c;
    position: relative;
    height: 100%;
}
.invoice-container {
    padding: 1rem;
}
.invoice-container .invoice-header .invoice-logo {
    margin: 0.8rem 0 0 0;
    display: inline-block;
    font-size: 1.6rem;
    font-weight: 700;
    color: #2e323c;
}
.invoice-container .invoice-header .invoice-logo img {
    max-width: 130px;
}
.invoice-container .invoice-header address {
    font-size: 0.8rem;
    color: #9fa8b9;
    margin: 0;
}
.invoice-container .invoice-details {
    margin: 1rem 0 0 0;
    padding: 1rem;
    line-height: 180%;
    background: #f5f6fa;
}
.invoice-container .invoice-details .invoice-num {
    text-align: right;
    font-size: 0.8rem;
}
.invoice-container .invoice-body {
    padding: 1rem 0 0 0;
}
.invoice-container .invoice-footer {
    text-align: center;
    font-size: 0.7rem;
    margin: 5px 0 0 0;
}

.invoice-status {
    text-align: center;
    padding: 1rem;
    background: #ffffff;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    margin-bottom: 1rem;
}
.invoice-status h2.status {
    margin: 0 0 0.8rem 0;
}
.invoice-status h5.status-title {
    margin: 0 0 0.8rem 0;
    color: #9fa8b9;
}
.invoice-status p.status-type {
    margin: 0.5rem 0 0 0;
    padding: 0;
    line-height: 150%;
}
.invoice-status i {
    font-size: 1.5rem;
    margin: 0 0 1rem 0;
    display: inline-block;
    padding: 1rem;
    background: #f5f6fa;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
}
.invoice-status .badge {
    text-transform: uppercase;
}

@media (max-width: 767px) {
    .invoice-container {
        padding: 1rem;
    }
}


.custom-table {
    border: 1px solid #e0e3ec;
	width: 100%;
}
.custom-table thead {
    background: #007ae1;
}
.custom-table thead th {
    border: 0;
    color: #ffffff;
}
.custom-table > tbody tr:hover {
    background: #fafafa;
}
.custom-table > tbody tr:nth-of-type(even) {
    background-color: #ffffff;
}
.custom-table > tbody td {
    border: 1px solid #e6e9f0;
	padding: 10px;
}


.card {
    background: #ffffff;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    border: 0;
    margin-bottom: 1rem;
}

.text-success {
    color: #00bb42 !important;
}

.text-muted {
    color: #9fa8b9 !important;
}

.custom-actions-btns {
    margin: auto;
    display: flex;
    justify-content: flex-end;
}

.custom-actions-btns .btn {
    margin: .3rem 0 .3rem .3rem;
}

</style>
<hr>
<table style="width:90%;">
	<tr>
		<td><img id="logo" src="{{ base_path() . '/public/img/picwish.png' }}" width="100%"></td>
		<td style="width:60%;">
			@if ($tipoReporte == 0)
				<center><h1>REPORTE DE VENTAS - MESA DEL DIA RESTAURANTE TUKO'S</h1></center>
			@else
				<center><h1>REPORTE DE VENTAS - MESA POR FECHAS RESTAURANTE TUKO'S</h1></center>
			@endif
			@if ($tipoReporte != 0)
				<center>(Fecha Consulta: {{ $desde }} al {{ $hasta }})</center>
			@else
				<center>(Fecha Consulta: {{ \Carbon\Carbon::now()->format('d-m-Y') }})</center>
			@endif
		</td>
	</tr>
</table>


<div class="container">
<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="card">
				<div class="card-body p-0">
					<div class="invoice-container">
						<hr>
						<div class="invoice-body">
							<!-- Row start -->
							<div class="row gutters">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="table-responsive">
										<table class="table custom-table m-0">
											<thead>
												<tr>
													<th style="text-align: center;">Id</th>
													<th style="text-align: center;">Fecha</th>
													<th style="text-align: center;"># Mesa</th>
													<th style="text-align: center;">User</th>
													<th style="text-align: center;">Total</th>
												</tr>
											</thead>
											<tbody>
											@foreach ($data as $venta)
												<tr>
													<td style="text-align: center;">
															{{ $venta->id }}
														<td scope="row" style="text-align: center;">
															{{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d-M-y H:i a') }}
														</td>
														<td scope="row">{{$venta->mesa->Nombre_mesa}}</td>
														<td scope="row">{{ $venta->user }}</td>
														<td scope="row">Bs. {{ number_format($venta->total, 2) }}</td>
												</tr>
											@endforeach
											</tbody>
											<tfoot>
												<tr>
													<td colspan="4">
														<strong><p align="right" style="color: blue !important;">TOTAL INGRESOS:</p></strong>
													</td>
													<td>
														<strong><p align="left" style="color: blue !important;">Bs. {{ number_format($data->sum('total'), 2) }}</p></strong>
													</td>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>