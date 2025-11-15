<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/../../../public/css/boostrap_dashboard/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="/../../../public/css/boostrap_dashboard/style.css" />
    <title>Actividades</title>
</head>

<body>
    <!-- offcanvas -->
    <?php include __DIR__ . '/../components/student/navbar.php'; ?>
    <!-- offcanvas -->

    <!-- top navigation bar -->
    <?php include __DIR__ . '/../components/student/sidebar.php'; ?>
    <!-- top navigation bar -->


    <main class="mt-5 pt-3">
        <div class="container-fluid">

            <!-- Bienvenida al estudiante -->
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h3 class="mb-2"><i class="bi me-2"></i>Session de Actividades</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Columna principal de actividades -->
                <div class="col-12">
                    <!-- Filtro de competencias -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-funnel me-2"></i>Filtrar Actividades</h5>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-end">
                                <div class="col-md-8 mb-3 mb-md-0">
                                    <label for="selectCompetencia" class="form-label fw-bold">Selecciona una
                                        competencia:</label>
                                    <select class="form-select" id="selectCompetencia">
                                        <!-- Filtrp de las competencias -->
                                        <option value="todas" selected>Todas las Competencias</option>
                                        <!-- Las opciones -->
                                        <option value="desarrollo-software">Desarrollo de Software Seguro</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary w-100">
                                        <i class="bi bi-search me-2"></i>Buscar
                                    </button> <!-- El boton para las busquedas de las actividades segun el filtro -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Título de sección -->
                    <h4 class="mb-3"><i class="bi bi-list-task me-2"></i>Mis Actividades Asignadas</h4>
                    <hr>

                    <!-- Grid de tarjetas de actividades -->
                    <div class="row">

                        <!-- Actividad 1 - cuando es PENDIENTE -->
                        <div class="col-md-6 mb-3">
                            <div class="card h-100 border-warning shadow-sm">
                                <div class="card-header bg-warning text-white">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">Diseño de Diagramas UML</h6> <!-- Nombre de la actividad -->
                                        <span class="badge bg-light text-dark">
                                            <i class="bi bi-exclamation-circle"></i> Pendiente
                                        </span> <!-- Estado de la actividad -->
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted mb-2"><small><i class="bi bi-bookmark me-1"></i>Desarrollo de
                                            Software Seguro</small></p> <!-- Competencias -->
                                    <p class="card-text small">Desarrollar un software seguro aplicando patrones de
                                        diseño...</p> <!-- Descripcion de la actividad -->
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <span class="text-danger"><i class="bi bi-calendar-x me-1"></i><small>Vence: 15
                                                Nov 2025</small></span> <!-- Fecha de la actividad -->
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modalActividad1">
                                            <i class="bi bi-eye me-1"></i>Ver Detalles
                                        </button> <!-- Abre una ventana de los detalles-->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actividad 2 - cuando es ENTREGADA. Contiene lo mismo que la actividad de arriba, pero, cambiando el modo cuando es entregada -->
                        <div class="col-md-6 mb-3">
                            <div class="card h-100 border-success shadow-sm">
                                <!-- border-success cambia el color a verde -->
                                <div class="card-header bg-success text-white">
                                    <!-- bg-success cambia el color a verde -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">Informe de Penetración</h6>
                                        <span class="badge bg-light text-success">
                                            <i class="bi bi-check-circle"></i> Entregada
                                        </span> <!-- Estado de la actividad -->
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted mb-2"><small><i class="bi bi-bookmark me-1"></i>Seguridad
                                            Informática Avanzada</small></p>
                                    <p class="card-text small">Crear un informe detallado sobre penetración de
                                        sistemas...</p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <span class="text-success"><i class="bi bi-star-fill me-1"></i><small>Nota:
                                                4.8/5.0</small></span>
                                        <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                                            data-bs-target="#modalActividad2">
                                            <i class="bi bi-eye me-1"></i>Ver Detalles
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- las demas cartas de las actividades saldran aqui -->

                    </div>
                </div>
            </div>

        </div>
        </div>
    </main>

    <!-- Modal de actividades incluidos aqui -->
    <?php include __DIR__ . '/../components/student/modal.actividades.php'; ?>

    <script src="./../../public/js/boostrap_dashboard/bootstrap.bundle.min.js"></script>
</body>

</html>