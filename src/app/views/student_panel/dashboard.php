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
  <link rel="stylesheet" href="/public/css/teacher_courses/evaluatins.css">
  <!-- carta azul -->
  <link rel="stylesheet" href="/public/css/card.blue.css">

  <title>Contenido Principal</title>
</head>

<body id="page-top">
  <!-- esto inicia todo el contenido -->
  <div id="wrapper">
    <!-- sidenav -->
    <?php include __DIR__ . '/../components/student/sidenav.php'; ?>
    <?php // viejo include __DIR__ . '/../components/student/sidebar.php'; ?>


    <!-- contenido del contenido -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- inicia el contenido principal -->
      <div id="content">
        <!-- topnav -->
        <?php include __DIR__ . '/../components/student/topnav.php'; ?>
        <?php // viejo include __DIR__ . '/../components/student/navbar.php'; ?>


        <!-- Contenido de la página de inicio -->
        <div class="container-fluid">

          <!-- TITULO -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mt-4 mb-0 text-gray-800">Contenido Principal</h1>
          </div>

          <!-- Fila de contenido -->
          <div class="row">

            <!-- Ejemplo de tarjeta normal -->
            <div class="col-xl-12 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Bienvenido Estudiante</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Este es su contenido principal.</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>



            <!-- Calendario -->
            <div class="col-lg-8 mb-3">
              <div class="card h-100 shadow">
                <div class="card-header d-flex align-items-center">
                  <i class="bi bi-calendar3 me-2"></i>
                  <span>Calendario</span>
                </div>
                <div class="card-body">
                  <div id="calendar"></div> <!-- Tu script de calendario lo controla -->
                </div>
              </div>
            </div>


            <!-- Mensaje Motivacional -->
            <div class="col-xl-4 col-md-6 mb-4"> <!-- Más ancho para combinar con el calendario -->
              <div class="card border-bottom-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">

                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-2">
                        Mensaje motivacional
                      </div>

                      <!-- Frase que se llena desde JS -->
                      <h5 class="font-weight-bold text-gray-800 mb-0" id="frase">
                        <!-- Aquí aparece la frase -->
                      </h5>
                    </div>

                    <!-- Ícono a la derecha -->
                    <div class="col-auto">
                      <i class="fas fa-smile-beam fa-2x text-gray-300"></i>
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
  <script src="/public/js/student/script.calendar.js"></script>
  <script src="/public/js/student/frases.js"></script>
  <script src="/public/js/script.js"></script>
</body>

</html>