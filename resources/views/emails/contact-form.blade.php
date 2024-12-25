<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #02311a; color: white; padding: 20px; }
        .content { padding: 20px; }
        .footer { text-align: center; padding: 20px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Nuevo Mensaje de Contacto</h2>
        </div>
        <div class="content">
            <p><strong>Nombre:</strong> {{ $data['nombre'] }}</p>
            <p><strong>Email:</strong> {{ $data['email'] }}</p>
            <p><strong>Teléfono:</strong> {{ $data['telefono'] ?? 'No proporcionado' }}</p>
            <p><strong>Mensaje:</strong></p>
            <p>{{ $data['mensaje'] }}</p>
        </div>
        <div class="footer">
            <p>Este mensaje fue enviado desde el formulario de contacto del Sistema Vocacional.</p>
        </div>
    </div>
</body>
</html>