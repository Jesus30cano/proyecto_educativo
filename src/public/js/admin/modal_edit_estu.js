// BUSCAR ESTUDIANTE
function openEditEstudianteModal() {
  document.getElementById("edit_estudi").style.display = "block";
}

function closeModal(id) {
  document.getElementById(id).style.display = "none";
}

async function buscarEstudiante() {
  const id_estudiante = document.getElementById("search_estudiante_doc").value;
  // Crea el FormData solo con el ID a buscar

  try {
    const response = await fetch("/general/mostrarDatosPersonales", {
      method: "POST",
      body: JSON.stringify({ id_user: id_estudiante }),
      headers: {
        "Content-Type": "application/json",
      },
    });

    // Puede que la respuesta no sea JSON si hay error: se intenta analizar como JSON
    const text = await response.text();
    let data;
    try {
      data = JSON.parse(text);
    } catch (e) {
      console.error("Respuesta no es JSON:", text);
      showToast("Respuesta inesperada del servidor", "#e74c3c", 4000);
      return;
    }

    // Si la búsqueda fue exitosa, llena el formulario de edición
    if (data.status === "success" && data.data) {
      // Valida que el rol sea de estudiante

      if (data.data.id_rol !== 3) {
        showToast("No se encontró el estudiante.", "#e74c3c", 4000);
        return;
      }
      document.getElementById("edit_profesor_nombre").value =
        data.data.nombre || "";
      document.getElementById("edit_profesor_apellido").value =
        data.data.apellido || "";
      document.getElementById("edit_profesor_fecha_nacimiento").value =
        data.data.fecha_nacimiento || "";
      document.getElementById("edit_profesor_telefono").value =
        data.data.telefono || "";
      document.getElementById("edit_profesor_direccion").value =
        data.data.direccion || "";
      document.getElementById("edit_profesor_genero").value =
        data.data.genero || "";
      showToast("Estudiante encontrado", "#27ae60", 3000);
      console.log("Datos recibidos para edición:", data.data);
    } else {
      showToast(data.message || "No se encontró el estudiante.", "#e74c3c", 4000);
    }
  } catch (error) {
    console.error("Error al buscar estudiante:", error);
    showToast("Error de red o servidor", "#e74c3c", 4000);
  }
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
document
  .getElementById("editEstudianteForm")
  .addEventListener("submit", function (e) {
    e.preventDefault();
actualizarEstudiante();
  

    
    closeModal("edit_estudi");
  });
async function actualizarEstudiante() {
  // Obtiene los valores del formulario de edición
  const id_estudiante = document.getElementById("search_estudiante_doc").value;
  const nombre = document.getElementById("edit_profesor_nombre").value;
  const apellido = document.getElementById("edit_profesor_apellido").value;
  const fecha_nacimiento = document.getElementById(
    "edit_profesor_fecha_nacimiento"
  ).value;
  const telefono = document.getElementById("edit_profesor_telefono").value;
  const direccion = document.getElementById("edit_profesor_direccion").value;
  const genero = document.getElementById("edit_profesor_genero").value;
  const formData = new FormData();
  formData.append("id_usuario", id_estudiante);
  formData.append("nombre", nombre);
  formData.append("apellido", apellido);
  formData.append("fecha_nacimiento", fecha_nacimiento);
  formData.append("telefono", telefono);
  formData.append("direccion", direccion);
  formData.append("genero", genero);
  try {
    // Envía el formulario al backend para actualizar los datos personales
    const response = await fetch("/general/actualizarDatosPersonales", {
      method: "POST",
      body: formData,
    });
    const data = await response.json();
    if (data.status === "success") {
      showToast("Estudiante actualizado exitosamente", "#27ae60", 3000);
      document.getElementById("editEstudianteForm").reset();
      closeModal("edit_estudi");
      cargarDatosDashboardTabla(); // Actualiza la tabla de estudiantes
    } else {
      showToast(data.message, "#e74c3c", 4000);
    }
  } catch (error) {
    console.error("Error al actualizar estudiante:", error);
    showToast("Error de red o servidor", "#e74c3c", 4000);
  }
}