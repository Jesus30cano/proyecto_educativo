<!-- Datos Personales -->
<div class="row">
  <div class="col-md-12 mb-4">
    <div class="card shadow border-0" style="border-radius: 15px; overflow: hidden;">
      <div class="card-header text-white py-4" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
        <h5 class="mb-0 d-flex align-items-center">
          <i class="fas fa-user-circle me-3" style="font-size: 1.5rem;"></i>
          Información Personal
        </h5>
      </div>

      <div class="card-body p-4" style="background: linear-gradient(to bottom, #f8f9fc 0%, #ffffff 100%);">
        <div class="row">
          <!-- Columna izquierda -->
          <div class="col-md-6">
            <div class="info-item mb-4">
              <label class="text-muted small mb-2 d-flex align-items-center">
                <i class="fas fa-user text-primary me-2"></i>Nombre
              </label>
              <p class="mb-0 h6 text-dark"><span id="nombre">-</span></p>
            </div>

            <div class="info-item mb-4">
              <label class="text-muted small mb-2 d-flex align-items-center">
                <i class="fas fa-user-tag text-primary me-2"></i>Apellidos
              </label>
              <p class="mb-0 h6 text-dark"><span id="apellido">-</span></p>
            </div>

            <div class="info-item mb-4">
              <label class="text-muted small mb-2 d-flex align-items-center">
                <i class="fas fa-envelope text-primary me-2"></i>Email
              </label>
              <p class="mb-0 h6 text-dark"><span id="correo">-</span></p>
            </div>

            <div class="info-item mb-4">
              <label class="text-muted small mb-2 d-flex align-items-center">
                <i class="fas fa-id-card text-primary me-2"></i>Tipo de Documento
              </label>
              <p class="mb-0 h6 text-dark"><span id="tipo_documento">-</span></p>
            </div>

            <div class="info-item">
              <label class="text-muted small mb-2 d-flex align-items-center">
                <i class="fas fa-hashtag text-primary me-2"></i>No. Documento
              </label>
              <p class="mb-0 h6 text-dark"><span id="numero_documento">-</span></p>
            </div>
          </div>

          <!-- Columna derecha -->
          <div class="col-md-6">
            <div class="info-item mb-4">
              <label class="text-muted small mb-2 d-flex align-items-center">
                <i class="fas fa-calendar-alt text-success me-2"></i>Fecha de Nacimiento
              </label>
              <p class="mb-0 h6 text-dark"><span id="fecha_nacimiento">-</span></p>
            </div>

            <div class="info-item mb-4">
              <label class="text-muted small mb-2 d-flex align-items-center">
                <i class="fas fa-phone text-success me-2"></i>Teléfono
              </label>
              <p class="mb-0 h6 text-dark"><span id="telefono">-</span></p>
            </div>

            <div class="info-item mb-4">
              <label class="text-muted small mb-2 d-flex align-items-center">
                <i class="fas fa-map-marker-alt text-success me-2"></i>Dirección
              </label>
              <p class="mb-0 h6 text-dark"><span id="direccion">-</span></p>
            </div>

            <div class="info-item mb-4">
              <label class="text-muted small mb-2 d-flex align-items-center">
                <i class="fas fa-venus-mars text-success me-2"></i>Género
              </label>
              <p class="mb-0 h6 text-dark"><span id="genero">-</span></p>
            </div>

            <div class="info-item">
              <label class="text-muted small mb-2 d-flex align-items-center">
                <i class="fas fa-shield-alt text-success me-2"></i>Estado de la Cuenta
              </label>
              <p class="mb-0">
                <span class="badge px-3 py-2" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); font-size: 0.9rem; border-radius: 20px;">
                  <i class="fas fa-check-circle me-1"></i>Activa
                </span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.info-item {
  padding: 12px 15px;
  background: white;
  border-radius: 10px;
  border-left: 3px solid #4facfe;
  transition: all 0.3s ease;
}

.info-item:hover {
  transform: translateX(5px);
  box-shadow: 0 2px 8px rgba(79, 172, 254, 0.15);
}

.info-item label i {
  font-size: 1.1rem;
}

