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
        padding: 30px 0;
    }

    /* Table Styles */

    .table-wrapper{
        box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
    }

    .fl-table {
        border-radius: 5px;
        font-size: 14px;
        font-weight: normal;
        border: none;
        border-collapse: collapse;
        width: 100%;
        white-space: nowrap;
        background-color: white;
    }

    .fl-table td, .fl-table th {
        text-align: center;
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
    <table class="fl-table">
        <thead>
        <tr>
            <th class="text-center">
            <strong>N De Factura.</strong>
            </th>
            <th class="text-center">
            <strong>Codigo De Control</strong>
            </th>
            <th class="text-center">
            <strong>CI o NIT</strong>
            </th>
            <th class="text-center">
            <strong>Nombre Cliente</strong>
            </th>
            <th class="text-center">
            <strong>Fecha De Emision</strong>
            </th>
            <th class="text-center">
            <strong>Importe</strong>
            </th>
            <th class="text-center">
            <strong>Estado</strong>
            </th>
            <th class="text-center">
            <strong>Autorizacion</strong>
            </th>
            <th class="text-center">
            <strong>Fecha Limite</strong>
            </th>
        </tr>
        </thead>
        <tbody>
        @php
            $i=1;
        @endphp

        <tbody>
    </table>
