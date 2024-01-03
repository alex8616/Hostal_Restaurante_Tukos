@extends('layouts.main', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
@section('content')
<br><br>
<link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 

<div style="width:98%; background: white; border-radius: 15px; margin: auto; margin-top:6px;">
    <div id="divheader" style="margin: auto;"><br>
        <div class="projects-section-line" style="margin-left: 20px;">
            <div class="projects-status">
                <div class="item-status" id="problemstart" style="padding: 10px;">
                    <span class="status-number">{{ $CantInicioProblemas }}</span>
                    <span class="status-type">INICIADOS</span>
                </div>
                <div class="item-status" id="problemprogress" style="padding: 10px;">
                    <span class="status-number">{{ $CantProgresoProblemas }}</span>
                    <span class="status-type">PROCESO</span>
                </div>
                <div class="item-status" id="problemend" style="padding: 10px;">
                    <span class="status-number">{{ $CantSolucionadoProblemas }}</span>
                    <span class="status-type">SOLUCIONADOS</span>
                </div>
            </div>
            <div class="view-actions" style="margin-right: 40px;">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal">Add + </button>                
                @include('hostal.problemas.CrearProblema')
            </div>
        </div>
    </div>
    @if($CantInicioProblemas != 0)
    <div id="contenedor-problemas" class="note-container note-grid">
        <div id="contenido1">
            @foreach($problemas as $problema)
                @if($problema->tipoproblema == 'LEVE')
                <div id="problema-{{$problema->id}}" class="note-item all-notes" style="border: 2px solid blue">
                    <div class="note-inner-content">
                        <div class="note-content">
                            <p class="note-title" data-noteTitle="Meeting with Kelly">{{ $problema->titulo }}</p>
                            <p class="meta-time">{{ $problema->asignado_fecha }}</p>
                            <div class="note-description-content">
                                <p class="note-description">EL PROBLEMA ES LO SIGUIENTE:</p>
                                <p>{{$problema->description}}</p>
                            </div>
                        </div>
                        <div class="note-action">
                            <!-- Button trigger modal -->
                            <a href="" data-toggle="modal" data-target="#Solucionar{{$problema->id}}"><div class="badge badge-success">Dar Solucion</div></a>                                  
                        </div>
                    </div>
                </div>
                @elseif($problema->tipoproblema == 'MEDIO')
                <div id="problema-{{$problema->id}}" class="note-item all-notes note-social" style="background: #F9E79F; border: 2px solid orange">
                    <div class="note-inner-content">
                        <div class="note-content">
                            <p class="note-title" data-noteTitle="Meeting with Kelly">{{ $problema->titulo }}</p>
                            <p class="meta-time">{{ $problema->asignado_fecha }}</p>
                            <div class="note-description-content">
                                <p class="note-description">EL PROBLEMA ES LO SIGUIENTE:</p>
                                <p>{{$problema->description}}</p>
                            </div>
                        </div>
                        <div class="note-action">
                            <!-- Button trigger modal -->
                            <a href="" data-toggle="modal" data-target="#Solucionar{{$problema->id}}"><div class="badge badge-success">Dar Solucion</div></a>                                  
                        </div>
                    </div>
                </div>
                @else
                <div id="problema-{{$problema->id}}" class="note-item all-notes note-important" style="border: 2px solid red">
                    <div class="note-inner-content">
                        <div class="note-content">
                            <p class="note-title" data-noteTitle="Meeting with Kelly">{{ $problema->titulo }}</p>
                            <p class="meta-time">{{ $problema->asignado_fecha }}</p>
                            <div class="note-description-content">
                                <p class="note-description">EL PROBLEMA ES LO SIGUIENTE:</p>
                                <p>{{$problema->description}}</p>
                            </div>
                        </div>
                        <div class="note-action">
                            <!-- Button trigger modal -->
                            <a href="" data-toggle="modal" data-target="#Solucionar{{$problema->id}}"><div class="badge badge-success">Dar Solucion</div></a>                                  
                        </div>
                    </div>
                </div>
                @endif
                @include('hostal.problemas.ModalUpdate')
            @endforeach                  
        </div>
        <div id="contenido2" style="display:none;">
            @foreach($problemas as $problema)
                @if($problema->estado == 'PROGRESO')
                <div id="problema-{{$problema->id}}" class="note-item all-notes">
                    <div class="note-inner-content">
                        <div class="note-content">
                            <p class="note-title" data-noteTitle="Meeting with Kelly">{{ $problema->titulo }}</p>
                            <p class="meta-time">11/01/2019</p>
                            <div class="note-description-content">
                                <p class="note-description" data-noteDescription="Curabitur facilisis vel elit sed dapibus sodales purus rhoncus.">Curabitur facilisis vel elit sed dapibus sodales purus rhoncus.</p>
                            </div>
                        </div>
                        <div class="note-action">
                            <p>hola mundo este es mi primner range para editar xd</p>
                            <button class="btn btn-success mb-2">Concluir</button>
                            <div class="w3-light-grey">
                                <div class="w3-blue" style="height:24px;width:75%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach        
        </div>
        <div id="contenido3" style="display:none;">
            @foreach($problemasconcluidos as $problemasconcluido)
                <div id="problema-{{$problemasconcluido->id}}" class="note-item all-notes" style="background: #B2FFAC; border: 2px solid green">
                    <div class="note-inner-content">
                        <div class="note-content">
                            <p class="note-title" data-noteTitle="Meeting with Kelly">{{ $problemasconcluido->titulo }}</p>
                            <p class="meta-time">El problema se registro {{ $problemasconcluido->asignado_fecha}} y se soluciono el {{ $problemasconcluido->resuelto_fecha}}</p>
                            <p class="meta-time"></p>
                            <div class="note-description-content">
                                <p class="note-description"> El Problemsa Se Soluciono: {{$problemasconcluido->solution}}.</p>
                            </div>
                        </div>
                        <div class="note-action">
                            <p>PROBLEMA SOLUCIONADO</p>
                        </div>
                    </div>
                </div>
            @endforeach        
        </div>        
    </div>
    @else
        <center>NO HAY REGISTROS</center>
    @endif
</div>

@endsection
@notifyCss
<!-- Importar los archivos necesarios de SimpleMDE -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    .item-status:hover {
        cursor: pointer;
    }
    .item-status.active {
        background-color: #FC2947;
        border-radius: 5px;
        color: white;
    }

    .projects-section {
        flex: 2;
        background-color: var(--projects-section);
        border-radius: 32px;
        padding: 32px 32px 0 32px;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .projects-section-line {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 32px;
    }
    .projects-section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        color: var(--main-color);
    }
    .projects-section-header p {
        font-size: 24px;
        line-height: 32px;
        font-weight: 700;
        opacity: 0.9;
        margin: 0;
        color: var(--main-color);
    }
    .projects-section-header .time {
        font-size: 20px;
    }
    .projects-status {
        display: flex;
    }
    .item-status {
	 display: flex;
	 flex-direction: column;
	 margin-right: 16px;
    }
    .item-status:not(:last-child) .status-type:after {
        content: '';
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translatey(-50%);
        width: 6px;
        height: 6px;
        border-radius: 50%;
        border: 1px solid var(--secondary-color);
    }
    .status-number {
        font-size: 24px;
        line-height: 32px;
        font-weight: 700;
        color: var(--main-color);
    }
    .status-type {
        position: relative;
        padding-right: 24px;
        color: var(--secondary-color);
    }
    .view-actions {
        display: flex;
        align-items: center;
    }
    .view-btn {
        width: 36px;
        height: 36px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 6px;
        border-radius: 4px;
        background-color: transparent;
        border: none;
        color: var(--main-color);
        margin-left: 8px;
        transition: 0.2s;
    }
    .view-btn.active {
        background-color: var(--link-color-active-bg);
        color: var(--link-color-active);
    }
    .view-btn:not(.active):hover {
        background-color: var(--link-color-hover);
        color: var(--link-color-active);
    }
</style>
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    function ocultarContenidos() {
    // Oculta todos los contenidos
    document.getElementById('contenido1').style.display = 'none';
    document.getElementById('contenido2').style.display = 'none';
    document.getElementById('contenido3').style.display = 'none';
    }

    // Muestra el contenido 1 por defecto al cargar la página
    document.getElementById('contenido1').style.display = 'block';

    // Selecciona los elementos clickeables
    const problemstart = document.getElementById('problemstart');
    const problemprogress = document.getElementById('problemprogress');
    const problemend = document.getElementById('problemend');

    // Agrega un evento de escucha de click a cada elemento clickeable
    problemstart.addEventListener('click', () => {
    // Oculta todos los contenidos y muestra el contenido correspondiente
    ocultarContenidos();
    document.getElementById('contenido1').style.display = 'block';
    });

    problemprogress.addEventListener('click', () => {
    // Oculta todos los contenidos y muestra el contenido correspondiente
    ocultarContenidos();
    document.getElementById('contenido2').style.display = 'block';
    });

    problemend.addEventListener('click', () => {
    // Oculta todos los contenidos y muestra el contenido correspondiente
    ocultarContenidos();
    document.getElementById('contenido3').style.display = 'block';
    });
</script>
<script>
    var items = document.querySelectorAll(".item-status");

    for (var i = 0; i < items.length; i++) {
    items[i].addEventListener("click", function() {
        var current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");
        this.className += " active";
    });
    }
</script>
<script>
    $(document).ready(function() {
        $('#formulario-problema').submit(function(event) {
            event.preventDefault(); // previene la acción por defecto del formulario
            
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                success: function(response) {
                    $('#formulario-problema')[0].reset(); // Limpia el formulario
                    $('#modalproblem').modal('hide'); // Cierra el modal con id="myModal"
                    toastr.success('El registro se ha guardado exitosamente.');
                    $.get(window.location.href, function(data) {
                        var $newContent = $(data).find('#contenedor-problemas').html();
                        $('#contenedor-problemas').html($newContent);
                    });
                },
                error: function(xhr, status, error) {
                    toastr.error('Ha ocurrido un error al guardar el registro.');
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#formulario-updateproblema').submit(function(event) {
            event.preventDefault(); // Evita que se envíe el formulario por HTTP directamente
            var formData = new FormData(this);
            var url = $(this).attr('action'); // Obtener la URL del formulario
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#formulario-updateproblema')[0].reset(); // Limpia el formulario
                    toastr.success('El Problema Ya Fue SOLUCIONADO');
                    $.get(window.location.href, function(data) {
                        var $newContent = $(data).find('#contenedor-problemas').html();
                        $('#contenedor-problemas').html($newContent);
                    });
                },
                error: function(xhr, status, error) {
                    toastr.error('Nose Pudo Concluir El Problema.');
                }
            });
        });
        
        $('#guardar').click(function() {
            $('#formulario-updateproblema').submit(); // Llama al evento submit() del formulario
        });
    });
</script>
@notifyJs
@endpush