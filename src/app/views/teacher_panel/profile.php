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

    <!-- Bienvenida al profesor -->
      <div class="row">
        <div class="col-md-12 mb-4">
          <div class="card bg-primary text-white">
            <div class="card-body">
              <h3 class="mb-2"><i class="bi me-2"></i>Perfil Profesor</h3>
            </div>
          </div>
        </div>
      </div>

        <!-- Profile Content -->
      <?php include __DIR__ . '/../components/perfil.php'; ?>

  </div>
</main>


<script src="/public/js/boostrap_dashboard/jquery-3.5.1.js"></script>
<script src="/public/js/boostrap_dashboard/jquery.dataTables.min.js"></script>
<script src="/public/js/boostrap_dashboard/dataTables.bootstrap5.min.js"></script>
<script src="/public/js/boostrap_dashboard/bootstrap.bundle.min.js"></script>

<script src="/public/js/perfil.js"></script>

</body>
</html>
