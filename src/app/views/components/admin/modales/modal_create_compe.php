<div id="crearCompetenciaModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('crearCompetenciaModal')">&times;</span>

    <h2>Crear Competencia</h2>

    <form id="crearCompetenciaForm">
      <div class="form-group">
        <label for="crear_competencia_nombre">Nombre:</label>
        <input type="text" id="crear_competencia_nombre" name="nombre" required>
      </div>

      <div class="form-group">
        <label for="crear_competencia_codigo">Codigo:</label>
        <input type="text" id="crear_competencia_codigo" name="codigo" required>
      </div>

      <div class="form-group">
        <label for="crear_competencia_descripcion">Descripcion:</label>
        <input type="text" id="crear_competencia_descripcion" name="descripcion" required>
      </div>

     

      <hr>

      <!-- Asignar instructor -->
      <div class="form-group">
        <label for="search_instructor_id">Asignar Instructor (buscar por ID):</label>
        <input type="number" id="search_instructor_id" name="search_instructor_id" required>
        <button type="button" class="btn btn-info" onclick="buscarInstructor()">Buscar</button>
      </div>

      <div class="form-group">
        <label for="crear_competencia_instructor">Instructor:</label>
        <input type="text" id="crear_competencia_instructor" name="instructor" readonly>
      </div>

      <button type="submit" class="btn btn-success">Guardar Competencia</button>
      <button type="button" class="btn btn-secondary" onclick="closeModal('crearCompetenciaModal')">Cancelar</button>
    </form>
  </div>
</div>
