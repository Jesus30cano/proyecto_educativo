<div id="edit_curso" class="modal_crear_curso">
  <div class="modal_crear_curso-content">
    <span class="close" onclick="closeModal('edit_curso')">&times;</span>
    <h2>Editar Curso</h2>

    <form method="POST" action="">
      <input type="hidden" name="action" value="edit">
      <input type="hidden" id="edit_curso_id" name="id_curso">

      <div class="form-group">
        <label for="edit_codigo">FICHA</label>
        <input type="text" id="edit_codigo" name="codigo" required>
      </div>

      <div class="form-group">
        <label for="edit_nombre">Nombre del Curso</label>
        <input type="text" id="edit_nombre" name="nombre" required>
      </div>

      <div class="form-group">
        <label for="edit_fecha_final">Fecha Final</label>
        <input type="date" id="edit_fecha_final" name="fecha_final" required>
      </div>

      <div class="form-group">
        <label for="edit_asignar_profesor_id">Asignar Profesor</label>
        <input type="number" id="edit_asignar_profesor_id" name="asignar_profesor_id" required>
        <button type="button" class="btn btn-info" onclick="buscarProfesorEditar()">Buscar</button>
      </div>

      <button type="submit" class="btn btn-success">Guardar Cambios</button>
      <button type="button" class="btn btn-secondary" onclick="closeModal('edit_curso')">Cancelar</button>
    </form>
  </div>
</div>
