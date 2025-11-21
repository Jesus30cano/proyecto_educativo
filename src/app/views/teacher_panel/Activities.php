<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de Actividades</title>

    <!-- Fuentes -->
    <link href="/public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Estilos principales -->
    <link href="/public/css/styles.css" rel="stylesheet">

    <!-- DataTables con Bootstrap 5 -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- Estilos del panel -->
    <link rel="stylesheet" href="/public/css/teacher_courses/dashboard.css">
    <link rel="stylesheet" href="/public/css/teacher_courses/courses.css">
    <link rel="stylesheet" href="/public/css/teacher_courses/activities.css">
    <link rel="stylesheet" href="/public/css/teacher_courses/evaluations.css">
    <link rel="stylesheet" href="/public/css/toast.css" />
    <!-- carta azul -->
    <link rel="stylesheet" href="/public/css/card.blue.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- sidenav -->
        <?php include __DIR__ . '/../components/teacher/sidenav.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- topnav -->
                <?php include __DIR__ . '/../components/teacher/topnav.php'; ?>

                <!-- Contenido principal -->
                <div class="container-fluid">

                    <!-- Título -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Actividades</h1>
                    </div>

                    <!-- Card contenedora -->
                    <div class="card shadow-sm border-0">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-white">
                                <i class="fas fa-table mr-2"></i>
                                Seguimiento de Actividades
                            </h6>
                        </div>
                        <div class="card-body">
                            <!-- Tabla principal -->
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
                <div class="modal fade" id="modalSeguimiento" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">
                                    Seguimiento de Entregas – <span id="tituloActividadModal"></span>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div id="infoActividad" class="mb-4 p-3 rounded info-actividad">
                                    <!-- JS coloca título, curso, competencia, fecha límite -->
                                </div>

                                <!-- Tabla de entregas -->
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

                <!-- Modal calificar -->
                <div class="modal fade" id="modalCalificar" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Calificar entrega</h5>
                                <button type="button" class="btn-close" data-dismiss="modal"
                                    aria-label="Cerrar"></button>
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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <!-- footer -->
            <?php include __DIR__ . '/../components/footer.php'; ?>
        </div>
    </div>

    <!-- scroll -->
    <?php include __DIR__ . '/../components/scroll.topnav.php'; ?>

    <!-- JS -->
    <script>
        const profesorId = <?= json_encode($_SESSION['user_id'] ?? null) ?>;
    </script>

    <!-- Librerías -->
    <script src="/public/vendor/jquery/jquery.min.js"></script>
    <script src="/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables core + Bootstrap 5 -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- Otros scripts -->
    <script src="/public/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="/public/js/styles/sb-admin-2.min.js"></script>
    <script src="/public/js/toast.js"></script>

    <!-- Script funcional -->
    <script src="/public/js/teacher/activities.js"></script>
</body>

</html>