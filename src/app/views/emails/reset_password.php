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
            <h2 class="subtitle"></h2>

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
                
            </div>
        </div>

    </div>

    <script src="/../../../public/js/toast.js"></script>
    <script src="/../../../public/js/login_pass/forgot-password.js"></script>
</body>

</html>