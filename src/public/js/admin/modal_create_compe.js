// --- Abrir modal vacío ---
function openCrearCompetenciaModal() {
  const modal = document.getElementById('crearCompetenciaModal');
  document.getElementById('crearCompetenciaForm').reset();

  // Limpiar campos
  document.getElementById('crear_competencia_instructor').value = '';

  modal.style.display = 'block';
}

// --- Cerrar modal ---
function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) modal.style.display = 'none';
}

// --- Cerrar al hacer clic fuera ---
window.onclick = function (event) {
  const modal = document.getElementById('crearCompetenciaModal');
  if (event.target === modal) closeModal('crearCompetenciaModal');
};

// --- Buscar instructor por ID ---
async function buscarInstructor() {
  const id_instructor = document.getElementById("search_instructor_id").value;
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
      document.getElementById("crear_competencia_instructor").value =
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

// --- Manejo del formulario de creación ---
document.getElementById('crearCompetenciaForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const nombre = document.getElementById('crear_competencia_nombre').value;
  const codigo = document.getElementById('crear_competencia_codigo').value;
  const descripcion = document.getElementById('crear_competencia_descripcion').value;
  const instructor_id = document.getElementById('search_instructor_id').value;

  if (!nombre || !codigo || !descripcion || !instructor_id) {
    showToast("Por favor completa todos los campos.", "#e74c3c", 4000);
    return;
  }

  fetch(`/admin/competencias/create`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ nombre, codigo, descripcion, instructor_id })
  })
    .then(response => response.json())
    .then(result => {
      
      if (result.status === "success") {
        showToast("Competencia creada exitosamente ✅", "#27ae60", 3000);
        closeModal('crearCompetenciaModal');
      } else {
        showToast("No se pudo crear la competencia.", "#e74c3c", 4000);
      }
    })
    .catch(err => {
      console.error("Error al crear la competencia:", err);
      showToast("Ocurrió un error al intentar crear la competencia.", "#e74c3c", 4000);
    });
});
