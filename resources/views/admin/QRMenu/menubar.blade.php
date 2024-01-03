<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>MENU BAR</title>
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="{{ asset('css/QRpage/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/QRpage/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('css/QRpage/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/QRpage/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('css/QRpage/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/QRpage/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/QRpage/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/QRpage/menubar.css') }}" rel="stylesheet">
  <style>
    .containerimg {
      position: relative;
      width: 100%;
      max-width: 600px;
    }

    .background-image {
      width: 100%;
      filter: blur(5px); /* Aplica el efecto de difuminado */
      z-index: -1; /* Envía la imagen al fondo */
    }

    .foreground-image {
      position: abstucoolute;
      top: 0;
      left: 0;
      width: 90%;
      margin-top: 5px;
      margin-left: 20px;
      margin-right: 20px;
    }
  </style>
</head>

<body>

    <section id="menu" class="menu section-bg" style="margin-top: -30px">
        <div class="containerimg">
            <img class="background-image" src="{{ asset('css/QRpage/img/head/bar.jpeg') }}" alt="Fondo difuminado">
            <img class="foreground-image" src="{{ asset('css/QRpage/img/head/bar.jpeg') }}" alt="Imagen encima">
        </div><br>
        <div class="container" data-aos="fade-up">
            <div class="row" data-aos="fade-up" data-aos-delay="100" style="margin-top: 20px; margin-bottom: 20px;">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="menu-flters">
                    <li data-filter=".filter-Preparadas" class="filter-active">Bebidas Preparadas</li>
                    <li data-filter=".filter-Tapados">Tapados</li>
                    <li data-filter=".filter-Cervezas">Cervezas</li>
                    <li data-filter=".filter-S_alchol">Sin alcohol</li>
                    </ul>
                </div>
            </div>
            <div class="row menu-container" data-aos="fade-up" data-aos-delay="200" style="margin-left: 15px; margin-right: 15px; margin-top: -40px;">
                <div class="col-lg-6 menu-item filter-Preparadas" style="border: 1px solid white; padding: 10px">
                    <ul id="menu-flters">
                        <li data-filter=".filter-C_calientes">Cocteles Calientes</li>
                        <li data-filter=".filter-C_frio">Cocteles Frios (JARRA)</li>
                        <li data-filter=".filter-C_frioC">Cocteles Frios (COPAS)</li>
                        <li data-filter=".filter-D_casa">De La Casa</li>
                    </ul>
                </div>   
                <div class="col-lg-6 menu-item filter-C_calientes" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/olla-moka.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">CARAJILLO</a><span>Bs.20,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Bebida Caliente con Cafe, Baileys y Ron
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-C_calientes" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/olla-moka.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">TE IRLANDES</a><span>Bs.18,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Bebida Caliente con Té negro, y Ron
                    </div>
                </div>
                <!--<div class="col-lg-6 menu-item filter-C_calientes" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/olla-moka.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">PONCHE DE VINO</a><span>Bs.35,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Bebida Caliente con fruta y vino
                    </div>
                </div>!-->
                <div class="col-lg-6 menu-item filter-C_calientes" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/olla-moka.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">LIMONADA</a><span>Bs.30,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Bebida caliente preparada con Singani y Limon
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-C_frio" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/jarra.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">CAIPRINHA (JARRA)</a><span>Bs.45,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Bebida caliente preparada con Singani y Limon
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-C_frio" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/jarra.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">CHUFLAY (JARRA)</a><span>Bs.60,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Bebida con Singani Casa Real Etiqueta Negra y Canada Dry
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-C_frio" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/jarra.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">RON COLA (JARRA)</a><span>Bs.55,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Bebida con Ron Abuelo y Coca Cola
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-C_frio" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/jarra.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">MOJITO (JARRA)</a><span>Bs.55,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Bebida con Cachaza, Hierbas y Limon
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-C_frio" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/jarra.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">FERNET COLA (JARRA)</a><span>Bs.45,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Bebida con Fernet y Coca Cola
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-C_frio" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/jarra.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">TEQUILA SUNRISE (JARRA)</a><span>Bs.65,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Bebida con Tequila, Naranja y Fresa
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-C_frio" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/jarra.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">DAIQUIRI DE FRUTOS ROJOS (JARRA)</a><span>Bs.60,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Bebida con Frutos Rojos y Vodka
                    </div>
                </div>
                
                <div class="col-lg-6 menu-item filter-C_frioC" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/vino.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">CAIPIRINHA (COPA)</a><span>Bs.20,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Bebida cocteles frios
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-C_frioC" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/vino.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">CHUFLAY (COPA)</a><span>Bs.22,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Bebida con Singani Casa Real Etiqueta Negra y Ginger
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-C_frioC" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/vino.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">DAIQUIRI DE FRUTOS ROJOS (COPA)</a><span>Bs.22,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Bebida con Frutos Rojos y Vodka
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-C_frioC" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/vino.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">FERNET COLA (COPA)</a><span>Bs.18,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Bebida con Fernet y Coca Cola
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-C_frioC" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/vino.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">MOJITO (COPA)</a><span>Bs.25,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Bebida con Cachaza, Hierbas y Limon
                    </div>
                </div>
                
                <div class="col-lg-6 menu-item filter-C_frioC" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/vino.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">RON COLA (COPA)</a><span>Bs.20,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Bebida con Ron Abuelo y Coca Cola
                    </div>
                </div><div class="col-lg-6 menu-item filter-C_frioC" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/vino.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">TEQUILA SUNRISE (COPA)</a><span>Bs.28,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Bebida con Tequila, Naranja y Fresa
                    </div>
                </div>
                
                <div class="col-lg-6 menu-item filter-D_casa" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/alcoholico.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">TUKO REAL (JARRA)</a><span>Bs.60,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Bebida hecha en casa con Singani
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-D_casa" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/alcoholico.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">PECERA TUKO'S</a><span>Bs.100,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Bebida hecha en casa con Ron Blanco.
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-D_casa" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/alcoholico.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">TUKO LOKO</a><span>Bs.200,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Bebida hecha en casa con Tequila 5 Lt
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-D_casa" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/alcoholico.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">GRAN TUKO LOKO</a><span>Bs.275,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Bebida hecha en casa con Tequila 8 Lt
                        </div>
                </div>

                <div class="col-lg-6 menu-item filter-Tapados" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/tapados.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">FERNET BRANCA</a><span>Bs.150,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Fernet Branca con Coca Cola
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-Tapados" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/tapados.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">FERNET BRANCA MENTA</a><span>Bs.140,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Botella de Fernet Menta, Acompañado de Sprite y Hielo
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-Tapados" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/tapados.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">RON ABUELO</a><span>Bs.180,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Botella de Ron Abuelo con Coca Cola y Hielo
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-Tapados" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/tapados.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">RON HAVANNA</a><span>Bs.190,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Botella de Ron Havanna Especial, con Coca Cola y Hielo
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-Tapados" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/tapados.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">SINGANI CASA REAL ETIQUETA AZUL</a><span>Bs.120,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Botella de Singani Casa Real Azul con Sprite
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-Tapados" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/tapados.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">SINGANI CASA REAL ETIQUETA NEGRA</a><span>Bs.160,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Botella de Singani Casa Real Negro con Hielo y Canada Dry
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-Tapados" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/tapados.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">JAGERMEISTER</a><span>Bs.280,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Botella de Jager con hielo y seis redbulls
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-Tapados" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/tapados.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">BACARDI LIMON</a><span>Bs.180,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Botella de Bacardi Limon con hielo y Sprite
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-Tapados" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/tapados.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">BACARDI MOJITO</a><span>Bs.190,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Botella de Bacardi Mojito con hielo y Sprite
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-Tapados" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/tapados.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">WHISKY RED LABEL</a><span>Bs.240,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Botella de Whisky Red Label con Agua/Coca Cola y Hielo
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-Tapados" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/tapados.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">ABSOLUT VODKA</a><span>Bs.230,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Botella de Whisky Red Label con Agua/Coca Cola y Hielo
                    </div>
                </div>

                <div class="col-lg-6 menu-item filter-Cervezas" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/cerveza.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">POTOSINA BOTELLIN</a><span>Bs.14,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Cerveceria Potosina
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-Cervezas" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/cerveza.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">POTOSINA YAPADITA</a><span>Bs.30,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Cerveceria Potosina
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-Cervezas" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/cerveza.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">BAVARIA LATA GRANDE</a><span>Bs.10,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Cerveceria Potosina
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-Cervezas" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/cerveza.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">POTOSINA PREMIUN 4000</a><span>Bs.30,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Cerveceria Potosina
                    </div>
                </div>

                <div class="col-lg-6 menu-item filter-S_alchol" style="border: 1px solid white; padding: 10px">
                    <ul id="menu-flters">
                        <li data-filter=".filter-S_calientes">Calientes</li>
                        <li data-filter=".filter-S_gaseosas">Gaseosas</li>
                        <li data-filter=".filter-S_jugos">Jugos De Temporada</li>
                        <li data-filter=".filter-S_milkshakes">Milkshakes</li>
                    </ul>
                </div>   
                <div class="col-lg-6 menu-item filter-S_calientes" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/te.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">TE</a><span>Bs.6,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Te Caliente
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-S_calientes" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/te.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">MATE</a><span>Bs.6,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Mate a eleccion (Aniz, Manzanilla, Coca, Boldo y Trimate)
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-S_calientes" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/te.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">CAFE</a><span>Bs.8,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Te Caliente
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-S_gaseosas" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/refresco.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">COCA COLA 2 LT</a><span>Bs.15,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Gaseosas 
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-S_gaseosas" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/refresco.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">FANTA 2 LT</a><span>Bs.15,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Gaseosas 
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-S_gaseosas" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/refresco.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">SPRITE 2 LT</a><span>Bs.15,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Gaseosas 
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-S_gaseosas" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/refresco.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">COCA COLA 500 ML</a><span>Bs.9,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Gaseosas 
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-S_gaseosas" style="border: 1px solid white; padding: 10px">
                   <img src="{{ asset('css/QRpage/img/bar/refresco.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">FANTA 500 ML</a><span>Bs.9,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Gaseosas 
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-S_jugos" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/zalamero.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">JUGOS CON AGUA</a><span>Bs.8,00</span>
                    </div>
                    <div class="menu-ingredients">
                    JUGO DE FRUTA 
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-S_jugos" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/zalamero.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">JUGOS CON LECHE</a><span>Bs.12,00</span>
                    </div>
                    <div class="menu-ingredients">
                    JUGO DE FRUTA 
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-S_milkshakes" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/flotar.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">MIlKSHAKE FRUTILLA</a><span>Bs.22,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Batido de Leche, Con Hielo y Frutilla.
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-S_milkshakes" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/flotar.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">MIlKSHAKE OREO</a><span>Bs.22,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Batido de Leche, Con Hielo y Oreo.
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-S_milkshakes" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/flotar.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">MIlKSHAKE MENTA</a><span>Bs.22,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Batido de Leche, Con Hielo y Menta.
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-S_milkshakes" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/flotar.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">MIlKSHAKE CHOCOLATE</a><span>Bs.22,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Batido de Leche, Con Hielo y Chocolate.
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-S_milkshakes" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/flotar.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">MIlKSHAKE NUTELLA</a><span>Bs.22,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Batido de Leche, Con Hielo y Nutella.
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-S_milkshakes" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/flotar.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">MIlKSHAKE VAINILLA</a><span>Bs.22,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Batido de Leche, Con Hielo y Vainilla.
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script src="{{ asset('css/QRpage/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('css/QRpage/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('css/QRpage/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('css/QRpage/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('css/QRpage/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('css/QRpage/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('css/QRpage/js/main.js') }}"></script>
</body>
</html>