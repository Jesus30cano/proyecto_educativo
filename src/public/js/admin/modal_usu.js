// --- Abrir modal vacío ---
function openEditUsuarioModal() {
  const modal = document.getElementById('editUsuarioModal');
  document.getElementById('editUsuarioForm').reset();
  modal.style.display = 'block';
}

// --- Cerrar modal ---
function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) modal.style.display = 'none';
}

// --- Cerrar al hacer clic fuera ---
window.onclick = function (event) {
  const modal = document.getElementById('editUsuarioModal');
  if (event.target === modal) closeModal('editUsuarioModal');
};

// --- Buscar usuario por ID (consulta a PHP con fetch) ---
function buscarUsuario() {
  const id = document.getElementById('search_usuario_id').value;

  if (!id) {
    alert("Por favor, ingresa un ID para buscar.");
    return;
  }

  fetch(`../controllers/get_usuario.php?id=${id}`)
    .then(response => response.json())
    .then(usuario => {
      if (!usuario || !usuario.id_usuario) {
        alert("No se encontró el usuario con ese ID.");
        return;
      }

      // Rellenar los campos
      document.getElementById('edit_usuario_correo').value = usuario.correo || '';
      document.getElementById('edit_usuario_password').value = ''; // nunca mostrar contraseña real
      document.getElementById('edit_usuario_nombre').value = usuario.nombre || '';
      document.getElementById('edit_usuario_apellido').value = usuario.apellido || '';
      document.getElementById('edit_usuario_genero').value = usuario.genero || '';
    })
    .catch(err => {
      console.error("Error al buscar el usuario:", err);
      alert("Ocurrió un error al buscar el usuario.");
    });
}

// --- Manejo del formulario de edición ---
document.getElementById('editUsuarioForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const id = document.getElementById('search_usuario_id').value;
  const correo = document.getElementById('edit_usuario_correo').value;
  const password = document.getElementById('edit_usuario_password').value;

  if (!id) {
    alert("Debes buscar primero un usuario por ID.");
    return;
  }

  fetch(`../controllers/update_usuario.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ id_usuario: id, correo, password })
  })
    .then(response => response.json())
    .then(result => {
      if (result.success) {
        alert("Usuario actualizado exitosamente ✅");
        closeModal('editUsuarioModal');
      } else {
        alert("No se pudo actualizar el usuario.");
      }
    })
    .catch(err => {
      console.error("Error al actualizar el usuario:", err);
      alert("Ocurrió un error al actualizar el usuario.");
    });
});
