<div id="crearCompetenciaModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('crearCompetenciaModal')">&times;</span>

    <h2>Crear Competencia</h2>

    <form id="crearCompetenciaForm">
      <div class="form-row">
        <div class="form-group">
          <label for="crear_competencia_nombre">Nombre:</label>
          <input type="text" id="crear_competencia_nombre" name="nombre" required>
        </div>

        <div class="form-group">
          <label for="crear_competencia_codigo">Código:</label>
          <input type="text" id="crear_competencia_codigo" name="codigo" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="crear_competencia_descripcion">Descripción:</label>
          <input type="text" id="crear_competencia_descripcion" name="descripcion" required>
        </div>
      </div>

      <hr>

      <!-- Asignar instructor -->
      <div class="search-section">
        <h3>Asignar Instructor</h3>
        <div class="form-group">
          <label for="search_instructor_id">Buscar Instructor por ID:</label>
          <div class="search-input-group">
            <input type="number" id="search_instructor_id" name="search_instructor_id" placeholder="Ingrese el ID del instructor" required>
            <button type="button" class="btn btn-info" onclick="buscarInstructor()">
              <i class="fas fa-search"></i> Buscar
            </button>
          </div>
        </div>
      </div>

      <div class="info-section">
        <div class="form-group">
          <label for="crear_competencia_instructor">Instructor Asignado:</label>
          <input type="text" id="crear_competencia_instructor" name="instructor" readonly>
        </div>
      </div>

      <div class="form-actions">
        <button type="button" class="btn btn-secondary" onclick="closeModal('crearCompetenciaModal')">Cancelar</button>
        <button type="submit" class="btn btn-success">
          <i class="fas fa-save"></i> Guardar Competencia
        </button>
      </div>
    </form>
  </div>
</div>
