<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
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
  <link rel="stylesheet" href="/public/css/teacher_courses/view_course.css">
  <!-- carta azul -->
  <link rel="stylesheet" href="/public/css/card.blue.css">
  <title>Competencias</title>

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
            <h1 class="h3 mt-4 mb-0 text-gray-800">Competencias</h1>
          </div>

          <!-- 🔵 ENCABEZADO DINÁMICO DEL CURSO -->
          <div id="cursoHeaderEST" class="curso-header mb-5 p-4 shadow-sm rounded">
            <!-- JS inserta nombre y ficha -->
            <h2 class="mb-1 fw-bold">ADSO</h2>
            <p class="text-muted mb-0"><strong>Ficha:</strong> 2618258</p>
          </div>

          <!-- 🟦 TÍTULO -->
          <h4 class="fw-bold mb-3">Competencias del Curso</h4>
          <hr>

          <!-- 🟦 CONTENEDOR DE COMPETENCIAS -->
          <div id="listaCompetenciasEST" class="competencias-container">
            <!-- JS inserta tarjetas -->
            <div class="competencia-card shadow-sm" data-id="1">
              <h5 class="title">Competencia de Comunicación Efectiva</h5>
              <p class="desc">Desarrollo de habilidades para expresar ideas de forma clara y persuasiva en diversos
                contextos profesionales.</p>
              <p class="info"><strong>Actividades:</strong> <span class="contador">12</span></p>
              <div class="btn-group-actions">
                <button class="btn btn-outline-primary btn-ver" data-id="1">Ver Actividades</button>
              </div>
            </div>


          </div>

          <!-- 📌 SIN COMPETENCIAS -->
          <p id="sinCompetenciasEST" class="text-muted text-center mt-4 d-none">
            No hay competencias registradas aún.
          </p>

        </div>


      </div>
      <!-- footer -->
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
</body>
</html>
