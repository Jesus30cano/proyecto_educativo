<div id="borrarProfesorModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('borrarProfesorModal')">&times;</span>

    <h2>Desactivar Profesor</h2>

    <form id="borrarProfesorForm">
      <!-- Sección de búsqueda -->
      <div class="search-section">
        <div class="form-group">
          <label for="search_profesor_id2">Buscar por ID del Profesor:</label>
          <div class="search-input-group">
            <input type="number" id="search_profesor_id2" placeholder="Ingrese el ID del profesor" required>
            <button type="button" class="btn btn-info" onclick="buscarProfesorBorrar()">
              <i class="fas fa-search"></i> Buscar
            </button>
          </div>
        </div>
      </div>

      <hr>

      <!-- Información del profesor en 2 columnas -->
      <div class="info-section">
        <h3>Información del Profesor</h3>
        
        <div class="form-row">
          <div class="form-group">
            <label for="borrar_profesor_nombre">Nombre:</label>
            <input type="text" id="borrar_profesor_nombre" readonly>
          </div>

          <div class="form-group">
            <label for="borrar_profesor_apellido">Apellido:</label>
            <input type="text" id="borrar_profesor_apellido" readonly>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="borrar_profesor_fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="borrar_profesor_fecha_nacimiento" readonly>
          </div>

          <div class="form-group">
            <label for="borrar_profesor_telefono">Teléfono:</label>
            <input type="text" id="borrar_profesor_telefono" readonly>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="borrar_profesor_direccion">Dirección:</label>
            <input type="text" id="borrar_profesor_direccion" readonly>
          </div>
        </div>
      </div>

      <!-- Botones de acción -->
      <div class="form-actions">
        <button type="button" class="btn btn-secondary" onclick="closeModal('borrarProfesorModal')">Cancelar</button>
        <button type="submit" class="btn btn-danger">
          <i class="fas fa-user-slash"></i> Desactivar Profesor
        </button>
      </div>
    </form>
  </div>
</div>
