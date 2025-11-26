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
function buscarCompetenciaEditar() {
  const id = document.getElementById('search_competencia_id').value;

  if (!id) {
    alert("Por favor, ingresa un ID para buscar.");
    return;
  }

  fetch(`../controllers/get_competencia.php?id=${id}`)
    .then(response => response.json())
    .then(competencia => {
      if (!competencia || !competencia.id_competencia) {
        alert("No se encontró la competencia con ese ID.");
        return;
      }

      // Rellenar los campos
      document.getElementById('edit_competencia_nombre').value = competencia.nombre || '';
      document.getElementById('edit_competencia_fecha_inicio').value = competencia.fecha_inicio || '';
      document.getElementById('edit_competencia_fecha_fin').value = competencia.fecha_fin || '';
      document.getElementById('edit_competencia_modalidad').value = competencia.modalidad || '';
      document.getElementById('edit_competencia_instructor').value = competencia.instructor || '';
    })
    .catch(err => {
      console.error("Error al buscar la competencia:", err);
      alert("Ocurrió un error al buscar la competencia.");
    });
}

// --- Buscar instructor por ID ---
function buscarInstructorEditar() {
  const id = document.getElementById('search_instructor_id_edit').value;

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
      document.getElementById('edit_competencia_instructor').value = instructor.nombre + " " + instructor.apellido;
    })
    .catch(err => {
      console.error("Error al buscar el instructor:", err);
      alert("Ocurrió un error al buscar el instructor.");
    });
}

// --- Manejo del formulario de edición ---
document.getElementById('editCompetenciaForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const id = document.getElementById('search_competencia_id').value;
  const nombre = document.getElementById('edit_competencia_nombre').value;
  const fecha_inicio = document.getElementById('edit_competencia_fecha_inicio').value;
  const fecha_fin = document.getElementById('edit_competencia_fecha_fin').value;
  const modalidad = document.getElementById('edit_competencia_modalidad').value;
  const instructor_id = document.getElementById('search_instructor_id_edit').value;

  if (!id || !nombre || !fecha_inicio || !fecha_fin || !modalidad || !instructor_id) {
    alert("Por favor, completa todos los campos.");
    return;
  }

  fetch(`../controllers/update_competencia.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ id_competencia: id, nombre, fecha_inicio, fecha_fin, modalidad, instructor_id })
  })
    .then(response => response.json())
    .then(result => {
      if (result.success) {
        alert("Competencia actualizada exitosamente ✅");
        closeModal('editCompetenciaModal');
      } else {
        alert("No se pudo actualizar la competencia.");
      }
    })
    .catch(err => {
      console.error("Error al actualizar la competencia:", err);
      alert("Ocurrió un error al intentar actualizar la competencia.");
    });
});
