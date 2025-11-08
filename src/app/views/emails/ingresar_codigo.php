<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Código - Cognia</title>
    <link rel="stylesheet" href="../../../public/css/toast.css">
    <link rel="stylesheet" href="../../../public/css/login_styles/login_styles.css">
    <style>
        .code-input-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 30px 0;
        }

        .code-input {
            width: 50px;
            height: 60px;
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            border: 2px solid #90CAF9;
            border-radius: 8px;
            background-color: #F5F5F5;
            color: #37474F;
            transition: all 0.3s;
        }

        .code-input:focus {
            border-color: #1E88E5;
            outline: none;
            box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.2);
            transform: scale(1.05);
        }

        
    </style>
</head>

<body>

    <div class="container-all">

        <div class="ctn-form">
            <h1 class="tittle">Verificar Código</h1>
            <h2 class="subtitle">Ingresa el código de 6 dígitos</h2>

            <p style="text-align: center; color: #37474F; font-size: 14px; margin-bottom: 10px;">
                Enviado a: <strong id="userEmail"></strong>
            </p>

            <form id="verifyCodeForm">
                <div class="code-input-container">
                    <input type="text" class="code-input" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                    <input type="text" class="code-input" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                    <input type="text" class="code-input" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                    <input type="text" class="code-input" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                    <input type="text" class="code-input" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                    <input type="text" class="code-input" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                </div>

                <button type="submit" class="btn-login">
                    VERIFICAR CÓDIGO
                </button>
            </form>

            

            <p class="text-footer">
                <a href="/auth/login">Volver al inicio de sesión</a>
            </p>
        </div>

        <div class="panel-info">
            <div class="capa"></div>
            <div style="position: relative; z-index: 3;">
                <div style="font-size: 80px; margin-bottom: 20px;"></div>
                <h2 class="tittle-description">Revisa tu correo</h2>
                <p class="text-description">
                    Hemos enviado un código de verificación de 6 dígitos a tu correo electrónico. Ingrésalo para continuar con el proceso de recuperación.
                </p>
                <p class="text-description" style="margin-top: 30px; font-size: 16px;">
                    El código expira en <strong>15 minutos</strong>
                </p>
            </div>
        </div>

    </div>

    <script src="/../../../public/js/toast.js"></script>
    <script src="/../../../public/js/login_pass/verify_code.js"></script>
</body>

</html>