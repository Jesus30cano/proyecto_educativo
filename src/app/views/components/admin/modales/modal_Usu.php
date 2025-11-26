<div id="editUsuarioModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('editUsuarioModal')">&times;</span>

    <h2>Editar Usuario</h2>

    <form id="editUsuarioForm">
      <!-- Campo para buscar -->
      <div class="form-group">
        <label for="search_usuario_id">Buscar por ID del Usuario:</label>
        <input type="number" id="search_usuario_id" name="search_usuario_id" required>
        <button type="button" class="btn btn-info" onclick="buscarUsuario()">Buscar</button>
      </div>

      <hr>
      <div class="form-group">
        <label for="edit_usuario_nombre">Nombre:</label>
        <input type="text" id="edit_usuario_nombre" name="nombre" disabled>
      </div>

      <div class="form-group">
        <label for="edit_usuario_apellido">Apellido:</label>
        <input type="text" id="edit_usuario_apellido" name="apellido" disabled>
      </div>

      <div class="form-group">
        <label for="edit_usuario_genero">Género:</label>
        <input type="text" id="edit_usuario_genero" name="genero" disabled>
      </div>


      <div class="form-group">
        <label for="edit_usuario_correo">Correo:</label>
        <input type="email" id="edit_usuario_correo" name="correo" required>
      </div>

      <div class="form-group">
        <label for="edit_usuario_password">Contraseña:</label>
        <input type="password" id="edit_usuario_password" name="password" required>
      </div>

      <button type="submit" class="btn btn-warning">Actualizar Usuario</button>
      <button type="button" class="btn btn-secondary" onclick="closeModal('editUsuarioModal')">Cancelar</button>
    </form>
  </div>
</div>