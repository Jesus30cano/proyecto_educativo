// Inicializa los datos en el dashboard al cargar la página
document.addEventListener("DOMContentLoaded", () => {
  cargarDatosCard();
  cargarDatosTabla();
});

// Función que solicita al backend los totales y los coloca en las tarjetas del dashboard
async function cargarDatosCard() {
  try {
    const response = await fetch("/admin/dashboard/obtenerTotalesActivos"); // Verifica que la ruta esté correctamente configurada en el backend

    // Verifica que la respuesta tenga formato JSON
    const contentType = response.headers.get("content-type");

    if (!contentType || !contentType.includes("application/json")) {
      // Si la respuesta no es JSON, muestra el contenido recibido para depuración
      console.error(
        "La respuesta no es JSON. Respuesta recibida:",
        await response.text()
      );
      return;
    }

    // Extrae los datos en formato JSON
    const data = await response.json();

    // Valida el estado del backend
    if (data.status !== "success") {
      console.error("Error en la respuesta del servidor:", data.message);
      return;
    }

    // Actualiza los contadores con los datos recibidos
    actualizarContadores(data.data);
  } catch (error) {
    console.error("Error cargando dashboard:", error);
  }
}

// Función que carga la tabla de profesores desde el backend
async function cargarDatosTabla() {
  try {
    const response = await fetch("/admin/general/listarUsuariosPorIdRol", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ id_rol: 2 }), // ID de rol para profesor
    });

    const data = await response.json();

    if (data.status !== "success") {
      console.error("Error en la respuesta del servidor:", data.message);
      return;
    }
    console.log("Datos del dashboard cargados:", data.data);

    // Llama a la función para actualizar la DataTable
    actualizarTabla(data.data || []);
  } catch (error) {
    console.error("Error cargando dashboard tabla:", error);
  }
}

// Actualiza los valores de las tarjetas (contadores) en el dashboard
function actualizarContadores(info) {
  document.getElementById("totalProfesores2").textContent = info.total_profesores;
}

let tablaInicializada = false;

// Actualiza la tabla (DataTable) con los datos de profesores
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
    $("#example").DataTable({
      data: data,
      columns: [
        { data: "id_usuario" },
        { data: "nombre" },
        { data: "apellido" },
        { data: "estado" },
        { data: "fecha_nacimiento" },
        { data: "telefono" },
        { data: "email" },
        { data: "direccion" },
        { data: "genero" },
      ],
      destroy: true,
    });
    tablaInicializada = true;
  } else {
    let table = $("#example").DataTable();
    table.clear();
    table.rows.add(data);
    table.draw();
    console.log("DataTable actualizado con:", data);
  }
}

//---------------------------------------
// Función para registrar un profesor utilizando los datos del formulario de registro
async function registrarDocente() {
  // Obtiene los valores de los campos del formulario de registro
  const tipo_documento = document.getElementById("tipo_documento").value;
  const cedula = document.getElementById("create_cedula").value;
  const nombre = document.getElementById("create_nombre").value;
  const apellido = document.getElementById("create_apellido").value;
  const fecha_nacimiento = document.getElementById("create_fecha_nacimiento").value;
  const telefono = document.getElementById("create_telefono").value;
  const direccion = document.getElementById("create_direccion").value;
  const genero = document.getElementById("create_genero").value;
  const correo = document.getElementById("create_correo").value;
  const password = document.getElementById("create_password").value;
  const id_rol = 2; // El rol 2 corresponde a profesor

  // Prepara los datos en FormData
  const formData = new FormData();
  formData.append("tipo_documento", tipo_documento);
  formData.append("no_documento", cedula);
  formData.append("nombre", nombre);
  formData.append("apellido", apellido);
  formData.append("fecha_nacimiento", fecha_nacimiento);
  formData.append("telefono", telefono);
  formData.append("direccion", direccion);
  formData.append("genero", genero);
  formData.append("email", correo);
  formData.append("password", password);
  formData.append("id_rol", id_rol);

  try {
    // Envía la solicitud de registro al backend
    const response = await fetch("/admin/general/registrarUsuario", {
      method: "POST",
      body: formData,
    });

    const data = await response.json();

    if (data.status === "success") {
      showToast("Profesor registrado exitosamente", "#27ae60", 3000);
      document.getElementById("createForm").reset();
      closeModal("createModal");
      cargarDatosTabla(); // Actualiza la tabla para mostrar el nuevo registro
    } else {
      showToast(data.message, "#e74c3c", 4000);
    }
  } catch (error) {
    console.error("Error al registrar profesor:", error);
  }
}

// Configura el evento submit para el formulario del registro de docentes
function setupFormSubmissionDocente() {
  const form = document.getElementById("createForm");
  if (form) {
    form.addEventListener("submit", async function (e) {
      e.preventDefault();
      await registrarDocente();
    });
  }
}
setupFormSubmissionDocente();

