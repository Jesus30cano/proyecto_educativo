<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Fuentes personalizadas -->
  <link href="/public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

  <!-- Estilos -->
  <link href="/public/css/styles2.css" rel="stylesheet">


  <!-- Fuentes personalizadas para esta plantilla -->
  <link href="/public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
  <!-- Estilos personalizados para esta plantilla-->
  <link href="/public/css/styles.css" rel="stylesheet">
  <!-- Estilos personalizados para esta página -->

  <link href="/public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/public/css/teacher_courses/evaluations.css">
  <!-- carta azul -->
  <link rel="stylesheet" href="/public/css/card.blue.css">

  <title>Usuarios</title>
</head>

<body id="page-top">

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include __DIR__ . '/../components/admin/sidenav.php'; ?>

    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">

        <!-- Topbar -->
        <?php include __DIR__ . '/../components/admin/topnav.php'; ?>

        <div class="container-fluid">

          <!-- Título -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Asistencias</h1>
          </div>


          <!-- Dashboard Cards -->
          <?php include __DIR__ . '/../components/admin/cards/card_usuarios.php'; ?>
          <!-- Toolbar con botón Crear Usuario -->
          <?php include __DIR__ . '/../components/admin/toolbars/toolbar_Usuarios.php'; ?>
          <!-- Tabla de usuarios -->
          <?php include __DIR__ . '/../components/admin/tables/DataTableUsuarios.php'; ?>



        </div>


        <!-- Footer -->
        <?php include __DIR__ . '/../components/footer.php'; ?>

      </div>

    </div>

    <!-- Scroll to top -->
    <?php include __DIR__ . '/../components/scroll.topnav.php'; ?>


    <!-- ===================================================== -->
    <!-- LIBRERÍAS NECESARIAS -->
    <!-- ===================================================== -->

    <!-- jQuery -->
    <script src="/public/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Easing -->
    <script src="/public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- SB Admin scripts -->
    <script src="/public/js/styles/sb-admin-2.min.js"></script>

    <!-- Datatables -->
    <script src="/public/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/public/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/public/js/styles/demo/datatables-demo.js"></script>

    <!-- NAVIGATION SCRIPTS -->
    <script src="/public/js/navigation.js"></script>
    <script src="/public/js/admin/modal.js"></script>



</body>

</html>