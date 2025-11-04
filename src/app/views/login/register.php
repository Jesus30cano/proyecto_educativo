


<?php 
//Pensaba que se debia hacer un registro para el login.
//pueden saltarse esto, borrarlo o dejarlo alli.
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../../../public/css/login_styles/login_styles.css">
</head>

<body>

    <div class="container-all">

        <div class="ctn-form">
            <h1 class="tittle">Plataforma Educativa</h1>
            <h2 class="subtitle">Crea tu Cuenta</h2>

            <form action="#" method="POST">

                <div class="input-group">
                    <label for="name">Nombre Completo</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="input-group">
                    <label for="tipo_documento">Tipo de Documento</label>
                    <select name="tipo_documento" id="tipo_documento" class="tipo_documento" required>
                        <option value="" disabled selected>Selecciona una opción</option>
                        <option value="cedula_de_ciudadania">Cedula de Ciudadania</option>
                        <option value="tarjeta_identidad">Tarjeta de Identidad</option>
                        <option value="cedula_extranjeria">Cedula de Extranjeria</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="document">Documento</label>
                    <input type="text" id="document" name="document" required>

                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="input-group">
                    <label for="password">Contraseña (Mín. 8 caracteres)</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="input-group">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>

                <button type="submit" class="btn-login">
                    REGISTRARSE
                </button>
            </form>

            <p class="text-footer">
                ¿Ya tienes cuenta?
                <a href="login.php"> Inicia Sesión aquí</a>
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
</body>
</html>