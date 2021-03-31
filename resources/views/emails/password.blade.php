<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2>Hola, {{$name}} gracias por registrarte en <strong>Cashouter</strong> !</h2>
    <p>Por favor confirma tu correo electrónico.</p>

    <a href="{{ url('/register/verify/' . $confirmation_code) }}">
        Clic para confirmar tu email
    </a>
</body>
</html>
