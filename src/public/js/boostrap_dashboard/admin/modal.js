// Abrir modal de creación
function openCreateModal() {
  document.getElementById("createModal").style.display = "block";
}

// Abrir modal de edición
function openEditModal(user) {
  document.getElementById("edit_id").value = user.id;
  document.getElementById("edit_username").value = user.username;
  document.getElementById("edit_correo").value = user.correo;
  document.getElementById("edit_rol").value = user.rol;
  document.getElementById("editModal").style.display = "block";
}

// Cerrar modal
function closeModal(modalId) {
  document.getElementById(modalId).style.display = "none";
}

// Eliminar usuario
function deleteUser(id, username) {
  if (
    confirm(`¿Estás seguro de que deseas eliminar al usuario "${username}"?`)
  ) {
    const form = document.createElement("form");
    form.method = "POST";
    form.action = "";

    const actionInput = document.createElement("input");
    actionInput.type = "hidden";
    actionInput.name = "action";
    actionInput.value = "delete";

    const idInput = document.createElement("input");
    idInput.type = "hidden";
    idInput.name = "id";
    idInput.value = id;

    form.appendChild(actionInput);
    form.appendChild(idInput);
    document.body.appendChild(form);
    form.submit();
  }
}

// Cerrar modales haciendo clic fuera
window.onclick = function (event) {
  const createModal = document.getElementById("createModal");
  const editModal = document.getElementById("editModal");
  if (event.target === createModal) {
    createModal.style.display = "none";
  }
  if (event.target === editModal) {
    editModal.style.display = "none";
  }
};
