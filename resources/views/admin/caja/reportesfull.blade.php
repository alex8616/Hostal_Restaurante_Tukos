@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<br><br><br><hr>		
    <!--Font-awsome-->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container">
          <header>
            <div style="text-align:center;margin-top:2px;font-weight:bold;text-decoration:none; width:100%">
    </div>            
          </header>
    <div class="xs-menu-cont">
    <a id="menutoggle"><i class="fa fa-align-justify"></i> </a>
      <nav class="xs-menu displaynone">
        <ul>
          <li>
            <a href="{{route('admin.caja.index')}}">CAJA</a>
          </li>
          <li>
            <a href="{{route('admin.ambiente.index')}}">About</a>
          </li>
          <li>
            <a href="#">Services</a>
          </li>
          <li>
            <a href="#">Team</a>
          </li>
          <li>
            <a href="#">Portfolio</a>
          </li>
          <li>
            <a href="#">Blog</a>
          </li>
          <li>
            <a href="#">Contact</a>
          </li>

        </ul>
      </nav>
    </div>
    <nav class="menu">
      <ul>
        <li class="active">
          <a href="{{route('admin.caja.index')}}">CAJA</a>
        </li>
        <li>
          <a href="{{route('admin.caja.codigo')}}">C0DIGOS</a>  
        </li>
        <li>
          <a href="{{route('admin.caja.articulos')}}">ARTICULOS</a>
        </li>
        <li>
          <a href="#" data-toggle="modal" data-target="#modelIdBuscarCaja">BUSQUEDA PERSONALIZADA</a>
        </li>
        <li>
          <a href="{{route('admin.caja.reportesfullexportar')}}" target="_blank">DESCARGAR EN PDF</a>
        </li>
      </ul>
    </nav>
  </div>
  <center>
    <div style="width: 97%; background-color:white;">
      <canvas id="myChart" width="200" height="100"></canvas>
    </div>
  </center>
  <div class="row" style="margin: auto; width:90%;">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
        <table class="table table-striped mt-0.5 table-bordered shadow-lg mt-4 dt-responsive nowrap" id="categoria">
          <caption>REPORTE DE MESES CAJA</caption> 
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
              <td>{{ $caja->caja_tarjetas_ingreso }}</td> 
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
          <div class="container">
        </div>
      </div>
    </div>
  </div>
  @include('admin.caja.BuscarCaja')
