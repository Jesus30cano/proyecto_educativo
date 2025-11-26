<div id="editCompetenciaModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('editCompetenciaModal')">&times;</span>

    <h2>Editar Competencia</h2>

    <form id="editCompetenciaForm">
      <!-- Buscar competencia -->
      <div class="form-group">
        <label for="search_competencia_id">Buscar por ID de la Competencia:</label>
        <input type="number" id="search_competencia_id" required>
        <button type="button" class="btn btn-info" onclick="buscarCompetenciaEditar()">Buscar</button>
      </div>

      <hr>

      <!-- Campos editables -->
      <div class="form-group">
        <label for="edit_competencia_nombre">Nombre:</label>
        <input type="text" id="edit_competencia_nombre" name="nombre" required>
      </div>

      <div class="form-group">
        <label for="edit_competencia_fecha_inicio">Fecha de Inicio:</label>
        <input type="date" id="edit_competencia_fecha_inicio" name="fecha_inicio" required>
      </div>

      <div class="form-group">
        <label for="edit_competencia_fecha_fin">Fecha Final:</label>
        <input type="date" id="edit_competencia_fecha_fin" name="fecha_fin" required>
      </div>

      <div class="form-group">
        <label for="edit_competencia_modalidad">Modalidad:</label>
        <input type="text" id="edit_competencia_modalidad" name="modalidad" required>
      </div>

      <hr>

      <!-- Asignar instructor -->
      <div class="form-group">
        <label for="search_instructor_id_edit">Asignar Instructor (buscar por ID):</label>
        <input type="number" id="search_instructor_id_edit" required>
        <button type="button" class="btn btn-info" onclick="buscarInstructorEditar()">Buscar</button>
      </div>

      <div class="form-group">
        <label for="edit_competencia_instructor">Instructor:</label>
        <input type="text" id="edit_competencia_instructor" readonly>
      </div>

      <button type="submit" class="btn btn-warning">Actualizar Competencia</button>
      <button type="button" class="btn btn-secondary" onclick="closeModal('editCompetenciaModal')">Cancelar</button>
    </form>
  </div>
</div>
