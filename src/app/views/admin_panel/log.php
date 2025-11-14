<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- CSS -->
  <link rel="stylesheet" href="/public/css/boostrap_dashboard/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="/public/css/boostrap_dashboard/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="/public/css/boostrap_dashboard/style.css">

  <title>Bootstrap 5 Admin Dashboard</title>
</head>

<body>
  <!-- Navbar -->
  <?php include __DIR__ . '/../components/admin/Navbar.php'; ?>

  <!-- Sidebar -->
  <?php include __DIR__ . '/../components/admin/Sidebar.php'; ?>

  <!-- Main Content -->
  <main class="mt-5 pt-3">
    <div class="container-fluid">

      <h4 class="mb-4">HISTORIAL</h4>

      <div class="row">
  <div class="col-md-12 mb-3">
    <div class="card">
      <div class="card-header">
        <span><i class="bi bi-table me-2"></i></span> Data Table
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="example22" class="table table-striped data-table" style="width: 100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>ACTIVIDAD</th>
                <th>FECHA</th>
              </tr>
            </thead>
            <tbody>
              <th>a</th>
              <th>a</th>
              <th>a</th>
              <th>a</th>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

      
    </div>
  </main>

  <!-- JavaScript -->
  <script src="/public/js/boostrap_dashboard/jquery-3.5.1.js"></script>
  <script src="/public/js/boostrap_dashboard/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
  <script src="/public/js/boostrap_dashboard/jquery.dataTables.min.js"></script>
  <script src="/public/js/boostrap_dashboard/dataTables.bootstrap5.min.js"></script>
  <script src="/public/js/boostrap_dashboard/script.js"></script>

  <script src="/public/js/boostrap_dashboard/admin/sidebar.js"></script>
<script src="/public/js/boostrap_dashboard/admin/log.js"></script>

</body>

</html>