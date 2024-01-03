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
            width: 900px;
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
            width: 1000px;
            height: 1000px;
            margin-left: -100px;
        }

        .logo {
            position: absolute;
            background-image: url('/img/picwish.png');
            background-size: 100% 100%;
            background-repeat: no-repeat;
            width: 400px;
            height: 250px;
            margin-left: 500px;
            margin-top: 25px;
        }

        .platosopa{
            background: #00204A;
            position: absolute;
            width: 200px;
            height: 200px;
            clip-path: circle(50% at 50% 50%);
            margin-top: 470px;
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
            margin-left: 230px;
        }
        .coverplato1{
            background: white;
            position: absolute;
            width: 260px;
            height: 260px;
            clip-path: circle(50% at 50% 50%);
            margin-top: 475px;
            margin-left: 225px;
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
        .plato1price {
            background: #00204A;
            position: absolute;
            width: 23%;
            height: 13%;
            border-radius: 0% 100% 46% 54% / 32% 62% 38% 68%;
            margin-top: 640px;
            margin-left: 235px;
        }
        .plato1bs{
            background: red;
            position: absolute;
            width: 6%;
            height: 6%;
            border-radius: 100%;
            margin-top: 688px;
            margin-left: 386px;
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
            margin-left: 490px;
        }
        .coverplato2{
            background: white;
            position: absolute;
            width: 260px;
            height: 260px;
            clip-path: circle(50% at 50% 50%);
            margin-top: 565px;
            margin-left: 485px;
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
            margin-left: 490px;
        }
        .plato2bs{
            background: red;
            position: absolute;
            width: 6%;
            height: 6%;
            border-radius: 100%;
            margin-top: 758px;
            margin-left: 638px;
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
        .platoextra{
            background: #00204A;
            position: absolute;
            width: 200px;
            height: 200px;
            clip-path: circle(50% at 50% 50%);
            margin-top: 780px;
            margin-left: 680px;
        }
        #texto-extra {
            font-size: 20px;
            shape-outside: circle(50% at 50% 50%);
            padding: 18px;
            padding-top: 40px;
            text-align: center;
            color: #FFFFFF;
            text-shadow: 0 -1px 4px #FFF, 0 -2px 10px #ff0, 0 -10px 20px #ff8000, 0 -18px 40px #F00;
            color: #FFFFFF;
        }

        .pedidos{
            width: 500px;
            height: 150px;
            position: absolute;
            margin-top: 810px;
            margin-left: 270px;
            font-weight: bold;
        }
        .ubicacionfoot{
            width: 300px;
            height: 150px;
            position: absolute;
            margin-top: 740px;
            margin-left: 20px;
            font-size: 35px;
            font-weight: bold;
        }
        .telefonosfoot{
            width: 350px;
            height: 150px;
            position: absolute;
            margin-top: 740px;
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
                    <div class="platoextra">
                        <p id="texto-extra">
                            SOLO EXTRAS. <br>
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
        <div class="div2" style="padding: 20px; margin-left: 50px"> 
            <form action="">
                <div class="row">
                    <label for="plato1">SOPA</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="inputsopa" name="inputsopa" placeholder="Nombre Plato" onkeyup="mostrarTexto('inputsopa', 'texto-sopa')"><br>
                    </div>
                </div>
                <div class="row">
                    <label for="plato1">PLATO 1</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="inputplato1" name="inputplato1" placeholder="Nombre Plato" onkeyup="mostrarTexto('inputplato1', 'texto-plato1')"><br>
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
                        <input type="text" class="form-control" id="inputplato2" name="inputplato2" placeholder="Nombre Plato" onkeyup="mostrarTexto('inputplato2', 'texto-plato2')"><br>
                    </div>
                    <div class="col-sm-6">
                        <label class="file">
                            <input type="file" id="inputimg2" name="inputimg2" aria-label="File browser example" onchange="mostrarImagen(this, 'img-plato2')">
                            <span class="file-custom"></span>
                        </label>
                    </div>
                </div>
            </form>
            <button id="btnCapture" class="btn-primary" style="width: 100%">Capturar imagen</button>
        </div>    
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
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
    </script>
    <script>
        var btnCapture = document.getElementById('btnCapture');
        btnCapture.addEventListener('click', function () {
            var x = 100;
            var y = 100;
            var width = 900;
            var height = 1000;
            domtoimage.toPng(document.body, { 
                quality: 1,
                width: width,
                height: height,
                style: {
                    left: -x + 'px',
                    top: -y + 'px',
                }
                })
            .then(function (dataUrl) {
                var link = document.createElement('a');
                link.href = dataUrl;
                link.download = 'imagen.png';
                link.click();
            })
            .catch(function (error) {
                console.error('Error al capturar la imagen:', error);
            });
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
</body>
</html>