<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Evaluaciones</title>

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
    <link rel="stylesheet" href="/public/css/teacher_courses/evaluations.css">
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
                <?php include __DIR__ . '/../components/topnav.php'; ?>


                <!-- Contenido de la página de inicio -->
                <div class="container-fluid">

                    <!-- TITULO -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Contenido Principal</h1>
                    </div>


                    <!-- Ejemplo de tarjeta normal -->
                    <div class="col-xl-12 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Bienvenido Profesor</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Este es su apartado de
                                            Evaluaciones</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h2 class="fw-bold mb-4 titulo-panel">Gestión de Evaluaciones</h2>

                    <div class="card shadow-sm border-0">
                        <div class="card-body">

                            <div class="mb-3">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modalEvaluacion">
                                    Crear Evaluación
                                </button>
                            </div>

                            <div class="table-responsive">
                                <table id="dataTable" class="table table-striped table-bordered align-middle w-100">
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
                                <button type="button" class="btn-close" data-dismiss="modal"></button>
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
                                            <input type="date" class="form-control" name="fecha"
                                                value="<?= date('Y-m-d') ?>">
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
                                            <button type="button" class="btn btn-outline-primary btn-sm"
                                                data-toggle="modal" data-target="#modalIA">Generar con IA</button>
                                            <button type="button" class="btn btn-outline-primary btn-sm"
                                                data-toggle="modal" data-target="#modalPreguntaManual">Agregar Pregunta
                                                Manual</button>
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
                                <button type="button" class="btn-close" data-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <textarea class="form-control mb-2" id="descripcionIA" rows="3"
                                    placeholder="Describe la temática o competencia"></textarea>
                                <input type="number" class="form-control mb-2" id="cantidadPreguntasIA"
                                    placeholder="Cantidad de preguntas" min="1" max="50">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="generarPreguntasIA">Generar
                                    Preguntas</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
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
                                <button type="button" class="btn-close" data-dismiss="modal"></button>
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

                                    <button type="button" class="btn btn-outline-primary btn-sm mb-2"
                                        id="btnAgregarOpcion">
                                        Agregar Opción
                                    </button>

                                    <div class="d-flex justify-content-between mt-3">
                                        <button type="submit" class="btn btn-primary" id="guardarPreguntaManual">
                                            Agregar Pregunta
                                        </button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
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
    <script src="/public/js/teacher/evaluations.js"></script>

</body>

</html>