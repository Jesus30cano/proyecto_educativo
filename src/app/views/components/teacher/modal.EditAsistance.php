<!-- Modal para EDITAR ASISTENCIA -->
<div class="modal fade" id="modalEditarAsistencia" tabindex="-1"
     aria-labelledby="modalEditarAsistenciaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalEditarAsistenciaLabel">
                    <i class="bi bi-pencil me-2"></i>Editar Asistencia
                </h5>
                <button type="button" class="btn-close btn-close-white"
                        data-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- ID oculto de la asistencia -->
                <input type="hidden" id="editIdAsistencia">

                <form>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Estudiante:</label>
                        <input type="text" class="form-control"
                               id="editEstudiante" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Fecha:</label>
                        <input type="date" class="form-control"
                               id="editFecha" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="editEstado" class="form-label fw-bold">Estado:</label>
                        <select class="form-select" id="editEstado">
                            <option value="presente">✓ Presente</option>
                            <option value="ausente">✗ Ausente</option>
                            <option value="excusa">📄 Excusa</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="editObservaciones" class="form-label fw-bold">Observaciones:</label>
                        <textarea class="form-control" id="editObservaciones"
                                  rows="3"
                                  placeholder="Ingresa observaciones si es necesario..."></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btnActualizarAsistencia">
                    <i class="bi bi-save me-1"></i>Actualizar
                </button>
            </div>
        </div>
    </div>
</div>