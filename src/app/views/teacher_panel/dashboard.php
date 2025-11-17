<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="/public/css/boostrap_dashboard/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="/public/css/boostrap_dashboard/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="/public/css/boostrap_dashboard/style.css">

  <!-- NUEVO CSS -->
  <link rel="stylesheet" href="/public/css/teacher_courses/dashboard.css">

  <title>Panel del Profesor</title>
</head>

<body>

<?php include __DIR__ . '/../components/teacher/navbar.php'; ?>
<?php include __DIR__ . '/../components/teacher/sidebar.php'; ?>

<main class="main-content">
  <div class="container-fluid">

    <!-- 🔵 TÍTULO -->
    <h2 class="titulo-panel">Panel del Profesor</h2>

    <!-- 🔹 CARDS INFORMACIÓN -->
    <div class="row">
      <div class="col-md-6 mb-3">
        <div class="card-custom card-blue p-3">
          <h5>Total Cursos</h5>
          <div class="card-number" id="totalCursos">0</div>
        </div>
      </div>

      <div class="col-md-6 mb-3">
        <div class="card-custom card-yellow p-3">
          <h5>Competencias Activas</h5>
          <div class="card-number" id="totalPendientes">0</div>
        </div>
      </div>
    </div>

    <!-- 🔹 TABLA CURSOS -->
    <div class="card-table mb-4">
      <div class="card-header">
        <i class="bi bi-journal-bookmark"></i> Mis Cursos
      </div>
      <div class="card-body table-responsive">
        <table id="tablaCursos" class="table table-striped w-100">
          <thead>
            <tr>
              <th>Curso</th>
              <th>Ficha</th>
              <th>Competencia</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>

    <!-- 🔹 TABLA ACTIVIDADES -->
    <div class="card-table mb-4">
      <div class="card-header">
        <i class="bi bi-hourglass-split"></i> Actividades Pendientes por Calificar
      </div>
      <div class="card-body table-responsive">
        <table id="tablaActividades" class="table table-striped w-100">
          <thead>
            <tr>
              <th>Ficha</th>
              <th>Curso</th>
              <th>Competencia</th>
              <th>Actividad</th>
              <th>Fecha entrega</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>

  </div>
</main>

<script src="/public/js/boostrap_dashboard/jquery-3.5.1.js"></script>
<script src="/public/js/boostrap_dashboard/jquery.dataTables.min.js"></script>
<script src="/public/js/boostrap_dashboard/dataTables.bootstrap5.min.js"></script>
<script src="/public/js/boostrap_dashboard/bootstrap.bundle.min.js"></script>
<script src="/public/js/boostrap_dashboard/teacher/dashboard.js"></script>

</body>
</html>
