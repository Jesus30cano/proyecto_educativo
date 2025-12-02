<div id="borrarCompetenciaModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('borrarCompetenciaModal')">&times;</span>

    <h2>Borrar Competencia</h2>

    <form id="borrarCompetenciaForm">
      <!-- Campo editable para búsqueda -->
      <div class="search-section">
        <div class="form-group">
          <label for="search_competencia_id">Buscar por ID de la Competencia:</label>
          <div class="search-input-group">
            <input type="number" id="search_competencia_id" placeholder="Ingrese el ID de la competencia" required>
            <button type="button" class="btn btn-info" onclick="buscarCompetenciaBorrar()">
              <i class="fas fa-search"></i> Buscar
            </button>
          </div>
        </div>
      </div>

      <hr>

      <!-- Campos solo para visualizar -->
      <div class="info-section">
        <h3>Información de la Competencia</h3>
        
        <div class="form-row">
          <div class="form-group">
            <label for="borrar_competencia_nombre">Nombre:</label>
            <input type="text" id="borrar_competencia_nombre" readonly>
          </div>

          <div class="form-group">
            <label for="borrar_competencia_modalidad">Modalidad:</label>
            <input type="text" id="borrar_competencia_modalidad" readonly>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="borrar_competencia_fecha_inicio">Fecha de Inicio:</label>
            <input type="date" id="borrar_competencia_fecha_inicio" readonly>
          </div>

          <div class="form-group">
            <label for="borrar_competencia_fecha_fin">Fecha Final:</label>
            <input type="date" id="borrar_competencia_fecha_fin" readonly>
          </div>
        </div>
      </div>

      <div class="form-actions">
        <button type="button" class="btn btn-secondary" onclick="closeModal('borrarCompetenciaModal')">Cancelar</button>
        <button type="submit" class="btn btn-danger">
          <i class="fas fa-trash"></i> Borrar Competencia
        </button>
      </div>
    </form>
  </div>
</div>
