<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Fuentes personalizadas -->
  <link href="/public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

  <!-- Estilos -->
  <link href="/public/css/styles2.css" rel="stylesheet">
  <link href="/public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/public/css/teacher_courses/evaluations.css">

  <title>Asistencias</title>
</head>

<body id="page-top">

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include __DIR__ . '/../components/admin/sidenav.php'; ?>

    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">

        <!-- Topbar -->
        <?php include __DIR__ . '/../components/admin/topnav.php'; ?>

        <div class="container-fluid">

          <!-- Título -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Asistencias</h1>
          </div>

        </div>

      </div>

      <!-- FILA DE GRÁFICAS -->
      <div class="row justify-content-center">

        <div class="col-xl-8 col-lg-10 col-md-12 mb-4">
          <?php include __DIR__ . '/../components/admin/charts/chart_estu.php'; ?>
        </div>

        <div class="col-xl-8 col-lg-10 col-md-12 mb-4">
          <?php include __DIR__ . '/../components/admin/charts/chart_pro.php'; ?>
        </div>

      </div>


      <!-- Footer -->
      <?php include __DIR__ . '/../components/footer.php'; ?>

    </div>

  </div>

  <!-- Scroll to top -->
  <?php include __DIR__ . '/../components/scroll.topnav.php'; ?>


  <!-- ===================================================== -->
  <!-- LIBRERÍAS NECESARIAS -->
  <!-- ===================================================== -->

  <!-- jQuery -->
  <script src="/public/vendor/jquery/jquery.min.js"></script>

  <!-- Bootstrap -->
  <script src="/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Easing -->
  <script src="/public/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- SB Admin scripts -->
  <script src="/public/js/styles/sb-admin-2.min.js"></script>

  <!-- Datatables -->
  <script src="/public/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="/public/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="/public/js/styles/demo/datatables-demo.js"></script>

  <!-- NAVIGATION SCRIPTS -->
  <script src="/public/js/navigation.js"></script>
  <script src="/public/js/admin/modal.js"></script>

  <!-- ===================================================== -->
  <!-- APEXCHARTS (DEBE IR ANTES DE TUS GRÁFICOS) -->
  <!-- ===================================================== -->
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

  <!-- ===================================================== -->
  <!-- ARCHIVOS JS DE LOS GRÁFICOS -->
  <!-- ===================================================== -->
  <script src="/public/js/admin/charts/chart_estu.js"></script>
  <script src="/public/js/admin/charts/charts_pro.js"></script>

</body>

</html>