@endsection
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/bottonfooder.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 
<style>
   .ui-menu .ui-menu-item a {
    font-size: 12px;
    }
    .ui-autocomplete {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1510 !important;
    float: left;
    display: none;
    min-width: 160px;
    width: 160px;
    padding: 4px 0;
    margin: 2px 0 0 0;
    list-style: none;
    background-color: #ffffff;
    border-color: #ccc;
    border-color: rgba(0, 0, 0, 0.2);
    border-style: solid;
    border-width: 1px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -webkit-background-clip: padding-box;
    -moz-background-clip: padding;
    background-clip: padding-box;
    *border-right-width: 2px;
    *border-bottom-width: 2px;
    }
    .ui-menu-item > a.ui-corner-all {
        display: block;
        padding: 3px 15px;
        clear: both;
        font-weight: normal;
        line-height: 18px;
        color: #555555;
        white-space: nowrap;
        text-decoration: none;
    }
    .ui-state-hover, .ui-state-active {
        color: #ffffff;
        text-decoration: none;
        background-color: #0088cc;
        border-radius: 0px;
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        background-image: none;
    }
      .demo-card-square1.mdl-card {
      width: 320px;
      height: 320px;
      margin:auto;
    }
    .demo-card-square1 > .mdl-card__title {
      color: #fff;
      background:
        url('https://cdn3.iconfinder.com/data/icons/google-material-design-icons/48/ic_directions_car_48px-128.png') bottom right 15% no-repeat #46B6AC;
    }
    .demo-card-square2.mdl-card {
      width: 320px;
      height: 320px;
    }
    .demo-card-square2 > .mdl-card__title {
      color: #fff;
      background:
        url('') bottom right 15% no-repeat #46B6AC;
    }
    
    ol, ul {
      list-style: none;
    }
    blockquote, q {
      quotes: none;
    }
    blockquote:before, blockquote:after, q:before, q:after {
      content: '';
      content: none;
    }
    table {
      border-collapse: collapse;
      border-spacing: 0;
    }
    header h2 {
      margin: 25px 10px;
      font-size: 28px;
      text-align: center;
      color:  #ea5849;
    }
    .container {
      margin: 10px auto;
      display: table;
      max-width: 100%;
      width: 100%;
    }

    nav.menu {
      background: #ea5849;
      position: relative;
      min-height: 45px;
      height: 100%;
    }

    .menu > ul > li {
      list-style: none;
      display: inline-block;
      color: #fff;
      line-height: 45px;
      
    }
    .menu > ul li a, .xs-menu li a {
      text-decoration: none;
      color: #fff;
      display:block;
      padding: 0px 24px;
    }
    .menu > ul li a:hover {
      background:#444;
      color: #fff;
      transition-duration: 0.3s;
      -moz-transition-duration: 0.3s;
      -webkit-transition-duration: 0.3s;
    }

    .displaynone{
      display: none;
    }
    .xs-menu-cont{
    display:none;
    }
    .xs-menu-cont > a:hover{
    cursor: pointer;
    }
      
    .xs-menu li {
    color: #fff;
    padding: 14px 30px;
    border-bottom: 1px solid #ccc;
    background: #FF0000;

    }
    .xs-menu  a{
    text-decoration:none;
    }

    .mega-menu {
      background: none repeat scroll 0 0 #888;
        left: 0;
        margin-top: 3px;
        position: absolute;
        width: 100%;
      padding:15px;
      display:none;
      transition-duration: 0.9s;
        
    }
    #menutoggle i {
        color: #fff;
        font-size: 33px;
        margin: 0;
        padding: 0;
    }


    /*--column--*/
    .mm-6column:after, .mm-6column:before, .mm-3column:after, .mm-3column:before{
    content:"";
    display:table;
    clear:both;


    }
    .mm-6column, .mm-3column {
    float: left;
    position: relative;
    }
    .mm-6column {
        width: 100%;
    }
    .mm-3column {
            width: 25%;
    }
    .responsive-img {
        display: block;
        max-width: 100%;

    }
    .left-images{
    margin-right:25px;
    }
    .left-images, .left-categories-list {
      float: left;
    }
    .categories-list li {
        display: block;
        line-height: normal;
        margin: 0;
        padding: 5px 0;
    }
    .categories-list li :hover{
        background:inherit !important;
    }
    .left-images > p {
        background: none repeat scroll 0 0 #FF0000;
        display: block;
        font-size: 18px;
        line-height: normal;
        margin: 0;
        padding: 5px 14px;
    }
    .categories-list span {
        font-size: 18px;
        padding-bottom: 5px;
        text-transform: uppercase;
    }
    .mm-view-more{
      background: none repeat scroll 0 0 #FF0000;
        color: #fff;
        display: inline !important;
        line-height: normal;
        padding: 5px 8px !important;
      margin-top:10px;
    }
    .display-on{
    display:block;
    transition-duration: 0.9s;
    }
    .drop-down > a:after{
    content:"\f103";
    color:red;
    font-family: FontAwesome;
    font-style: normal;
    margin-left: 5px;
    }
</style>
@notifyCss

@push('js')
{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.8/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.8/js/responsive.bootstrap4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script>
      var cData = JSON.parse('<?php echo $data;?>')
      const ctx = document.getElementById('myChart').getContext('2d');
      const myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: cData.label,
              datasets: [{
                  label: '# of Votes',
                  data: cData.data,
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(153, 102, 255, 0.2)',
                      'rgba(255, 159, 64, 0.2)'
                  ],
                  borderColor: [
                      'rgba(255, 99, 132, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 206, 86, 1)',
                      'rgba(75, 192, 192, 1)',
                      'rgba(153, 102, 255, 1)',
                      'rgba(255, 159, 64, 1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });
    </script>
    @notifyJs
@endpush