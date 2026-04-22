<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo contacto</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; color:#1f2937; line-height:1.5;">
    <h2 style="margin-bottom: 8px;">Nuevo mensaje desde el formulario de contacto</h2>

    <p><strong>Nombre:</strong> {{ $nombre }}</p>
    <p><strong>Correo:</strong> {{ $correo }}</p>
    <p><strong>Mensaje:</strong></p>
    <p style="white-space: pre-line;">{{ $mensaje }}</p>
</body>
</html>
