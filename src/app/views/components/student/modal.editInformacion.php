<!-- Modal Editar Información Personal -->

<!-- Para llamar estos modal es en la parte de id. en el perfil el boton de editar llama a dicho id con esto: data-bs-target="#modalEditarPersonal" -->

  <div class="modal fade" id="modalEditarPersonal" tabindex="-1" aria-labelledby="modalEditarPersonalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="modalEditarPersonalLabel">
            <i class="bi bi-pencil-square me-2"></i>Editar Información Personal
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="row">
              <!-- Columna izquierda - los compos a rellenar el estudiante. casi lo mismo que los comentarios del perfil explicando-->
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="editNombre" class="form-label fw-bold"><i class="bi bi-person me-2"></i>Nombre</label>
                  <input type="text" class="form-control" id="editNombre" value="Juan Carlos" required>
                </div>

                <div class="mb-3">
                  <label for="editApellido" class="form-label fw-bold"><i class="bi bi-person me-2"></i>Apellido</label>
                  <input type="text" class="form-control" id="editApellido" value="Pérez García" required>
                </div>

                <div class="mb-3">
                  <label for="editEmail" class="form-label fw-bold"><i class="bi bi-envelope me-2"></i>Email</label>
                  <input type="email" class="form-control" id="editEmail" value="juan.perez@estudiante.com" required>
                </div>

                <div class="mb-3">
                  <label for="editTelefono" class="form-label fw-bold"><i class="bi bi-telephone me-2"></i>Teléfono</label>
                  <input type="tel" class="form-control" id="editTelefono" value="+57 300 123 4567" required>
                </div>
              </div>

              <!-- Columna derecha -->
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="editFechaNacimiento" class="form-label fw-bold"><i class="bi bi-calendar-event me-2"></i>Fecha de Nacimiento</label>
                  <input type="date" class="form-control" id="editFechaNacimiento" value="2000-03-15" required>
                </div>

                <div class="mb-3">
                  <label for="editDireccion" class="form-label fw-bold"><i class="bi bi-geo-alt me-2"></i>Dirección</label>
                  <input type="text" class="form-control" id="editDireccion" value="Calle 123 #45-67, Barranquilla" required>
                </div>

                <div class="mb-3">
                  <label for="editGenero" class="form-label fw-bold"><i class="bi bi-person me-2"></i>Género</label>
                  <select class="form-select" id="editGenero" required>
                    <option value="masculino" selected>Masculino</option>
                    <option value="femenino">Femenino</option>
                    <option value="otro">Otro</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label for="editTipoDocumento" class="form-label fw-bold"><i class="bi bi-card-text me-2"></i>Tipo de Documento</label>
                  <select class="form-select" id="editTipoDocumento" required>
                    <option value="cc" selected>Cédula de Ciudadanía</option>
                    <option value="ti">Tarjeta de Identidad</option>
                    <option value="ce">Cédula de Extranjería</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="alert alert-info">
              <i class="bi bi-info-circle me-2"></i>
              <strong>Nota:</strong> El número de documento no puede ser modificado. Contacta a administración si necesitas cambiarlo.
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="bi bi-x-circle me-1"></i>Cancelar
          </button>
          <button type="button" class="btn btn-primary">
            <i class="bi bi-save me-1"></i>Guardar Cambios
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Editar Contacto de Emergencia. tambien ocurre lo mismo al llamar el mismo campo en la parte del perfil -->
  <div class="modal fade" id="modalEditarContacto" tabindex="-1" aria-labelledby="modalEditarContactoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-warning text-dark">
          <h5 class="modal-title" id="modalEditarContactoLabel">
            <i class="bi bi-pencil-square me-2"></i>Editar Contacto de Emergencia
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="row">
              <!-- Columna izquierda -->
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="contactoNombre" class="form-label fw-bold"><i class="bi bi-person me-2"></i>Nombre</label>
                  <input type="text" class="form-control" id="contactoNombre" value="Juan Carlos" required>
                </div>

                <div class="mb-3">
                  <label for="contactoApellido" class="form-label fw-bold"><i class="bi bi-person me-2"></i>Apellido</label>
                  <input type="text" class="form-control" id="contactoApellido" value="Pérez Angulo" required>
                </div>

                <div class="mb-3">
                  <label for="contactoEmail" class="form-label fw-bold"><i class="bi bi-envelope me-2"></i>Email</label>
                  <input type="email" class="form-control" id="contactoEmail" value="juan.perez@correo.com">
                </div>
              </div>

              <!-- Columna derecha -->
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="contactoParentesco" class="form-label fw-bold"><i class="bi bi-heart me-2"></i>Parentesco</label>
                  <select class="form-select" id="contactoParentesco" required>
                    <option value="padre" selected>Padre</option>
                    <option value="madre">Madre</option>
                    <option value="hermano">Hermano/a</option>
                    <option value="tio">Tío/a</option>
                    <option value="abuelo">Abuelo/a</option>
                    <option value="otro">Otro</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label for="contactoTelefono" class="form-label fw-bold"><i class="bi bi-telephone me-2"></i>Teléfono</label>
                  <input type="tel" class="form-control" id="contactoTelefono" value="+57 300 123 4567" required>
                </div>

                <div class="mb-3">
                  <label for="contactoDireccion" class="form-label fw-bold"><i class="bi bi-geo-alt me-2"></i>Dirección</label>
                  <input type="text" class="form-control" id="contactoDireccion" value="Calle 123 #45-67, Barranquilla">
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="contactoObservaciones" class="form-label fw-bold"><i class="bi bi-chat-square-text me-2"></i>Observaciones</label>
              <textarea class="form-control" id="contactoObservaciones" rows="3" maxlength="200">Es el padre. Contactar en caso de emergencia médica.</textarea>
              <small class="text-muted">Máximo 200 caracteres</small>
            </div>

            <div class="alert alert-warning">
              <i class="bi bi-exclamation-triangle me-2"></i>
              <strong>Importante:</strong> Este contacto será notificado en caso de emergencia.
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="bi bi-x-circle me-1"></i>Cancelar
          </button>
          <button type="button" class="btn btn-warning">
            <i class="bi bi-save me-1"></i>Guardar Cambios
          </button>
        </div>
      </div>
    </div>
  </div>