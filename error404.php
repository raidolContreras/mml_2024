<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404 - Página no encontrada</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f0f0;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }
        .container {
            text-align: center;
            max-width: 400px;
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .error-code {
            font-size: 72px;
            color: #F44336;
            margin-bottom: 10px;
            animation: pulse 1s infinite alternate;
        }
        @keyframes pulse {
            from {
                transform: scale(1);
            }
            to {
                transform: scale(1.1);
            }
        }
        .error-message {
            font-size: 24px;
            margin-bottom: 20px;
            animation: slideIn 1s ease;
        }
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .return-home {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 12px 24px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            margin-top: 20px;
            display: inline-block;
            animation: fadeIn 1s ease;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        .return-home:hover {
            background-color: #388E3C;
        }
        .illustration {
            max-width: 250px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-code">
            404
        </div>
        <div class="error-message">¡Ups! Parece que esta página no existe.</div>
        <a href="./" class="return-home">Volver al inicio</a>
    </div>
</body>
</html>
