@extends('layouts.app', ['activePage' => 'icons', 'titlePage' => __('Icons')])

@section('content')
<br><br><hr>
<div class="container-fluid">
    <div class="container-fluid">
    <div class="card card-plain">
        <div class="card-header card-header-warning">
        <h4 class="card-title">INFORMACION DE LA EMPRESA</h4>
        <p class="card-category">Restaurante Tuko's La Casa Real
        </p>
        </div>
        <div class="card" style="width: 100%;">
            <div class="card-body" style="width: 90%;  margin: 0 auto;">
                <div class="row">
                    <div class="form-group col-md-6">
                        @if (isset($empresa->Empresa_Logo))
                            <img src="{{ 'imagen' . '/' . $empresa->Empresa_Logo }}" width="100%" alt="logo.png" class="img-thumbnail">
                        @else
                            <img src="storage/uploads/logoempresa.png" alt="logo-defecto.png"
                                width="100%">
                        @endif
                        <br>
                        <center>
                            <button type="button" class="btn btn-success float-center" data-toggle="modal"
                                data-target="#exampleModal-2">Actualizar información de la empresa</button>
                        </center>
                    </div>
                    <div class="form-group col-md-6">
                        <strong><i class="fa-sharp fa-solid fa-user"></i> Propietario</strong>
                            <p class="text-muted">{{ $empresa->Empresa_Propietario }}</p><hr>
                        <strong><i class="fa-sharp fa-solid fa-address-card"></i> NIT</strong>
                            <p class="text-muted">{{ $empresa->Empresa_Nit }}</p><hr>
                        <strong><i class="fa-sharp fa-solid fa-city"></i> Nombre - Empresa </strong>
                            <p class="text-muted">{{ $empresa->Empresa_Nombre }}</p><hr>
                        <strong><i class="fa-sharp fa-solid fa-envelope"></i> Correo electrónico</strong>
                            <p class="text-muted">{{ $empresa->Empresa_Email }}</p><hr>
                        <strong><i class="fas fa-map-marked-alt mr-1"></i> Dirección</strong>
                            <p class="text-muted">{{ $empresa->Empresa_Direccion }}</p><hr>
                        <strong><i class="fa-sharp fa-solid fa-phone"></i> Telefono</strong>
                            <p class="text-muted">{{ $empresa->Empresa_Telefono }}</p><hr>
                        <strong><i class="fas fa-align-left mr-1"></i> Descripción</strong>
                            <p class="text-muted">{{ $empresa->Empresa_Descripcion }}</p><hr>            
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</div>
<div class="modal fade bd-example-modal-lg" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRAR CLIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                    <div class="col-md-12">
                        {!! Form::model($empresa, ['route' => ['admin.empresa.update', $empresa], 'method' => 'PUT', 'files' => true]) !!}
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="Empresa_Propietario" class="is-required">Propietario</label>
                                    <input type="text" class="form-control" name="Empresa_Propietario" id="Empresa_Propietario"
                                        value="{{ $empresa->Empresa_Propietario }}" aria-describedby="helpId">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Empresa_Nit" class="is-required">Numero de NIT</label>
                                    <input type="text" class="form-control" name="Empresa_Nit" id="Empresa_Nit" value="{{ $empresa->Empresa_Nit }}"
                                        aria-describedby="helpId">
                                </div>
                            </div><br>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="Empresa_Nombre" class="is-required">Nombre - Empresa</label>
                                    <input type="text" class="form-control" name="Empresa_Nombre" id="Empresa_Nombre"
                                        value="{{ $empresa->Empresa_Nombre }}" aria-describedby="helpId">                     
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Empresa_Email" class="is-required">Correo electrónico</label>
                                    <input type="Empresa_Email" class="form-control" name="Empresa_Email" id="Empresa_Email" value="{{ $empresa->Empresa_Email }}"
                                        aria-describedby="helpId">    
                                </div>
                            </div><br>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="Empresa_Direccion" class="is-required">Dirección</label>
                                    <input type="text" class="form-control" name="Empresa_Direccion" id="Empresa_Direccion"
                                    value="{{ $empresa->Empresa_Direccion }}" aria-describedby="helpId">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Empresa_Telefono" class="is-required">Telefono</label>
                                    <input type="text" class="form-control" name="Empresa_Telefono" id="Empresa_Telefono"
                                    value="{{ $empresa->Empresa_Telefono }}" aria-describedby="helpId">
                                </div>
                            </div><br>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="logo" class="is-required">Logo</label><br>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Empresa_Logo" id="Empresa_Logo" accept="image/*" onchange="loadFile(event)" class="form-control" tabindex="3">
                                        <label class="custom-file-label" for="validatedCustomFile">Click Para Seleccionar Imagen...</label>
                                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                                    </div>  
                                    <div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img src="{{ 'imagen' . '/' . $empresa->Empresa_Logo }}" width="200px" height="200px">
                                                Imagen Actual
                                            </div>
                                            <div class="col-md-6" id="imgcambio">
                                                <img id="output" width="200px" height="200px">
                                                Imagen A Cambiar
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        var loadFile = function(event) {
                                            var output = document.getElementById('output');
                                            output.src = URL.createObjectURL(event.target.files[0]);
                                            output.onload = function() {
                                            URL.revokeObjectURL(output.src) // free memory
                                            }
                                        };
                                    </script>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Empresa_Nit" class="is-required">Breve Descripcion</label>
                                    <textarea class="form-control" name="Empresa_Descripcion" id="Empresa_Descripcion"
                                    rows="12">{{ $empresa->Empresa_Descripcion }}</textarea>
                                </div>
                            </div>
                        </div>
                        <center>
                            <button type="submit" class="btn btn-danger">Cancelar</button>
                            <button type="submit" class="btn btn-success">Registrar</button>
                        </center>
                    {!! Form::close() !!}
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<link href="{{ asset('css/material-dashboardForms.css?v=2.1.1') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/>
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
    @notifyJs
@endpush