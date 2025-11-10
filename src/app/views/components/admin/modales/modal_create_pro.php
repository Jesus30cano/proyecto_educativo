<div id="createModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('createModal')">&times;</span>
    <h2>Crear Nuevo PROFESOR</h2>
    <form method="POST" action="">
      <input type="hidden" name="action" value="create">

      <div class="form-group">
        <label for="create_username">Usuario:</label>
        <input type="text" id="create_username" name="username" required>
      </div>

      <div class="form-group">
        <label for="create_correo">Correo:</label>
        <input type="email" id="create_correo" name="correo" required>
      </div>

      <div class="form-group">
        <label for="create_password">Contraseña:</label>
        <input type="password" id="create_password" name="password" required>
      </div>

      <div class="form-group">
        <label for="create_rol">Rol:</label>
        <select id="create_rol" name="rol" required>
          <option value="docente">Docente</option>
        </select>
      </div>

      <button type="submit" class="btn btn-success">Crear Profesor</button>
      <button type="button" class="btn btn-secondary" onclick="closeModal('createModal')">Cancelar</button>
    </form>
  </div>
</div>
