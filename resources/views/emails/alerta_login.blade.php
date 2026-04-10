<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
        }
        .email-wrapper {
            width: 100%;
            padding: 40px 0;
            background-color: #f4f7f6;
        }
        .email-card {
            max-width: 500px;
            margin: 0 auto;
            background-color: #ffffff;
            border-top: 5px solid #D4AF37; /* Dorado */
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .email-header {
            background-color: #0B2545; /* Azul Marino Elegante */
            color: #D4AF37; /* Dorado */
            text-align: center;
            padding: 30px 20px;
        }
        .email-header h2 {
            margin: 0;
            font-size: 26px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .email-body {
            padding: 35px 25px;
            color: #333333;
            text-align: center;
        }
        .email-body h3 {
            color: #0B2545;
            margin-top: 0;
            font-size: 20px;
        }
        .email-body p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
            color: #555555;
        }
        .btn-gold {
            display: inline-block;
            padding: 14px 30px;
            background-color: #D4AF37; /* Dorado */
            color: #0B2545 !important; /* Texto Azul Marino */
            text-decoration: none;
            font-weight: bold;
            border-radius: 30px;
            font-size: 16px;
        }
        .email-footer {
            background-color: #f9f9f9;
            padding: 20px;
            text-align: center;
            font-size: 13px;
            color: #888888;
            border-top: 1px solid #eeeeee;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-card">
            <div class="email-header">
                <h2>STYLEHUB</h2>
            </div>
            
            <div class="email-body">
                <h3>Nuevo inicio de sesión activo</h3>
                <p>Se ha detectado actividad reciente en tu cuenta. Si fuiste tú, puedes ignorar este mensaje con tranquilidad.</p>
                
                <a href="{{ route('acceso') }}" class="btn-gold">
                    Verificar actividad reciente
                </a>
            </div>
            
            <div class="email-footer">
                <p style="margin: 0;"><strong>¿No fuiste tú?</strong> Solicita inmediatamente un cambio de contraseña al administrador del sistema para proteger tu información.</p>
            </div>
        </div>
    </div>
</body>
</html>