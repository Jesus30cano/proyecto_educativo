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
  <link rel="stylesheet" href="/public/css/teacher_courses/courses.css">
  <title>Perfil</title>
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
            <h1 class="h3 mt-4 mb-0 text-gray-800"><i class="fas fa-award mr-2 text-warning"></i>Mis Competencias</h1>
          </div>

          <!-- 🔍 BUSCADOR -->
          <div class="mb-4 search-box" style="max-width: 420px;">
            <input type="text" id="buscarCursoEST" class="form-control" placeholder="Buscar por código o nombre de competencia...">
          </div>

          <!-- 🟦 CONTENEDOR DE CURSOS -->
          <div id="contenedorCursosEST">
            <!-- Los cursos se cargarán dinámicamente aquí -->
          </div>

          <!-- 📌 SIN RESULTADOS -->
          <p id="sinResultadosEST" class="text-center text-muted mt-4 d-none">
            No se encontraron competencias.
          </p>



        </div>

        
      </div>
      <!-- topnav -->
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

  <!-- Script para cursos del estudiante -->
  <script src="/public/js/student/course.js"></script>

</body>
</html>