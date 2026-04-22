@php
    $proyecto = $evento->proyecto ?? null;
    $tipo = $evento->tipo ?? null;
    $nombreUsuario = $usuario->name ?? 'usuario';
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Alerta de Plazo Próximo</title>
</head>
<body>
    <p>Hola {{ $nombreUsuario }},</p>

    <h2>¡Atención! Se acerca un plazo importante en el calendario</h2>
    @if($diasFaltantes > 0)
        <p style="color: #d35400;"><strong>Faltan {{ $diasFaltantes }} día{{ $diasFaltantes == 1 ? '' : 's' }} para el evento.</strong></p>
    @elseif($diasFaltantes == 0)
        <p style="color: #c0392b;"><strong>¡Hoy es el día del evento!</strong></p>
    @elseif($diasFaltantes < 0)
        <p style="color: #888;"><strong>Este evento ya pasó.</strong></p>
    @endif
    <p><strong>Tipo de evento:</strong> {{ $tipo->gls_tipo ?? '-' }}</p>
    <p><strong>Descripción:</strong> {{ $evento->descripcion ?? '-' }}</p>
    <p><strong>Fecha límite:</strong> {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}</p>
    @if($proyecto)
        <p><strong>Proyecto:</strong> {{ $proyecto->nombre ?? '-' }}</p>
        <p><strong>Código Proyecto:</strong> {{ $proyecto->codigo ?? '-' }}</p>
    @endif
    <hr>
    <p>Por favor, tome las acciones necesarias antes de la fecha indicada.</p>
    <p>Saludos,<br>Equipo RioNero</p>
</body>
</html>
