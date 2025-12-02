<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

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
  <link rel="stylesheet" href="/public/css/toast.css">
  <!-- carta azul -->
  <link rel="stylesheet" href="/public/css/card.blue.css">
  <title>Competencias</title>
</head>

<body id="page-top">
  <!-- esto inicia todo el contenido -->
  <div id="wrapper">
    <!-- sidenav -->
    <?php include __DIR__ . '/../components/admin/sidenav.php'; ?>


    <!-- contenido del contenido -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- inicia el contenido principal -->
      <div id="content">
        <!-- topnav -->
        <?php include __DIR__ . '/../components/admin/topnav.php'; ?>


        <!-- Contenido de la página de inicio -->
        <div class="container-fluid">

          <!-- TITULO -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h2 mb-0 font-weight-bold text-gray-800">
              <i class="fas fa-award mr-3 text-primary"></i>Gestión de Competencias
            </h1>
          </div>


           <!-- Dashboard Cards -->
           <div class="row">
  <div class="col-md-4 mb-3">
    <div class="card bg-primary text-white h-100">
      <div class="card-body py-5">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <div class="text-xs font-weight-bold text-uppercase mb-1" style="opacity: 0.9;">Total Competencias</div>
            <div class="h3 mb-0 font-weight-bold"><span id="total_competencias"></span></div>
          </div>
          <div class="icon-shape">
            <i class="fas fa-award fa-2x" style="opacity: 0.3;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4 mb-3">
    <div class="card bg-success text-white h-100">
      <div class="card-body py-5">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <div class="text-xs font-weight-bold text-uppercase mb-1" style="opacity: 0.9;">Competencias Activas</div>
            <div class="h3 mb-0 font-weight-bold"><span id="competencias_activas"></span></div>
          </div>
          <div class="icon-shape">
            <i class="fas fa-check-circle fa-2x" style="opacity: 0.3;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4 mb-3">
    <div class="card bg-warning text-dark h-100">
      <div class="card-body py-5">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <div class="text-xs font-weight-bold text-uppercase mb-1" style="opacity: 0.8;">Competencias Inactivas</div>
            <div class="h3 mb-0 font-weight-bold"><span id="competencias_inactivas"></span></div>
          </div>
          <div class="icon-shape">
            <i class="fas fa-times-circle fa-2x" style="opacity: 0.3;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

            <?php include __DIR__ . '/../components/admin/toolbars/toolbar_Competen.php'; ?>
      
            <!-- Data Table -->
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Data Table
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-striped data-table" style="width: 100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>CODIGO</th>
                                <th>NOMBRE</th>
                                <th>DECRIPCION</th>
                                <th>PROFESOR</th>
                                <th>ESTADO</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>


      </div>
      <!-- topnav -->
    <?php include __DIR__ . '/../components/footer.php'; ?>


    </div>
    

  </div>


  </div>
  </div>

  <!-- scroll -->
  <?php include __DIR__ . '/../components/scroll.topnav.php'; ?>


  <!-- apartado de script, BOOSTRAP -->
  <!-- Bootstrap core JavaScript-->
  <script src="/public/vendor/jquery/jquery.min.js"></script>
  <script src="/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/public/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/public/js/styles/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="/public/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="/public/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="/public/js/styles/demo/datatables-demo.js"></script>

  <!-- script de funcionalidad -->
  <script src="/public/js/script.js"></script>
  <script src="/public/js/admin/competencia.js"></script>
  <script src="/public/js/toast.js"></script>


</body>
</html>