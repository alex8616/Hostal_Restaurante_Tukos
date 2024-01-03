@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<br><br><hr>
<div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-warning">
          <table style="width:80%">
              <tr>
                <td><h4 class="card-title">CLIENTES</h4></td>
                <td class="text-right">
                  <div class="wrap">
                  </div>
                </td>
                <td class="text-right">
                  <div class="wrap">
                  </div>
                </td>
                <td class="text-right">
                  <div class="wrap">
                  </div>
                </td>
              </tr>
            </table>
          </div>
                <table class="table table-striped mt-0.5 table-bordered shadow-lg mt-4 dt-responsive" id="categoria">
                        <div class="" style="width: 80%; margin:auto">
                    <div class="card-body">
                        {!! Form::open(['route' => 'admin.users.store', 'method' => 'POST']) !!}
                        <br><br>
                        <div class="form-group">
                            <label for="name">Nombre: </label><br>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" autofocus>
                            @if ($errors->has('name'))
                                <div class="alert alert-danger">
                                    <span class="error text-danger">{{ $errors->first('name') }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">Correo electrónico: </label><br>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <div class="alert alert-danger">
                                    <span class="error text-danger">{{ $errors->first('email') }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password">Contraseña: </label><br>
                            <input type="password" name="password" id="password" class="form-control" aria-describedby="helpId">
                            @if ($errors->has('password'))
                                <div class="alert alert-danger">
                                    <span class="error text-danger">{{ $errors->first('password') }}</span>
                                </div>
                            @endif
                        </div>

                        @include('admin.user._form')
                        <center>
                            <button type="submit" class="btn btn-success mr-2">Registrar</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                Cancelar
                            </a>
                        </center>
                        {!! Form::close() !!}
                    </div>
                </div>
            </table>
            </div>
          </div>
        </div>
    </div>
@stop


