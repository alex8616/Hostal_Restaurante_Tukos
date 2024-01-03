<!--ventana para Update--->
<link href="{{asset('css/show.css')}}" rel="stylesheet" type="text/css" />

<div class="modal fade" id="ShowPlato{{ $plato->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #563d7c !important;">
            <h6 class="modal-title" style="color: #fff; text-align: center;">
                DETALLES DEL PLATO
            </h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>


    <form action="{{ route('updateplato', $plato->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ @method_field('PUT') }}
        <div class="recipe-container">
            @if (isset($plato->imagen))
                <img class="img-thumbnail" src="{{ asset('storage' . '/' . $plato->imagen) }}" style="width: 100%; height: 100%; "/>
            @else
                <img class="recipe-image" src="{{ asset('img/errorimg.jpeg') }}" style="width: 100%; height: 100%;"/>
            @endif
        <div class="recipe-content">
            <h2 class="heading-2">Nombre Del Plato</h2>
            <h1 class="heading-1">
            {{$plato->Nombre_plato}}<br>
            </h1>
            <p class="paragraph">
            {{ $plato->Caracteristicas_plato }}
            </p>
            <ul class="recipe-list meta">
            <li class="recipe-item">
                <div class="recipe-value">{{ $plato->Precio_plato }} Bs</div>
                <div class="recipe-text">Precio</div>        
            </li>
            <li class="recipe-item">
                <div class="recipe-value">{{date('d/m/Y');}}</div>        
                <div class="recipe-text">Registro</div>        
            </li>
            </ul>
            <div class="recipe-stars">
            <span class="recipe-star"></span>
            <span class="recipe-star"></span>
            <span class="recipe-star"></span>
            <span class="recipe-star"></span>
            <span class="recipe-star inactive"></span>
            <span class="recipe-ratings">29</span>
            </div>
        </div>
        </div>  
    </form>
    </div>
</div>
</div>

<!---fin ventana Update --->