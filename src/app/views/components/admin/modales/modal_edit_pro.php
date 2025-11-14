<div id="editProfesorModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('editProfesorModal')">&times;</span>
    
    <h2>Editar Profesor</h2>

    <form id="editProfesorForm" >
      <!-- Campo para buscar -->
      <div class="form-group">
        <label for="search_profesor_id">Buscar por ID del Profesor:</label>
        <input type="number" id="search_profesor_id" name="search_profesor_id" required>
        <button type="button" class="btn btn-info" onclick="buscarProfesor()">Buscar</button>
      </div>

      <hr>

      <div class="form-group">
        <label for="edit_profesor_nombre">Nombre:</label>
        <input type="text" id="edit_profesor_nombre" name="nombre" required>
      </div>
      
      <div class="form-group">
        <label for="edit_profesor_apellido">Apellido:</label>
        <input type="text" id="edit_profesor_apellido" name="apellido" required>
      </div>

      <div class="form-group">
        <label for="edit_profesor_fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="edit_profesor_fecha_nacimiento" name="fecha_nacimiento" required>
      </div>

     

      <div class="form-group">
        <label for="edit_profesor_telefono">Teléfono:</label>
        <input type="text" id="edit_profesor_telefono" name="telefono">
      </div>

      <div class="form-group">
        <label for="edit_profesor_direccion">Dirección:</label>
        <input type="text" id="edit_profesor_direccion" name="direccion">
      </div>

      <div class="form-group">
        <label for="edit_profesor_genero">Género:</label>
        <select id="edit_profesor_genero" name="genero" required>
          <option value="">Selecciona tu género</option>
          <option value="Masculino">Masculino</option>
          <option value="Femenino">Femenino</option>
          <option value="Otro">Otro</option>
        </select>
      </div>

      <button type="submit" class="btn btn-warning">Actualizar Profesor</button>
      <button type="button" class="btn btn-secondary" onclick="closeModal('editProfesorModal')">Cancelar</button>
    </form>
  </div>
</div>
