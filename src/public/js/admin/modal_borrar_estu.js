// -----------------------------
// ABRIR MODAL
// -----------------------------
function openEliminarEstudianteModal() {
    const modal = document.getElementById("borrar_estudi");
    if (modal) {
        modal.style.display = "block";
    } else {
        console.error("❌ No se encontró el modal borrar_estudi");
    }
}

// -----------------------------
// CERRAR MODAL
// -----------------------------
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = "none";
    } else {
        console.error("❌ No se encontró el modal:", modalId);
    }
}

// Cerrar modal si el usuario hace clic fuera del contenido
window.onclick = function(e) {
    const modal = document.getElementById("borrar_estudi");
    if (e.target === modal) {
        modal.style.display = "none";
    }
};

// -----------------------------
// BUSCAR ESTUDIANTE PARA BORRAR
// -----------------------------
function buscarEstudianteBorrar() {
    const documento = document.getElementById("search_estudiante_doc_b").value.trim();

    if (documento === "") {
        alert("⚠ Debes ingresar un número de documento");
        return;
    }

    // 🔥 Aquí harás la consulta real con AJAX (Fetch)
    fetch(`/controllers/EstudiantesController.php?action=buscar&documento=${documento}`)
        .then(response => response.json())
        .then(data => {

            if (!data || data.error) {
                alert("❌ Estudiante no encontrado");
                limpiarCamposBorrar();
                return;
            }

            // Rellenar los campos
            document.getElementById("borrar_tipo_docu").value = data.tipo_documento;
            document.getElementById("borrar_num_documento").value = data.numero_documento;
            document.getElementById("borrar_nombre").value = data.nombre;
            document.getElementById("borrar_apellido").value = data.apellido;
            document.getElementById("borrar_edad").value = data.edad;
            document.getElementById("borrar_correo").value = data.correo;
        })
        .catch(error => {
            console.error("Error en la búsqueda:", error);
            alert("❌ Error buscando al estudiante");
        });
}

// -----------------------------
// LIMPIAR CAMPOS
// -----------------------------
function limpiarCamposBorrar() {
    document.getElementById("borrar_tipo_docu").value = "";
    document.getElementById("borrar_num_documento").value = "";
    document.getElementById("borrar_nombre").value = "";
    document.getElementById("borrar_apellido").value = "";
    document.getElementById("borrar_edad").value = "";
    document.getElementById("borrar_correo").value = "";
}

// -----------------------------
// ENVIAR FORMULARIO DE ELIMINACIÓN
// -----------------------------
document.getElementById("borrarEstudianteForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const documento = document.getElementById("borrar_num_documento").value;

    if (documento === "") {
        alert("⚠ Debes buscar un estudiante primero.");
        return;
    }

    if (!confirm("¿Seguro que deseas eliminar este estudiante? ❗")) return;

    // Enviar petición DELETE
    fetch(`/controllers/EstudiantesController.php?action=eliminar`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ documento })
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            alert("✅ Estudiante eliminado correctamente");
            closeModal("borrar_estudi");
            limpiarCamposBorrar();
        } else {
            alert("❌ No se pudo eliminar el estudiante");
        }
    })
    .catch(error => {
        console.error("Error eliminando estudiante:", error);
        alert("❌ Error en el servidor");
    });
});
