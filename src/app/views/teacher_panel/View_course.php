<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Curso | Ver</title>

  <link rel="stylesheet" href="/public/css/boostrap_dashboard/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="/public/css/boostrap_dashboard/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="/public/css/boostrap_dashboard/style.css">
  <link rel="stylesheet" href="/public/css/teacher_courses/view_course.css">
</head>

<body>

  <?php require_once __DIR__ . "/../components/teacher/sidebar.php"; ?>
  <?php require_once __DIR__ . "/../components/teacher/navbar.php"; ?>

  <main class="main-content p-4">

    <div class="container">

      <div id="cursoHeader" class="curso-header mb-5 p-4 shadow-sm rounded">
        <!-- JS inserta nombre y ficha -->
      </div>

      <h4 class="fw-bold mb-3">Competencias del Curso</h4>

      <div id="listaCompetencias" class="competencias-container">
        <!-- JS inserta tarjetas -->
      </div>

      <p id="sinCompetencias" class="text-muted text-center mt-4 d-none">
        No hay competencias registradas aún.
      </p>

    </div>

  </main>

  <script src="/public/js/boostrap_dashboard/bootstrap.bundle.min.js"></script>

  <script>
    const cursoData = <?= json_encode($curso) ?>;
    const competenciasData = <?= json_encode($competencias) ?>;
  </script>

  <script src="/public/js/teacher/view_course.js"></script>
</body>

</html>