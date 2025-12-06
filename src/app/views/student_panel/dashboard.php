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

  <title>Contenido Principal</title>
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
            <h1 class="h2 mt-4 mb-0 font-weight-bold text-gray-800">
              <i class="fas fa-tachometer-alt mr-3 text-primary"></i>Panel Estudiante
            </h1>
          </div>

          <!-- Banner de Bienvenida -->
          <div class="row mb-4">
            <div class="col-12">
              <div class="card border-left-primary shadow py-3" style="background: #ffffff;">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-md-8">
                      <h3 class="font-weight-bold mb-2" style="color: #4e73df;">
                        <i class="fas fa-user-graduate mr-2" style="color: #4e73df;"></i>¡Bienvenido de nuevo,
                       Estudiante!
                      </h3>
                      <p class="text-muted mb-0">
                        <i class="fas fa-info-circle mr-2"></i>Aquí podrás ver tus curso principal, actividades
                        pendientes y examenes pendientes
                      </p>
                    </div>
                    <div class="col-md-4 text-right d-none d-md-block">
                      <i class="fas fa-graduation-cap fa-5x" style="color: #4e73df; opacity: 0.3;"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Tarjetas de Estadísticas -->
          <div class="row mb-1">

          <!-- Nombre del estudiante -->
            <div class="col-xl-6 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        Estudiante
                      </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        Keiner Cardenas <!-- Aquí irá el nombre real -->
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Curso + ficha -->
            <div class="col-xl-6 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Curso Principal
                      </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        ADSO - Ficha 2568991
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book-open fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- Fila de contenido principal -->
          <div class="row">

            <!-- Actividades Pendientes -->
            <div class="col-md-6 mb-4">
              <div class="card bg-warning text-white h-100">
                <div class="card-body py-4">
                  <div class="d-flex align-items-center justify-content-between">
                    <div>
                      <div class="text-xs font-weight-bold text-uppercase mb-1" style="opacity: 0.9;">
                        Actividades Pendientes
                      </div>
                      <div class="h3 mb-0 font-weight-bold"><span>3</span></div>
                    </div>
                    <div class="icon-shape">
                      <i class="fas fa-tasks fa-2x" style="opacity: 0.3;"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Actividades Pendientes -->
            <div class="col-md-6 mb-4">
              <div class="card bg-primary text-white h-100">
                <div class="card-body py-4">
                  <div class="d-flex align-items-center justify-content-between">
                    <div>
                      <div class="text-xs font-weight-bold text-uppercase mb-1" style="opacity: 0.9;">
                        Examenes Pendientes
                      </div>
                      <div class="h3 mb-0 font-weight-bold"><span>3</span></div>
                    </div>
                    <div class="icon-shape">
                      <i class="fas fa-tasks fa-2x" style="opacity: 0.3;"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Fila Calendario + Mensaje motivacional -->
            <!-- Calendario -->
            <div class="col-lg-8 mb-3">
              <div class="card h-100 shadow">
                <div class="card-header blue-claro d-flex align-items-center">
                  <i class="fas fa-calendar-alt mr-2 text-primary"></i>
                  <span>Calendario</span>
                </div>
                <div class="card-body">
                  <div id="calendar"></div>
                </div>
              </div>
            </div>

            <!-- Mensaje motivacional -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">

                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-2">
                        Mensaje Motivacional
                      </div>

                      <h5 class="font-weight-bold text-gray-800 mb-0" id="frase">
                        <!-- Tu frase JS aparecerá aquí -->
                      </h5>
                    </div>

                    <div class="col-auto">
                      <i class="fas fa-smile-beam fa-2x text-gray-300"></i>
                    </div>

                  </div>
                </div>
                <div class="card-footer text-center bg-light">
                  <small class="text-muted">
                    <i class="far fa-calendar-alt mr-1"></i>
                    ¡Sigue adelante, cada día es una nueva oportunidad!
                  </small>
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
  <script src="/public/js/student/script.calendar.js"></script>
  <script src="/public/js/student/frases.js"></script>
  <script src="/public/js/script.js"></script>
</body>

</html>