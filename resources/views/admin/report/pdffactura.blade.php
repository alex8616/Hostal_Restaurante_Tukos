<table id="order-listing" class="table table-striped mt-0.5 table-bordered shadow-lg mt-4">
    <thead class="bg-primary text-white">
        <tr>
            <th>N° FACTURA</th>
            <th>CODIGO DE CONTROL</th>
            <th>CI o NIT</th>
            <th>CLIENTE</th>
            <th>FECHA DE EMISION</th>
            <th>IMPORTE</th>
            <th>ESTADO</th>
            <th>AUTORIZACION</th>
            <th>FECHA LIMITE</th>
            <th style="width:50px;">Ver</th>
        </tr>
    </thead>
    <tbody> 
        @foreach ($datafactura as $new)
            <tr>
                <td><strong>{{ $new->numFactura }}</strong></td>
                <td>{{ $new->codigo_Control }}</td>
             
            </tr>
        @endforeach
    </tbody>
</table>
