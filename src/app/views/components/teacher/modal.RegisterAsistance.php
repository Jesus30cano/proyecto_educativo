<!-- Modal para REGISTRAR ASISTENCIA DEL DÍA -->
<div class="modal fade" id="modalRegistrarAsistencia" tabindex="-1"
     aria-labelledby="modalRegistrarAsistenciaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="modalRegistrarAsistenciaLabel">
                    <i class="bi bi-calendar-check me-2"></i>Registrar Asistencia del Día
                </h5>
                <button type="button" class="btn-close btn-close-white"
                        data-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                
                <div class="row mb-4">
                    <div class="col-md-6">
                       
                    
                    </div>
                    <div class="col-md-6">
                        <label for="grupoAsistencia" class="form-label fw-bold">Grupo/Curso:</label>
                        <select class="form-control" id="grupoAsistencia">
                            <option>Cargando cursos...</option>
                        </select>
                    </div>
                </div>

                <hr>

                <h6 class="mb-3">
                    <i class="bi bi-people me-2"></i>Lista de Estudiantes
                </h6>

               
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="tablaAsistencia">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 35%">Estudiante</th>
                                <th style="width: 30%">Estado</th>
                                <th style="width: 30%">Observaciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyAsistencia">
                           
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>Cancelar
                </button>

                
                <button type="button" class="btn btn-success" id="btnGuardarAsistencia">
                    <i class="bi bi-save me-1"></i>Guardar Asistencia
                </button>
            </div>
        </div>
    </div>
</div>