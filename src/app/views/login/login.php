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

    <div class="container-all">

        <div class="ctn-form">
            <h1 class="tittle">Plataforma Educativa</h1>
            <h2 class="subtitle">Inicia Sesión</h2>

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
                Bienvenido a la plataforma
            </p>
        </div>

        <div class="panel-info">
            <div class="capa"></div>
            <h2 class="tittle-description">¡Bienvenido a la Plataforma!</h2>
            <p class="text-description">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus vel ab fugit ipsam corrupti dolores
                architecto, id illum dolorum asperiores sed?
            </p>
        </div>

    </div>
    <script src="/../../../public/js/toast.js"></script>

    <script src="/../../../public/js/login.js"></script>
</body>

</html>
