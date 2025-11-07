<!-- Modal para Actividad 1 - PENDIENTE -->

<!-- Esto es llamado por la id="modalActividad1" donde en la parte de actividades se hace esto: data-bs-target="#modalActividad1"> que es del boton que abre los detalles de la actividad -->

    <div class="modal fade" id="modalActividad1" tabindex="-1" aria-labelledby="modalActividad1Label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="modalActividad1Label">
                        <i class="bi bi-file-earmark-text me-2"></i>Diseño de Diagramas UML
                    </h5> <!-- Nombre de la actividad -->
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <div class="mb-3">
                        <h6 class="text-primary"><i class="bi bi-bookmark me-2"></i>Competencia:</h6> <!-- Competencia -->
                        <p>Desarrollo de Software Seguro</p> <!-- Nombre de la competencia -->
                    </div>

                    <div class="mb-3">
                        <h6 class="text-primary"><i class="bi bi-card-text me-2"></i>Descripción:</h6>
                        <p>Desarrollar un software seguro aplicando patrones de diseño UML. Debe incluir diagramas de
                            clases, secuencia y casos de uso.</p> <!--Descripcion de la actividad-->
                    </div>

                    <div class="mb-3">
                        <h6 class="text-primary"><i class="bi bi-calendar-event me-2"></i>Fecha de Entrega:</h6>
                        <p class="text-danger fw-bold">15 de Noviembre, 2025 - Miércoles</p> <!-- Fecha de entrega -->
                    </div>

                    <div class="mb-4">
                        <h6 class="text-primary"><i class="bi bi-download me-2"></i>Documento de Instrucciones:</h6>
                        <a href="#" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-file-earmark-pdf me-1"></i>Descargar Instrucciones (PDF)
                        </a> <!-- Descargar documento de intrucciones enviados por el profesor -->
                    </div>

                    <hr>

                    <form>
                        <h6 class="text-success mb-3"><i class="bi bi-upload me-2"></i>Enviar mi Trabajo</h6>

                        <div class="mb-3">
                            <label for="archivoEntrega1" class="form-label fw-bold">Adjuntar Archivo:</label>
                            <input type="file" class="form-control" id="archivoEntrega1" required> <!-- Enviar archiv0 -->
                            <small class="text-muted">Formatos permitidos: PDF, DOCX, ZIP (Máx. 10MB)</small>
                        </div>

                        <div class="mb-3">
                            <label for="descripcionEntrega1" class="form-label fw-bold">Descripción de lo
                                realizado:</label>
                            <textarea class="form-control" id="descripcionEntrega1" rows="4"
                                placeholder="Describe brevemente lo que hiciste en esta actividad..."
                                maxlength="500"></textarea> <!-- Descripcion de la tarea hecha por el estudiante -->
                            <small class="text-muted">Máximo 500 caracteres</small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>Cancelar
                    </button> <!-- botom cancelar -->
                    <button type="button" class="btn btn-success">
                        <i class="bi bi-send me-1"></i>Enviar Actividad
                    </button> <!-- boton de enviar actividad -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Actividad 2 - cuando es ENTREGADA -->
    <div class="modal fade" id="modalActividad2" tabindex="-1" aria-labelledby="modalActividad2Label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white"> <!-- bg-succces a verde cuando es entregada la actividad -->
                    <h5 class="modal-title" id="modalActividad2Label">
                        <i class="bi bi-file-earmark-check me-2"></i>Informe de Penetración de Sistemas
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <strong>Actividad Entregada y Calificada</strong>
                    </div>

                    <div class="mb-3">
                        <h6 class="text-primary"><i class="bi bi-bookmark me-2"></i>Competencia:</h6>
                        <p>Seguridad Informática Avanzada</p>
                    </div>

                    <div class="mb-3">
                        <h6 class="text-primary"><i class="bi bi-card-text me-2"></i>Descripción:</h6>
                        <p>Crear un informe detallado sobre penetración de sistemas y vulnerabilidades comunes.</p>
                    </div>

                    <div class="mb-3">
                        <h6 class="text-primary"><i class="bi bi-calendar-check me-2"></i>Fecha de Entrega:</h6>
                        <p>28 de Octubre, 2025 - Jueves</p>
                    </div>

                    <div class="mb-3">
                        <h6 class="text-success"><i class="bi bi-star-fill me-2"></i>Calificación Obtenida:</h6>
                        <h4 class="text-success">4.8 / 5.0</h4> <!-- Calificacion de la actividad -->
                    </div>

                    <div class="mb-3">
                        <h6 class="text-primary"><i class="bi bi-chat-square-text me-2"></i>Observaciones del Profesor:
                        </h6>
                        <div class="alert alert-info">
                            Excelente trabajo. Los diagramas están bien estructurados. Se recomienda profundizar más en
                            los patrones de comportamiento.
                        </div> <!-- Observacion hecha por el profesor -->
                    </div>

                    <div class="mb-3">
                        <h6 class="text-primary"><i class="bi bi-download me-2"></i>Documentos:</h6>
                        <a href="#" class="btn btn-outline-primary btn-sm me-2 mb-2">
                            <i class="bi bi-file-earmark-pdf me-1"></i>Descargar Instrucciones
                        </a> <!-- Instruccion del profesor -->
                        <a href="#" class="btn btn-outline-success btn-sm mb-2">
                            <i class="bi bi-file-earmark-arrow-down me-1"></i>Ver mi Entrega
                        </a> <!-- Documento enviado por el estudiante -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>Cerrar
                    </button> <!-- Salir del modal -->
                </div>
            </div>
        </div>
    </div>