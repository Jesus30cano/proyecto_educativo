<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Asistencias</title>

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
    <link rel="stylesheet" href="/public/css/teacher_courses/evaluations.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
                <h4 class="fw-bold mb-1">Gestion de asistencias</h4>
              </div>
            </div>

                    <div class="row">
                        <div class="col-12">

                            <!-- Acciones rápidas -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <button class="btn btn-success" data-toggle="modal"
                                    data-target="#modalRegistrarAsistencia">
                                    <i class="bi bi-plus-circle me-2"></i>Registrar Asistencia del Día
                                </button>
                            </div>

                            <!-- Filtros -->
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><i class="bi bi-funnel me-2"></i>Filtrar Asistencias</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row align-items-end">
                                        <div class="col-md-4 mb-3 mb-md-0">
                                            <label for="selectGrupo" class="form-label fw-bold">Grupo/Curso:</label>


                                            <select class="form-control" id="selectGrupo">
                                                <option>Cargando cursos...</option>

                                            <select class="form-control" id="selectGrupo">
<<<<<<< HEAD
                                                
                                                
=======
                                                    
                                                
>>>>>>> 8fd071125f71d2a471425c97cef503dc8e58c566
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3 mb-md-0">
                                            <label for="fechaDesde" class="form-label fw-bold">Fecha</label>
                                            <input type="date" class="form-control" id="fecha">
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-primary w-100" id="btnBuscarAsistencias">
                                                <i class="bi bi-search me-2"></i>Buscar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tabla de historial de asistencias -->
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><i class="bi bi-table me-2"></i>Historial de Asistencias</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="table-responsive">
                                            <table id="dataTable"
                                                class="table table-striped table-bordered align-middle w-100">
                                                <thead class="table-header">
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Estudiante</th>
                                                        <th>Grupo</th>
                                                        <th>Fecha</th>
                                                        <th>Estado</th>
                                                        <th>Observaciones</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>



                        </div>

                    </div>
                    <!-- footer -->
                    <?php include __DIR__ . '/../components/footer.php'; ?>
                </div>


            </div>

            <!-- Modal para REGISTRAR ASISTENCIA DEL DÍA -->
            <?php require_once __DIR__ . "/../components/teacher/modal.RegisterAsistance.php"; ?>

            <!-- Modal para EDITAR ASISTENCIA -->
            <?php require_once __DIR__ . "/../components/teacher/modal.EditAsistance.php"; ?>

            <!-- scroll -->
            <?php include __DIR__ . '/../components/scroll.topnav.php'; ?>


            <!-- Script para inicializar DataTables. Esto aparece lo dema de la tabla como la busqueda, cuanto registro quiere aparecer, pasar a la otral ista de la tabla y demas -->
            <script>
                $(document).ready(function() {
                    // Inicializar DataTable para la tabla de asistencias
                    $('#dataTable').DataTable({
                        language: {
                            url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
                        },
                        pageLength: 10,
                        order: [
                            [3, 'desc']
                        ] // Ordenar por fecha descendente
                    });
                });
            </script>

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
            <script src="/public/js/teacher/assistance.js"></script>

</body>

</html>