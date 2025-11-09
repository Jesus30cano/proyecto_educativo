<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña - Cognia</title>
    <link rel="stylesheet" href="../../../public/css/toast.css">
    <link rel="stylesheet" href="../../../public/css/login_styles/login_styles.css">
    <style>
        .input-container {
            margin-bottom: 20px;
        }
        .input-label {
            display: block;
            margin-bottom: 8px;
            color: #37474F;
            font-weight: 600;
        }
        .input-field {
            width: 100%;
            padding: 12px;
            font-size: 18px;
            border: 2px solid #90CAF9;
            border-radius: 8px;
            background-color: #F5F5F5;
            color: #37474F;
            transition: all 0.3s;
        }
        .input-field:focus {
            border-color: #1E88E5;
            outline: none;
            box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.16);
            transform: scale(1.02);
        }
    </style>
</head>
<body>
    <div class="container-all">
        <div class="ctn-form">
            <h1 class="tittle">Restablecer Contraseña</h1>
            <h2 class="subtitle">Ingresa tu nueva contraseña</h2>
            <form id="resetPasswordForm">
                <div class="input-container">
                    <label for="password" class="input-label">Nueva contraseña</label>
                    <input type="password" id="password" class="input-field" required minlength="6" autocomplete="new-password">
                </div>
                <div class="input-container">
                    <label for="confirm_password" class="input-label">Confirmar contraseña</label>
                    <input type="password" id="confirm_password" class="input-field" required minlength="6" autocomplete="new-password">
                </div>
                <button type="submit" class="btn-login">CAMBIAR CONTRASEÑA</button>
            </form>
            <p class="text-footer">
                <a href="/auth/login">Volver al inicio de sesión</a>
            </p>
        </div>
        <div class="panel-info">
            <div class="capa"></div>
            <div style="position: relative; z-index: 3;">
                <div style="font-size: 80px; margin-bottom: 20px;"></div>
                <h2 class="tittle-description">¡Protege tu cuenta!</h2>
                <p class="text-description">
                    Ingresa una nueva contraseña segura que puedas recordar.
                </p>
            </div>
        </div>
    </div>
    <script src="/../../../public/js/toast.js"></script>
    <script src="/../../../public/js/login_pass/reset_password.js"></script>
</body>
</html>