<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de Actividades</title>

    <link rel="stylesheet" href="/public/css/boostrap_dashboard/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="/public/css/boostrap_dashboard/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/public/css/boostrap_dashboard/style.css">
    <link rel="stylesheet" href="/public/css/teacher_courses/activities.css">
</head>

<body>

    <?php require_once __DIR__ . "/../components/teacher/sidebar.php"; ?>
    <?php require_once __DIR__ . "/../components/teacher/navbar.php"; ?>

    <main class="main-content p-3 p-md-4">
        <div class="container-fluid">

            <!-- 🔵 TÍTULO PRINCIPAL -->
            <h2 class="fw-bold mb-4 titulo-panel">Panel de Seguimiento de Actividades</h2>

            <!-- CARD CONTENEDORA -->
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <!-- TABLA PRINCIPAL (RESPONSIVE) -->
                    <div class="table-responsive">
                        <table id="tablaActividades" class="table table-striped table-bordered align-middle w-100">
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
    </main>

    <!-- Modal de seguimiento de estudiantes -->
    <div class="modal fade" id="modalSeguimiento" tabindex="-1" aria-hidden="true">
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
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="idEntregaCalificar">

                    <label class="form-label fw-bold">Seleccione la calificación:</label>
                    <select id="selectCalificacion" class="form-select">
                        <option value="">Seleccione...</option>
                        <option value="Aprobado">Aprobado</option>
                        <option value="No aprobado">No aprobado</option>
                    </select>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" id="btnGuardarCalificacion">Guardar</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>

            </div>
        </div>
    </div>



    <!-- JS -->
    <script>
        const profesorId = <?= json_encode($_SESSION['user_id'] ?? null) ?>;
    </script>

    <script src="/public/js/boostrap_dashboard/jquery-3.5.1.js"></script>
    <script src="/public/js/boostrap_dashboard/jquery.dataTables.min.js"></script>
    <script src="/public/js/boostrap_dashboard/dataTables.bootstrap5.min.js"></script>
    <script src="/public/js/boostrap_dashboard/bootstrap.bundle.min.js"></script>

    <script src="/public/js/teacher/activities.js"></script>

</body>

</html>