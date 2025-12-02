<!-- Modal para REGISTRAR ASISTENCIA DEL DÍA -->
<div class="modal fade" id="modalRegistrarAsistencia" tabindex="-1"
    aria-labelledby="modalRegistrarAsistenciaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title font-weight-bold" id="modalRegistrarAsistenciaLabel">
                    <i class="fas fa-user-check mr-2"></i>Registrar Asistencia del Día
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                
                <div class="row mb-4">
                       
                    <div class="col-md-6">
                        <label for="grupoAsistencia" class="form-label fw-bold">Grupo/Curso:</label>
                        <select class="form-control" id="grupoAsistencia">
                            <option>Cargando cursos...</option>
                        </select>
                    </div>
                </div>

                <div class="alert alert-info mt-3">
                    <i class="fas fa-info-circle mr-2"></i>
                    <strong>Instrucciones:</strong> Seleccione el grupo y marque la asistencia de cada estudiante.
                </div>

                <h6 class="mb-3 text-primary font-weight-bold">
                    <i class="fas fa-users mr-2"></i>Lista de Estudiantes
                </h6>

               
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle" id="tablaAsistencia">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 5%" class="text-center">#</th>
                                <th style="width: 35%"><i class="fas fa-user mr-1"></i>Estudiante</th>
                                <th style="width: 30%" class="text-center"><i class="fas fa-clipboard-check mr-1"></i>Estado</th>
                                <th style="width: 30%"><i class="fas fa-comment mr-1"></i>Observaciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyAsistencia">
                           
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary btn-modern" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-success btn-modern" id="btnGuardarAsistencia">
                    <i class="fas fa-save mr-2"></i>Guardar Asistencia
                </button>
            </div>
        </div>
    </div>
</div>