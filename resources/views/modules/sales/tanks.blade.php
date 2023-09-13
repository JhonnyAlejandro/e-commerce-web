<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        #contenedor {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #mensaje {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div id="contenedor">
        <div id="mensaje">
            <h1>¡Gracias por tu Compra!</h1>
            <p>Estamos emocionados de que hayas elegido nuestros productos. Tu satisfacción es nuestra principal
                prioridad.</p>
            <p>Esperamos que disfrutes de tu producto y que te brinde momentos de alegría y diversión.</p>
            <a href="{{ route('home') }}"
                class="bg-blue-900 text-white btn-lg text-sm hover:shadow-lg flex items-center justify-center uppercase font-semibold transition duration-300 ease-in-out mt-4 mx-5 mb-5">
                ir a la pagina de nuevo
            </a>
        </div>
    </div>
</body>

</html>
