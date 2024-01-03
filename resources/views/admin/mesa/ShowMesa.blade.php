<!--ventana para Update--->
<div class="modal fade" id="ShowMesa{{ $mesa->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header" style="background-color: #563d7c !important;">
            <h6 class="modal-title" style="color: #fff; text-align: center;">
                Ver Información ...
            </h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="POST" action="{{ route('updatemesa', $mesa->id) }}">
            @method('PUT')
            @csrf
            <div class="modal-body" id="cont_modal">
                <div class="form-group">
                    <label for="id" class="col-form-label">ID Mesa: </label> {{ $mesa->id }}<br><hr>                
                    <label for="Nombre_mesa" class="col-form-label">Nombre o Numero De La Mesa:</label> {{ $mesa->Nombre_mesa }}<br><hr>
                    <label for="created_at" class="col-form-label">Fecha Creacion:</label> {{ $mesa->created_at }}<br><hr>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </form>

    </div>
</div>
</div>
<!---fin ventana Update --->
