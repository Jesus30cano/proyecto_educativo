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

  <!-- Modal para Crear Actividad -->
  <div class="modal fade" id="modalCrearActividad" tabindex="-1" aria-labelledby="modalCrearActividadLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form id="formCrearActividad" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCrearActividadLabel">Crear Nueva Actividad</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="titulo" class="form-label">Título</label>
              <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
              <label for="descripcion" class="form-label">Descripción</label>
              <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
            </div>
            <div class="mb-3">
              <label for="fecha_entrega" class="form-label">Fecha de entrega</label>
              <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" required>
            </div>
            <div class="mb-3">
              <label for="archivo" class="form-label">Archivo (opcional)</label>
              <input type="file" class="form-control" id="archivo" name="archivo">
            </div>
            <!-- Campos ocultos -->
            <input type="hidden" name="curso" id="cursoHidden">
            <input type="hidden" name="competencia" id="competenciaHidden">
            <input type="hidden" name="profesor" id="profesorHidden" value="<?= $_SESSION['user_id'] ?? '' ?>">
            <div id="mensajeModal" class="mt-2"></div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Guardar Actividad</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="/public/js/boostrap_dashboard/jquery-3.5.1.js"></script>
  <script src="/public/js/boostrap_dashboard/jquery.dataTables.min.js"></script>
  <script src="/public/js/boostrap_dashboard/dataTables.bootstrap5.min.js"></script>
  <script src="/public/js/boostrap_dashboard/bootstrap.bundle.min.js"></script>
  <script>
    const cursoData = <?= json_encode($curso) ?>;
    const competenciasData = <?= json_encode($competencias) ?>;
  </script>
  <script src="/public/js/teacher/view_course.js"></script>
</body>

</html>