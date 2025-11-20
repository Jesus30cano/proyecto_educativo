<!DOCTYPE html>
<html lang="es">

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
  <link rel="stylesheet" href="/public/css/teacher_courses/dashboard.css">
   <link rel="stylesheet" href="/public/css/teacher_courses/evaluations.css">
  <!-- carta azul -->
  <link rel="stylesheet" href="/public/css/card.blue.css">

  <title>Contenido Principal</title>
</head>

<body id="page-top">
  <!-- esto inicia todo el contenido -->
  <div id="wrapper">
    <!-- sidenav -->
    <?php include __DIR__ . '/../components/teacher/sidenav.php'; ?>


    <!-- contenido del contenido -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- inicia el contenido principal -->
      <div id="content">
        <!-- topnav -->
        <?php include __DIR__ . '/../components/teacher/topnav.php'; ?>


        <!-- Contenido de la página de inicio -->
        <div class="container-fluid">

          

          <!-- Ejemplo de tarjeta normal -->
            <div class="col-xl-12 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Bienvenido Docente</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Este es su contenido principal.</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          <!-- 🔹 CARDS INFORMACIÓN -->
          <div class="row">
            <div class="col-md-6 mb-3">
              <div class="card-custom card-blue p-3">
                <h5>Total Cursos</h5>
                <div class="card-number" id="totalCursos">0</div>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <div class="card-custom card-yellow p-3">
                <h5>Competencias Activas</h5>
                <div class="card-number" id="totalPendientes">0</div>
              </div>
            </div>
          </div>

          <!-- 🔹 TABLA CURSOS -->
          <div class="card-table mb-4">
            <div class="card-header">
              <i class="bi bi-journal-bookmark"></i> Mis Cursos
            </div>
            <div class="card-body table-responsive">
              <table id="tablaCursos" class="table table-striped w-100">
                <thead>
                  <tr>
                    <th>Curso</th>
                    <th>Ficha</th>
                    <th>Competencia</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>

          <!-- 🔹 TABLA ACTIVIDADES -->
          <div class="card-table mb-4">
            <div class="card-header">
              <i class="bi bi-hourglass-split"></i> Actividades Pendientes por Calificar
            </div>
            <div class="card-body table-responsive">
              <table id="tablaActividades" class="table table-striped w-100">
                <thead>
                  <tr>
                    <th>Ficha</th>
                    <th>Curso</th>
                    <th>Competencia</th>
                    <th>Actividad</th>
                    <th>Fecha entrega</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>



          
        </div>

      </div>
      <!-- footer -->
      <?php include __DIR__ . '/../components/footer.php'; ?>

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
  <script src="/public/js/teacher/dashboard.js"></script>

</body>
</html>