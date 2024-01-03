@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<br><br><hr>
    <div class="card" style="width: 80%; margin:auto;">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.roles.store', 'method' => 'POST']) !!}
            <h3>Crear Nuevo ROL</h3>
            <hr>
            <div class="form-row">            
                <div class="form-group col-md-5">
                    <label for="name">Nombre:</label><br>
                    <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" autofocus >
                    @if ($errors->has('name'))
                    <div class="alert alert-danger">
                        <span class="error text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    @endif
                </div>
                <div class="form-group col-md-5">
                    <label for="description">Descripción:</label><br>
                    <input class="form-control" name="description" id="description" value="{{old('description')}}">
                    @if ($errors->has('description'))
                    <div class="alert alert-danger">
                        <span class="error text-danger">{{ $errors->first('description') }}</span>
                    </div>
                    @endif
                </div>
            </div>
            @include('admin.role._form')
            <button type="submit" class="btn btn-primary mr-2">Registrar</button>
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
@stop

@section('js')
@stop
