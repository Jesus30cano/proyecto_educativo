// --- Abrir modal de creación de curso ---
function openCreateCursoModal() {
  const modal = document.getElementById('create_curso');
  if (!modal) {
    console.error("No se encontró el modal de creación de curso");
    return;
  }

  // Limpiar todos los campos antes de abrir el modal
  document.getElementById('create_curso_id').value = '';
  document.getElementById('create_codigo').value = '';
  document.getElementById('create_nombre').value = '';
  document.getElementById('create_fecha_final').value = '';
  document.getElementById('asignar_profesor_id').value = '';

  // Mostrar el modal
  modal.style.display = 'block';
}

// --- Cerrar modal por ID ---
function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.style.display = 'none';
  }
}

// --- Cerrar el modal al hacer clic fuera del contenido ---
window.onclick = function(event) {
  const modal = document.getElementById('create_curso');
  if (event.target === modal) {
    closeModal('create_curso');
  }
};

// --- Función ejemplo para buscar profesor (puedes personalizarla) ---
function buscarProfesor() {
  const profesorId = document.getElementById('asignar_profesor_id').value.trim();

  if (profesorId === '') {
    alert('Por favor, ingresa un ID de profesor para buscar.');
    return;
  }

  // Aquí puedes realizar una petición AJAX o Fetch para buscar el profesor
  console.log(`Buscando profesor con ID: ${profesorId}`);

  // Ejemplo temporal (simulado)
  setTimeout(() => {
    alert(`Profesor con ID ${profesorId} encontrado (simulado).`);
  }, 800);
}
