<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="/public/css/boostrap_dashboard/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="/public/css/boostrap_dashboard/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="/public/css/boostrap_dashboard/style.css">

  <title>Panel del Profesor</title>
</head>
<body>

<?php include __DIR__ . '/../components/teacher/navbar.php'; ?>
<?php include __DIR__ . '/../components/teacher/sidebar.php'; ?>

<main class="mt-5 pt-3">
  <div class="container-fluid">

    <!-- TÍTULO -->
    <div class="row mb-4">
      <h3 class="text-dark">Panel del Profesor</h3>
      <hr>
    </div>

    <!-- CARDS -->
    <div class="row">
      <div class="col-md-6 mb-3">
        <div class="card text-white bg-primary h-100">
          <div class="card-body">
            <h5>Total Cursos</h5>
            <h3 id="totalCursos">0</h3>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <div class="card text-white bg-warning h-100">
          <div class="card-body">
            <h5>Actividades Pendientes</h5>
            <h3 id="totalPendientes">0</h3>
          </div>
        </div>
      </div>
    </div>

    <!-- TABLA CURSOS -->
    <div class="card mb-4">
      <div class="card-header"><i class="bi bi-journal-bookmark"></i> Mis Cursos</div>
      <div class="card-body">
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

    <!-- TABLA ACTIVIDADES PENDIENTES -->
    <div class="card mb-4">
      <div class="card-header"><i class="bi bi-hourglass-split"></i> Actividades Pendientes por Calificar</div>
      <div class="card-body">
        <table id="tablaActividades" class="table table-striped w-100">
          <thead>
            <tr>
              <th>ficha</th>
              <th>Curso</th>
              <th>competencia</th>
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
