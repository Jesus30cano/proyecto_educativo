<div id="edit_estudi" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('edit_estudi')">&times;</span>
    <h2>Editar Estudiante</h2>

    <form id="editEstudianteForm">

      <!-- Buscar estudiante -->
      <div class="form-group">
        <label for="search_estudiante_doc">Buscar por Número de Documento:</label>
        <input type="text" id="search_estudiante_doc" required>
        <button type="button" class="btn btn-info" onclick="buscarEstudiante()">Buscar</button>
      </div>

      <hr>

      <div class="form-group">
        <label for="edit_tipo_docu">TIPO DOCUMENTO</label>
        <select id="edit_tipo_docu" name="tipo_documento" required>
          <option value="targe_identidad">TARJETA IDENTIDAD</option>
          <option value="cedula">CEDULA DE CIUDADANIA</option>
          <option value="documento_extranjero">DOCUMENTO EXTRANJERO</option>
        </select>
      </div>

      <div class="form-group">
        <label for="edit_num_documento">NÚMERO DE DOCUMENTO</label>
        <input type="text" id="edit_num_documento" name="numero_documento" required readonly>
      </div>

      <div class="form-group">
        <label for="edit_nombre">NOMBRE</label>
        <input type="text" id="edit_nombre" name="nombre" required>
      </div>

      <div class="form-group">
        <label for="edit_apellido">APELLIDO</label>
        <input type="text" id="edit_apellido" name="apellido" required>
      </div>

      <div class="form-group">
        <label for="edit_edad">EDAD</label>
        <input type="number" id="edit_edad" name="edad" min="1" max="120" required>
      </div>

      <button type="submit" class="btn btn-warning">Actualizar Estudiante</button>
      <button type="button" class="btn btn-secondary" onclick="closeModal('edit_estudi')">Cancelar</button>

    </form>
  </div>
</div>
