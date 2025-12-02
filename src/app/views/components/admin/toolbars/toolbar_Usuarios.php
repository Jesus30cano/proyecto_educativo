<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gestión de Usuarios</title>
  <link href="/public/css/admin/styles_modal_profeCR.css" rel="stylesheet" />

</head>

<body>

  <div class="toolbar mb-4"> 

 
    <button class="btn btn-warning btn-modern" onclick="openEditUsuarioModal()">
      <i class="fas fa-edit mr-2"></i>Editar Usuario
    </button>

  </div>


<div id="editUsuarioModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('editUsuarioModal')">&times;</span>

    <h2>Editar Usuario</h2>

    <form id="editUsuarioForm">
      <!-- Campo para buscar -->
      <div class="search-section">
        <div class="form-group">
          <label for="search_usuario_id">Buscar por ID del Usuario:</label>
          <div class="search-input-group">
            <input type="number" id="search_usuario_id" name="search_usuario_id" placeholder="Ingrese el ID del usuario" required>
            <button type="button" class="btn btn-info" onclick="buscarUsuario()">
              <i class="fas fa-search"></i> Buscar
            </button>
          </div>
        </div>
      </div>

      <hr>

      <div class="info-section">
        <h3>Información del Usuario</h3>
        
        <div class="form-row">
          <div class="form-group">
            <label for="edit_usuario_nombre">Nombre:</label>
            <input type="text" id="edit_usuario_nombre" name="nombre" disabled>
          </div>

          <div class="form-group">
            <label for="edit_usuario_apellido">Apellido:</label>
            <input type="text" id="edit_usuario_apellido" name="apellido" disabled>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="edit_usuario_correo">Correo:</label>
            <input type="email" id="edit_usuario_correo" name="correo" required>
          </div>

          <div class="form-group">
            <label for="edit_usuario_password">Contraseña:</label>
            <input type="password" id="edit_usuario_password" name="password" placeholder="Dejar vacío para no cambiar">
          </div>
        </div>
      </div>

      <div class="form-actions">
        <button type="button" class="btn btn-secondary" onclick="closeModal('editUsuarioModal')">Cancelar</button>
        <button type="submit" class="btn btn-warning">
          <i class="fas fa-save"></i> Actualizar Usuario
        </button>
      </div>
    </form>
  </div>
</div>



  

</body>
</html>