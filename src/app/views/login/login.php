<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../../../public/css/login_styles/login_styles.css"> <?php //Css que esta en public en la carpeta css ?>
</head>
<body>

    <div class="container-all">

        <div class="ctn-form">
            <h1 class="tittle">Plataforma Educativa</h1>
            <h2 class="subtitle">Inicia Sesión</h2>

            <form action="#" method="POST"> <?php//Metodos?>

                <div class="input-group">
                    <label for="document">Documento</label>
                    <input type="text" name="document" required>
                </div>

                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" required>
                </div>

                <button type="submit" class="btn-login">
                    ACCEDER
                </button>
            </form>

            <p class="text-footer">
                Bienvenido a la plataforma
               <?php//aqui estaba el link (ahref) para que lo llevara al registro?>
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