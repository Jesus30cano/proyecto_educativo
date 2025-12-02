<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gestión de Usuarios</title>
  <link href="/public/css/admin/styles_modal_cursoCR.css" rel="stylesheet" />
</head>
<body>

  <div class="toolbar mb-3">
    <button class="btn btn-success" onclick="openCreateCursoModal()">➕ Crear Curso</button>
    <button class="btn btn-warning" onclick="openEditCursoModal()">✏️ Editar Curso</button>
    <button class="btn btn-danger" onclick="openEliminarCursoModal()">🗑️ Eliminar Curso</button>
  </div>
  
  <!-- Modal crear curso -->
  <div id="create_curso" class="modal_crear_curso">
    <div class="modal_crear_curso-content">
      <span class="close" onclick="closeModal('create_curso')">&times;</span>
      <h2>Crear Curso</h2>
      <form id="createCursoForm">
        <input type="hidden" name="action" value="create">
        <input type="hidden" id="create_curso_id" name="id_curso">

        <div class="form-row">
          <div class="form-group">
            <label for="create_ficha">Ficha:</label>
            <input type="text" id="create_ficha" name="ficha" required>
          </div>

          <div class="form-group">
            <label for="create_nombre_combo">Nombre del Curso:</label>
            <select id="create_nombre_combo" name="nombre" required>
              <option value="">Selecciona curso...</option>
              <option value="ADSO">ADSO</option>
              <option value="Gestión Empresarial">Gestión Empresarial</option>
              <option value="SST">SST</option>
              <option value="Biología">Biología</option>
              <option value="Programación">Programación</option>
              <option value='Diseño Gráfico'>Diseño Gráfico</option>
              <option value='Marketing Digital'>Marketing Digital</option>
              <option value='Redes'>Redes</option>
              <option value='Electrónica'>Electrónica</option>
              <option value='Contabilidad'>Contabilidad</option>
              <option value='Matemáticas'>Matemáticas</option>
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="create_instructor_combo">Instructor Líder:</label>
            <select id="create_instructor_combo" name="instructor_lider" required>
              <option value="">Selecciona instructor...</option>
              <!-- Se llena vía JS -->
            </select>
          </div>

          <div class="form-group">
            <label for="create_fecha_inicio">Fecha de Inicio:</label>
            <input type="date" id="create_fecha_inicio" name="fecha_inicio" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="create_fecha_fin">Fecha Final:</label>
            <input type="date" id="create_fecha_fin" name="fecha_final" required>
          </div>
        </div>

        <div class="form-actions">
          <button type="submit" class="btn btn-success">Crear Curso</button>
          <button type="button" class="btn btn-secondary" onclick="closeModal('create_curso')">Cancelar</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal editar curso -->
  <div id="edit_curso" class="modal_crear_curso">
    <div class="modal_crear_curso-content">
      <span class="close" onclick="closeModal('edit_curso')">&times;</span>
      <h2>Editar Curso</h2>
      <form id="editCursoForm">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" id="edit_curso_id" name="id_curso">

        <!-- Sección de búsqueda -->
        <div class="search-section">
          <div class="form-group">
            <label for="edit_ficha">Buscar por Ficha:</label>
            <div class="search-input-group">
              <input type="text" id="edit_ficha" name="ficha" placeholder="Ingrese la ficha del curso" required>
              <button type="button" class="btn btn-info" onclick="buscarCursoPorFicha()">
                <i class="fas fa-search"></i> Buscar
              </button>
            </div>
          </div>
        </div>

        <hr>

        <!-- Información del curso en 2 columnas -->
        <div class="info-section">
          <h3>Información del Curso</h3>
          
          <div class="form-row">
            <div class="form-group">
              <label for="edit_nombre_combo">Nombre del Curso:</label>
              <select id="edit_nombre_combo" name="nombre" required>
                <option value="">Selecciona curso...</option>
                <option value="ADSO">ADSO</option>
                <option value="Gestión Empresarial">Gestión Empresarial</option>
                <option value="SST">SST</option>
                <option value="Biología">Biología</option>
                <option value="Programación">Programación</option>
                <option value='Diseño Gráfico'>Diseño Gráfico</option>
                <option value='Marketing Digital'>Marketing Digital</option>
                <option value='Redes'>Redes</option>
                <option value='Electrónica'>Electrónica</option>
                <option value='Contabilidad'>Contabilidad</option>
                <option value='Matemáticas'>Matemáticas</option>
              </select>
            </div>

            <div class="form-group">
              <label for="edit_instructor_combo">Instructor Líder:</label>
              <select id="edit_instructor_combo" name="instructor_lider" required>
                <option value="">Selecciona instructor...</option>
                <!-- Se llena vía JS -->
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="edit_fecha_inicio">Fecha de Inicio:</label>
              <input type="date" id="edit_fecha_inicio" name="fecha_inicio" required>
            </div>
            
            <div class="form-group">
              <label for="edit_fecha_fin">Fecha Final:</label>
              <input type="date" id="edit_fecha_fin" name="fecha_final" required>
            </div>
          </div>
        </div>

        <!-- Botones de acción -->
        <div class="form-actions">
          <button type="button" class="btn btn-secondary" onclick="closeModal('edit_curso')">Cancelar</button>
          <button type="submit" class="btn btn-warning">
            <i class="fas fa-save"></i> Guardar Cambios
          </button>
        </div>
      </form>
    </div>
  </div>
  <!-- Modal desactivar (eliminar) curso -->
  <div id="desactivar_curso_modal" class="modal_crear_curso">
    <div class="modal_crear_curso-content">
      <span class="close" onclick="closeModal('desactivar_curso_modal')">&times;</span>
      <h2>Desactivar Curso</h2>
      <form id="desactivarCursoForm">
        <!-- Sección de búsqueda -->
        <div class="search-section">
          <div class="form-group">
            <label for="desactivar_ficha">Ficha del Curso:</label>
            <input type="text" id="desactivar_ficha" name="ficha" placeholder="Ingrese la ficha del curso" required>
          </div>
        </div>

        <hr>

        <!-- Información adicional -->
        <div class="info-section">
          <h3>Información de Desactivación</h3>
          
          <div class="form-group">
            <label for="desactivar_mensaje">Motivo o mensaje (log):</label>
            <textarea id="desactivar_mensaje" name="mensaje" rows="4" required placeholder="Describe el motivo de la desactivación"></textarea>
          </div>
        </div>

        <!-- Botones de acción -->
        <div class="form-actions">
          <button type="button" class="btn btn-secondary" onclick="closeModal('desactivar_curso_modal')">Cancelar</button>
          <button type="submit" class="btn btn-danger">
            <i class="fas fa-ban"></i> Desactivar Curso
          </button>
        </div>
      </form>
    </div>
  </div>

  <script src="/public/js/admin/modal_curso.js"></script>
</body>
</html>