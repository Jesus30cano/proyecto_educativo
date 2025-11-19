// BUSCAR ESTUDIANTE
function openEditEstudianteModal() {
    document.getElementById("edit_estudi").style.display = "block";
}

function closeModal(id) {
    document.getElementById(id).style.display = "none";
}

function buscarEstudiante() {
    let doc = document.getElementById("search_estudiante_doc").value.trim();

    if (doc === "") {
        alert("Debes ingresar un número de documento.");
        return;
    }

    // Ejemplo real con PHP:
    /*
    fetch("controllers/estudiantes.php?action=buscar&documento=" + doc)
        .then(res => res.json())
        .then(data => {
            if (!data.success) {
                alert("Estudiante no encontrado.");
                return;
            }
            cargarDatosEstudiante(data.estudiante);
        });
    */

    // SIMULACIÓN (BORRAR cuando uses PHP)
    let simulado = {
        tipo_documento: "cedula",
        numero_documento: doc,
        nombre: "Juan",
        apellido: "Martínez",
        edad: 15,
        correo: "juan@gmail.com"
    };

    cargarDatosEstudiante(simulado);
    alert("Estudiante encontrado (simulado).");
}


// Cargar en inputs
function cargarDatosEstudiante(e) {
    document.getElementById("edit_tipo_docu").value = e.tipo_documento;
    document.getElementById("edit_num_documento").value = e.numero_documento;
    document.getElementById("edit_nombre").value = e.nombre;
    document.getElementById("edit_apellido").value = e.apellido;
    document.getElementById("edit_edad").value = e.edad;
    document.getElementById("edit_correo").value = e.correo;

    // password no se carga por seguridad
}



// ACTUALIZAR ESTUDIANTE
document.getElementById("editEstudianteForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let formData = new FormData(this);
    let doc = document.getElementById("edit_num_documento").value;

    /*
    fetch("controllers/estudiantes.php?action=actualizar&documento=" + doc, {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert("Estudiante actualizado correctamente.");
            closeModal('edit_estudi');
        } else {
            alert("Error al actualizar.");
        }
    });
    */

    alert("Estudiante actualizado (simulado).");
    closeModal('edit_estudi');
});
