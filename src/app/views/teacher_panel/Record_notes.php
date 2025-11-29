<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de notas</title>
    <link href="/public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Estilos principales -->
    <link href="/public/css/styles.css" rel="stylesheet">
    <link href="/public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/teacher_courses/notes.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- carta azul -->
    <link rel="stylesheet" href="/public/css/card.blue.css">
    <link rel="stylesheet" href="/public/css/toast.css">

    
</head>

<body id="page-top">

    <div id="wrapper">
        <!-- sidenav -->
        <?php include __DIR__ . '/../components/teacher/sidenav.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <!-- topnav -->
                <?php include __DIR__ . '/../components/teacher/topnav.php'; ?>

                <div class="container-fluid">

                    <!-- Título -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Notas</h1>
                    </div>

                    <!-- Filtros -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="bi bi-funnel me-2"></i>Filtrar por Curso y Competencia
                            </h5>
                        </div>

                        <div class="card-body">
                            <div class="row align-items-end">

                                <!-- Curso/Ficha -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Ficha:</label>
                                    <select class="form-control" id="selectFicha">
                                        <option value="">Seleccione una Ficha...</option>
                                    </select>
                                </div>

                                <!-- Competencias dinámicas -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Competencia:</label>
                                    <select class="form-control" id="selectCompetencia" disabled>
                                        <option value="">Seleccione una competencia...</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <button class="btn blue-claro text-white w-100" id="btnBuscarNotas">
                                        <i class="bi bi-search me-2"></i>Buscar
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Resultados de competencias (tarjetas estilo cursos) -->
                    <div class="row">
                        <div class="col-12">
                            <h5 class="fw-bold text-secondary mb-3">Competencias del Curso</h5>

                            <div id="contenedorCompetencias">
                                <!-- Tarjetas generadas por JS -->
                            </div>
                        </div>
                    </div>

                </div>

                <!-- footer -->
                <?php include __DIR__ . '/../components/footer.php'; ?>

            </div>

        </div>
    </div>

    <!-- Modal: Estudiantes y notas -->
    <div class="modal fade" id="modalNotas" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-people-fill me-2"></i>Calificar Estudiantes
                    </h5>
                    <button class="btn-close bg-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th>Estudiante</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="listaEstudiantes">
                                <!-- Estudiantes por competencia -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button class="btn btn-success" id="btnGuardarNotas">
                        Guardar Notas
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- Scripts Bootstrap -->
    <script src="/public/vendor/jquery/jquery.min.js"></script>
    <script src="/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables -->
    <script src="/public/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/public/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Script funcional -->
    <script src="/public/js/teacher/notes.js"></script>
    <script src="/public/js/toast.js"></script>

</body>

</html>