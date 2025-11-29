document.addEventListener("DOMContentLoaded", () => {
  cargarDatosUsuarioCard();
  cargarDatosTabla();
});// --- Abrir modal vacío ---
async function buscarUsuario() {
  const id = document.getElementById('search_usuario_id').value;
  if (!id) {
    showToast("Por favor, ingresa un ID para buscar.", "#920b0bff", 3000);
    return;
  }
  if (id==1) {
    showToast("No se puede editar el usuario administrador.", "#920b0bff", 3000);
    return;
  }
  try {
    const response = await fetch("/general/mostrarDatosPersonales", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ id_user: id }),
    });
    const data = await response.json();
    if (data.status !== "success") {
      showToast("No se encontró el usuario con ese ID.", "#920b0bff", 3000);
      return;
    }
    const usuario = data.data;
    // Rellenar los campos
    document.getElementById('edit_usuario_correo').value = usuario.email || '';
    document.getElementById('edit_usuario_password').value = ''; // nunca mostrar contraseña real
    document.getElementById('edit_usuario_nombre').value = usuario.nombre || '';
    document.getElementById('edit_usuario_apellido').value = usuario.apellido || '';
   
  } catch (error) {
    console.error("Error al buscar el usuario:", error);
    showToast("Ocurrió un error al buscar el usuario.", "#920b0bff", 3000);
  }


}

async function cargarDatosUsuarioCard() {
  try {
    const response = await fetch("/admin/dashboard/obtenerTotalesActivos"); // Asegúrate de que esta ruta coincida con la del backend

    // Validar que la respuesta sea JSON(hay que revisar si funciona bien esto, no lo entendi muy bien)
    const contentType = response.headers.get("content-type");

    if (!contentType || !contentType.includes("application/json")) {
      console.error(
        "⚠️ La respuesta no es JSON. Respuesta recibida:",
        await response.text()
      );
      return;
    }

    const data = await response.json();

    if (data.status !== "success") {
      console.error("❌ Error en la respuesta del servidor:", data.message);
      return;
    }

    actualizarContadores(data.data);
  } catch (error) {
    console.error("❌ Error cargando dashboard:", error);
  }
}
async function cargarDatosTabla() {
  try {
    const response = await fetch("/admin/general/listarUsuariosPorIdRol", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ id_rol: 99 }), // ID de rol para profesor
    });

    const data = await response.json();

    if (data.status !== "success") {
      console.error("Error en la respuesta del servidor:", data.message);
      return;
    }

    // Llama a la función para actualizar la DataTable
    actualizarTabla(data.data || []);
  } catch (error) {
    console.error("Error cargando dashboard tabla:", error);
  }
}
let tablaInicializada = false;
function actualizarTabla(data) {
  // Si data no es un array, lo convierte a array
  if (!Array.isArray(data)) {
    console.warn("'data' no es un array. Empaquetando en array:", data);
    data = [data];
  }

  // Advierte si el array está vacío
  if (data.length === 0) {
    console.warn("El array de datos está vacío.");
  }

  // Inicializa la tabla si no está inicializada, si ya está inicializada solo actualiza los datos
  if (!tablaInicializada) {
    $("#dataTable").DataTable({
      data: data,
      columns: [
        { data: "id_usuario" },
        { data: "nombre" },
        { data: "apellido" },
        { data: "estado" },
        { data: "email" },
        { data: "genero" },
      ],
      destroy: true,
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
      },
    });
    tablaInicializada = true;
  } else {
    let table = $("#dataTable").DataTable();
    table.clear();
    table.rows.add(data);
    table.draw();
  }
}

function actualizarContadores(info) {

  document.getElementById("totalUsuarios").textContent =
    info.total_estudiantes + info.total_profesores;
}
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



// --- Manejo del formulario de edición ---
document.getElementById('editUsuarioForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const id = document.getElementById('search_usuario_id').value;

  const correo = document.getElementById('edit_usuario_correo').value;
  const password = document.getElementById('edit_usuario_password').value;

  if (!id) {
    showToast("Ingresa un ID para buscar.", "#920b0bff", 3000);
    return;
  }
  try {
     fetch('/admin/general/actualizarUsuario', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        id_usuario: id,
        correo: correo,
        password: password
      })
    }).then(response => response.json())
      .then(data2 => {
        if (data2.status === 'success') {
          showToast("Usuario actualizado con éxito.", "#0b920bff", 3000);
          closeModal('editUsuarioModal');
          cargarDatosTabla(); // Recargar la tabla para reflejar los cambios
        } else {
          showToast("Error al actualizar el usuario1: " + data2.message, "#920b0bff", 3000);
        }
    }).catch(error => {
      showToast("Error al actualizar el usuario2: " + error.message, "#920b0bff", 3000); 
    
    });
  } catch (error) {
    console.error("Error al actualizar el usuario:", error);
    showToast("Ocurrió un error al actualizar el usuario.", "#920b0bff", 3000);
  }
});
