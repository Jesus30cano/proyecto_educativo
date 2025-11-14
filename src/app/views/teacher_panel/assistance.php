<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Asistencias | Panel Profesor</title>

    <link rel="stylesheet" href="/public/css/boostrap_dashboard/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="/public/css/boostrap_dashboard/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/public/css/boostrap_dashboard/style.css">
    <link rel="stylesheet" href="/public/css/teacher_courses/courses.css">

</head>

<body>

<!-- Chicos esta vista no tiene su ruta. arreglarlo -->

    <?php require_once __DIR__ . "/../components/teacher/sidebar.php"; ?>
    <?php require_once __DIR__ . "/../components/teacher/navbar.php"; ?>

    <main class="main-content p-4">
        <div class="container">

            <!-- Título -->
            <h2 class="fw-bold mb-3">Control de Asistencias</h2>

            <div class="row">
                <div class="col-12">

                    <!-- Acciones rápidas -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4><i class="bi bi-calendar-check me-2"></i>Gestión de Asistencias</h4>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrarAsistencia">
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
                                    <select class="form-select" id="selectGrupo">
                                        <option value="todos" selected>Todos los Grupos</option>
                                        <option value="grupo1">Grupo A - Ingeniería de Software</option>
                                        <option value="grupo2">Grupo B - Seguridad Informática</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3 mb-md-0">
                                    <label for="fechaDesde" class="form-label fw-bold">Fecha</label>
                                    <input type="date" class="form-control" id="fecha">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary w-100">
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
                                <table id="tablaAsistencias" class="table table-striped table-hover" style="width: 100%">
                                    <thead class="table-dark">
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
                                        <!-- Asistencia 1 - PRESENTE -->
                                        <tr>
                                            <td>001</td>
                                            <td>Juan Pérez García</td>
                                            <td>Grupo A</td>
                                            <td>11 Nov 2025</td>
                                            <td><span class="badge bg-success"><i class="bi bi-check-circle"></i> Presente</span></td>
                                            <td>-</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" title="Editar" data-bs-toggle="modal" data-bs-target="#modalEditarAsistencia">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Asistencia 2 - AUSENTE -->
                                        <tr>
                                            <td>002</td>
                                            <td>María López Sánchez</td>
                                            <td>Grupo A</td>
                                            <td>11 Nov 2025</td>
                                            <td><span class="badge bg-danger"><i class="bi bi-x-circle"></i> Ausente</span></td>
                                            <td>Sin justificación</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" title="Editar" data-bs-toggle="modal" data-bs-target="#modalEditarAsistencia">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </main>


    <!-- Modal para REGISTRAR ASISTENCIA DEL DÍA -->
    <?php require_once __DIR__ . "/../components/teacher/modal.RegisterAsistance.php"; ?>
    


    <!-- Modal para EDITAR ASISTENCIA -->
    <?php require_once __DIR__ . "/../components/teacher/modal.EditAsistance.php"; ?>


    <script src="/public/js/boostrap_dashboard/jquery-3.5.1.js"></script>
    <script src="/public/js/boostrap_dashboard/jquery.dataTables.min.js"></script>
    <script src="/public/js/boostrap_dashboard/dataTables.bootstrap5.min.js"></script>
    <script src="/public/js/boostrap_dashboard/bootstrap.bundle.min.js"></script>

    <!-- Script para inicializar DataTables. Esto aparece lo dema de la tabla como la busqueda, cuanto registro quiere aparecer, pasar a la otral ista de la tabla y demas -->
    <script>
        $(document).ready(function() {
            // Inicializar DataTable para la tabla de asistencias
            $('#tablaAsistencias').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
                },
                pageLength: 10,
                order: [[3, 'desc']] // Ordenar por fecha descendente
            });
        });
    </script>
    
</body>

</html>