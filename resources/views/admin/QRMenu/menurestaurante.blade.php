<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>MENU RESTAURANTE</title>
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
      position: absolute;
      top: 0;
      left: 0;
      width: 90%;
      margin-top: 5px;
      margin-left: 20px;
      margin-right: 20px;
    }
    .overlay {
      position: absolute;
      top: 10%;
      left: 0;
      width: 100%;
      transform: translateY(-50%);
      background-color: rgba(255, 255, 255, 0.6);
      text-align: center;
      padding: 10px;
    }

    p {
      font-size: 24px;
      font-weight: bold;
      margin: 0;
    }
  </style>
</head>

<body>

    <section id="menu" class="menu section-bg" style="margin-top: -30px">
        <div class="containerimg">
            <img class="background-image" src="{{ asset('css/QRpage/img/head/res.jpeg') }}" alt="Fondo difuminado">
            <img class="foreground-image" src="{{ asset('css/QRpage/img/head/res.jpeg') }}" alt="Imagen encima">
            <div class="overlay">
                <p>RESTAURANTE</p>
            </div>
        </div><br>
        <div class="container" data-aos="fade-up">
            <div class="row" data-aos="fade-up" data-aos-delay="100" style="margin-top: 20px; margin-bottom: 20px;">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="menu-flters">
                    <li data-filter=".filter-festival" class="filter-active">FESTIVAL</li>
                    <li data-filter=".filter-burguer">HAMBURGUESA</li>
                    <li data-filter=".filter-alitas">ALITAS</li>
                    <li data-filter=".filter-t_piqueos">TABLAS DE PIQUEOS</li>
                    </ul>
                </div>
            </div>
            <div class="row menu-container" data-aos="fade-up" data-aos-delay="200" style="margin-left: 15px; margin-right: 15px; margin-top: -40px;">
                <div class="col-lg-6 menu-item filter-burguer" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/burguer.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">HAMBURGUESA CLASICA</a><span>Bs.20,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Carne de 150gr. tomate, lechuga, cebolla y porcion de papas
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-burguer" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/burguer.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">HAMBURGUESA DULCE</a><span>Bs.22,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Carne de 150gr. Queso, coleslaw, miel y mostaza, porcion de papas
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-burguer" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/burguer.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">HAMBURGUESA CON QUESO</a><span>Bs.25,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Carne de 200gr. tomate, lechuga, cebolla, queso y porcion de papas
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-burguer" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/burguer.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">HAMBURGUESA HAWAIANA</a><span>Bs.25,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Carne de 150gr. jamòn, piña, lechuga, salsa remoulade y porcion de papas
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-burguer" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/burguer.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">HAMBURGUESA CRUJIENTE</a><span>Bs.25,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Filete de Pollo, lechuga, tomate, pepinillos, cebolla, salsa de mostaza y porcion de papas
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-burguer" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/burguer.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">HAMBURGUESA DE AROS DE CEBOLLA</a><span>Bs.26,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Carne de 150gr. tomate, lechuga, aros de cebolla y porcion de papas
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-burguer" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/burguer.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">HAMBURGUESA DE CEBOLLA CARAMELIZADA</a><span>Bs.26,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Carne de 150gr. queso, tocino, tomate, lechuga, aros de cebolla y porcion de papas
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-burguer" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/burguer.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">CHORI PORKY</a><span>Bs.28,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Chorizo, salchicha, lechuga, cebolla, chucrut y porcion de papas
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-burguer" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/burguer.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">HAMBURGUESA CHORI</a><span>Bs.32,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Carne de 100gr. Chorizo, tomate, lechuga, cebolla y porcion de papas
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-burguer" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/burguer.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">HAMBURGUESA DE TUKO</a><span>Bs.35,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Carne de 150gr. Milanesa de Pollo, Huevo, tomate, lechuga, cebolla y porcion de papas
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-burguer" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/burguer.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">HAMBURGUESA CALIENTE</a><span>Bs.28,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Carne de 150gr. tomate, lechuga, cebolla, jalapeños, salsa picante, porcion de papas
                    </div>
                </div>

                <div class="col-lg-6 menu-item filter-alitas" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/alitas.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">ALITAS</a><span>Bs.22,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Alitas normales sin salsa.
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-alitas" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/alitas.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">ALITAS DE BARBACOA</a><span>Bs.25,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Alitas normales con salsa de barbacoa.
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-alitas" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/alitas.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">ALITAS DE MIEL Y MOSTAZA</a><span>Bs.25,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Alitas normales con salsa de miel y mostaza.
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-alitas" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/alitas.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">ALITAS CALIENTES</a><span>Bs.25,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Alitas caliente ...
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-alitas" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/alitas.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">ALITAS A LA TUKO'S</a><span>Bs.25,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Alitas especiales de la casa.
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-alitas" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/alitas.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">ALITAS DE QUESO</a><span>Bs.25,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Alitas normales con salsa de queso.
                    </div>
                </div>

                <div class="col-lg-6 menu-item filter-t_piqueos" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/table.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">TABLA DE ALITAS</a><span>Bs.35,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Tabla con salchicha y alitas acompañada de papas fritas y salsas
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-t_piqueos" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/table.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">TABLA DE CHORIZO Y LOMO</a><span>Bs.45,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Tabla con salchicha, queso y carne molida acompañada de papas fritas y salsas
                    </div>
                </div>
                <div class="col-lg-6 menu-item filter-t_piqueos" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/table.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">TABLA DE CARNE MOLIDA</a><span>Bs.30,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Tabla con chorizo y lomo acompañado de papas fritas y salsas
                    </div>
                </div>

                <div class="col-lg-6 menu-item filter-festival" style="border: 1px solid white; padding: 10px">
                    <img src="{{ asset('css/QRpage/img/bar/salchi.png') }}" class="menu-img" alt="">
                    <div class="menu-content">
                    <a href="#">COMBO FESTIVAL PICANA MIXTA</a><span>Bs.40,00</span>
                    </div>
                    <div class="menu-ingredients">
                    Picana mixta de carne de res y pollo. 
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