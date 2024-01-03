@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<br><br><hr>		
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
            <a href="#">About</a>
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
          <a href="{{route('admin.ambiente.reportegeneral')}}" target="_blank">REPORTE GENERAL TODOS LOS AMBIENTES</a>
        </li>
        <li>
          <a href="#" class="button" data-toggle="modal" data-target="#rangefecha">REPORTE POR FECHAS</a>  
        </li>
        <li>
        </li>
      </ul>
    </nav>
  </div>
<div class="floating-container">
    <button type="button" data-toggle="modal" data-target="#modelId">
        <div class="floating-button">+</div>
    </button>
</div>
<section class="wrapper" style="height: 80vh;">
  <div class="container-fostrap">
      <div class="content">
          <div class="container">
              <div class="row">
              @foreach ($ambientes as $ambiente)
                  <div class="col-xs-12 col-sm-4">
                      <div class="card card-block">
                      <form action="{{ route('caja.destroycaja', $ambiente) }}" method="POST" class="eliminar-form">
                          @method('DELETE')
                          @csrf
                          <button type="submit" class="text-right" style="padding:3%" title="Eliminar Registro">
                            <h4 class="card-title text-right"><i class="material-icons" style="color: red;">close</i></h4>
                          </button>
                      </form>
                        <h5 class="card-title mt-3 mb-3"><center>{{$ambiente->Nombre_Ambiente}}</center></h5>
                        <center>{{$ambiente->created_at}}</center><br>
                        <a href="{{ route('admin.ambiente.reserva', $ambiente) }}"
                            class="btn btn-danger ">Reservar
                        </a>
                    </div>
                  </div>
                  @endforeach
              </div>
              <div>
              </div>
          </div>
      </div>
  </div>
</section>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modelId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRAR AMBIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                  <form action="{{ route('admin.ambiente.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputNombre" class="is-required">Nombre Del ambiente</label><br>
                                <input type="text" name="Nombre_Ambiente" id="Nombre_Ambiente" value="{{ old('Nombre_Ambiente') }}" 
                                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                tabindex="1" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();">    
                            </div>
                        </div><br>
                        </div>  
                        <center>
                            <button type="submit" class="btn btn-danger">Cancelar</button>
                            <button type="submit" class="btn btn-success">Registrar</button>
                        </center>
                  </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="rangefecha" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buscar Por Rango FECHA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.ambiente.reportegeneralfecha') }}" method="get" target="_blank">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Desde Fecha</label><br>
                            <input type="date" id="desdefecha" name="desdefecha">
                        </div>
                        <div class="col-md-6">
                            <label for="">Hasta Fecha</label><br>
                            <input type="date" id="hastafecha" name="hastafecha">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-6 grid-margin stretch-card">
                            <button type="submit" class="btn btn-success" tabindex="4" style="width: 100%;" >Buscar </button>
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close" style="width: 100%;">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/bottonfooder.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/>
<style>
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

    img{
      height:150px;
      width:100%;
    }

    div [class^="col-"]{
      padding-left:5px;
      padding-right:5px;
    }
    .card{
      transition:0.5s;
      cursor:pointer;
    }
    .card-title{  
      font-size:15px;
      transition:1s;
      cursor:pointer;
    }
    .card-title i{  
      font-size:15px;
      transition:1s;
      cursor:pointer;
      color:#ffa710
    }
    .card-title i:hover{
      transform: scale(1.25) rotate(100deg); 
      color:#18d4ca;
      
    }
    .card:hover{
      transform: scale(1.05);
      box-shadow: 10px 10px 15px rgba(0,0,0,0.3);
    }
    .card-text{
      height:80px;  
    }

    .card::before, .card::after {
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      transform: scale3d(0, 0, 1);
      transition: transform .3s ease-out 0s;
      background: rgba(255, 255, 255, 0.1);
      content: '';
      pointer-events: none;
    }
    .card::before {
      transform-origin: left top;
    }
    .card::after {
      transform-origin: right bottom;
    }
    .card:hover::before, .card:hover::after, .card:focus::before, .card:focus::after {
      transform: scale3d(1, 1, 1);
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

    <script>
        $('.eliminar-form').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Quieres eliminar?',
                text: "El registro se eliminara definitivamente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>
    @if (session('delete') == 'ok')
        <script>
            Swal.fire(
                'Eliminar!',
                'Se Eliminó el registro.',
                'success'
            )
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $('#categoria').DataTable({
                responsive: true,
                autoWidth: false,
                "bSort" : false,
                "language": {
                    "lengthMenu": "Mostrar registro por página",
                    "zeroRecords": "No se encontro registro",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "search": "Buscar",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente"
                    },
                    "infoEmpty": "No hay registros",
                    "infoFiltered": "(Filtrado de _MAX_ registros totales)"
                },
                "lengthMenu": [
                    [4, 10, 50, -1],
                    [5, 10, 50, "All"]
                ]

            });
        });
    </script>
    @notifyJs
@endpush