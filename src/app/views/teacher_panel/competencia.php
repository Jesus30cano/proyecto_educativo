<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <!-- Fuentes personalizadas para esta plantilla -->
    <link href="/public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Estilos personalizados para esta plantilla-->
    <link href="/public/css/styles.css" rel="stylesheet">
    <!-- Estilos personalizados para esta página -->
    <link href="/public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/teacher_courses/dashboard.css">
    <link rel="stylesheet" href="/public/css/teacher_courses/competencia.css">
    <!-- carta azul -->
    <title>Actividades de la Competencia</title>

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

                <!-- Título -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Competencias</h1>
                </div>

                    <!-- 🔵 Encabezado Competencia -->
                    <div class="competencia-header mb-4 shadow-sm">
                        <h4 id="tituloCompetencia" class="fw-bold mb-1">Competencia</h4>
                        <p id="descripcionCompetencia" class="mb-0">Descripción</p>
                    </div>

                    <!-- Filtro por fecha -->
                    <div class="card mb-4">
                        <div class="card-header blue-claro text-white">
                            <h6 class="m-0 font-weight-bold">Filtrar por fecha</h6>
                        </div>

                        <div class="card-body">
                            <div class="row align-items-end">

                                <div class="col-md-4">
                                    <label for="filtroDesde" class="form-label">Desde</label>
                                    <input type="date" id="filtroDesde" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label for="filtroHasta" class="form-label">Hasta</label>
                                    <input type="date" id="filtroHasta" class="form-control">
                                </div>

                                <div class="col-md-4 d-flex align-items-end">
                                    <button id="btnFiltrarFechas" class="btn btn-outline-primary w-100">
                                        <i class="bi bi-filter"></i> Filtrar por fecha
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>


                    <!-- 🗃 Contenedor actividades -->
                    <div id="actividadesContainer" class="row gy-4"></div>

                    <!-- 📌 Sin actividades -->
                    <p id="sinActividades" class="text-muted text-center mt-4 d-none">
                        No hay actividades registradas para esta competencia.
                    </p>

                    <!-- 🔙 Volver -->
                    <div class="mt-4">
                        <a href="/teacher/course/ver" class="btn btn-secondary">
                            <i class="bi bi-arrow-left-short"></i> Volver al curso
                        </a>
                    </div>

                    <!-- ❌ Confirmación eliminar -->
                    <div id="confirmacion" style="display:none; position:fixed; top:50%; left:60%; transform:translate(-50%, -50%);
                        background:#fff; box-shadow:0 5px 20px rgba(0,0,0,.3); padding:24px 32px; border-radius:12px; z-index:999;">
                        <p class="fw-bold mb-3">¿Estás seguro de que deseas eliminar esta actividad?</p>
                        <button id="btnSiEliminar" class="btn btn-danger me-2">Sí, eliminar</button>
                        <button id="btnNoEliminar" class="btn btn-secondary">Cancelar</button>
                    </div>

                    <!-- ✏ Modal editar actividad -->
                    <div class="modal fade" id="modalEditarActividad" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form id="formEditarActividad">

                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold">Editar Actividad</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" id="editId">

                                        <div class="mb-3">
                                            <label for="editTitulo" class="form-label">Título</label>
                                            <input type="text" class="form-control" id="editTitulo" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="editDescripcion" class="form-label">Descripción</label>
                                            <textarea class="form-control" id="editDescripcion" rows="3"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="editFecha" class="form-label">Fecha de entrega</label>
                                            <input type="date" class="form-control" id="editFecha" required>
                                        </div>

                                        <div id="mensajeEdicion" class="mt-2"></div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancelar</button>
                                    </div>

                                </form>
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

    <script>
        const profesorId = <?= json_encode($_SESSION['user_id'] ?? null) ?>;
        const cursoId = <?= json_encode($_SESSION['curso_seleccionado'] ?? null) ?>;
        const competenciaId = <?= json_encode($_SESSION['competencia_seleccionada'] ?? null) ?>;
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
    <script src="/public/js/teacher/competencia.js"></script>

</body>
</html>