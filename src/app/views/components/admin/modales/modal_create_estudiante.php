<div id="create_estudi" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('create_estudi')">&times;</span>
    <h2>Crear Nuevo Estudiante</h2>
    <form method="POST" action="">
      <input type="hidden" name="action" value="create">

      <div class="form-group">
        <label for="create_tipo_docu">TIPO DOCUMENTO</label>
        <select id="create_tipo_docu" name="tipo_documento" required>
          <option value="targe_identidad">TARJETA IDENTIDAD</option>
          <option value="cedula">CEDULA DE CIUDADANIA</option>
          <option value="documento_extranjero">DOCUMENTO EXTRANJERO</option>
        </select>
      </div>

      <div class="form-group">
        <label for="create_num_documento">NÚMERO DE DOCUMENTO</label>
        <input type="text" id="create_num_documento" name="numero_documento" required>
      </div>

      <div class="form-group">
        <label for="create_nombre">NOMBRE</label>
        <input type="text" id="create_nombre" name="nombre" required>
      </div>

      <div class="form-group">
        <label for="create_apellido">APELLIDO</label>
        <input type="text" id="create_apellido" name="apellido" required>
      </div>

      <div class="form-group">
        <label for="create_edad">EDAD</label>
        <input type="number" id="create_edad" name="edad" min="1" max="120" required>
      </div>

      <div class="form-group">
        <label for="create_correo">CORREO ELECTRÓNICO</label>
        <input type="email" id="create_correo" name="correo" required>
      </div>

      <div class="form-group">
        <label for="create_password">CONTRASEÑA</label>
        <input type="password" id="create_password" name="password" required>
      </div>

      <button type="submit" class="btn btn-success">Crear Estudiante</button>
      <button type="button" class="btn btn-secondary" onclick="closeModal('create_estudi')">Cancelar</button>
    </form>
  </div>
</div>