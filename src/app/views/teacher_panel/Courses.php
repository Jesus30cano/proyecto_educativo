<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mis Cursos | Panel Profesor</title>

    <link rel="stylesheet" href="/public/css/boostrap_dashboard/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="/public/css/boostrap_dashboard/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/public/css/boostrap_dashboard/style.css">
    <link rel="stylesheet" href="/public/css/teacher_courses/courses.css">

</head>

<body>

    <?php require_once __DIR__ . "/../components/teacher/sidebar.php"; ?>
    <?php require_once __DIR__ . "/../components/teacher/navbar.php"; ?>

    <main class="main-content p-4">
        <div class="container">

            <!-- 🔵 TÍTULO PRINCIPAL -->
            <h2 class="fw-bold mb-4 titulo-panel">Mis Cursos</h2>

            <!-- 🔍 BUSCADOR -->
            <div class="mb-4 search-box" style="max-width: 320px;">
                <input type="text" id="buscarCurso" class="form-control" placeholder="Buscar por ficha o nombre...">
            </div>

            <!-- 🟦 CONTENEDOR DE CURSOS -->
            <div id="contenedorCursos">
                <!-- Se insertan las cards por JS -->
            </div>

            <!-- 📌 SIN RESULTADOS -->
            <p id="sinResultados" class="text-center text-muted mt-4 d-none">
                No se encontraron cursos.
            </p>

        </div>
    </main>

    <!-- JS -->
    <script src="/public/js/boostrap_dashboard/jquery-3.5.1.js"></script>
    <script src="/public/js/boostrap_dashboard/jquery.dataTables.min.js"></script>
    <script src="/public/js/boostrap_dashboard/dataTables.bootstrap5.min.js"></script>
    <script src="/public/js/boostrap_dashboard/bootstrap.bundle.min.js"></script>
    
    <script src="/public/js/teacher/course.js"></script>

</body>

</html>