<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
  <!-- CSS -->
  <link rel="stylesheet" href="/../../../public/css/boostrap_dashboard/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="/../../../public/css/boostrap_dashboard/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="/../../../public/css/boostrap_dashboard/style.css" />
  <title>Gestión de Profesores</title>
</head>
<body>
  <!-- Navbar -->
  <?php include __DIR__ . '/../components/admin/Navbar.php'; ?>

  <!-- Sidebar -->
  <?php include __DIR__ . '/../components/admin/Sidebar.php'; ?>

  <!-- Main Content -->
  <main class="mt-5 pt-3">
    <div class="container-fluid">
      <h4 class="mb-4">PROFESOR</h4>

      <!-- Toolbar con botón Crear Usuario -->
      <?php include __DIR__ .'/../components/admin/toolbar.php'; ?>


    </div>
  </main>


  <!-- JavaScript -->
    <script src="./../../public/js/boostrap_dashboard/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./../../public/js/boostrap_dashboard/jquery-3.5.1.js"></script>
    <script src="./../../public/js/boostrap_dashboard/jquery.dataTables.min.js"></script>
    <script src="./../../public/js/boostrap_dashboard/dataTables.bootstrap5.min.js"></script>
    <script src="./../../public/js/boostrap_dashboard/navigation.js"></script>
    <script src="./../../public/js/boostrap_dashboard/admin/modal.js"></script>
    
</body>
</html>