<!-- Modal para REGISTRAR ASISTENCIA DEL DÍA -->
<div class="modal fade" id="modalRegistrarAsistencia" tabindex="-1" aria-labelledby="modalRegistrarAsistenciaLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalRegistrarAsistenciaLabel">
                        <i class="bi bi-calendar-check me-2"></i>Registrar Asistencia del Día
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Información de la clase -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="fechaAsistencia" class="form-label fw-bold">Fecha:</label>
                            <input type="date" class="form-control" id="fechaAsistencia" value="2025-11-11">
                        </div>
                        <div class="col-md-6">
                            <label for="grupoAsistencia" class="form-label fw-bold">Grupo/Curso:</label>
                            <select class="form-select" id="grupoAsistencia">
                                <option value="grupo1" selected>Grupo A - Ingeniería de Software</option>
                                <option value="grupo2">Grupo B - Seguridad Informática</option>
                            </select>
                        </div>
                    </div>

                    <hr>

                    <h6 class="mb-3"><i class="bi bi-people me-2"></i>Lista de Estudiantes</h6>

                    <!-- Tabla de estudiantes para marcar asistencia -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th style="width: 35%">Estudiante</th>
                                    <th style="width: 30%">Estado</th>
                                    <th style="width: 30%">Observaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Estudiante 1 -->
                                <tr>
                                    <td>1</td>
                                    <td>Juan Pérez García</td>
                                    <td>
                                        <select class="form-select form-select-sm estado-asistencia">
                                            <option value="presente" selected>✓ Presente</option>
                                            <option value="ausente">✗ Ausente</option>
                                            <option value="tardanza">⏰ Tardanza</option>
                                            <option value="justificado">📄 Justificado</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" placeholder="Observaciones...">
                                    </td>
                                </tr>
                                <!-- Estudiante 2 -->
                                <tr>
                                    <td>2</td>
                                    <td>María López Sánchez</td>
                                    <td>
                                        <select class="form-select form-select-sm estado-asistencia">
                                            <option value="presente" selected>✓ Presente</option>
                                            <option value="ausente">✗ Ausente</option>
                                            <option value="tardanza">⏰ Tardanza</option>
                                            <option value="justificado">📄 Justificado</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" placeholder="Observaciones...">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>Cancelar
                    </button>
                    <button type="button" class="btn btn-success">
                        <i class="bi bi-save me-1"></i>Guardar Asistencia
                    </button>
                </div>
            </div>
        </div>
    </div>