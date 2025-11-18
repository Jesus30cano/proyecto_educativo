<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de Actividades</title>

    <!-- archivos del css y diseño -->

    <!-- Fuentes personalizadas para esta plantilla -->
    <link href="/public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Estilos personalizados para esta plantilla-->
    <link href="/public/css/styles2.css" rel="stylesheet">
    <!-- Estilos personalizados para esta página -->
    <link href="/public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/teacher_courses/dashboard.css">

    <link rel="stylesheet" href="/public/css/teacher_courses/courses.css">
    <link rel="stylesheet" href="/public/css/teacher_courses/activities.css">
    <link rel="stylesheet" href="/public/css/toast.css" />

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

                    

                    <!-- 🔵 TÍTULO PRINCIPAL -->
                    <h2 class="fw-bold mb-4 titulo-panel">Panel de Seguimiento de Actividades</h2>

                    <!-- CARD CONTENEDORA -->
                    <div class="card shadow-sm border-0">
                        <div class="card-body">

                            <!-- TABLA PRINCIPAL (RESPONSIVE) -->
                            <div class="table-responsive">
                                <table id="tablaActividades"
                                    class="table table-striped table-bordered align-middle w-100">
                                    <thead class="table-header">
                                        <tr>
                                            <th>Actividad</th>
                                            <th>Curso</th>
                                            <th>Ficha</th>
                                            <th>Competencia</th>
                                            <th>Entrega Límite</th>
                                            <th>Estado General</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- JS inserta contenido -->
                                    </tbody>
                                </table>
                            </div>

                            <p id="sinDatos" class="text-center text-muted mt-3 d-none">
                                No se encontraron actividades registradas.
                            </p>
                        </div>
                    </div>

                </div>

                <!-- Modal de seguimiento de estudiantes -->
                <div class="modal fade" id="modalSeguimiento" tabindex="-1" aria-hidden="inert">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">
                                    Seguimiento de Entregas – <span id="tituloActividadModal"></span>
                                </h5>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <div id="infoActividad" class="mb-4 p-3 rounded info-actividad">
                                    <!-- JS coloca título, curso, competencia, fecha límite -->
                                </div>

                                <!-- TABLA DE ENTREGAS (RESPONSIVE) -->
                                <div class="table-responsive">
                                    <table id="tablaEntregas" class="table table-bordered align-middle w-100">
                                        <thead class="table-secondary">
                                            <tr>
                                                <th>Estudiante</th>
                                                <th>Estado</th>
                                                <th>Fecha Entrega</th>
                                                <th>Archivo</th>
                                                <th>Calificación</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- JS inserta entregas -->
                                        </tbody>
                                    </table>
                                </div>

                                <p id="sinEntregas" class="text-center text-muted mt-3 d-none">
                                    No hay entregas registradas.
                                </p>

                            </div>

                        </div>
                    </div>
                </div>


                <!-- MODAL CALIFICAR -->
                <div class="modal fade" id="modalCalificar" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Calificar entrega</h5>
                                <button class="btn-close" data-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <input type="hidden" id="idEntregaCalificar">

                                <label class="form-label fw-bold">Seleccione la calificación:</label>
                                <select id="selectCalificacion" class="form-select">
                                    <option value="">Seleccione...</option>
                                    <option value="aprobado">Aprobado</option>
                                    <option value="reprobado">No aprobado</option>
                                </select>

                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-primary" id="btnGuardarCalificacion">Guardar</button>
                                <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            </div>

                        </div>
                    </div>
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

    <!-- JS -->
     <script>
        const profesorId = <?= json_encode($_SESSION['user_id'] ?? null) ?>;
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
    <script src="/public/js/toast.js"></script>
    <script src="/public/js/teacher/activities.js"></script>

</body>

</html>