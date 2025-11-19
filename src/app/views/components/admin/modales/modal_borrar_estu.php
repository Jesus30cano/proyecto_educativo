<div id="borrar_estudi" class="modal">
    <div class="modal-content"> <span class="close" onclick="closeModal('borrar_estudi')">&times;</span>
        <h2>Eliminar Estudiante</h2>
        <form id="borrarEstudianteForm"> <!-- Buscar -->
            <div class="form-group"> <label for="search_estudiante_doc_b">Buscar por Número de Documento:</label> <input type="text" id="search_estudiante_doc_b" required> <button type="button" class="btn btn-info" onclick="buscarEstudianteBorrar()">Buscar</button> </div>
            <hr>
            <div class="form-group"> <label for="borrar_tipo_docu">TIPO DOCUMENTO</label> <select id="borrar_tipo_docu" disabled>
                    <option value="targe_identidad">TARJETA IDENTIDAD</option>
                    <option value="cedula">CEDULA DE CIUDADANIA</option>
                    <option value="documento_extranjero">DOCUMENTO EXTRANJERO</option>
                </select> </div>
            <div class="form-group"> <label for="borrar_num_documento">NÚMERO DE DOCUMENTO</label> <input type="text" id="borrar_num_documento" readonly> </div>
            <div class="form-group"> <label for="borrar_nombre">NOMBRE</label> <input type="text" id="borrar_nombre" readonly> </div>
            <div class="form-group"> <label for="borrar_apellido">APELLIDO</label> <input type="text" id="borrar_apellido" readonly> </div>
            <div class="form-group"> <label for="borrar_edad">EDAD</label> <input type="number" id="borrar_edad" readonly> </div>
            <div class="form-group"> <label for="borrar_correo">CORREO</label> <input type="email" id="borrar_correo" readonly> </div> <button type="submit" class="btn btn-danger">Eliminar Estudiante</button> <button type="button" class="btn btn-secondary" onclick="closeModal('borrar_estudi')">Cancelar</button>
        </form>
    </div>
</div>