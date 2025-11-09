<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title><?= $curso['nombre'] ?> | Curso</title>

  <link rel="stylesheet" href="/public/css/boostrap_dashboard/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="/public/css/boostrap_dashboard/style.css">
  <link rel="stylesheet" href="/public/css/teacher_courses/ver_curso.css">

</head>

<body>

  <?php require_once __DIR__ . "/../../components/teacher/sidebar.php"; ?>
  <?php require_once __DIR__ . "/../../components/teacher/navbar.php"; ?>

  <main class="main-content p-4">

    <div class="container">

      <h2 class="fw-bold mb-4"><?= $curso['nombre'] ?> </h2>
      <p class="text-muted mb-4">Ficha: <?= $curso['ficha'] ?></p>

      <h4 class="fw-bold mb-3">Competencias del Curso</h4>

      <div class="competencias-container">
        <?php foreach ($competencias as $c): ?>
          <div class="competencia-card">
            <h5 class="title"><?= $c['nombre'] ?></h5>
            <p class="desc"><?= $c['descripcion'] ?></p>
            <p class="info"><strong>Actividades:</strong> <?= $c['actividades'] ?></p>

            <div class="d-flex gap-2">
              <a href="/teacher/actividades/competencia/<?= $c['id'] ?>" class="btn btn-outline-primary w-100">Ver Actividades</a>
              <a href="/teacher/actividades/nueva/<?= $c['id'] ?>" class="btn btn-primary w-100">Agregar Actividad</a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    </div>

  </main>

  <script src="/public/js/boostrap_dashboard/bootstrap.bundle.min.js"></script>

</body>
</html>
