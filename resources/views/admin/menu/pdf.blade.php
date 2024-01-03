<link href="http://fonts.cdnfonts.com/css/danny-varefella" rel="stylesheet">
<style>
    @import url('http://fonts.cdnfonts.com/css/danny-varefella');
    @page {
        margin-top: 0;  
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 0;
    }
    #txt{
        background: red;
        font-family: cursive;
    }
    body{
        background-image: url("{{ base_path() . '/public/img/FondoMenu.jpg' }}");
    }
    #logo{
        float:right;
        width: 35%;
    }
    #fondo2{
        float:left;
        transform: rotate(75deg);
        width: 50%;
        margin-left: -130;
        margin-top: -150;
    }
    #fondo3{
        position: absolute;
        float:right;
        width: 60%;
        transform: rotate(60deg);
        margin-right: -150;
        margin-top: 5;
    }
    #tilulom{
    color: white;
    float: right;
    text-align:center;
    }
    #subtitulos{
    color: white;
    margin-left: 20;
    }
    #platos{
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
        width: 200px;
        height: 150px;
    }
    #tbplatos{
        margin:auto;
        width: 80%;
    }
    table td h3{
        color: white;
    }
    table td h2{
        color: white;
    }
    #precio{
        text-align: right;
    }
    #textprecio{
        color: orange;
    }
    #txtdetalles{
        vertical-align: top;
    }
    #tbinfo{
        width: 80%;
        margin: auto;
    }
    #moto{
        width: 100%;
    }
    hr {
        width: 70%;
        height: 5px;
        background-color: orange;
    }
    #tbdatos{
        width: 90%;
        margin: auto;  
    }
</style>
<header>
</header>
<body>
<img id="fondo2" src="{{ base_path() . '/public/img/fondo2.jpg' }}" width="30%"><img id="logo" src="{{ base_path() . '/public/img/picwish.png' }}" width="30%"><br><br><br><br>
    <h2 id="tilulom">NUESTRO MENU DE <br>{{ \Carbon\Carbon::parse($menu->fecha_registro)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y') }}</h2><br><br><br><br><br>
    <h3 id="subtitulos">Incluye Sopa De Viernes</h3>
    @foreach ($detallemenus as $detallemenu)
        <table class="table table-light" id="tbplatos">
            <tbody>
                <tr>
                    <td width="40%" id="txtdetalles">
                        <h2>{{$detallemenu->plato->Nombre_plato}}</h2>
                        <h3>{{$detallemenu->plato->Caracteristicas_plato}}</h3>
                    </td>
                    <td width="30%"><img id="platos" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/storage/'.'/'.$detallemenu->plato->imagen))) }}"></td>
                    <td width="30%" id="precio"><h2 id="textprecio">{{$detallemenu->plato->Precio_plato}} Bs.</h2></td>
                </tr>
            </tbody>
        </table>        
    @endforeach
    <hr>
    <table class="table table-light" id="tbinfo">
            <tbody>
                <tr>
                    <td width="20%">
                        <h2>Reservas:</h2> 
                    </td>
                    <td width="30%">
                        <h2>78632592<br>
                        62-30689</h2>
                    </td>
                    <td width="20%">
                        <img id="moto" src="{{ base_path() . '/public/img/moto.png' }}">
                    </td>
                    <td width="30%">
                        <h2>11:00 - 13:00 LUN - DOM</h2>
                    </td>
                </tr>
            </tbody>
    </table> 
    <table class="table table-light" id="tbdatos">
            <tr>
                <td width="10%">
                    <h2>
                        Calle Hoyos #29
                        @Tuko's Resto
                    </h2>
                </td>
                <td width="20%">
                    <h2>Tukos La Casa<br>Real Restaurante</h2>
                </td>
            </tr>
        </table>
    <img id="fondo3" src="{{ base_path() . '/public/img/fondo2.jpg' }}" width="30%">
</body>

