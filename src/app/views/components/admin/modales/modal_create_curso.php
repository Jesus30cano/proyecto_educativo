<div id="create_curso" class="modal_crear_curso">
  <div class="modal_crear_curso-content">
    <span class="close" onclick="closeModal('create_curso')">&times;</span>
    
    <h2>Crear Curso</h2>
    <form method="POST" action="">
      <input type="hidden" name="action" value="create">
      <input type="hidden" id="create_curso_id" name="id_curso">

      <div class="form-group">
        <label for="create_codigo">Código del Curso</label>
        <input type="text" id="create_codigo" name="codigo" required>
      </div>

      <div class="form-group">
        <label for="create_nombre">Nombre del Curso</label>
        <input type="text" id="create_nombre" name="nombre" required>
      </div>

      <div class="form-group">
        <label for="create_fecha_final">Fecha Final</label>
        <input type="date" id="create_fecha_final" name="fecha_final" required>
      </div>

      <div class="form-group">
        <label for="asignar_profesor_id">Asignar Profesor</label>
        <input type="number" id="asignar_profesor_id" name="asignar_profesor_id" required>
        <button type="button" class="btn btn-info" onclick="buscarProfesor()">Buscar</button>
      </div>

      <button type="submit" class="btn btn-success">Crear Curso</button>
      <button type="button" class="btn btn-secondary" onclick="closeModal('create_curso')">Cancelar</button>
    </form>
  </div>
</div>
