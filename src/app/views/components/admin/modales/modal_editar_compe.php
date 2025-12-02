<div id="editCompetenciaModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('editCompetenciaModal')">&times;</span>

    <h2>Editar Competencia</h2>

    <form id="editCompetenciaForm">
      <!-- Buscar competencia -->
      <div class="search-section">
        <div class="form-group">
          <label for="search_competencia_id">Buscar por ID de la Competencia:</label>
          <div class="search-input-group">
            <input type="number" id="search_competencia_id" placeholder="Ingrese el ID de la competencia" required>
            <button type="button" class="btn btn-info" onclick="buscarCompetenciaEditar()">
              <i class="fas fa-search"></i> Buscar
            </button>
          </div>
        </div>
      </div>

      <hr>

      <!-- Campos editables -->
      <div class="info-section">
        <h3>Información de la Competencia</h3>
        
        <div class="form-row">
          <div class="form-group">
            <label for="edit_competencia_nombre">Nombre:</label>
            <input type="text" id="edit_competencia_nombre" name="nombre" required>
          </div>

          <div class="form-group">
            <label for="edit_competencia_codigo">Código:</label>
            <input type="text" id="edit_competencia_codigo" name="codigo" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="edit_competencia_descripcion">Descripción:</label>
            <input type="text" id="edit_competencia_descripcion" name="descripcion" required>
          </div>
        </div>
      </div>

      <hr>

      <!-- Asignar instructor -->
      <div class="search-section">
        <h3>Asignar Instructor</h3>
        <div class="form-group">
          <label for="search_instructor_id_edit">Buscar Instructor por ID:</label>
          <div class="search-input-group">
            <input type="number" id="search_instructor_id_edit" placeholder="Ingrese el ID del instructor" required>
            <button type="button" class="btn btn-info" onclick="buscarInstructorEditar()">
              <i class="fas fa-search"></i> Buscar
            </button>
          </div>
        </div>
      </div>

      <div class="info-section">
        <div class="form-group">
          <label for="edit_competencia_instructor">Instructor Asignado:</label>
          <input type="text" id="edit_competencia_instructor" readonly>
        </div>
      </div>

      <div class="form-actions">
        <button type="button" class="btn btn-secondary" onclick="closeModal('editCompetenciaModal')">Cancelar</button>
        <button type="submit" class="btn btn-warning">
          <i class="fas fa-save"></i> Actualizar Competencia
        </button>
      </div>
    </form>
  </div>
</div>
