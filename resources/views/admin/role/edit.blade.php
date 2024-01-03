@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<br><br><hr>
 <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-blue">
          <table style="width:80%">
              <tr>
                <td><h4 class="card-title">EDITAR ROL PARA EL MANEJO DE SISTEMA</h4></td>
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
                        <div class="" style="width: 80%; margin:auto">        <div class="card-body">
            {!! Form::model($role, ['route' => ['admin.roles.update', $role], 'method' => 'PUT']) !!}
            <div class="form-group">
                <label for="name">Nombre: </label><br>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $role->name) }}" autofocus>
                @if ($errors->has('name'))
                    <div class="alert alert-danger">
                        <span class="error text-danger">{{ $errors->first('name') }}</span>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="description">Descripción: </label><br>
                <textarea class="form-control" name="description" id="description"
                    rows="3">{{ old('description', $role->description) }}</textarea>
                @if ($errors->has('description'))
                    <div class="alert alert-danger">
                        <span class="error text-danger">{{ $errors->first('description') }}</span>
                    </div>
                @endif
            </div>

            @include('admin.role._form')

            <button type="submit" class="btn btn-primary mr-2">Actualizar</button>
            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                Cancelar
            </a>
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
<link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
<style>
    .card{
    
        position: relativa;
        top: 50%;
        left: 25%;
    }
</style>
@stop

@section('js')
@stop
