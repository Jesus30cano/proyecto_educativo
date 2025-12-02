<div id="createModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('createModal')">&times;</span>
    <h2>Crear Nuevo PROFESOR</h2>
    <form id="createForm">
      <div class="form-row">
        <div class="form-group" id="tipo_documento_group">
          <label for="tipo_documento">Tipo de Documento:</label>
          <select name="tipo_documento" id="tipo_documento" required>
            <option value="">Selecciona tu tipo de documento</option>
            <option value="cedula_de_ciudadania">Cédula de Ciudadanía</option>
            <option value="tarjeta_identidad">Tarjeta de Identidad</option>
            <option value="cedula_extranjeria">Cédula de Extranjería</option>
          </select>
        </div>

        <div class="form-group">
          <label for="create_cedula">Cédula:</label>
          <input type="text" id="create_cedula" name="cedula" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="create_nombre">Nombre:</label>
          <input type="text" id="create_nombre" name="nombre" required>
        </div>

        <div class="form-group">
          <label for="create_apellido">Apellido:</label>
          <input type="text" id="create_apellido" name="apellido" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="create_correo">Correo:</label>
          <input type="email" id="create_correo" name="correo" required>
        </div>

        <div class="form-group">
          <label for="create_password">Contraseña:</label>
          <input type="password" id="create_password" name="password" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="create_fecha_nacimiento">Fecha de Nacimiento:</label>
          <input type="date" id="create_fecha_nacimiento" name="fecha_nacimiento" required>
        </div>

        <div class="form-group">
          <label for="create_genero">Género:</label>
          <select id="create_genero" name="genero" required>
            <option value="">Selecciona tu género</option>
            <option value="masculino">Masculino</option>
            <option value="femenino">Femenino</option>
            <option value="otro">Otro</option>
          </select>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="create_telefono">Teléfono:</label>
          <input type="text" id="create_telefono" name="telefono" required>
        </div>

        <div class="form-group">
          <label for="create_direccion">Dirección:</label>
          <input type="text" id="create_direccion" name="direccion" required>
        </div>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-success">Crear Profesor</button>
        <button type="button" class="btn btn-secondary" onclick="closeModal('createModal')">Cancelar</button>
      </div>
    </form>
  </div>
</div>
