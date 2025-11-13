<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- CSS -->
  <link rel="stylesheet" href="/public/css/boostrap_dashboard/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  
  <link rel="stylesheet" href="/public/css/boostrap_dashboard/style.css">
  

  <title>Bootstrap 5 Admin Profile</title>
</head>

<body>
  <!-- Navbar -->
  <?php include __DIR__ . '/../components/admin/Navbar.php'; ?>

  <!-- Sidebar -->
  <?php include __DIR__ . '/../components/admin/Sidebar.php'; ?>

  <!-- Main Content -->
  <main class="mt-5 pt-3">
    <div class="container-fluid">

      <h4 class="mb-4"></h4>
      <!-- Bienvenida al administrador -->
      <div class="row">
        <div class="col-md-12 mb-4">
          <div class="card bg-primary text-white">
            <div class="card-body">
              <h3 class="mb-2"><i class="bi me-2"></i>Perfil Administrador</h3>
            </div>
          </div>
        </div>
      </div>

        <!-- Profile Content -->
      <?php include __DIR__ . '/../components/perfil.php'; ?>
    </div>
  </main>

  <!-- JavaScript -->
  <script src="/public/js/boostrap_dashboard/jquery-3.5.1.js"></script>
  <script src="/public/js/boostrap_dashboard/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
  <script src="/public/js/boostrap_dashboard/jquery.dataTables.min.js"></script>
  <script src="/public/js/boostrap_dashboard/dataTables.bootstrap5.min.js"></script>
  <script src="/public/js/boostrap_dashboard/script.js"></script>
  <script src="/public/js/perfil.js"></script>
  <script src="/public/js/boostrap_dashboard/admin/sidebar.js"></script>

</body>

</html>