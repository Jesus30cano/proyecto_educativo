<!-- Datos Personales -->
<div class="row">
  <div class="col-md-12 mb-4">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="bi bi-person-badge me-2"></i>Información Personal</h5>
      </div>

      <div class="card-body p-4">
        <div class="row">
          <!-- Columna izquierda -->
          <div class="col-md-6">
            <div class="mb-3 pb-3 border-bottom">
              <label class="text-muted small mb-1">
                <i class="bi bi-person me-2"></i>Nombre
              </label>
              <p class="mb-0 fw-bold"><span id="nombre">-</span></p>
            </div>

            <div class="mb-3 pb-3 border-bottom">
              <label class="text-muted small mb-1">
                <i class="bi bi-person me-2"></i>Apellidos
              </label>
              <p class="mb-0 fw-bold"><span id="apellido">-</span></p>
            </div>

            <div class="mb-3 pb-3 border-bottom">
              <label class="text-muted small mb-1">
                <i class="bi bi-envelope me-2"></i>Email
              </label>
              <p class="mb-0 fw-bold"><span id="correo">-</span></p>
            </div>

            <div class="mb-3 pb-3 border-bottom">
              <label class="text-muted small mb-1">
                <i class="bi bi-card-text me-2"></i>Tipo de Documento
              </label>
              <p class="mb-0 fw-bold"><span id="tipo_documento">-</span></p>
            </div>

            <div class="mb-3">
              <label class="text-muted small mb-1">
                <i class="bi bi-hash me-2"></i>No. Documento
              </label>
              <p class="mb-0 fw-bold"><span id="numero_documento">-</span></p>
            </div>
          </div>

          <!-- Columna derecha -->
          <div class="col-md-6">
            <div class="mb-3 pb-3 border-bottom">
              <label class="text-muted small mb-1">
                <i class="bi bi-calendar-event me-2"></i>Fecha de Nacimiento
              </label>
              <p class="mb-0 fw-bold"><span id="fecha_nacimiento">-</span></p>
            </div>

            <div class="mb-3 pb-3 border-bottom">
              <label class="text-muted small mb-1">
                <i class="bi bi-telephone me-2"></i>Teléfono
              </label>
              <p class="mb-0 fw-bold"><span id="telefono">-</span></p>
            </div>

            <div class="mb-3 pb-3 border-bottom">
              <label class="text-muted small mb-1">
                <i class="bi bi-geo-alt me-2"></i>Dirección
              </label>
              <p class="mb-0 fw-bold"><span id="direccion">-</span></p>
            </div>

            <div class="mb-3 pb-3 border-bottom">
              <label class="text-muted small mb-1">
                <i class="bi bi-gender-ambiguous me-2"></i>Género
              </label>
              <p class="mb-0 fw-bold"><span id="genero">-</span></p>
            </div>

            <div class="mb-3">
              <label class="text-muted small mb-1">
                <i class="bi bi-shield-check me-2"></i>Estado de la Cuenta
              </label>
              <p class="mb-0">
                <span class="badge bg-success px-3 py-2">
                  <i class="bi bi-check-circle me-1"></i>Activa
                </span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Título de Contactos de Emergencia -->
<div class="row">
  <div class="col-md-12 mb-3">
    <h4><i class="bi bi-exclamation-triangle me-2"></i>Contacto de Emergencia</h4>
    <hr>
  </div>
</div>

<!-- Datos de emergencias -->
<div class="row">
  <div class="col-md-12 mb-4">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-warning">
        <h5 class="mb-0">
          <i class="bi bi-person-fill-exclamation me-2 text-white"></i>Contacto de Emergencia
        </h5>
      </div>
      
      <div class="card-body p-4" id="contenedorContactos">
        <div class="contacto-emergencia">
          <div class="row">
            <!-- Columna izquierda -->
            <div class="col-md-6">
              <div class="mb-3 pb-3 border-bottom">
                <label class="text-muted small mb-1">
                  <i class="bi bi-person me-2"></i>Nombre
                </label>
                <p class="mb-0 fw-bold"><span id="emergencia_nombre">-</span></p>
              </div>

              <div class="mb-3 pb-3 border-bottom">
                <label class="text-muted small mb-1">
                  <i class="bi bi-person me-2"></i>Apellido
                </label>
                <p class="mb-0 fw-bold"><span id="emergencia_apellido">-</span></p>
              </div>

              <div class="mb-3 pb-3 border-bottom">
                <label class="text-muted small mb-1">
                  <i class="bi bi-envelope me-2"></i>Email
                </label>
                <p class="mb-0 fw-bold"><span id="emergencia_correo">-</span></p>
              </div>

              <div class="mb-3">
                <label class="text-muted small mb-1">
                  <i class="bi bi-heart me-2"></i>Parentesco
                </label>
                <p class="mb-0 fw-bold"><span id="emergencia_parentesco">-</span></p>
              </div>
            </div>

            <!-- Columna derecha -->
            <div class="col-md-6">
              <div class="mb-3 pb-3 border-bottom">
                <label class="text-muted small mb-1">
                  <i class="bi bi-telephone me-2"></i>Teléfono
                </label>
                <p class="mb-0 fw-bold"><span id="emergencia_telefono">-</span></p>
              </div>

              <div class="mb-3 pb-3 border-bottom">
                <label class="text-muted small mb-1">
                  <i class="bi bi-geo-alt me-2"></i>Dirección
                </label>
                <p class="mb-0 fw-bold"><span id="emergencia_direccion">-</span></p>
              </div>

              <div class="mb-3">
                <label class="text-muted small mb-1">
                  <i class="bi bi-chat-square-text me-2"></i>Observaciones
                </label>
                <p class="mb-0 fw-bold"><span id="emergencia_observaciones">-</span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>