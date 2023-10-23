<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mensajes Bee</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 10px;
        }
        
        .content {
            padding: 20px;
        }
        
        .button {
            display: inline-block;
            background-color: #D4E6F1;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        
        .footer {
            background-color: #f2f2f2;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h2>Notificación de Email</h2>
        </div>
        <div class="content">
            <p>Hola,</p>
            <p>Tu cuenta de correo electrónico ha sido configurada correctamente. A continuación, te proporcionamos los detalles de tu cuenta:</p>
            <p><strong>Correo Electrónico:</strong> {{$msg['email']}}</p>
            <p><strong>Contraseña:</strong> {{$msg['password']}}</p>
            <p>Puedes acceder a tu correo electrónico haciendo clic en el siguiente enlace:</p>
            <a class="button" href="http://127.0.0.1:8000/login">Acceder a tu correo</a>
        </div>
        <div class="footer">
            <p>Este es un mensaje automático. Por favor, no respondas a este correo.</p>
        </div>
    </div>
    
    <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
</body>
</html>