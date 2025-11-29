// --- Abrir modal vacío ---
function openEditCompetenciaModal() {
  const modal = document.getElementById('editCompetenciaModal');
  document.getElementById('editCompetenciaForm').reset();

  // Limpiar campos
  document.getElementById('edit_competencia_instructor').value = '';

  modal.style.display = 'block';
}

// --- Cerrar modal ---
function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) modal.style.display = 'none';
}

// --- Cerrar al hacer clic fuera ---
window.onclick = function (event) {
  const modal = document.getElementById('editCompetenciaModal');
  if (event.target === modal) closeModal('editCompetenciaModal');
};

// --- Buscar competencia por ID ---

 async function buscarCompetenciaEditar() {
  const id_competencia = document.getElementById("search_competencia_id").value;
  // Crea el FormData solo con el ID a buscar

  try {
    const response = await fetch("/admin/competencias/buscarCompetencia", {
      method: "POST",
      body: JSON.stringify({ id_competencia: id_competencia }),
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
      // Valida que el rol sea de profesor
      document.getElementById("edit_competencia_nombre").value =data.data.nombre;
      document.getElementById("edit_competencia_codigo").value =data.data.codigo;
      document.getElementById("edit_competencia_descripcion").value =data.data.descripcion;
      document.getElementById("search_instructor_id_edit").value =data.data.id_profesor;
      
      document.getElementById("edit_competencia_instructor").value =
        data.data.nombre_completo  ;
      
      showToast("Competencia encontrada", "#27ae60", 3000);
      console.log("Datos recibidos para edición:", data.data);
    } else {
      showToast(data.message || "No se encontró la competencia.", "#e74c3c", 4000);
    }
  } catch (error) {
    console.error("Error al buscar competencia:", error);
    showToast("Error de red o servidor", "#e74c3c", 4000);
  }
}

// --- Buscar instructor por ID ---

async function buscarInstructorEditar() {
  const id_instructor = document.getElementById("search_instructor_id_edit").value;
  // Crea el FormData solo con el ID a buscar

  try {
    const response = await fetch("/general/mostrarDatosPersonales", {
      method: "POST",
      body: JSON.stringify({ id_user: id_instructor }),
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
      // Valida que el rol sea de profesor

      if (data.data.id_rol !== 2) {
        showToast("No se encontró el profesor.", "#e74c3c", 4000);
        return;
      }
      document.getElementById("edit_competencia_instructor").value =
        data.data.nombre + " " + (data.data.apellido || "") ;
      
      showToast("Profesor encontrado", "#27ae60", 3000);
      console.log("Datos recibidos para edición:", data.data);
    } else {
      showToast(data.message || "No se encontró el profesor.", "#e74c3c", 4000);
    }
  } catch (error) {
    console.error("Error al buscar profesor:", error);
    showToast("Error de red o servidor", "#e74c3c", 4000);
  }
}

// --- Manejo del formulario de edición ---
document.getElementById('editCompetenciaForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const id = document.getElementById('search_competencia_id').value;
  const nombre = document.getElementById('edit_competencia_nombre').value;
  const codigo = document.getElementById('edit_competencia_codigo').value;
  const descripcion = document.getElementById('edit_competencia_descripcion').value;
  const instructor_id = document.getElementById('search_instructor_id_edit').value;

  if (!id || !nombre || !codigo || !descripcion || !instructor_id) {
    alert("Por favor, completa todos los campos.");
    return;
  }

  fetch(`/admin/competencias/update`, {
    method: 'PUT',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ id_competencia: id, nombre, codigo, descripcion, instructor_id })
  })
    .then(response => response.json())
    .then(result => {
      
      if (result.status === "success") {
       showToast("Competencia actualizada exitosamente ✅", "#27ae60", 3000);
        closeModal('editCompetenciaModal');
      } else {
        showToast("No se pudo actualizar la competencia.", "#e74c3c", 4000);
      }
    })
    .catch(err => {
      console.error("Error al actualizar la competencia:", err);
      showToast("Ocurrió un error al intentar actualizar la competencia.", "#e74c3c", 4000);
    });
});
