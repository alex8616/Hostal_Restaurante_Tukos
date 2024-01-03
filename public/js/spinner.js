    // Bloquear botones de entrada en la página
    var inputs = document.getElementsByTagName("input");
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].disabled = true;
    }

    // Ocultar spinner, overlay y habilitar botones de entrada una vez que la página haya cargado completamente
    window.addEventListener('load', function() {
        document.querySelector('.spinner').style.display = 'none';
        document.querySelector('.overlay').style.display = 'none';

        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].disabled = false;
        }
    });