.info-item p {
  color: #2d3748;
}
</style>

<!-- Título de Contactos de Emergencia -->
<div class="row">
  <div class="col-md-12 mb-4 mt-2">
    <div class="d-flex align-items-center">
      <div class="flex-grow-1" style="height: 2px; background: linear-gradient(to right, #f093fb 0%, #f5576c 100%);"></div>
      <h4 class="mx-3 mb-0 text-dark d-flex align-items-center">
        <i class="fas fa-exclamation-triangle text-warning me-2"></i>
        Contacto de Emergencia
      </h4>
      <div class="flex-grow-1" style="height: 2px; background: linear-gradient(to right, #f5576c 0%, #f093fb 100%);"></div>
    </div>
  </div>
</div>

<!-- Datos de emergencias -->
<div class="row">
  <div class="col-md-12 mb-4">
    <div class="card shadow border-0" style="border-radius: 15px; overflow: hidden;">
      <div class="card-header text-white py-4" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
        <h5 class="mb-0 d-flex align-items-center">
          <i class="fas fa-ambulance me-3" style="font-size: 1.5rem;"></i>
          Contacto de Emergencia
        </h5>
      </div>
      
      <div class="card-body p-4" style="background: linear-gradient(to bottom, #fff5f5 0%, #ffffff 100%);" id="contenedorContactos">
        <div class="contacto-emergencia">
          <div class="row">
            <!-- Columna izquierda -->
            <div class="col-md-6">
              <div class="info-item-emergency mb-4">
                <label class="text-muted small mb-2 d-flex align-items-center">
                  <i class="fas fa-user text-danger me-2"></i>Nombre
                </label>
                <p class="mb-0 h6 text-dark"><span id="emergencia_nombre">-</span></p>
              </div>

              <div class="info-item-emergency mb-4">
                <label class="text-muted small mb-2 d-flex align-items-center">
                  <i class="fas fa-user-tag text-danger me-2"></i>Apellido
                </label>
                <p class="mb-0 h6 text-dark"><span id="emergencia_apellido">-</span></p>
              </div>

              <div class="info-item-emergency mb-4">
                <label class="text-muted small mb-2 d-flex align-items-center">
                  <i class="fas fa-envelope text-danger me-2"></i>Email
                </label>
                <p class="mb-0 h6 text-dark"><span id="emergencia_correo">-</span></p>
              </div>

              <div class="info-item-emergency">
                <label class="text-muted small mb-2 d-flex align-items-center">
                  <i class="fas fa-heart text-danger me-2"></i>Parentesco
                </label>
                <p class="mb-0 h6 text-dark"><span id="emergencia_parentesco">-</span></p>
              </div>
            </div>

            <!-- Columna derecha -->
            <div class="col-md-6">
              <div class="info-item-emergency mb-4">
                <label class="text-muted small mb-2 d-flex align-items-center">
                  <i class="fas fa-phone text-warning me-2"></i>Teléfono
                </label>
                <p class="mb-0 h6 text-dark"><span id="emergencia_telefono">-</span></p>
              </div>

              <div class="info-item-emergency mb-4">
                <label class="text-muted small mb-2 d-flex align-items-center">
                  <i class="fas fa-map-marker-alt text-warning me-2"></i>Dirección
                </label>
                <p class="mb-0 h6 text-dark"><span id="emergencia_direccion">-</span></p>
              </div>

              <div class="info-item-emergency">
                <label class="text-muted small mb-2 d-flex align-items-center">
                  <i class="fas fa-comment-dots text-warning me-2"></i>Observaciones
                </label>
                <p class="mb-0 h6 text-dark"><span id="emergencia_observaciones">-</span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.info-item-emergency {
  padding: 12px 15px;
  background: white;
  border-radius: 10px;
  border-left: 3px solid #f5576c;
  transition: all 0.3s ease;
}

.info-item-emergency:hover {
  transform: translateX(5px);
  box-shadow: 0 2px 8px rgba(245, 87, 108, 0.15);
}

.info-item-emergency label i {
  font-size: 1.1rem;
}

.info-item-emergency p {
  color: #2d3748;
}
</style>