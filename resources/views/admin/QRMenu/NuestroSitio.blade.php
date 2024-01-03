<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TUKO'S LA CASA REAL</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
       .custom-div {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        max-width: 300px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        cursor: pointer;
        transition: background-color 0.3s;
        }

        .custom-div:hover {
        background-color: #f0f0f0;
        }

        .icon {
        width: 45px; /* Ajusta el tamaño según tus necesidades */
        height: 45px; /* Ajusta el tamaño según tus necesidades */
        margin-left: 30px;
        }

        .text {
        font-size: 18px;
        margin-right: 10px;
        margin-left: 20px;
        }

        /* Estilos para mantener el ícono y el texto en la misma línea */
        .custom-div p, .custom-div img {
        display: inline-block;
        vertical-align: middle;
        }
        /* Estilos personalizados */
        body {
            background-color: #f8f9fa;
        }
        .container {
            padding: 10px;
            text-align: center;
        }
        .row > div {
            background-color: #ffffff;
            border-radius: 8px;
            margin: 10px;
            padding: 10px;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }
        .row > div:hover {
            transform: translateY(-5px);
        }

    </style>
</head>
<body>
    <div>
        <img class="main-image" src="{{ asset('img/logocompleto.jpg') }}" alt="Imagen Principal" style="width: 100%">
    </div>
    <div class="container">
        <h2 style="text-align: left">Conéctate Con Nosotros</h2>
        <div class="row">
            <div class="col-12 col-md-4 custom-div" onclick="window.location.href='https://www.facebook.com/tukosresto'">
                <p class="text">Danos un Me Gusta</p>
                <img class="icon" src="{{ asset('img/icon/icons8-facebook-circled.svg') }}" alt="Ícono de Facebook">
            </div>
            <div class="col-12 col-md-4 custom-div" onclick="window.location.href='https://www.instagram.com/tukosresto/'">
                <p class="text">Síguenos en Instagram</p>
                <img class="icon" src="{{ asset('img/icon/icons8-instagram.svg') }}" alt="Ícono de Facebook">
            </div>
            <div class="col-12 col-md-4 custom-div" onclick="window.location.href='tel:+26230689'">
                <p class="text">Llámanos</p>
                <img class="icon" src="{{ asset('img/icon/icons8-call.svg') }}" alt="Ícono de Facebook">
            </div>
            <div class="col-12 col-md-4 custom-div" onclick="window.location.href='https://api.whatsapp.com/send/?phone=78632592&text&type=phone_number&app_absent=0'">
                <p class="text">Envíanos un Mensaje</p>
                <img class="icon" src="{{ asset('img/icon/icons8-whatsapp.svg') }}" alt="Ícono de Facebook">
            </div>
            <div class="col-12 col-md-4 custom-div" onclick="window.location.href='https://tukos.sdmlabo.com/menurestaurante'">
                <p class="text">Nuestro Menú Restaurante</p>
                <img class="icon" src="{{ asset('img/icon/icons8-menu-64.png') }}" alt="Ícono de Facebook">
            </div>
            <div class="col-12 col-md-4 custom-div" onclick="window.location.href='https://tukos.sdmlabo.com/menubar'">
                <p class="text">Nuestro Menú Bar</p>
                <img class="icon" src="{{ asset('img/icon/icons8-bar-counter-48.png') }}" alt="Ícono de Facebook">
            </div>
        </div>
    </div>
</body>
</html>
