<div id="borrarProfesorModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('borrarProfesorModal')">&times;</span>

    <h2>Borrar Profesor</h2>

    <form id="borrarProfesorForm">
      <div class="form-group">
        <label for="search_profesor_id2">Buscar por ID del Profesor:</label>
        <input type="number" id="search_profesor_id2" required>
        <button type="button" class="btn btn-info" onclick="buscarProfesorBorrar()">Buscar</button>
      </div>

      <hr>

      <div class="form-group">
        <label for="borrar_profesor_nombre">Nombre:</label>
        <input type="text" id="borrar_profesor_nombre" readonly>
      </div>

      <div class="form-group">
        <label for="borrar_profesor_apellido">Apellido:</label>
        <input type="text" id="borrar_profesor_apellido" readonly>
      </div>

      <div class="form-group">
        <label for="borrar_profesor_fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="borrar_profesor_fecha_nacimiento" readonly>
      </div>

      <div class="form-group">
        <label for="borrar_profesor_telefono">Teléfono:</label>
        <input type="text" id="borrar_profesor_telefono" readonly>
      </div>

      <div class="form-group">
        <label for="borrar_profesor_direccion">Dirección:</label>
        <input type="text" id="borrar_profesor_direccion" readonly>
      </div>

      <button type="submit" class="btn btn-danger">Borrar Profesor</button>
      <button type="button" class="btn btn-secondary" onclick="closeModal('borrarProfesorModal')">Cancelar</button>
    </form>
  </div>
</div>
