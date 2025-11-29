document.addEventListener("DOMContentLoaded", () => {
  cargarDatosDashboardCard();
  cargarDatosDashboardTabla();
});
async function cargarDatosDashboardCard() {
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
async function cargarDatosDashboardTabla() {
  try {
    const response = await fetch("/admin/general/listarUsuariosPorIdRol",
        { method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ id_rol:3 }),
    }
    ); // Asegúrate de que esta ruta coincida con la del backend
    const data = await response.json();
    if (data.status !== "success") {
      console.error("❌ Error en la respuesta del servidor:", data.message);
      return;
    }
    
    actualizarTabla(data.data || []);
  } catch (error) {
    console.error("❌ Error cargando dashboard tabla:", error);
  }
}

// 🔹 Actualiza los cards (contador)
function actualizarContadores(info) {
  document.getElementById("totalEstudiantes").textContent =
    info.total_estudiantes;
  
}

let tablaInicializada = false;

function actualizarTabla(data) {
  // Convierte data en array si es un solo objeto
  if (!Array.isArray(data)) {
    console.warn("⚠️ 'data' no es un array. Empaquetando en array:", data);
    data = [data];
  }

  // Opcional: advertencia si el array está vacío
  if (data.length === 0) {
    console.warn("⚠️ El array de datos está vacío.");
  }

  if (!tablaInicializada) {
    $("#dataTable").DataTable({
      data: data,
      columns: [
        { data: "id_usuario" },
        { data: "nombre" },
        { data: "apellido" },
        { data: "estado" },
        { data: "fecha_nacimiento" },
        { data: "email" },
        { data: "telefono" },
        
        { data: "direccion" },
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
    console.log("🔄 DataTable actualizado con:", data);
  }
}
