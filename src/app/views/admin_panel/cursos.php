<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

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
  <link rel="stylesheet" href="/public/css/toast.css">
  <title>Cursos</title>
</head>

<body id="page-top">
  <!-- esto inicia todo el contenido -->
  <div id="wrapper">
    <!-- sidenav -->
    <?php include __DIR__ . '/../components/admin/sidenav.php'; ?>


    <!-- contenido del contenido -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- inicia el contenido principal -->
      <div id="content">
        <!-- topnav -->
        <?php include __DIR__ . '/../components/topnav.php'; ?>


        <!-- Contenido de la página de inicio -->
        <div class="container-fluid">

          <!-- TITULO -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cursos</h1>
          </div>


           <!-- Dashboard Cards -->
            <?php include __DIR__ . '/../components/admin/cards/Cards_cursos.php'; ?>

            <?php include __DIR__ . '/../components/admin/toolbars/toolbar_curso.php'; ?>
      
            <!-- Data Table -->
            <?php include __DIR__ .'/../components/admin/tables/DataTableCursos.php'; ?>
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
  <script src="/public/js/script.js"></script>
  <script src="/public/js/admin/curso.js"></script>
  <script src="/public/js/toast.js"></script>


</body>
</html>