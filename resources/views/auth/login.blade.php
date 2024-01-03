@extends('layouts.main', ['class' => 'off-canvas-sidebar', 'activePage' => 'login', 'title' => __('Material Dashboard')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row align-items-center">
    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
      <form class="form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="card card-login card-hidden mb-3">
          <div class="card-header card-header-primary">
            <img src="{{ asset('img/picwish.png') }}" width="100%"/>
          </div>
          <div class="card-body">
            <p class="card-description text-center">{{ __('Ingrese Sus Credenciales') }} <strong>PARA INICIAR SESION</strong> {{ __(' Usuario y Contraseña ') }}</p>
            <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">email</i>
                  </span>
                </div>
                <input type="email" name="email" class="form-control" placeholder="{{ __('Email...') }}" required>
              </div>
              @if ($errors->has('email'))
                <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                  <strong>{{ $errors->first('email') }}</strong>
                </div>
              @endif
            </div>
            <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                  </span>
                </div>
                <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password...') }}" required>
              </div>
              @if ($errors->has('password'))
                <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                  <strong>{{ $errors->first('password') }}</strong>
                </div>
              @endif
            </div>
          </div>
          <div class="card-footer justify-content-center">
            <button type="submit" class="btn btn-primary btn-link btn-lg">{{ __('INICIAR SESION') }}</button>
          </div>
        </div>
      </form>
      <div class="row">
          <div class="text-center" style="width:100%">
            <div class="social-line">
              <a href="https://www.facebook.com/tukosresto/" class="btn btn-just-icon btn-link btn-white">
                <i class="fa fa-facebook-square"></i>
              </a>
              <a href="https://www.instagram.com/tukosresto/" class="btn btn-just-icon btn-link btn-white">
                <i class="fa fa-instagram"></i>
              </a>
              <a href="https://g.page/Tukos?share" class="btn btn-just-icon btn-link btn-white">
                <i class="fa fa-map"></i>
              </a>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
        