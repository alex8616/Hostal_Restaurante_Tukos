<!-- En tu archivo GeneradorQR.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Generador de C車digo QR</title>
</head>
<body>
    <h1>Generador de C車digo QR</h1>

    <p>URL a codificar: {{ $data }}</p>

    <!-- Mostrar el c車digo QR utilizando la variable $qrCodeWithLogo -->
    <img src="data:image/png;base64,{{ base64_encode($qrCodeWithLogo) }}" alt="C車digo QR con logotipo">

</body>
</html>
