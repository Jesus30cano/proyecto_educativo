<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - Cognia</title>
    <link rel="stylesheet" href="../../../public/css/toast.css">
    <link rel="stylesheet" href="../../../public/css/login_styles/login_styles.css">
</head>

<body>

    <div class="container-all">

        <div class="ctn-form">
            <h1 class="tittle">Recuperar Contraseña</h1>
            <h2 class="subtitle">Ingresa tu correo electrónico</h2>

            <form id="forgotPasswordForm">
                <!-- 🔽 Correo Electrónico -->
                <div class="input-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" name="email" id="email" placeholder="ejemplo@correo.com" required>
                </div>

                <button type="submit" class="btn-login">
                    ENVIAR CÓDIGO
                </button>
            </form>

            <p class="text-footer">
                ¿Recordaste tu contraseña? <a href="/auth/login">Iniciar Sesión</a>
            </p>
        </div>

        <div class="panel-info">
            <div class="capa"></div>
            <div style="position: relative; z-index: 3;">
                <div style="font-size: 80px; margin-bottom: 20px;"></div>
                <h2 class="tittle-description">¿Olvidaste tu contraseña?</h2>
                <p class="text-description">
                    No te preocupes, ingresa tu correo electrónico y te enviaremos un código de verificación para que puedas restablecer tu contraseña de forma segura.
                </p>
                <p class="text-description" style="margin-top: 30px; font-size: 16px;">
                    El código será válido por <strong>15 minutos</strong>
                </p>
            </div>
        </div>

    </div>

    <script src="/../../../public/js/toast.js"></script>
    <script src="/../../../public/js/login_pass/forgot-password.js"></script>
</body>

</html>