<div id="borrarCompetenciaModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('borrarCompetenciaModal')">&times;</span>

    <h2>Borrar Competencia</h2>

    <form id="borrarCompetenciaForm">
      <!-- Campo editable para búsqueda -->
      <div class="form-group">
        <label for="search_competencia_id">Buscar por ID de la Competencia:</label>
        <input type="number" id="search_competencia_id" required>
        <button type="button" class="btn btn-info" onclick="buscarCompetenciaBorrar()">Buscar</button>
      </div>

      <hr>

      <!-- Campos solo para visualizar -->
      <div class="form-group">
        <label for="borrar_competencia_nombre">Nombre:</label>
        <input type="text" id="borrar_competencia_nombre" readonly>
      </div>

      <div class="form-group">
        <label for="borrar_competencia_fecha_inicio">Fecha de Inicio:</label>
        <input type="date" id="borrar_competencia_fecha_inicio" readonly>
      </div>

      <div class="form-group">
        <label for="borrar_competencia_fecha_fin">Fecha Final:</label>
        <input type="date" id="borrar_competencia_fecha_fin" readonly>
      </div>

      <div class="form-group">
        <label for="borrar_competencia_modalidad">Modalidad:</label>
        <input type="text" id="borrar_competencia_modalidad" readonly>
      </div>

      <button type="submit" class="btn btn-danger">Borrar Competencia</button>
      <button type="button" class="btn btn-secondary" onclick="closeModal('borrarCompetenciaModal')">Cancelar</button>
    </form>
  </div>
</div>
