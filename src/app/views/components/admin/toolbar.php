<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gestión de Usuarios</title>
  <link href="../css/styles_modal.css" rel="stylesheet" />

</head>

<body>

  <div class="toolbar">
    <button class="btn btn-success" onclick="openCreateModal()">➕ Crear Usuario</button>
  </div>

  <!-- Modal Crear Usuario -->
  <div id="createModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('createModal')">&times;</span>
      <h2 class="mb-4">Registrar Nuevo Usuario</h2>
      <form method="POST" action="">
        <input type="hidden" name="action" value="create">

        <!-- Tipo de documento -->
        <div class="form-group">
          <label for="tipo_documento">Tipo de documento:</label>
          <select id="tipo_documento" name="tipo_documento" class="form-select" required>
            <option value="">Seleccione...</option>
            <option value="CC">Cédula de Ciudadanía</option>
            <option value="DE">Documento Extranjero</option>
          </select>
        </div>

        <!-- Número de documento -->
        <div class="form-group">
          <label for="numero_documento">Número de documento:</label>
          <input type="text" id="numero_documento" name="numero_documento" class="form-control" required>
        </div>

        <!-- Nombres -->
        <div class="form-group">
          <label for="nombres">Nombres:</label>
          <input type="text" id="nombres" name="nombres" class="form-control" required>
        </div>

        <!-- Apellidos -->
        <div class="form-group">
          <label for="apellidos">Apellidos:</label>
          <input type="text" id="apellidos" name="apellidos" class="form-control" required>
        </div>

        <!-- Edad -->
        <div class="form-group">
          <label for="edad">Edad:</label>
          <input type="number" id="edad" name="edad" min="0" class="form-control" required>
        </div>

        <!-- Teléfono -->
        <div class="form-group">
          <label for="telefono">Teléfono:</label>
          <input type="text" id="telefono" name="telefono" class="form-control" required>
        </div>

        <!-- Género -->
        <div class="form-group">
          <label for="genero">Género:</label>
          <select id="genero" name="genero" class="form-select" required>
            <option value="">Seleccione...</option>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
            <option value="Otro">Otro</option>
          </select>
        </div>

        <!-- Fecha de nacimiento -->
        <div class="form-group">
          <label for="fecha_nacimiento">Fecha de nacimiento:</label>
          <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" required>
        </div>

        <!-- Correo -->
        <div class="form-group">
          <label for="correo">Correo electrónico:</label>
          <input type="email" id="correo" name="correo" class="form-control" required>
        </div>

        <!-- Contraseña -->
        <div class="form-group">
          <label for="password">Contraseña:</label>
          <input type="password" id="password" name="password" class="form-control" required>
        </div>


        <div class="text-center mt-4">
          <button type="submit" class="btn btn-success px-4">Registrar Usuario</button>
          <button type="button" class="btn btn-secondary px-4" onclick="closeModal('createModal')">Cancelar</button>
        </div>
      </form>
    </div>
  </div>

  <script src="../js/modal.js"></script>

</body>
</html>
