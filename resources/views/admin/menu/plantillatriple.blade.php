<!DOCTYPE html>
<html lang="en">
<head>
<style>
        .parent {
        display: grid;
        grid-template-columns: 0.8fr 1fr;
        grid-template-rows: 1fr;
        grid-column-gap: 0px;
        grid-row-gap: 0px;
        }

        .div1 { grid-area: 1 / 1 / 2 / 2; }
        .div2 { grid-area: 1 / 2 / 2 / 3; }

        #elementToCapture {
            position: absolute;
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;
            width: 950px;
            height: 1000px;
            border: 1px solid black;
            background: white;
            overflow: hidden;
        }

        .esquinasuperior {
            background: #00204A;
            position: absolute;
            width: 800px;
            height: 800px;
            clip-path: circle(50% at 50% 50%);
            margin-top: -400px;
            margin-left: 450px;
        }

        .nuestromenu{
            background: white;
            position: absolute;
            width: 510px;
            height: 150px;
            margin-top: 50px;
            margin-left: 0px;
        }
        #texto-menu {
            font-size: 40px;
            padding: 10px;
            text-align: center; 
            font-weight: bold;
            color: #00204A;
            -webkit-background-clip: text;
            background-clip: text;
        }

        .esquinainferior{
            background: #FD5F00;
            position: absolute;
            width: 1500px;
            height: 1500px;
            clip-path: circle(50% at 50% 50%);
            margin-top: 550px;
            margin-left: -600px;
        }

        .centroimg img{
            width: 1100px;
            height: 1000px;
            margin-left: -100px;
        }

        .logo {
            position: absolute;
            background-image: url('/img/picwish.png');
            background-size: 100% 100%;
            background-repeat: no-repeat;
            width: 400px;
            height: 220px;
            margin-left: 535px;
            margin-top: 25px;
        }

        .platosopa{
            background: #00204A;
            position: absolute;
            width: 200px;
            height: 200px;
            clip-path: circle(50% at 50% 50%);
            margin-top: 430px;
            margin-left: 10px;
        }
        #texto-sopa {
            font-size: 20px;
            shape-outside: circle(50% at 50% 50%);
            padding: 18px;
            padding-top: 60px;
            text-align: center;
            color: #FFFFFF;
            text-shadow: 0 -1px 4px #FFF, 0 -2px 10px #ff0, 0 -10px 20px #ff8000, 0 -18px 40px #F00;
            color: #FFFFFF;
        }
        
        .plato1{
            background: white;
            position: absolute;
            width: 250px;
            height: 250px;
            clip-path: circle(50% at 50% 50%);
            margin-top: 480px;
            margin-left: 215px;
        }
        .plato1 img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            cursor: move;
            user-select: none;
            transform-origin: top left;
            transition: transform 0.5s cubic-bezier(0.25, 0.1, 0.25, 1);
        }
        .coverplato1{
            background: white;
            position: absolute;
            width: 260px;
            height: 260px;
            clip-path: circle(50% at 50% 50%);
            margin-top: 475px;
            margin-left: 210px;
        }
        .plato1price {
            background: #00204A;
            position: absolute;
            width: 23%;
            height: 13%;
            border-radius: 0% 100% 46% 54% / 32% 62% 38% 68%;
            margin-top: 640px;
            margin-left: 220px;
        }
        .plato1bs{
            background: red;
            position: absolute;
            width: 6%;
            height: 6%;
            border-radius: 100%;
            margin-top: 688px;
            margin-left: 378px;
        }
        #texto-plato1bs {
            color: red;
            font-size: 20px;
            shape-outside: circle(50% at 50% 50%);
            padding-top: 15px;
            text-align: center;
            color: #FFFFFF;
            text-shadow: 0 -1px 4px #FFF, 0 -2px 10px #ff0, 0 -10px 20px #ff8000, 0 -18px 40px #F00;
            color: #FFFFFF;
        }
        #texto-plato1 {
            color: red;
            font-size: 20px;
            shape-outside: circle(50% at 50% 50%);
            padding-right: 65px;
            padding-top: 30px;
            text-align: center;
            color: #FFFFFF;
            text-shadow: 0 -1px 4px #FFF, 0 -2px 10px #ff0, 0 -10px 20px #ff8000, 0 -18px 40px #F00;
            color: #FFFFFF;
        }

        .plato2{
            background: white;
            position: absolute;
            width: 250px;
            height: 250px;
            clip-path: circle(50% at 50% 50%);
            margin-top: 570px;
            margin-left: 470px;
        }
        .coverplato2{
            background: white;
            position: absolute;
            width: 260px;
            height: 260px;
            clip-path: circle(50% at 50% 50%);
            margin-top: 565px;
            margin-left: 465px;
        }
        .plato2 img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            cursor: move;
            user-select: none;
            transform-origin: top left;
            transition: transform 0.5s cubic-bezier(0.25, 0.1, 0.25, 1);
        }
        .plato2price {
            background: #00204A;
            position: absolute;
            width: 23%;
            height: 13%;
            border-radius: 0% 100% 46% 54% / 32% 62% 38% 68%;
            margin-top: 710px;
            margin-left: 470px;
        }
        .plato2bs{
            background: red;
            position: absolute;
            width: 6%;
            height: 6%;
            border-radius: 100%;
            margin-top: 759px;
            margin-left: 628px;
        }
        #texto-plato2bs {
            color: red;
            font-size: 20px;
            shape-outside: circle(50% at 50% 50%);
            padding-top: 15px;
            text-align: center;
            color: #FFFFFF;
            text-shadow: 0 -1px 4px #FFF, 0 -2px 10px #ff0, 0 -10px 20px #ff8000, 0 -18px 40px #F00;
            color: #FFFFFF;
        }
        #texto-plato2 {
            color: red;
            font-size: 20px;
            shape-outside: circle(50% at 50% 50%);
            padding-right: 65px;
            padding-top: 30px;
            text-align: center;
            color: #FFFFFF;
            text-shadow: 0 -1px 4px #FFF, 0 -2px 10px #ff0, 0 -10px 20px #ff8000, 0 -18px 40px #F00;
            color: #FFFFFF;
        }

        .plato3{
            background: white;
            position: absolute;
            width: 250px;
            height: 250px;
            clip-path: circle(50% at 50% 50%);
            margin-top: 730px;
            margin-left: 690px;
        }
        .coverplato3{
            background: white;
            position: absolute;
            width: 260px;
            height: 260px;
            clip-path: circle(50% at 50% 50%);
            margin-top: 725px;
            margin-left: 685px;
        }
        .plato3 img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            cursor: move;
            user-select: none;
            transform-origin: top left;
            transition: transform 0.5s cubic-bezier(0.25, 0.1, 0.25, 1);
        }
        .plato3price {
            background: #00204A;
            position: absolute;
            width: 23%;
            height: 13%;
            border-radius: 0% 100% 46% 54% / 32% 62% 38% 68%;
            margin-top: 860px;
            margin-left: 690px;
        }
        .plato3bs{
            background: red;
            position: absolute;
            width: 6%;
            height: 6%;
            border-radius: 100%;
            margin-top: 910px;
            margin-left: 848px;
        }
        #texto-plato3bs {
            color: red;
            font-size: 20px;
            shape-outside: circle(50% at 50% 50%);
            padding-top: 15px;
            text-align: center;
            color: #FFFFFF;
            text-shadow: 0 -1px 4px #FFF, 0 -2px 10px #ff0, 0 -10px 20px #ff8000, 0 -18px 40px #F00;
            color: #FFFFFF;
        }
        #texto-plato3 {
            color: red;
            font-size: 20px;
            shape-outside: circle(50% at 50% 50%);
            padding-right: 65px;
            padding-top: 30px;
            text-align: center;
            color: #FFFFFF;
            text-shadow: 0 -1px 4px #FFF, 0 -2px 10px #ff0, 0 -10px 20px #ff8000, 0 -18px 40px #F00;
            color: #FFFFFF;
        }

        .platoextra{
            background: #00204A;
            position: absolute;
            width: 200px;
            height: 200px;
            clip-path: circle(50% at 50% 50%);
            margin-top: 640px;
            margin-left: 10px;
        }
        #texto-extra {
            font-size: 18px;
            shape-outside: circle(50% at 50% 50%);
            padding: 22px;
            padding-top: 40px;
            color: #FFFFFF;
            text-align: center;
            color: #FFFFFF;
        }

        .pedidos{
            width: 500px;
            height: 150px;
            position: absolute;
            margin-top: 815px;
            margin-left: 270px;
            font-weight: bold;
        }
        .ubicacionfoot{
            width: 300px;
            height: 150px;
            position: absolute;
            margin-top: 755px;
            margin-left: 20px;
            font-size: 35px;
            font-weight: bold;
        }
        .telefonosfoot{
            width: 350px;
            height: 150px;
            position: absolute;
            margin-top: 755px;
            margin-left: 270px;
            font-size: 35px;
            font-weight: bold;
        }

        #foot{
            width: 700px;
            position: absolute;
            margin-top: 85px;
            margin-left: 1px;
        }