// Función para buscar un profesor por su ID usando el backend y llenar el formulario de edición
async function buscarProfesor() {
  const id_profesor = document.getElementById("search_profesor_id").value;
  // Crea el FormData solo con el ID a buscar
  

  try {
    const response = await fetch("/general/mostrarDatosPersonales", {
      method: "POST",
      body: JSON.stringify({ id_user: id_profesor }),
      headers: {
        "Content-Type": "application/json",
      },
    });

    // Puede que la respuesta no sea JSON si hay error: se intenta analizar como JSON
    const text = await response.text();
    let data;
    try {
      data = JSON.parse(text);
    } catch (e) {
      console.error("Respuesta no es JSON:", text);
      showToast("Respuesta inesperada del servidor", "#e74c3c", 4000);
      return;
    }

    // Si la búsqueda fue exitosa, llena el formulario de edición
    if (data.status === "success" && data.data) {
      // Valida que el rol sea de profesor
      
      if (data.data.id_rol !== 2) {
        showToast("No se encontró el profesor.", "#e74c3c", 4000);
        return;
      }
      document.getElementById("edit_profesor_nombre").value = data.data.nombre || "";
      document.getElementById("edit_profesor_apellido").value = data.data.apellido || "";
      document.getElementById("edit_profesor_fecha_nacimiento").value = data.data.fecha_nacimiento || "";
      document.getElementById("edit_profesor_telefono").value = data.data.telefono || "";
      document.getElementById("edit_profesor_direccion").value = data.data.direccion || "";
      document.getElementById("edit_profesor_genero").value = data.data.genero || "";
      showToast("Profesor encontrado", "#27ae60", 3000);
      console.log("Datos recibidos para edición:", data.data);
    } else {
      showToast(data.message || "No se encontró el profesor.", "#e74c3c", 4000);
    }
  } catch (error) {
    console.error("Error al buscar profesor:", error);
    showToast("Error de red o servidor", "#e74c3c", 4000);
  }
}

// Función para actualizar los datos de un profesor
async function actualizarProfesor() {
  // Obtiene los valores del formulario de edición
  const id_profesor = document.getElementById("search_profesor_id").value;
  const nombre = document.getElementById("edit_profesor_nombre").value;
  const apellido = document.getElementById("edit_profesor_apellido").value;
  const fecha_nacimiento = document.getElementById("edit_profesor_fecha_nacimiento").value;
  const telefono = document.getElementById("edit_profesor_telefono").value;
  const direccion = document.getElementById("edit_profesor_direccion").value;
  const genero = document.getElementById("edit_profesor_genero").value;
  const formData = new FormData();
  formData.append("id_usuario", id_profesor);
  formData.append("nombre", nombre);
  formData.append("apellido", apellido);
  formData.append("fecha_nacimiento", fecha_nacimiento);
  formData.append("telefono", telefono);
  formData.append("direccion", direccion);
  formData.append("genero", genero);
  try {
    // Envía el formulario al backend para actualizar los datos personales
    const response = await fetch("/general/actualizarDatosPersonales", {
      method: "POST",
      body: formData,
    });
    const data = await response.json();
    if (data.status === "success") {
      showToast("Profesor actualizado exitosamente", "#27ae60", 3000);
      document.getElementById("editProfesorForm").reset();
      closeModal("editProfesorModal");
      cargarDatosTabla(); // Actualiza la tabla de profesores
    } else {
      showToast(data.message, "#e74c3c", 4000);
    }
  } catch (error) {
    console.error("Error al actualizar profesor:", error);
    showToast("Error de red o servidor", "#e74c3c", 4000);
  }
} 

// Configura el evento submit del formulario de edición de profesor
function setupFormSubmissionActualizarProfesor() {
  const form = document.getElementById("editProfesorForm");
  if (form) {
    form.addEventListener("submit", async function (e) {
      e.preventDefault();
      await actualizarProfesor();
    });
  }
}
setupFormSubmissionActualizarProfesor();

// Hace que los campos de teléfono y cédula en edición solo permitan números
document.addEventListener('DOMContentLoaded', function() {
  // Función que filtra el input para solo números
  function soloNumeros(event) {
    // Remueve cualquier carácter que no sea número, permite copiar-pegar
    event.target.value = event.target.value.replace(/\D/g, '');
  }

  // Para el campo teléfono de edición
  const telefonoInput = document.getElementById('edit_profesor_telefono');
  if (telefonoInput) {
    telefonoInput.addEventListener('input', soloNumeros);
  }

  // Para el campo cédula de edición (si existe en tu formulario)
  const cedulaInput = document.getElementById('edit_profesor_cedula');
  if (cedulaInput) {
    cedulaInput.addEventListener('input', soloNumeros);
  }
});

// Hace que los campos de teléfono y cédula en el formulario de creación solo permitan números
document.addEventListener('DOMContentLoaded', function() {
  // Función para permitir solo números
  function soloNumeros(event) {
    event.target.value = event.target.value.replace(/\D/g, '');
  }

  // Campo cédula en creación (solo números)
  const cedulaInput = document.getElementById('create_cedula');
  if (cedulaInput) {
    cedulaInput.addEventListener('input', soloNumeros);
  }

  // Campo teléfono en creación (solo números)
  const telefonoInput = document.getElementById('create_telefono');
  if (telefonoInput) {
    telefonoInput.addEventListener('input', soloNumeros);
  }
});