// modal_create_estu.js - VERSIÓN CORREGIDA

// Esperar a que el DOM esté completamente cargado
document.addEventListener("DOMContentLoaded", function () {
  // Referencias a elementos del DOM
  const modal = document.getElementById("create_estudi");
  const openModalBtn = document.getElementById("openModalBtn");
  const createForm = document.getElementById("createForm");

  // Verificar que los elementos existen antes de agregar event listeners
  if (openModalBtn) {
    openModalBtn.addEventListener("click", function () {
      openModal("create_estudi");

    });
  }

  if (modal) {
    // Cerrar modal al hacer clic fuera del contenido
    window.addEventListener("click", function (event) {
      if (event.target === modal) {
        closeModal("create_estudi");
      }
    });
  }



});
setupFormSubmissionEstudiante();
function setupFormSubmissionEstudiante() {
  const form = document.getElementById("createForm");
  if (form) {
    form.addEventListener("submit", async function (e) {
      e.preventDefault();
      await registrar_estudiante();
    });
  }
}
async function registrar_estudiante()  {
  const tipo_documento = document.getElementById("tipo_documento").value;
  const numero_documento = document.getElementById("create_cedula").value;
  const nombre = document.getElementById("create_nombre").value;
  const apellido = document.getElementById("create_apellido").value;
  const fecha_nacimiento = document.getElementById("create_fecha_nacimiento").value;
  const correo = document.getElementById("create_correo").value;
  const password = document.getElementById("create_password").value;
  const telefono = document.getElementById("create_telefono").value;
  const direccion = document.getElementById("create_direccion").value;
  const genero = document.getElementById("create_genero").value;
  const id_rol = 3; // Rol de estudiante
  const formData = new FormData();
  formData.append("tipo_documento", tipo_documento);
  formData.append("no_documento", numero_documento);
  formData.append("nombre", nombre);
  formData.append("apellido", apellido);
  formData.append("fecha_nacimiento", fecha_nacimiento);
  formData.append("email", correo);
  formData.append("password", password);
  formData.append("telefono", telefono);
  formData.append("direccion", direccion);
  formData.append("genero", genero);
  formData.append("id_rol", id_rol);
  try {
    const response = await fetch("/admin/general/registrarUsuario", {
      method: "POST",
      body: formData,
    });
    const data = await response.json();
    console.log("Respuesta del servidor:", data);
    if (data.status === "success") {
      showToast("Estudiante registrado exitosamente", "#27ae60", 3000);
      closeModal("create_estudi");
      // Aquí puedes agregar código para actualizar la tabla o limpiar el formulario si es necesario
    } else {
      showToast("❌ Error al registrar el estudiante: " + data.message, "#e74c3c", 3000);
    }
  } catch (error) {
    console.error("❌ Error en la solicitud:", error);
    showToast("❌ Error en la solicitud: " + error.message, "#e74c3c", 3000);
  }
}

// Función para abrir el modal
function openModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.style.display = "block";
    document.getElementById("tipo_documento_group").value = "";
    document.getElementById("create_cedula").value = "";
    document.getElementById("create_nombre").value = "";
    document.getElementById("create_apellido").value = "";
    document.getElementById("create_fecha_nacimiento").value = "";
    document.getElementById("create_correo").value = "";
    document.getElementById("create_password").value = "";
    document.getElementById("create_fecha_nacimiento").value = "";
    document.getElementById("create_telefono").value = "";
    document.getElementById("create_direccion").value = "";
    document.getElementById("create_genero").value = "";
    console.log("Modal abierto:", modalId);
    
  } else {
    console.error("Modal no encontrado:", modalId);
  }
}

// Función para cerrar el modal
function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.style.display = "none";
  }
}

// Función alternativa para compatibilidad con onclick
function openCreateEstudianteModal() {
  openModal("create_estudi");
}

