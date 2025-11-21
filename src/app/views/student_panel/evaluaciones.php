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
                      <select class="form-control" id="selectCompetenia">
                        <option value="todos" selected>Todos las competencias</option>
                        <option value="matematicas">Matemáticas Avanzadas</option>
                      </select>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                      <label for="selectEstado" class="font-weight-bold">Por Estado:</label>
                      <select class="form-control" id="selectEstado">
                        <option value="todos" selected>Todos</option>
                        <option value="disponibles">Disponibles</option>
                        <option value="inactivas">Inactivas</option>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <button class="btn blue-claro text-white btn-block">
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
              <div class="row">

                <!-- Evaluación 1 - DISPONIBLE -->
                <div class="col-md-6 mb-4">
                  <div class="card shadow h-100">
                    <div class="card-header py-3 bg-primary text-white">
                      <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 font-weight-bold">Evaluación de Matemáticas</h6>
                        <span class="badge badge-success">
                          <i class="fas fa-check-circle"></i> Disponible
                        </span>
                      </div>
                    </div>
                    <div class="card-body">
                      <p class="text-muted mb-2">
                        <small><i class="fas fa-bookmark mr-1"></i>Cálculo Diferencial</small>
                      </p>
                      <p class="card-text small">Evaluación sobre derivadas, límites y continuidad de funciones.</p>
                      <div class="d-flex justify-content-between align-items-center mt-3">
                        <button class="btn btn-sm blue-claro text-white" data-toggle="modal" data-target="#modalEvaluacion1">
                          <i class="fas fa-eye mr-1"></i>Detalles
                        </button>
                      </div>
                      <p class="text-muted mb-0 mt-2">
                        <small><i class="far fa-calendar-alt mr-1"></i>Fecha límite: 10 Nov 2024</small>
                      </p>
                    </div>
                  </div>
                </div>

                <!-- Evaluación 2 - cuando esta INACTIVA -->
                <div class="col-md-6 mb-4">
                  <div class="card shadow h-100">
                    <div class="card-header py-3 bg-secondary text-white">
                      <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 font-weight-bold">Evaluación de Física</h6>
                        <span class="badge badge-danger">
                          <i class="fas fa-times-circle"></i> Inactiva
                        </span>
                      </div>
                    </div>
                    <div class="card-body">
                      <p class="text-muted mb-2">
                        <small><i class="fas fa-bookmark mr-1"></i>Cinemática</small>
                      </p>
                      <p class="card-text small">Evaluación sobre movimiento rectilíneo, velocidad y aceleración.</p>
                      <div class="d-flex justify-content-between align-items-center mt-3">
                        <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modalEvaluacion2">
                          <i class="fas fa-eye mr-1"></i>Detalles
                        </button>
                      </div>
                      <p class="text-muted mb-0 mt-2">
                        <small><i class="far fa-calendar-times mr-1"></i>Fecha límite: 08 Nov 2024</small>
                      </p>
                    </div>
                  </div>
                </div>

                <!-- Evaluación 3 - FINALIZADA -->
                <div class="col-md-6 mb-4">
                  <div class="card shadow h-100">
                    <div class="card-header py-3 bg-success text-white">
                      <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 font-weight-bold">Evaluación de Redes</h6>
                        <span class="badge badge-light text-success">
                          <i class="fas fa-check-circle"></i> Finalizada
                        </span>
                      </div>
                    </div>
                    <div class="card-body">
                      <p class="text-muted mb-2">
                        <small><i class="fas fa-bookmark mr-1"></i>Protocolos TCP/IP</small>
                      </p>
                      <p class="card-text small">Evaluación sobre arquitectura de redes y modelos OSI.</p>
                      <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                          <span class="badge badge-success">
                            <i class="fas fa-star"></i> APROBADO
                          </span>
                        </div>
                      </div>
                      <p class="text-muted mb-0 mt-2">
                        <small><i class="far fa-calendar-check mr-1"></i>Fecha límite: 05 Nov 2024</small>
                      </p>
                    </div>
                  </div>
                </div>

                <!-- Las demas cartas de las evaluaciones seguiran aqui -->

              </div>
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
</body>
</html>