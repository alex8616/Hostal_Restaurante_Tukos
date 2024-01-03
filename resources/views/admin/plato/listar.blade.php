@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List')])

@section('content')
<br><br><hr>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container">
          <header>
        <div style="text-align:center;margin-top:2px;font-weight:bold;text-decoration:none;">
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
          <a href="{{route('admin.plato.index')}}">LISTA PLATOS</a>
        </li>
        <li>
          <a href="{{route('admin.plato.listar')}}">GRID PLATOS</a>  
        </li>
      </ul>
    </nav>
  </div>
<section class="wrapper">
    <div class="container-fostrap" style="background-color: white; width:90%; margin:auto;">
        <div class="content">
            <div class="container">
                <div class="row">
                @foreach($platos as $plato)
                    <div class="col-xs-12 col-sm-4">
                        <div class="card">
                            <a class="img-card" href="#">
                            @if (isset($plato->imagen))
                                <img class="img-thumbnail" src="{{ asset('storage' . '/' . $plato->imagen) }}"/>
                            @else
                                <img class="img-thumbnail" src="{{ asset('storage/uploads/nofound.jpg') }}"/>
                            @endif
                          </a>
                            <div class="card-content">
                                <h4 class="card-title">
                                    <a href="#"> {{$plato->Nombre_plato}}</a>
                                </h4><br><br>
                                <p class="" style="float:left">
                                    <i class="fa-solid fa-money-bill-1-wave"></i> Precio: {{ $plato->Precio_plato }} Bs.                                
                                </p>
                                <p style="float:right">
                                    <i class="fa-solid fa-calendar-days"></i> Registro: {{date('d/m/Y');}}
                                </p>
                            </div><br><br>
                            <div class="card-read-more">
                                <form action="{{ route('admin.plato.destroy', $plato) }}" method="POST" class="eliminar-form">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-outline-info" style="width:48%" type="button" data-toggle="modal" style="padding:6%" data-target="#EditPlato{{ $plato->id }}" title="Actualizar Registro">
                                    EDITAR
                                    </button>
                                    <button type="button" class="btn btn-outline-warning" style="width:48%" data-toggle="modal" style="padding:6%" data-target="#ShowPlato{{ $plato->id }}" title="Actualizar Registro">
                                    VER
                                    </button>
                                </form>
                            </div><br>
                        </div>
                    </div>
                    @include('admin.plato.EditPlato')
                    @include('admin.plato.ShowPlato')
                    @endforeach
                </div>
                <div>
                    {{$platos->links()}}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
<style>    
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
        @import url(https://fonts.googleapis.com/css?family=Roboto:400,100,900);

    html,
    body {
    -moz-box-sizing: border-box;
        box-sizing: border-box;
    height: 100%;
    width: 100%; 
    background: #FFF;
    font-family: 'Roboto', sans-serif;
    font-weight: 400;
    }
    
    .wrapper {
    display: table;
    height: 100%;
    width: 100%;
    }

    .container-fostrap {
    display: table-cell;
    text-align: center;
    vertical-align: middle;
    }
    .fostrap-logo {
    width: 100px;
    margin-bottom:15px
    }
    h1.heading {
    color: #fff;
    font-size: 1.15em;
    font-weight: 900;
    margin: 0 0 0.5em;
    color: #505050;
    }
    @media (min-width: 450px) {
    h1.heading {
        font-size: 3.55em;
    }
    }
    @media (min-width: 760px) {
    h1.heading {
        font-size: 3.05em;
    }
    }
    @media (min-width: 900px) {
    h1.heading {
        font-size: 3.25em;
        margin: 0 0 0.3em;
    }
    } 
    .card {
    display: block; 
        margin-bottom: 20px;
        line-height: 1.42857143;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12); 
        transition: box-shadow .25s; 
    }
    .card:hover {
    box-shadow: 0 8px 17px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    }
    .img-card {
    width: 100%;
    height:200px;
    border-top-left-radius:2px;
    border-top-right-radius:2px;
    display:block;
        overflow: hidden;
    }
    .img-card img{
    width: 100%;
    height: 200px;
    object-fit:cover; 
    transition: all .25s ease;
    } 
    .card-content {
    padding:15px;
    text-align:left;
    }
    .card-title {
    margin-top:0px;
    font-weight: 700;
    font-size: 1.65em;
    }
    .card-title a {
    color: #000;
    text-decoration: none !important;
    }
    .card-read-more {
    border-top: 1px solid #D4D4D4;
    }
    .card-read-more a {
    text-decoration: none !important;
    padding:10px;
    font-weight:600;
    text-transform: uppercase
    }
</style>

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>
    <script>
       // VARIABLES
        const rangeInput = document.querySelector('input[type = "range"]');
        const imageList = document.querySelector(".image-list");
        const searchInput = document.querySelector('input[type="search"]');
        const btns = document.querySelectorAll(".view-options button");
        const photosCounter = document.querySelector(".toolbar .counter span");
        const imageListItems = document.querySelectorAll(".image-list li");
        const captions = document.querySelectorAll(".image-list figcaption p:first-child");
        const myArray = [];
        let counter = 1;
        const active = "active";
        const listView = "list-view";
        const gridView = "grid-view";
        const dNone = "d-none";

        // SET VIEW
        for (const btn of btns) {
        btn.addEventListener("click", function() {
            const parent = this.parentElement;
            document.querySelector(".view-options .active").classList.remove(active);
            parent.classList.add(active);
            this.disabled = true;
            document.querySelector('.view-options [class^="show-"]:not(.active) button').disabled = false;

            if (parent.classList.contains("show-list")) {
            parent.previousElementSibling.previousElementSibling.classList.add(dNone);
            imageList.classList.remove(gridView);
            imageList.classList.add(listView);
            } else {
            parent.previousElementSibling.classList.remove(dNone);
            imageList.classList.remove(listView);
            imageList.classList.add(gridView);
            }
        });
        }

        // SET THUMBNAIL VIEW - CHANGE CSS VARIABLE
        rangeInput.addEventListener("input", function() {
        document.documentElement.style.setProperty("--minRangeValue",`${this.value}px`);
        });

        // SEARCH FUNCTIONALITY
        for (const caption of captions) {
        myArray.push({
            id: counter++,
            text: caption.textContent
        });
        }

        searchInput.addEventListener("keyup", keyupHandler);

        function keyupHandler() {
        for (const item of imageListItems) {
            item.classList.add(dNone);
        }
        const text = this.value;
        const filteredArray = myArray.filter(el => el.text.includes(text));
        if (filteredArray.length > 0) {
            for (const el of filteredArray) {
            document.querySelector(`.image-list li:nth-child(${el.id})`).classList.remove(dNone);
            }
        }
        photosCounter.textContent = filteredArray.length;
        }
    </script>
    
    @if(session('eliminar')=='ok')
        <script>
            Swal.fire(
                    'Eliminando ...',
                    'Los Datos Fueron ELIMINADOS Correctamente',
                    'success'
                    )
        </script>
    @endif

    @if(session('actualizar')=='ok')
        <script>
            Swal.fire(
                    'Actualizando ...',
                    'Los Datos Fueron Actualizados Correctamente',
                    'success'
                    )
        </script>
    @endif

    <script>
        $('.formulario-eliminar').submit(function(e){
            e.preventDefault();
                Swal.fire({
                title: '¿Estas Seguro?',
                text: "Este Plato Se Eliminara Definitivamente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡SI, Eliminar!'
                }).then((result) => {
                if (result.value) {
                    this.submit();
                }
                })
        })
    </script>
@stop


