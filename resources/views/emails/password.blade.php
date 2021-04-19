<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2>Hola, {{$name}} tus datos han sido actualizados en <strong>Inmobiliaria Daniel Canepa Propiedades</strong> !</h2>
    <p>Su nueva contraseña de correo es <b>{{$confirmation_code}}</b>.</p>
    <p>Por favor confirme su correo electrónico en el siguiente enlace para poder acceder a la aplicación.</p>

    <a href="{{ url('/admin') }}">
        Clic acá para ir a la aplicación 
    </a>
</body>
</html>
