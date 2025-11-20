<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mis Cursos</title>

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

  <link rel="stylesheet" href="/public/css/teacher_courses/courses.css">
  <!-- carta azul -->
  <link rel="stylesheet" href="/public/css/card.blue.css">
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

          
          <div class="col-xl-12 col-md-6 mb-4">
              <div class="card-header">
                <h4 class="fw-bold mb-1">Mis cursos</h4>
              </div>
          </div>

          <!-- 🔍 BUSCADOR -->
          <div class="mb-4 search-box" style="max-width: 320px;">
            <input type="text" id="buscarCurso" class="form-control" placeholder="Buscar por ficha o nombre...">
          </div>

          <!-- 🟦 CONTENEDOR DE CURSOS -->
          <div id="contenedorCursos">
            <!-- Se insertan las cards por JS -->
          </div>

          <!-- 📌 SIN RESULTADOS -->
          <p id="sinResultados" class="text-center text-muted mt-4 d-none">
            No se encontraron cursos.
          </p>


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
  <script src="/public/js/teacher/course.js"></script>

</body>

</html>