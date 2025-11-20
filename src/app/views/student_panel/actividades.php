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
  <title>Actividades</title>
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
            <h1 class="h3 mt-4 mb-0 text-gray-800">Actividades</h1>
          </div>

            <div class="col-xl-12 col-md-6 mb-4">
              <div class="card-header">
                <h4 class="fw-bold mb-1">Apartado de Actividades</h4>
              </div>
            </div>

          <!-- fila de contenido-->
          <div class="row">

            <!-- Columna principal de actividades -->
            <div class="col-12">

              <!-- Filtro de competencias -->
              <div class="card mb-4">
                <div class="card-header bg-light">
                  <h6 class="m-0 font-weight-bold text-white">Filtro de actividades</h6>
                </div>
                <div class="card-body">
                  <div class="row align-items-end">
                    <div class="col-md-8 mb-3 mb-md-0">
                      <label for="selectCompetencia" class="font-weight-bold">Selecciona una competencia:</label>
                      <select class="form-control" id="selectCompetencia">
                        <option value="todas" selected>Todas las Competencias</option>
                        <option value="desarrollo-software">Desarrollo de Software Seguro</option>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <button class="btn btn-primary w-100">
                        <i class="bi bi-search me-2"></i>Buscar
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Título de sección -->
              <h4 class="mb-3"><i class="bi bi-list-task me-2"></i>Mis Actividades Asignadas</h4>
              <hr>

              <!-- Grid de tarjetas de actividades -->
              <div class="row">

                <!-- Actividad 1 - PENDIENTE -->
                <div class="col-md-6 mb-3">
                  <div class="card h-100 border-warning shadow-sm">
                    <div class="card-header bg-warning text-white">
                      <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Diseño de Diagramas UML</h6>
                        <span class="badge bg-light text-dark">
                          <i class="bi bi-exclamation-circle"></i> Pendiente
                        </span>
                      </div>
                    </div>
                    <div class="card-body">
                      <p class="text-muted mb-2"><small><i class="bi bi-bookmark me-1"></i>Desarrollo de
                          Software Seguro</small></p>
                      <p class="card-text small">Desarrollar un software seguro aplicando patrones de
                        diseño...</p>
                      <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="text-danger"><i class="bi bi-calendar-x me-1"></i><small>Vence: 15
                            Nov 2025</small></span>
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalActividad1">
                          <i class="bi bi-eye me-1"></i>Ver Detalles
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Actividad 2 - ENTREGADA -->
                <div class="col-md-6 mb-3">
                  <div class="card h-100 border-success shadow-sm">
                    <div class="card-header bg-success text-white">
                      <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Informe de Penetración</h6>
                        <span class="badge bg-light text-success">
                          <i class="bi bi-check-circle"></i> Entregada
                        </span>
                      </div>
                    </div>
                    <div class="card-body">
                      <p class="text-muted mb-2"><small><i class="bi bi-bookmark me-1"></i>Seguridad
                          Informática Avanzada</small></p>
                      <p class="card-text small">Crear un informe detallado sobre penetración de
                        sistemas...</p>
                      <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="text-success"><i class="bi bi-star-fill me-1"></i><small>Nota:
                            4.8/5.0</small></span>
                        <button class="btn btn-sm btn-outline-success" data-toggle="modal"
                          data-target="#modalActividad2">
                          <i class="bi bi-eye me-1"></i>Ver Detalles
                        </button>
                      </div>
                    </div>
                  </div>
                </div>


                <!-- AQUI SIGUEN LAS DEMAS CARTAS DE ACTIVIDADES -->
              </div> <!-- FIN GRID ACTIVIDADES -->

            </div>

          </div> <!-- FIN ROW -->

        </div> <!-- FIN CONTAINER-FLUID -->

      </div> <!-- FIN CONTENT -->

    </div> <!-- FIN CONTENT-WRAPPER -->

  </div> <!-- FIN WRAPPER -->


  <!-- ========================================= -->
  <!-- MODALES (siempre al final del body) -->
  <!-- ========================================= -->
  <?php include __DIR__ . '/../components/student/modal.actividades.php'; ?>




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
  <script src="/public/js/student/script.calendar.js"></script>
  <script src="/public/js/student/frases.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
</body>

</html>