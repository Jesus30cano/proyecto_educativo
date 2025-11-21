<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- archivos del css y diseño -->

  <!-- Fuentes personalizadas para esta plantilla -->
  <link href="/public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
  <!-- Estilos personalizados para esta plantilla-->
  <link href="/public/css/styles.css" rel="stylesheet">
  <!-- Estilos personalizados para esta página -->
  <link href="/public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- carta azul -->
  <link rel="stylesheet" href="/public/css/card.blue.css">
  <title>Evaluaciones</title>
</head>

<body id="page-top">
  <!-- esto inicia todo el contenido -->
  <div id="wrapper">
    <!-- sidenav -->
    <?php include __DIR__ . '/../components/student/sidenav.php'; ?>

    <!-- contenido del contenido -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- inicia el contenido principal -->
      <div id="content">
        <!-- topnav -->
        <?php include __DIR__ . '/../components/student/topnav.php'; ?>

        <!-- Contenido de la página de inicio -->
        <div class="container-fluid">

          <!-- TITULO -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mt-4 mb-0 text-gray-800">Evaluaciones</h1>
          </div>

          <!-- Fila de contenido -->
          <div class="row">
            <!-- Columna principal de evaluaciones -->
            <div class="col-12">

              <!-- Filtro de evaluaciones -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-filter mr-2"></i>Filtrar Evaluaciones
                  </h6>
                </div>
                <div class="card-body">
                  <div class="row align-items-end">
                    <div class="col-md-5 mb-3 mb-md-0">
                      <label for="selectComp" class="font-weight-bold">Por Competencias:</label>
                      <select class="form-control" id="selectCompetencia">
                        <option value="todos" selected>Todos las competencias</option>

                      </select>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                      <label for="selectEstado" class="font-weight-bold">Por Estado:</label>
                      <select class="form-control" id="selectEstado">
                        <option value="todos" selected>Todos</option>
                        
                      </select>
                    </div>
                    <div class="col-md-3">
                      <button class="btn btn-primary btn-block" id="btnBuscarEvaluaciones">
                        <i class="fas fa-search mr-2"></i>Buscar
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Título de sección -->
              <h4 class="mb-3"><i class="fas fa-clipboard-check mr-2"></i>Evaluaciones</h4>
              <hr>

              <!-- Grid de tarjetas de evaluaciones -->
              
              <div class="row" id="contenedor-evaluaciones">
                <div class="col-12">
                  <p class="text-muted mb-0">Cargando evaluaciones...</p>
                </div>
              </div>

              <!-- MODAL -->
              <?php include __DIR__ . '/../components/student/modal.evaluaciones.php'; ?>

            </div>
            <!-- /.container-fluid -->

          </div>
          <!-- End of Main Content -->

          <!-- Footer -->
          <?php include __DIR__ . '/../components/footer.php'; ?>

        </div>
        <!-- End of Content Wrapper -->

      </div>
      <!-- End of Page Wrapper -->



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
      <script src="/public/js/student/script.calendar.js"></script>
      <script src="/public/js/student/frases.js"></script>
      <script src="/public/js/student/Evaluations.js"></script>
</body>

</html>