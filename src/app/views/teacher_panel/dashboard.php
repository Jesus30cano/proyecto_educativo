<?php
// Configuración inicial
$activeTab = $_GET['tab'] ?? 'inicio';
$activeSection = $_GET['section'] ?? 'inicio';
//esto llama a los script que estan en la carpeta js, dashboard.js
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta charset="UTF-8">
    <title>Panel de Administración - Cognia</title>
    <link rel="stylesheet" href="/../../../public/css/dashboard.css">
</head>
<body>
    <div class="container">
        <?php include __DIR__ . '/../components/navbar.php'; ?>
        <?php include __DIR__ . '/../components/action-bar.php'; ?>

        <div class="main-wrapper">
            <?php include __DIR__ . '/../components/teacher/sidebar.php'; ?>

            <main class="main-content">
                <div class="welcome-card">
                    <h1 class="title">Bienvenido al Panel del Profesor</h1>
                    <p class="subtitle">Vista previa del panel</p>
                </div>

                <div class="welcome-card">
                    <h2 class="title">Sección: <?= ucfirst($activeSection) ?></h2>
                    <p class="subtitle">
                        Tab activa: <strong><?= ucfirst($activeTab) ?></strong>
                    </p>
                    <p class="subtitle">
                        Aquí se mostrará el contenido.
                    </p>
                </div>
            </main>
        </div>
    </div>

    <script src="./../../public/js/Dashboard/dashboard.js"></script>
</body>
</html>
