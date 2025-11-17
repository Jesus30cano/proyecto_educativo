<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Evaluaciones</title>

    <link rel="stylesheet" href="/public/css/boostrap_dashboard/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="/public/css/boostrap_dashboard/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/public/css/boostrap_dashboard/style.css">
    <link rel="stylesheet" href="/public/css/teacher_courses/evaluations.css">
</head>

<body>

    <?php require_once __DIR__ . "/../components/teacher/sidebar.php"; ?>
    <?php require_once __DIR__ . "/../components/teacher/navbar.php"; ?>

    <main class="main-content p-3 p-md-4">
        <div class="container-fluid">

            <h2 class="fw-bold mb-4 titulo-panel">Gestión de Evaluaciones</h2>

            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <div class="mb-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEvaluacion">
                            Crear Evaluación
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table id="tablaEvaluaciones" class="table table-striped table-bordered align-middle w-100">
                            <thead class="table-header">
                                <tr>
                                    <th>Título</th>
                                    <th>Ficha</th>
                                    <th>Curso</th>
                                    <th>Competencia</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="tabla-evaluaciones">
                                <!-- JS inserta evaluaciones -->
                            </tbody>
                        </table>
                    </div>

                    <p id="sinDatos" class="text-center text-muted mt-3 d-none">
                        No se encontraron evaluaciones registradas.
                    </p>

                </div>
            </div>

        </div>
    </main>

    <!-- Modal Crear/Editar Evaluación -->
    <div class="modal fade" id="modalEvaluacion" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Crear Evaluación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="form-evaluacion">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Título</label>
                                <input type="text" class="form-control" name="titulo" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Fecha</label>
                                <input type="date" class="form-control" name="fecha" value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Descripción</label>
                            <textarea class="form-control" name="descripcion" rows="2"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Curso</label>
                                <select class="form-select" name="id_curso">
                                    <option value="">Seleccionar curso</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Competencia</label>
                                <select class="form-select" name="id_competencia">
                                    <option value="">Seleccionar competencia</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Estado</label>
                            <select class="form-select" name="activa">
                                <option value="true" selected>Activa</option>
                                <option value="false">Inactiva</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <h5>Preguntas</h5>

                            <div class="mb-2">
                                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalIA">Generar con IA</button>
                                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalPreguntaManual">Agregar Pregunta Manual</button>
                            </div>

                            <div id="preguntas-lista">
                                <!-- Preguntas se agregan aquí -->
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">Guardar Evaluación</button>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal IA -->
    <div class="modal fade" id="modalIA" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Generar Preguntas con IA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <textarea class="form-control mb-2" id="descripcionIA" rows="3"
                        placeholder="Describe la temática o competencia"></textarea>
                    <input type="number" class="form-control mb-2" id="cantidadPreguntasIA"
                        placeholder="Cantidad de preguntas" min="1" max="50">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="generarPreguntasIA">Generar Preguntas</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Pregunta Manual -->
    <div class="modal fade" id="modalPreguntaManual" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Agregar Pregunta Manual</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="formPreguntasManual">
                        <div class="mb-3">
                            <label class="form-label">Pregunta</label>
                            <input type="text" class="form-control mb-2 pregunta-texto"
                                placeholder="Escribe tu pregunta" required>
                        </div>

                        <div id="opcionesManual">
                            <div class="input-group mb-2 opcion-grupo">
                                <input type="text" class="form-control opcion-texto" placeholder="Opción 1">
                                <div class="input-group-text">
                                    <input type="radio" name="correcta" class="correcta-radio">
                                </div>
                            </div>
                            <div class="input-group mb-2 opcion-grupo">
                                <input type="text" class="form-control opcion-texto" placeholder="Opción 2">
                                <div class="input-group-text">
                                    <input type="radio" name="correcta" class="correcta-radio">
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-outline-primary btn-sm mb-2" id="btnAgregarOpcion">
                            Agregar Opción
                        </button>

                        <div class="d-flex justify-content-between mt-3">
                            <button type="submit" class="btn btn-primary" id="guardarPreguntaManual">
                                Agregar Pregunta
                            </button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cerrar
                            </button>
                        </div>
                    </form>

                    <div id="preguntasAgregadas" class="mt-4">
                        <h6>Preguntas agregadas:</h6>
                        <ul class="list-group">
                            <!-- JS insertará aquí -->
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="/public/js/boostrap_dashboard/jquery-3.5.1.js"></script>
    <script src="/public/js/boostrap_dashboard/jquery.dataTables.min.js"></script>
    <script src="/public/js/boostrap_dashboard/dataTables.bootstrap5.min.js"></script>
    <script src="/public/js/boostrap_dashboard/bootstrap.bundle.min.js"></script>
    <script src="/public/js/teacher/evaluations.js"></script>

    <script>
        $(document).ready(function () {
            $('#tablaEvaluaciones').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                pageLength: 5,
                lengthMenu: [5, 10, 20],
                responsive: true,
                autoWidth: false
            });
        });
    </script>

</body>

</html>
