<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #02311a;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
            background-color: #f8f8f8;
        }
        .credentials {
            background-color: white;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bienvenido(a) {{ $name }}</h1>
    </div>
    
    <div class="content">
        <p>Has sido registrado como publicador en nuestro sistema. Aquí están tus credenciales de acceso:</p>
        
        <div class="credentials">
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Contraseña:</strong> {{ $password }}</p>
        </div>
        
        <p>Te recomendamos cambiar tu contraseña después de iniciar sesión por primera vez.</p>
        
        <p>Saludos cordiales,<br>
        El equipo administrativo</p>
    </div>
</body>
</html>