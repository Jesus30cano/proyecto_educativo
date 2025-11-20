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
  <link href="/public/css/styles2.css" rel="stylesheet">
  <!-- Estilos personalizados para esta página -->
  <link href="/public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/public/css/teacher_courses/evaluations.css">


  <title>Calificaciones</title>
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
            <h1 class="h3 mb-0 text-gray-800">Calificaciones</h1>
          </div>

          <!-- FILA SUPERIOR: Gráfico y Resumen -->
          <div class="row">

            <!-- COLUMNA IZQUIERDA: Lista de competencias con scroll -->
            <div class="col-xl-7 col-lg-7 mb-4">
              <div class="card shadow h-100">
                <div class="card-header py-3 bg-success">
                  <h6 class="m-0 font-weight-bold text-white">Lista de aprobación de competencias</h6>
                </div>
                <div class="card-body" style="max-height: 500px; overflow-y: auto;">

                  <div class="card-body" style="max-height: 500px; overflow-y: auto;">

                    <!-- AQUÍ SE RENDERIZARÁN LAS COMPETENCIAS DESDE JS -->
                    <div id="lista-competencias">
                      <!-- Opcional: Puedes dejar un loader o mensaje inicial -->
                      <p class="text-muted">Cargando competencias...</p>
                    </div>

                  </div>


                  <!-- Más competencias aquí -->
                </div>
              </div>
            </div>

            <!-- COLUMNA DERECHA: RESUMEN ACADÉMICO -->
            <div class="col-xl-5 col-lg-5 mb-4">
              <div class="h-100">
                <div class="card-body">

                  <!-- Aprobadas -->
                  <div class="card border-left-success shadow mb-3">
                    <div class="card-body py-3">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            <i class="fas fa-check-circle mr-1"></i>Aprobadas
                          </div>
                          <div class="h3 mb-0 font-weight-bold text-gray-800" id="count-aprobadas">0</div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- No Aprobadas -->
                  <div class="card border-left-danger shadow mb-3">
                    <div class="card-body py-3">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            <i class="fas fa-times-circle mr-1"></i>No Aprobadas
                          </div>
                          <div class="h3 mb-0 font-weight-bold text-gray-800" id="count-no-aprobadas">0</div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Pendientes -->
                  <div class="card border-left-warning shadow">
                    <div class="card-body py-3">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            <i class="fas fa-clock mr-1"></i>Pendientes
                          </div>
                          <div class="h3 mb-0 font-weight-bold text-gray-800" id="count-pendientes">0</div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-hourglass-half fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>


            <!-- Filtro de Competencias -->
            <div class="row">
              <div class="col-xl-12 mb-4">
                <div class="card shadow">
                  <div class="card-header py-3 bg-primary">
                    <h6 class="m-0 font-weight-bold text-white">
                      <i class="fas fa-filter mr-2"></i>
                      Filtrar Calificaciones por Competencia
                    </h6>
                  </div>
                  <div class="card-body">
                    <div class="row align-items-end">
                      <div class="col-md-8 mb-3 mb-md-0">
                        <label for="selectCompetencia" class="font-weight-bold text-gray-700">
                          Selecciona una competencia:
                        </label>
                        <select class="form-control form-control-lg" id="selectCompetencia">
                          <option value="todas" selected>Todas las Competencias</option>
                          <option value="matematicas">Matemáticas</option>
                          <option value="programacion">Programación</option>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <button class="btn btn-primary btn-block">
                          <i class="fas fa-search mr-2"></i>Aplicar Filtro
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- DataTales Example Adaptado -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                  <i class="fas fa-table mr-2"></i>
                  Calificaciones
                </h6>
              </div>

              <div class="card-body">
                <div class="table-responsive">

                  <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Profesor</th>
                        <th>Competencia</th>
                        <th>Evaluación</th>
                        <th>Fecha Evaluación</th>
                        <th>Nota de Calificación</th>
                        <th>Observación</th>
                      </tr>
                    </thead>

                    <tbody id = "tbody-calificaciones">
                      
                    </tbody>
                  </table>

                </div>
              </div>
            </div>


          </div>
          <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- topnav -->
        <?php include __DIR__ . '/../components/footer.php'; ?>

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- scroll -->
    <?php include __DIR__ . '/../components/scroll.topnav.php'; ?>




    <!-- Bootstrap core JavaScript-->
    <script src="/public/vendor/jquery/jquery.min.js"></script>
    <script src="/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/public/js/styles/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/public/vendor/chart.js/Chart.min.js"></script>
    <script src="/public/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/public/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/public/js/styles/demo/datatables-demo.js"></script>

    <!-- script de funcionalidad -->
     <script src="/public/js/student/qualifications.js"></script>
</body>

</html>