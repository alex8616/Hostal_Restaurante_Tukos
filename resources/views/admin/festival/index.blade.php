@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
@section('content')
<br><br><hr>
<!-- Button trigger modal -->
<a data-toggle="modal" data-target="#modelId">
  ADD
</a>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">REGISTRAR FESTIVAL</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
      <form action="{{ route('admin.festival.festivalstore') }}" method="POST" id="add-form" enctype="multipart/form-data">
      @csrf
          <div class="row">
              <div class="col-md-12">  
                  <div class="form-group">
                      <label class="col-sm-12 col-form-label is-required" for="Nombre_reserva">NOMBRE FESTIVAL: </label><br>
                      <input type="text" name="nombre_festival" id="nombre_festival" class="otraclaseform"
                          tabindex="1" autofocus onkeyup=" javascript:this.value=this.value.toUpperCase();" required>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-12 col-form-label is-required" for="inicio_caja">DESCRIPCION FESTIVAL: </label><br>
                      <input type="text" name="descripcion_festival" id="descripcion_festival" class="otraclaseform" required>
                  </div> 
                  <div>
                      <label class="col-sm-12 col-form-label is-required" for="inicio_caja">FOTO FESTIVAL: </label><br>
                      <input type="file" name="img_festival" id="img_festival">
                  </div> 
              </div>
          </div>
          <div id="preview"></div>
          <hr>
          <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                  <button type="submit" class="btn btn-secondary" tabindex="4" style="width: 100%;">Registrar </button>
              </div>
              <div class="col-md-6 grid-margin stretch-card">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" style="width: 100%;">Cancelar</button>
              </div>
          </div>
      </form> 
      </div>
    </div>
  </div>
</div>

<section class="wrapper">
  <div class="container-fostrap">
      <div class="content">
          <div class="container">
              <div class="row">
                @foreach($festivales as $festival)
                  <div class="col-xs-12 col-sm-4">
                      <div class="card card-block">
                      <form action="{{route('admin.festival.reportefestival')}}" target="_blank">
                        <h5 class="card-title mt-3 mb-3">
                        <center><strong>{{ $festival->nombre_festival }}</strong>
                        <br><br>
                        <img src="{{ asset(Storage::url($festival->foto_festival)) }}" alt="Mi imagen" class="imagen-estilo">
                        </center></h5><hr>
                        <table style="padding: 2500px;">
                          <tr>
                            <td class="text-center"style="background:#E9E9E9; padding:10px; width: 1000px">
                              <input type="text" id="festival_id" name="festival_id" value="{{ $festival->id }}" hidden>
                              <button type="submit" href="{{ route('admin.festival.reportefestival') }}" target="_blank">TOTAL {{ $festival->registrofestivales->sum('total') + $festival->reservafestivales->sum('Total_reserva') }} Bs.</button>
                            </td>
                          </tr>
                        </table>
                        <center>
                        <table>
                          <tr>
                            <td>
                            <a href="{{ route('admin.festival.registrar', $festival) }}"
                                class="btn btn-success" style="width: 100%">INGRESAR
                            </a>
                            </td>
                            <td>
                            <a href="{{ route('admin.festival.RealizarReserva', $festival) }}"
                                class="btn btn-secundary" style="width: 100%">RESERVAS
                            </a>
                            </td>
                          </tr>
                        </table>
                        </center>
                      </form>
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
@endsection
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/caja/registrar.css')}}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<style>
  .imagen-estilo {
    width: 300px;
    height: 250px;
    box-shadow: 0px 0px 10px 5px rgba(0, 0, 0, 0.5);
  }
  /*Input FORM*/
  .otraclase{
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .otraclase:focus {
        border-color: #4d94ff;
        box-shadow: 0 0 0 0.25rem rgba(77, 148, 255, 0.25);
    }
    .otraclaseform{
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .otraclaseform:focus {
        border-color: #4d94ff;
        box-shadow: 0 0 0 0.25rem rgba(77, 148, 255, 0.25);
    }
    /*FIN input*/
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
    }
    .imagen-articulo {
        display: inline-block;
        width: 110px;
        border: 1px solid #ccc;
        margin-right: 10px;
        border-radius: 10px;
    }
</style>
@notifyCss
@push('js')
@notifyJs
@endpush