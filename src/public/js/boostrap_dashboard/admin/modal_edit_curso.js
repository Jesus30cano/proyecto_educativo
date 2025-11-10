// --- Abrir modal de edición ---
function openEditCursoModal() {
  const modal = document.getElementById('edit_curso');
  if (!modal) {
    console.error("No se encontró el modal de edición de curso");
    return;
  }

  // Limpiar campos antes de abrir (sin parámetros)
  document.getElementById('edit_curso_id').value = '';
  document.getElementById('edit_codigo').value = '';
  document.getElementById('edit_nombre').value = '';
  document.getElementById('edit_fecha_final').value = '';
  document.getElementById('edit_asignar_profesor_id').value = '';

  // Mostrar el modal
  modal.style.display = 'block';
}

// --- Cerrar modal ---
function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) modal.style.display = 'none';
}

// --- Cerrar si se hace clic fuera ---
window.onclick = function(event) {
  const modal = document.getElementById('edit_curso');
  if (event.target === modal) closeModal('edit_curso');
};

// --- Buscar profesor (simulado) ---
function buscarProfesorEditar() {
  const profesorId = document.getElementById('edit_asignar_profesor_id').value.trim();
  if (profesorId === '') {
    alert('Por favor, ingresa un ID de profesor para buscar.');
    return;
  }

  console.log(`Buscando profesor con ID: ${profesorId}`);
  setTimeout(() => alert(`Profesor con ID ${profesorId} encontrado (simulado).`), 800);
}
