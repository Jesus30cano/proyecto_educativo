<div id="borrar_estudi" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('borrar_estudi')">&times;</span>
    <h2>Desactivar Estudiante</h2>
    <form id="borrarEstudianteForm">
      <!-- Sección de búsqueda -->
      <div class="search-section">
        <div class="form-group">
          <label for="search_estudiante_doc_b">Buscar por Número de Documento:</label>
          <div class="search-input-group">
            <input type="text" id="search_estudiante_doc_b" placeholder="Ingrese el número de documento" required>
            <button type="button" class="btn btn-info" onclick="buscarEstudianteBorrar()">
              <i class="fas fa-search"></i> Buscar
            </button>
          </div>
        </div>
      </div>

      <hr>

      <!-- Información del estudiante en 2 columnas -->
      <div class="info-section">
        <h3>Información del Estudiante</h3>
        
        <div class="form-row">
          <div class="form-group">
            <label for="borrar_tipo_docu">Tipo Documento:</label>
            <select id="borrar_tipo_docu" disabled>
              <option value="targe_identidad">Tarjeta de Identidad</option>
              <option value="cedula">Cédula de Ciudadanía</option>
              <option value="documento_extranjero">Documento Extranjero</option>
            </select>
          </div>

          <div class="form-group">
            <label for="borrar_num_documento">Número de Documento:</label>
            <input type="text" id="borrar_num_documento" readonly>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="borrar_nombre">Nombre:</label>
            <input type="text" id="borrar_nombre" readonly>
          </div>

          <div class="form-group">
            <label for="borrar_apellido">Apellido:</label>
            <input type="text" id="borrar_apellido" readonly>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="borrar_edad">Edad:</label>
            <input type="number" id="borrar_edad" readonly>
          </div>

          <div class="form-group">
            <label for="borrar_correo">Correo:</label>
            <input type="email" id="borrar_correo" readonly>
          </div>
        </div>
      </div>

      <!-- Botones de acción -->
      <div class="form-actions">
        <button type="button" class="btn btn-secondary" onclick="closeModal('borrar_estudi')">Cancelar</button>
        <button type="submit" class="btn btn-danger">
          <i class="fas fa-user-slash"></i> Desactivar Estudiante
        </button>
      </div>
    </form>
  </div>
</div>