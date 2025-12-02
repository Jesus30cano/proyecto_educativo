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

  
  <!-- Fuentes personalizadas para esta plantilla -->
  <link href="/public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
  <!-- Estilos personalizados para esta plantilla-->
  <link href="/public/css/styles.css" rel="stylesheet">
  <!-- Estilos personalizados para esta página -->

  <link href="/public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/public/css/teacher_courses/evaluations.css">
  <!-- carta azul -->
  <link rel="stylesheet" href="/public/css/card.blue.css">

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

          <!-- Tarjetas de Estadísticas -->
          <div class="row">
            <!-- Total Asistencias -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Total Asistencias</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalAsistencias">2040</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Estudiantes Presentes -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Estudiantes Presentes</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="estudiantesPresentes">962</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Profesores Presentes -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        Profesores Presentes</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="profesoresPresentes">23</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Porcentaje de Asistencia -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        % Asistencia</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="porcentajeAsistencia">75%</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-chart-pie fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
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