</style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/wtf-forms.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-DlUyN1Q8yfSKrG63D2MbJSykfB03v+dpOWGU7JilG8jx+uZzJEl9bDxLgwlDErL28rrAQyM9S2U2i1EdT3Y9zg==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
    <script src="https://kit.fontawesome.com/06d27ee426.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

</head>
<body>
    <div class="parent">
        <div class="div1"> 
            <div id="elementToCapture"> 
                <div class="nuestromenu">
                    <p id="texto-menu">
                        Nuestro Menu De {{ \Carbon\Carbon::parse(now())->locale('es')->isoFormat('dddd') }}
                    </p>
                </div>               
                <div class="esquinasuperior"></div>
                <div class="esquinainferior"></div>

                <div id="foot">
                    <div class="telefonosfoot">
                        <span style="color: black; font-size: 25px; text-shadow: 2px 1px 9px #ff4d00;"><i class="fa-brands fa-whatsapp" style="color: blue; font-size: 30px;"></i> 78632592</span>
                        <span style="color: black; font-size: 25px; text-shadow: 2px 1px 9px #ff4d00;"><i class="fa-solid fa-tty" style="color: blue; font-size: 30px;"></i> 62-30689</span>
                    </div>
                    <div class="ubicacionfoot">
                        <div style="margin-left: 60px; margin-top: -70px; position: absolute">
                            <span style="color: black; font-size: 25px;"><i class="fa-solid fa-map-location-dot" style="color: blue; font-size: 60px;"></i></span><br>
                        </div>
                        <span style="color: black; font-size: 25px; text-shadow: 2px 1px 9px #ff4d00;">Calle Hoyos #29</span><br>
                        <span style="color: black; font-size: 25px; text-shadow: 2px 1px 9px #ff4d00;">LUN - DOM</span><br>
                        <span style="color: black; font-size: 25px; text-shadow: 2px 1px 9px #ff4d00;">11:00 - 13:00</span>
                    </div>
                    <div class="pedidos">
                        <img src="/img/moto.png" alt="" width="100px">
                        <img src="/img/pedidosya.png" alt="" width="70px" style="border-radius: 15px;">
                        <img src="/img/yummy.png" alt="" width="70px"  style="border-radius: 15px;">
                        <img src="/img/dinki.png" alt="" width="70px">
                    </div> 
                </div>

                <div id="allplatos">
                    <div class="platosopa">
                        <p id="texto-sopa"></p>
                    </div>
                    <div class="coverplato1"></div>
                    <div class="plato1">
                        <img id="img-plato1" src="" alt="">
                    </div>
                    <div class="plato1price">
                        <p id="texto-plato1"  class="draggable"></p>
                    </div>
                    <div class="plato1bs">
                        <p id="texto-plato1bs">23Bs.</p>
                    </div>
                    <div class="coverplato2"></div>
                    <div class="plato2">
                        <img id="img-plato2" src="" alt="">
                    </div>                    
                    <div class="plato2price">
                        <p id="texto-plato2"  class="draggable"></p>
                    </div>
                    <div class="plato2bs">
                        <p id="texto-plato2bs">23Bs.</p>
                    </div>
                    <div class="coverplato3"></div>
                    <div class="plato3">
                        <img id="img-plato3" src="" alt="">
                    </div>                    
                    <div class="plato3price">
                        <p id="texto-plato3"  class="draggable"></p>
                    </div>
                    <div class="plato3bs">
                        <p id="texto-plato3bs">23Bs.</p>
                    </div>
                    <div class="platoextra">
                        <p id="texto-extra">
                            <span style="color: red; font-weight: bold"> SOLO EXTRAS</span><br>
                            - MILANESA DE POLLO 25BS <br>
                            - SILPANCHO 25BS <br>
                        </p>
                    </div>
                </div>
                <div class="logo"></div>
                <div class="centroimg">
                    <img src="/img/escritorio.jpeg" alt="">
                </div>    
            
            </div>
        </div>    
        <div class="div2" style="padding: 20px; margin-left: 250px"> 
            <form action="">
                <div class="row">
                    <label for="plato1">SOPA</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="inputsopa" name="inputsopa" placeholder="Nombre Plato" oninput="this.value = this.value.toUpperCase()" onkeyup="mostrarTexto('inputsopa', 'texto-sopa')"><br>
                    </div>
                </div>
                <div class="row">
                    <label for="plato1">PLATO 1</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="inputplato1" name="inputplato1" placeholder="Nombre Plato" oninput="this.value = this.value.toUpperCase()" onkeyup="mostrarTexto('inputplato1', 'texto-plato1')"><br>
                    </div>
                    <div class="col-sm-6">
                        <label class="file">
                            <input type="file" id="inputimg1" name="inputimg1" aria-label="File browser example" onchange="mostrarImagen(this, 'img-plato1')">
                            <span class="file-custom"></span>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <label for="plato1">PLATO 2</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="inputplato2" name="inputplato2" placeholder="Nombre Plato" oninput="this.value = this.value.toUpperCase()" onkeyup="mostrarTexto('inputplato2', 'texto-plato2')"><br>
                    </div>
                    <div class="col-sm-6">
                        <label class="file">
                            <input type="file" id="inputimg2" name="inputimg2" aria-label="File browser example" onchange="mostrarImagen(this, 'img-plato2')">
                            <span class="file-custom"></span>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <label for="plato1">PLATO 3</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="inputplato3" name="inputplato3" placeholder="Nombre Plato" oninput="this.value = this.value.toUpperCase()" onkeyup="mostrarTexto('inputplato3', 'texto-plato3')"><br>
                    </div>
                    <div class="col-sm-6">
                        <label class="file">
                            <input type="file" id="inputimg3" name="inputimg3" aria-label="File browser example" onchange="mostrarImagen(this, 'img-plato3')">
                            <span class="file-custom"></span>
                        </label>
                    </div>
                </div>
            </form>
            <button id="btnCapturePDF" class="btn-primary" style="width: 100%" onclick="captureImageAndPDF()">Capturar imagen y descargar PDF</button>
        </div>    
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.6.0/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script>
        function mostrarTexto(inputId, textoId) {
            var input = document.getElementById(inputId);
            var texto = document.getElementById(textoId);
            texto.innerText = input.value;
        }

        function mostrarImagen(input, imagenId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var imagen = document.getElementById(imagenId);
                    imagen.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        var draggableImg1 = document.getElementById("img-plato1");
        var draggableImg2 = document.getElementById("img-plato2");
        var draggableImg3 = document.getElementById("img-plato3");

        // Funciones para img-plato1
        var initialX1;
        var initialY1;
        var currentX1 = 0;
        var currentY1 = 0;
        var dragging1 = false;
        var scaling1 = false;
        var initialScale1;
        var lastScale1 = 1;

        draggableImg1.addEventListener("mousedown", function (event) {
            event.preventDefault();

            if (event.ctrlKey) {
                scaling1 = true;
                initialScale1 = lastScale1;
                return;
            }

            initialX1 = event.clientX - currentX1;
            initialY1 = event.clientY - currentY1;
            dragging1 = true;
        });

        document.addEventListener("mousemove", function (event) {
            if (scaling1) {
                event.preventDefault();

                var scale = initialScale1 * (1 + (event.clientX - initialX1) * 0.001);
                draggableImg1.style.transform = "scale(" + scale + ")";
                lastScale1 = scale;
                return;
            }

            if (dragging1) {
                event.preventDefault();
                currentX1 = event.clientX - initialX1;
                currentY1 = event.clientY - initialY1;
                draggableImg1.style.transform = "translate(" + currentX1 + "px, " + currentY1 + "px) scale(" + lastScale1 + ")";
            }
        });

        document.addEventListener("mouseup", function () {
            dragging1 = false;
            scaling1 = false;
        });

        draggableImg1.addEventListener("wheel", function (event) {
            event.preventDefault();

            var scaleDelta = event.deltaY * -0.001;
            var scale = lastScale1 + scaleDelta;
            draggableImg1.style.transform = "scale(" + scale + ")";
            lastScale1 = scale;
        });


        // Funciones para img-plato2
        var initialX2;
        var initialY2;
        var currentX2 = 0;
        var currentY2 = 0;
        var dragging2 = false;
        var scaling2 = false;
        var initialScale2;
        var lastScale2 = 1;

        draggableImg2.addEventListener("mousedown", function (event) {
            event.preventDefault();

            if (event.ctrlKey) {
                scaling2 = true;
                initialScale2 = lastScale2;
                return;
            }

            initialX2 = event.clientX - currentX2;
            initialY2 = event.clientY - currentY2;
            dragging2 = true;
        });

        document.addEventListener("mousemove", function (event) {
            if (scaling2) {
                event.preventDefault();

                var scale = initialScale2 * (1 + (event.clientX - initialX2) * 0.001);
                draggableImg2.style.transform = "scale(" + scale + ")";
                lastScale2 = scale;
                return;
            }

            if (dragging2) {
                event.preventDefault();
                currentX2 = event.clientX - initialX2;
                currentY2 = event.clientY - initialY2;
                draggableImg2.style.transform = "translate(" + currentX2 + "px, " + currentY2 + "px) scale(" + lastScale2 + ")";
            }
        });

        document.addEventListener("mouseup", function () {
            dragging2 = false;
            scaling2 = false;
        });

        draggableImg2.addEventListener("wheel", function (event) {
            event.preventDefault();

            var scaleDelta = event.deltaY * -0.001;
            var scale = lastScale2 + scaleDelta;
            draggableImg2.style.transform = "scale(" + scale + ")";
            lastScale2 = scale;
        });


        // Funciones para img-plato3
        var initialX3;
        var initialY3;
        var currentX3 = 0;
        var currentY3 = 0;
        var dragging3 = false;
        var scaling3 = false;
        var initialScale3;
        var lastScale3 = 1;

        draggableImg3.addEventListener("mousedown", function (event) {
            event.preventDefault();

            if (event.ctrlKey) {
                scaling3 = true;
                initialScale3 = lastScale3;
                return;
            }

            initialX3 = event.clientX - currentX3;
            initialY3 = event.clientY - currentY3;
            dragging3 = true;
        });

        document.addEventListener("mousemove", function (event) {
            if (scaling3) {
                event.preventDefault();

                var scale = initialScale3 * (1 + (event.clientX - initialX3) * 0.001);
                draggableImg3.style.transform = "scale(" + scale + ")";
                lastScale3 = scale;
                return;
            }

            if (dragging3) {
                event.preventDefault();
                currentX3 = event.clientX - initialX3;
                currentY3 = event.clientY - initialY3;
                draggableImg3.style.transform = "translate(" + currentX3 + "px, " + currentY3 + "px) scale(" + lastScale3 + ")";
            }
        });

        document.addEventListener("mouseup", function () {
            dragging3 = false;
            scaling3 = false;
        });

        draggableImg3.addEventListener("wheel", function (event) {
            event.preventDefault();

            var scaleDelta = event.deltaY * -0.001;
            var scale = lastScale3 + scaleDelta;
            draggableImg3.style.transform = "scale(" + scale + ")";
            lastScale3 = scale;
        });
    </script>
    <script>
        var menuElement = document.getElementById("texto-menu");
        var menuText = menuElement.textContent || menuElement.innerText;
        var menuTextMayusculas = menuText.toUpperCase();
        menuElement.textContent = menuTextMayusculas;
    </script>
    <script>
        // Selecciona los elementos arrastrables por su clase "draggable"
        var draggableEls = document.getElementsByClassName("draggable");

        // Configura la interacción para cada elemento arrastrable
        for (var i = 0; i < draggableEls.length; i++) {
            var draggableEl = draggableEls[i];

            interact(draggableEl)
                .draggable({
                    onmove: dragMoveListener
                })
                .resizable({
                    edges: { left: true, right: true, bottom: true, top: true }
                })
                .on('resizemove', function (event) {
                    var target = event.target;
                    var x = (parseFloat(target.getAttribute('data-x')) || 0);
                    var y = (parseFloat(target.getAttribute('data-y')) || 0);

                    // Actualiza el tamaño del elemento
                    target.style.width = event.rect.width + 'px';
                    target.style.height = event.rect.height + 'px';

                    // Calcula la nueva posición del elemento considerando el cambio de tamaño
                    x += event.deltaRect.left;
                    y += event.deltaRect.top;

                    // Actualiza la posición del elemento
                    target.style.transform = 'translate(' + x + 'px,' + y + 'px)';

                    target.setAttribute('data-x', x);
                    target.setAttribute('data-y', y);
                });
        }

        function dragMoveListener(event) {
            var target = event.target;
            var x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
            var y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

            target.style.transform = 'translate(' + x + 'px, ' + y + 'px)';

            target.setAttribute('data-x', x);
            target.setAttribute('data-y', y);
        }
    </script>
    <script>
        function captureImageAndPDF() {
            var x = 100;
            var y = 100;
            var width = 950;
            var height = 1000;

            domtoimage.toPng(document.body, {
                quality: 1,
                width: width,
                height: height,
                style: {
                    left: -x + 'px',
                    top: -y + 'px',
                },
            })
                .then(function (dataUrl) {
                    var zip = new JSZip();
                    var currentDate = new Date();
                    var folderName = 'Menu_' + currentDate.getDate() + '_' + (currentDate.getMonth() + 1) + '_' + currentDate.getFullYear();
                    var folder = zip.folder(folderName);

                    // Agregar la imagen al archivo ZIP
                    folder.file('imagen.png', dataURLToBlob(dataUrl));

                    // Después de capturar la imagen, llamar a la función para generar y descargar el PDF
                    generarPDF(folder).then(function () {
                        // Generar y descargar el archivo ZIP
                        var currentDate = new Date();
                        var zipName = 'Menu_' + currentDate.getDate() + '_' + (currentDate.getMonth() + 1) + '_' + currentDate.getFullYear() + '.zip';
                        zip.generateAsync({ type: 'blob' }).then(function (blob) {
                            saveAs(blob, zipName);
                        });
                    });
                })
                .catch(function (error) {
                    console.error('Error al capturar la imagen:', error);
                });
        }

        // Función para ajustar el tamaño de letra para que el texto quepa en una sola página
        function adjustFontSizeInSinglePage(doc, text, yPos, maxWidth, maxHeight, fontSize) {
            doc.setFontSize(fontSize);
            const lineHeight = fontSize * 1.0; // Altura de línea estimada

            const lines = doc.splitTextToSize(text, maxWidth);

            const totalHeight = lines.length * lineHeight;
            if (totalHeight <= maxHeight - yPos) {
                // El texto cabe en la página actual, agregar todas las líneas
                for (let i = 0; i < lines.length; i++) {
                doc.text(10, yPos, lines[i]);
                yPos += lineHeight;
                }
            } else {
                // El texto no cabe en la página actual, reducir el tamaño de letra y ajustar
                fontSize -= 1;
                if (fontSize >= 5) {
                return adjustFontSizeInSinglePage(doc, text, yPos, maxWidth, maxHeight, fontSize);
                } else {
                // El tamaño de letra es demasiado pequeño incluso para ajustar en una sola página, mostrar advertencia
                doc.text(10, yPos, 'El texto es demasiado largo para ajustarse en una sola página.');
                }
            }

            return yPos;
        }

        // Función para generar el PDF
        function generarPDF(zipFolder) {
        return new Promise(function (resolve, reject) {
            // Crear un nuevo objeto jsPDF
            const doc = new jsPDF('landscape', 'pt');

            // Establecer el ancho de línea en 0 para eliminar los bordes
            doc.setLineWidth(0);

            // Establecer el tamaño máximo de la página
            const maxWidth = 834; // Ancho máximo del texto en la página
            const maxHeight = 1169; // Altura máxima del texto en la página
            const fontSize = 75; // Tamaño de letra inicial

            // Obtener los valores de los inputs
            const sopa = document.getElementById('inputsopa').value;
            const plato1 = document.getElementById('inputplato1').value;
            const plato2 = document.getElementById('inputplato2').value;
            const plato3 = document.getElementById('inputplato3').value;

            // Agregar los valores al PDF en una sola página
            let yPos = 70; // Posición inicial en Y

            yPos = adjustFontSizeInSinglePage(doc, sopa, yPos, maxWidth, maxHeight, fontSize);
            yPos = adjustFontSizeInSinglePage(doc, plato1, yPos, maxWidth, maxHeight, fontSize);
            yPos = adjustFontSizeInSinglePage(doc, plato2, yPos, maxWidth, maxHeight, fontSize);
            yPos = adjustFontSizeInSinglePage(doc, plato3, yPos, maxWidth, maxHeight, fontSize);

            // Obtener el contenido del PDF como una cadena de datos
            const pdfData = doc.output('datauristring');

            // Agregar el PDF al archivo ZIP
            zipFolder.file('formulario.pdf', dataURLToBlob(pdfData));

            resolve();
        });
        }
       
        // Función para agregar texto con saltos de línea y ajuste de tamaño de letra
        function addTextWithLineBreaks(doc, text, yPos, maxWidth, reduccionEspacio) {
            let fontSize = 75; // Tamaño de letra inicial
            const lineHeight = fontSize * 0.5; // Altura de línea estimada

            const maxTextWidth = maxWidth - 20; // Ancho máximo del texto con margen
            const maxTextHeight = doc.internal.pageSize.getHeight() - 0; // Altura máxima del texto con margen

            let lines = doc.splitTextToSize(text, maxTextWidth);

            // Verificar si el texto cabe en la página actual
            if ((yPos + lines.length * lineHeight) <= maxTextHeight) {
                doc.setFontSize(fontSize);
                doc.setLineHeightFactor(reduccionEspacio); // Reducción del espacio entre líneas

                for (let i = 0; i < lines.length; i++) {
                doc.text(10, yPos, lines[i]);
                yPos += lineHeight;
                }
            } else {
                // El texto no cabe en la página actual, agregar un salto de página
                doc.addPage();
                yPos = 30;
                lines = doc.splitTextToSize(text, maxTextWidth); // Volver a dividir el texto en líneas

                doc.setFontSize(fontSize);
                doc.setLineHeightFactor(reduccionEspacio); // Reducción del espacio entre líneas

                for (let i = 0; i < lines.length; i++) {
                if ((yPos + lineHeight) > maxTextHeight) {
                    // El texto no cabe en la página actual, agregar un salto de página
                    doc.addPage();
                    yPos = 30;
                }

                doc.text(10, yPos, lines[i]);
                yPos += lineHeight;
                }
            }

            return yPos;
        }

        function dataURLToBlob(dataURL) {
            const arr = dataURL.split(',');
            const mime = arr[0].match(/:(.*?);/)[1];
            const bstr = atob(arr[1]);
            let n = bstr.length;
            const u8arr = new Uint8Array(n);
            while (n--) {
                u8arr[n] = bstr.charCodeAt(n);
            }
            return new Blob([u8arr], { type: mime });
        }
    </script>
</body>
</html>
