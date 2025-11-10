<div id="editProfesorModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('editProfesorModal')">&times;</span>
    
    <h2>Editar Profesor</h2>

    <form id="editProfesorForm" method="POST" action="">
      <input type="hidden" name="action" value="update">
      <input type="hidden" id="edit_profesor_id" name="id_profesor">

      <!-- Campo para buscar -->
      <div class="form-group">
        <label for="search_profesor_id">Buscar por ID del Profesor:</label>
        <input type="number" id="search_profesor_id" name="search_profesor_id" required>
        <button type="button" class="btn btn-info" onclick="buscarProfesor()">Buscar</button>
      </div>

      <hr>

      <div class="form-group">
        <label for="edit_profesor_nombre">Nombre Completo:</label>
        <input type="text" id="edit_profesor_nombre" name="nombre" required>
      </div>

      <div class="form-group">
        <label for="edit_profesor_correo">Correo:</label>
        <input type="email" id="edit_profesor_correo" name="correo" required>
      </div>

      <div class="form-group">
        <label for="edit_profesor_telefono">Teléfono:</label>
        <input type="text" id="edit_profesor_telefono" name="telefono">
      </div>

      <div class="form-group">
        <label for="edit_profesor_especialidad">Especialidad:</label>
        <input type="text" id="edit_profesor_especialidad" name="especialidad">
      </div>

      <div class="form-group">
        <label for="edit_profesor_estado">Estado:</label>
        <select id="edit_profesor_estado" name="estado" required>
          <option value="activo">Activo</option>
          <option value="inactivo">Inactivo</option>
        </select>
      </div>

      <button type="submit" class="btn btn-warning">Actualizar Profesor</button>
      <button type="button" class="btn btn-secondary" onclick="closeModal('editProfesorModal')">Cancelar</button>
    </form>
  </div>
</div>
