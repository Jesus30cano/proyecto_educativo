// --- Abrir modal vacío ---
function openEditProfesorModal() {
    const modal = document.getElementById('editProfesorModal');
    document.getElementById('editProfesorForm').reset();
    modal.style.display = 'block';
  }
  
  // --- Cerrar modal ---
  function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) modal.style.display = 'none';
  }
  
  // --- Cerrar al hacer clic fuera ---
  window.onclick = function (event) {
    const modal = document.getElementById('editProfesorModal');
    if (event.target === modal) closeModal('editProfesorModal');
  };
  
  // --- Buscar profesor por ID (consulta a PHP con fetch) ---
  function buscarProfesor() {
    const id = document.getElementById('search_profesor_id').value;
  
    if (!id) {
      alert("Por favor, ingresa un ID para buscar.");
      return;
    }
  
    fetch(`../controllers/get_profesor.php?id=${id}`)
      .then(response => response.json())
      .then(profesor => {
        if (!profesor || !profesor.id_profesor) {
          alert("No se encontró el profesor con ese ID.");
          return;
        }
  
        // Rellenar los campos
        document.getElementById('edit_profesor_id').value = profesor.id_profesor;
        document.getElementById('edit_profesor_nombre').value = profesor.nombre;
        document.getElementById('edit_profesor_correo').value = profesor.correo;
        document.getElementById('edit_profesor_telefono').value = profesor.telefono || '';
        document.getElementById('edit_profesor_especialidad').value = profesor.especialidad || '';
        document.getElementById('edit_profesor_estado').value = profesor.estado || 'activo';
      })
      .catch(err => {
        console.error("Error al buscar el profesor:", err);
        alert("Ocurrió un error al buscar el profesor.");
      });
  }
  