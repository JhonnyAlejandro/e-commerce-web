<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Recibiste un correo de contacto de {{ $msg['first_name'] }} {{ $msg['last_name'] }} </h1>
    <p><strong>Asunto:</strong> {{ $msg['message'] }}</p>
    <p><strong>Teléfono:</strong> {{ $msg['phone'] }}</p>
</body>

</html>
