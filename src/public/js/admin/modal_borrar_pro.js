// ABRIR MODAL
function openEliminarProfesorModal() {
  const modal = document.getElementById("borrarProfesorModal");
  modal.style.display = "block";
}

// CERRAR MODAL
function closeModal(id) {
  document.getElementById(id).style.display = "none";
}

// BUSCAR PROFESOR (AJAX SIMULADO)
function buscarProfesorBorrar() {
  const id = document.getElementById("search_profesor_id2").value.trim();

  if (id === "") {
    alert("Ingrese un ID para buscar.");
    return;
  }

  // Simulación de respuesta del servidor (cámbialo por fetch)
  // Aquí haces tu consulta real con PHP
  const profesor = {
    nombre: "Carlos",
    apellido: "Martínez",
    fecha_nacimiento: "1990-05-12",
    telefono: "3201234567",
    direccion: "Calle Falsa 123",
  };

  // Llenar los campos
  document.getElementById("borrar_profesor_nombre").value = profesor.nombre;
  document.getElementById("borrar_profesor_apellido").value = profesor.apellido;
  document.getElementById("borrar_profesor_fecha_nacimiento").value =
    profesor.fecha_nacimiento;
  document.getElementById("borrar_profesor_telefono").value = profesor.telefono;
  document.getElementById("borrar_profesor_direccion").value =
    profesor.direccion;

  alert("Profesor encontrado.");
}

// SUBMIT DEL FORMULARIO
document
  .getElementById("borrarProfesorForm")
  .addEventListener("submit", function (e) {
    e.preventDefault();

    if (confirm("¿Estás seguro de borrar este profesor?")) {
      alert("Profesor eliminado correctamente.");
      closeModal("borrarProfesorModal");
    }
  });
