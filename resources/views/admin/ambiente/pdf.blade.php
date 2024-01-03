<div id="invoice">
    <div class="invoice overflow-auto">
        <div style="min-width: 500px">
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <h2 class="to">{{$reserva->cliente}}</h2>
                        <div class="address">{{$reserva->motivo}}</div>
                    </div>
                    <div class="col invoice-details">
                    @foreach($ambientes as $ambiente)
                        @if($ambiente->id == $reserva->ambiente_id)
                        <h1 class="invoice-id">RESERVA {{$ambiente->Nombre_Ambiente}}</h1>
                        <div class="date">{{$reserva->fecha}}</div>
                        <div class="date">Desde <strong style="color:#3989c6">{{$reserva->hora_inicio}}</strong> hasta <strong style="color:#3989c6">{{$reserva->hora_fin}}</strong></div>
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left">Detalle</th>
                            <th class="text-right">Cantidad</th>
                            <th class="text-right">Precio</th>
                            <th class="text-right">SubTotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=2;
                        @endphp
                        <tr>
                            <td class="no">1</td>
                            <td class="text-left"><h3>
                            {{$ambiente->Nombre_Ambiente}} - {{$reserva->motivo}}
                            </td>
                            <td class="unit">1</td>
                            <td class="qty">{{$reserva->precio}}</td>
                            <td class="total">{{$reserva->precio}}</td>
                        </tr>
                        @endif
                        @endforeach
                        @foreach($detallereservas as $detallereserva)
                        @if($detallereserva->reserva_id == $reserva->id)
                        <tr>
                            <td class="no">{{$i++}}</td>
                            <td class="text-left"><h3>
                                {{$detallereserva->descripcion_refrigerio}}
                            </td>
                            <td class="unit">{{$detallereserva->cantidad_refrigerio}}</td>
                            <td class="qty">{{$detallereserva->precio_refrigerio}}</td>
                            <td class="total">{{$detallereserva->cantidad_refrigerio * $detallereserva->precio_refrigerio}}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <br>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">TOTAL</td>
                            <td>Bs. {{$reserva->total}}</td>
                        </tr>
                    </tfoot>
                </table>
                <!-- <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                </div> -->
            </main>
            <!-- <footer>
                Invoice was created on a computer and is valid without the signature and seal.
            </footer> -->
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>
<style>
    #invoice{
    margin: auto;
}

.invoice {
    background-color: #FFF;
    min-height: 100%;
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #3989c6
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #3989c6
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #3989c6
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #3989c6;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #3989c6;
    font-size: 1.4em;
    border-top: 1px solid #3989c6
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}
</style>