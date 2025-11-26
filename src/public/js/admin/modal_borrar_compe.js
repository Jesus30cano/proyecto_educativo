// --- Abrir modal vacío ---
function openBorrarCompetenciaModal() {
  const modal = document.getElementById('borrarCompetenciaModal');
  document.getElementById('borrarCompetenciaForm').reset();

  // Limpiar campos readonly
  document.getElementById('borrar_competencia_nombre').value = '';
  document.getElementById('borrar_competencia_fecha_inicio').value = '';
  document.getElementById('borrar_competencia_fecha_fin').value = '';
  document.getElementById('borrar_competencia_modalidad').value = '';

  modal.style.display = 'block';
}

// --- Cerrar modal ---
function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) modal.style.display = 'none';
}

// --- Cerrar al hacer clic fuera ---
window.onclick = function (event) {
  const modal = document.getElementById('borrarCompetenciaModal');
  if (event.target === modal) closeModal('borrarCompetenciaModal');
};

// --- Buscar competencia por ID ---
function buscarCompetenciaBorrar() {
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

      // Rellenar los campos readonly
      document.getElementById('borrar_competencia_nombre').value = competencia.nombre || '';
      document.getElementById('borrar_competencia_fecha_inicio').value = competencia.fecha_inicio || '';
      document.getElementById('borrar_competencia_fecha_fin').value = competencia.fecha_fin || '';
      document.getElementById('borrar_competencia_modalidad').value = competencia.modalidad || '';
    })
    .catch(err => {
      console.error("Error al buscar la competencia:", err);
      alert("Ocurrió un error al buscar la competencia.");
    });
}

// --- Manejo del formulario de borrado ---
document.getElementById('borrarCompetenciaForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const id = document.getElementById('search_competencia_id').value;

  if (!id) {
    alert("Debes buscar primero una competencia por ID.");
    return;
  }

  if (!confirm("¿Estás seguro de que deseas borrar esta competencia? Esta acción no se puede deshacer.")) {
    return;
  }

  fetch(`../controllers/delete_competencia.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ id_competencia: id })
  })
    .then(response => response.json())
    .then(result => {
      if (result.success) {
        alert("Competencia borrada exitosamente 🗑️");
        closeModal('borrarCompetenciaModal');
      } else {
        alert("No se pudo borrar la competencia.");
      }
    })
    .catch(err => {
      console.error("Error al borrar la competencia:", err);
      alert("Ocurrió un error al intentar borrar la competencia.");
    });
});
