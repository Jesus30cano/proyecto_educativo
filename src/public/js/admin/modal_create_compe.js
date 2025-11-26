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
function buscarInstructor() {
  const id = document.getElementById('search_instructor_id').value;

  if (!id) {
    alert("Por favor, ingresa un ID de instructor.");
    return;
  }

  fetch(`../controllers/get_instructor.php?id=${id}`)
    .then(response => response.json())
    .then(instructor => {
      if (!instructor || !instructor.id_instructor) {
        alert("No se encontró el instructor con ese ID.");
        return;
      }

      // Mostrar nombre completo del instructor
      document.getElementById('crear_competencia_instructor').value = instructor.nombre + " " + instructor.apellido;
    })
    .catch(err => {
      console.error("Error al buscar el instructor:", err);
      alert("Ocurrió un error al buscar el instructor.");
    });
}

// --- Manejo del formulario de creación ---
document.getElementById('crearCompetenciaForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const nombre = document.getElementById('crear_competencia_nombre').value;
  const fecha_inicio = document.getElementById('crear_competencia_fecha_inicio').value;
  const fecha_fin = document.getElementById('crear_competencia_fecha_fin').value;
  const modalidad = document.getElementById('crear_competencia_modalidad').value;
  const instructor_id = document.getElementById('search_instructor_id').value;

  if (!nombre || !fecha_inicio || !fecha_fin || !modalidad || !instructor_id) {
    alert("Por favor, completa todos los campos.");
    return;
  }

  fetch(`../controllers/create_competencia.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ nombre, fecha_inicio, fecha_fin, modalidad, instructor_id })
  })
    .then(response => response.json())
    .then(result => {
      if (result.success) {
        alert("Competencia creada exitosamente ✅");
        closeModal('crearCompetenciaModal');
      } else {
        alert("No se pudo crear la competencia.");
      }
    })
    .catch(err => {
      console.error("Error al crear la competencia:", err);
      alert("Ocurrió un error al intentar crear la competencia.");
    });
});
