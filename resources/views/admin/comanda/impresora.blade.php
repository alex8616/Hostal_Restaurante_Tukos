<!DOCTYPE html>
<html>
<head>
    <title>Seleccionar Impresora Predeterminada</title>
</head>
<body>
    <h1>Seleccionar Impresora Predeterminada</h1>
    <button onclick="seleccionarImpresora()">Seleccionar Impresora</button>

    <script>
        function seleccionarImpresora() {
            if (typeof navigator.print === 'function') {
                navigator.print()
                    .then(function () {
                        console.log('Impresora seleccionada y configurada como predeterminada.');
                    })
                    .catch(function (error) {
                        console.error('Error al seleccionar la impresora: ', error);
                    });
            } else {
                console.error('La API navigator.print no est¨¢ soportada en este navegador.');
            }
        }
    </script>
</body>
</html>
