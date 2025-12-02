<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../../../public/css/toast.css">
    <link rel="stylesheet" href="../../../public/css/login_styles/login_styles.css">


</head>

<body>
    <!-- Botón para volver al home -->
    <a href="/" class="btn-home" title="Volver al inicio">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
            <polyline points="9 22 9 12 15 12 15 22"></polyline>
        </svg>
        <span>Inicio</span>
    </a>

    <div class="container-all">

        <div class="ctn-form">
            <h1 class="tittle">Plataforma Educativa</h1>
            <h2 class="subtitle"></h2>

            <form id="loginForm">
                <!-- 🔽 Tipo de documento -->
                <div class="input-group" id="tipo_documento_group">
                    <label for="tipo_documento">Tipo de Documento</label>
                    <select name="tipo_documento" id="tipo_documento" required>
                        <option value="">Selecciona tu tipo de documento</option>
                        <option value="cedula_de_ciudadania">Cédula de Ciudadanía</option>
                        <option value="tarjeta_identidad">Tarjeta de Identidad</option>
                        <option value="cedula_extranjeria">Cédula de Extranjería</option>
                    </select>
                </div>

                <!-- 🔽 Documento -->
                <div class="input-group">
                    <label for="document">Documento</label>
                    <input type="text" name="document" id="document" required>
                </div>

                <!-- 🔽 Contraseña -->
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" required>
                </div>

                <button type="submit" class="btn-login">
                    ACCEDER
                </button>
            </form>
            <p class="text-footer">
                <a href="/auth/vista_forgot_password">¿Olvidaste tu contraseña?</a>
            </p>

           
        </div>

        <div class="panel-info">
            
            
        </div>

    </div>
    <script src="/../../../public/js/toast.js"></script>

    <script src="/../../../public/js/login.js"></script>
</body>

</html>
