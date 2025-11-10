// --- Abrir el modal de creación de usuario ---
function openCreateModal() {
  const modal = document.getElementById('createModal');
  if (!modal) {
    console.error("No se encontró el modal de creación de usuario");
    return;
  }

  // Limpiar los campos del formulario antes de abrirlo
  document.getElementById('create_username').value = '';
  document.getElementById('create_correo').value = '';
  document.getElementById('create_password').value = '';
  document.getElementById('create_rol').value = 'usuario';

  modal.style.display = 'block';
}

// --- Cerrar modal por ID ---
function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) modal.style.display = 'none';
}

// --- Cerrar modal al hacer clic fuera del contenido ---
window.onclick = function(event) {
  const modal = document.getElementById('createModal');
  if (event.target === modal) {
    closeModal('createModal');
  }
};
