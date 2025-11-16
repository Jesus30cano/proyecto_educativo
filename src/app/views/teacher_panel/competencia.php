<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Actividades de la Competencia</title>
    <link rel="stylesheet" href="/public/css/boostrap_dashboard/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="/public/css/boostrap_dashboard/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/public/css/boostrap_dashboard/style.css">
    <link rel="stylesheet" href="/public/css/teacher_courses/competencia.css">
</head>

<body>

    <?php require_once __DIR__ . "/../components/teacher/sidebar.php"; ?>
    <?php require_once __DIR__ . "/../components/teacher/navbar.php"; ?>

    <main class="main-content p-4">
        <div class="container">

            <div class="competencia-header p-4 mb-4 shadow-sm">
                <h4 id="tituloCompetencia" class="fw-bold mb-1">Competencia</h4>
                <p id="descripcionCompetencia" class="mb-0">Descripción</p>
            </div>

            <!-- Filtros por fecha -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <label for="filtroDesde" class="form-label">Desde</label>
                    <input type="date" id="filtroDesde" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="filtroHasta" class="form-label">Hasta</label>
                    <input type="date" id="filtroHasta" class="form-control">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button id="btnFiltrarFechas" class="btn btn-outline-primary w-100">Filtrar por fecha</button>
                </div>
            </div>

            <div id="actividadesContainer" class="row gy-4"></div>

            <p id="sinActividades" class="text-muted text-center mt-4 d-none">
                No hay actividades registradas para esta competencia.
            </p>

            <div class="mt-4">
                <a href="/teacher/course/ver" class="btn btn-outline-dark">← Volver al curso</a>
            </div>
        </div>
    </main>
    <div id="confirmacion" style="display:none; position:fixed; top:50%; left:60%; transform:translate(-50%, -50%);
 background:#fff; box-shadow:0 5px 20px rgba(0,0,0,.3); padding:24px 32px; border-radius:10px; z-index:999;">
  <p>¿Estás seguro de que deseas eliminar esta actividad?</p>
  <button id="btnSiEliminar" style="margin-right:8px;">Sí, eliminar</button>
  <button id="btnNoEliminar">Cancelar</button>
</div>

    <!-- Modal de edición -->
    <div class="modal fade" id="modalEditarActividad" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formEditarActividad">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Actividad</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="/public/js/boostrap_dashboard/jquery-3.5.1.js"></script>
    <script src="/public/js/boostrap_dashboard/jquery.dataTables.min.js"></script>
    <script src="/public/js/boostrap_dashboard/dataTables.bootstrap5.min.js"></script>
    <script src="/public/js/boostrap_dashboard/bootstrap.bundle.min.js"></script>

    <script>
        const profesorId = <?= json_encode($_SESSION['user_id'] ?? null) ?>;
        const cursoId = <?= json_encode($_SESSION['curso_seleccionado'] ?? null) ?>;
        const competenciaId = <?= json_encode($_SESSION['competencia_seleccionada'] ?? null) ?>;
    </script>

    <script src="/public/js/teacher/competencia.js"></script>
</body>

</html>