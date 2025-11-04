<?php
// Configuración inicial
$activeTab = $_GET['tab'] ?? 'inicio';
$activeSection = $_GET['section'] ?? 'inicio';

// Datos de estadísticas
$statsData = [
    ['label' => 'Estudiantes', 'number' => 1247, 'color' => '#1E88E5', 'icon' => '👥'],
    ['label' => 'Profesores', 'number' => 87, 'color' => '#90CAF9', 'icon' => '🎓'],
    ['label' => 'Secretarias', 'number' => 12, 'color' => '#37474F', 'icon' => '👤']
];
//esto llama a los script que estan en la carpeta js, dashboard.js
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta charset="UTF-8">
    <title>Panel de Administración - Cognia</title>
    <link rel="stylesheet" href="../../../public/css/dashboard.css">
</head>
<body>
    <div class="container">
        <?php include  __DIR__ . '/../components/navbar.php'; // los componentes de navegacion y cosas asi para ser reutilizadas en cualquier dashboard?>
        <?php include  __DIR__ . '/../components/action-bar.php'; ?>

        <div class="main-wrapper">
            <?php include  __DIR__ . '/../components/admin/sidebar.php'; //algunos componentes estan hechos para el administrador u alguna otra cosa segun el rol. la carpeta de components hay subcawrpetas para diferente rol ?>

            <main class="main-content">
                <div class="welcome-card">
                    <h1 class="title">Bienvenido al Panel de Administración</h1>
                    <p class="subtitle">Gestiona tu institución educativa desde un solo lugar</p>
                </div>

                <?php include __DIR__ . '/../components/admin/stats-grid.php'; ?>

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
