@extends('layouts.main', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
@section('content')
<br><br><hr>
<div style="width: 92%; margin-left: 7%; padding: 5px;">
    <button class="my-button" style="background: #EB455F;" data-toggle="modal" data-target="#modelId">
        REPORTE
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reporte Mes</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('hostal.controlcamareria.reporte') }}" method="post" target="_blank">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="">SELECCIONA EL MES</label><br>
                            <?php $mesActual = date('Y-m'); ?>
                            <input type="month" id="RegistroMes" name="RegistroMes" value="{{ $mesActual }}" class="otraclaseform">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @foreach($habitaciones as $habitacione)
        <button class="my-button" data-toggle="modal" data-target="#ControlHabitacion{{ $habitacione->id }}">
            {{ $habitacione->Nombre_habitacion }}
            @foreach($registros as $registro)
                @if(substr($registro->fecha_registro, 0, 10) == $today && $registro->habitacion_id == $habitacione->id)
                    <p style="background: red;">{{ $registro->actividad }}</p>
                @endif
            @endforeach
        </button>
        <div class="modal fade" id="ControlHabitacion{{ $habitacione->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">SELECCIONE ACCION</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                    <form action="{{ route('hostal.controlcamareria.storecontrol') }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" id="habitacion_id" name="habitacion_id" value="{{ $habitacione->id }}" hidden>
                                <label for="">SELECCIONE UNA TAREA</label>
                                <select id="accion" name="accion" required size="4px" class="otraclaseform">
                                    <option value="T">LIMPIEZA TOTAL</option>
                                    <option value="P">LIMPIEZA PARCIAL</option>
                                    <option value="MG">MANO DE GATO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">OBSERVACION</label>
                                <textarea name="observacion" id="observacion" cols="20" rows="5" class="otraclaseform"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                        <button type="submit" class="btn btn-primary">REGISTRAR</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
@notifyCss
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 
<style>
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

    .my-button {
    width: 200px;
    height: 200px;
    margin: 10px;
    max-width: 150px; /* ajusta el tamaño máximo según tus necesidades */
    padding: 30px;
    border: none;
    background-color: #6DA9E4;
    color: #fff;
    font-size: 1rem;
    font-weight: 600;
    text-transform: uppercase;
    border-radius: 0;
    box-sizing: border-box;
    cursor: pointer;
    transition: all 0.3s ease;
    }

    @media screen and (min-width: 768px) {
    .my-button {
        max-width: 100px; /* ajusta el tamaño máximo según tus necesidades */
    }
    }

    @media screen and (min-width: 992px) {
    .my-button {
        max-width: 200px; /* ajusta el tamaño máximo según tus necesidades */
    }
    }
</style>
@push('js')
@notifyJs

@endpush