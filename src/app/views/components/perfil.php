<div class="row">
        <div class="col-md-12">
          <h4><i class="bi bi-list-task me-2"></i> Datos personales</h4>
          <hr>
        </div>
      </div>


      <!-- Datos Personales -->
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header bg-primary text-white">
              <span><i class="bi bi-person-badge me-2"></i></span> Información Personal
            </div>

            <div class="card-body">
              <div class="row">
                <!-- Columna izquierda -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-person me-2"></i>Nombre </label>
                    <p class="form-control-plaintext"><span id="nombre"></span></p> <!-- Nombre -->
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-person me-2"></i>Apellidos </label>
                    <p class="form-control-plaintext"><span id="apellido"></span></p> <!-- Apellido -->
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-envelope me-2"></i>Email</label>
                    <p class="form-control-plaintext"><span id="correo"></span></p> <!-- Correo  -->
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-card-text me-2"></i>Tipo de Documento</label>
                    <p class="form-control-plaintext"><span id="tipo_documento"></span></p> <!-- tipo de Documento -->
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-hash me-2"></i>No. Documento</label>
                    <p class="form-control-plaintext"><span id="numero_documento"></span></p> <!-- Numero de documento  -->
                  </div>
                </div>

                <!-- Columna derecha -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-calendar-event me-2"></i>Fecha de
                      Nacimiento</label>
                    <p class="form-control-plaintext"><span id="fecha_nacimiento"></span></p> <!-- Fecha de nacimiento -->
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-telephone me-2"></i>Teléfono</label>
                    <p class="form-control-plaintext"><span id="telefono"></span></p> <!-- Numero de telefono -->
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-geo-alt me-2"></i>Dirección</label>
                    <p class="form-control-plaintext"><span id="direccion"></span></p> <!-- Direccion -->
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-person me-2"></i>Género</label>
                    <p class="form-control-plaintext"><span id="genero"></span></p> <!-- Genero -->
                  </div>
                </div>
              </div>

              <hr>

              <div class="row">
                <div class="col-md-12">

                  <div class="mb-0">
                    <label class="form-label fw-bold"><i class="bi bi-shield-check me-2"></i>Estado de la Cuenta</label>
                    <p class="form-control-plaintext">
                      <span class="badge bg-success">Activa</span>
                    </p>
                  </div>
                </div>
              </div>

              
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <h4><i class="bi bi-list-task me-2"></i> Contacto de emergencias</h4>
          <hr>
        </div>
      </div>


      <!-- Datos de emergencias -->
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
              <span><i class="bi bi-exclamation-triangle me-2"></i>Contactos de Emergencia</span>
              
            </div>
            <div class="card-body" id="contenedorContactos">

              <!-- Contacto 1 -->
              <div class="contacto-emergencia">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h6 class="mb-0"><i class="bi bi-person-fill-exclamation me-2"></i>Contacto </h6>
                 
                  </button> <!-- Boton que elimina los contactos (el codigo se encuentra en contactos.js) -->
                </div>

                <div class="row">
                  <!-- Columna izquierda -->
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label fw-bold"><i class="bi bi-person me-2"></i>Nombre</label>
                      <p class="form-control-plaintext"><span id="emergencia_nombre"></span></p>
                      <!-- los parrafos estara la informacion del estudiante. asi sera en todos los demas abajo -->
                    </div>

                    <div class="mb-3">
                      <label class="form-label fw-bold"><i class="bi bi-person me-2"></i>Apellido</label>
                      <p class="form-control-plaintext"><span id="emergencia_apellido"></span></p>
                    </div>

                    <div class="mb-3">
                      <label class="form-label fw-bold"><i class="bi bi-envelope me-2"></i>Email</label>
                      <p class="form-control-plaintext"><span id="emergencia_correo"></span></p>
                    </div>
                  </div>

                  <!-- Columna derecha -->
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label fw-bold"><i class="bi bi-heart me-2"></i>Parentesco</label>
                      <p class="form-control-plaintext"><span id="emergencia_parentesco"></span></p>
                    </div>

                    <div class="mb-3">
                      <label class="form-label fw-bold"><i class="bi bi-telephone me-2"></i>Teléfono</label>
                      <p class="form-control-plaintext"><span id="emergencia_telefono"></span></p>
                    </div>

                    <div class="mb-3">
                      <label class="form-label fw-bold"><i class="bi bi-geo-alt me-2"></i>Dirección</label>
                      <p class="form-control-plaintext"><span id="emergencia_direccion"></span></p>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="mb-3">
                      <label class="form-label fw-bold"><i class="bi bi-chat-square-text me-2"></i>Observaciones</label>
                      <p class="form-control-plaintext"><span id="emergencia_observaciones"></span></p>
                    </div>
                  </div>
                </div>

               
              </div>