document.addEventListener("DOMContentLoaded", () => {
  cargarDatosDashboardCard();
  cargarDatosDashboardTabla();
});

// Función para cargar datos desde el backend
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
      console.error(
        "❌ Error en la respuesta del servidor:", data.message 
      );
      return;
    }
    
    actualizarContadores(data.data);
    
  } catch (error) {
    console.error("❌ Error cargando dashboard:", error);
  }
}
async function cargarDatosDashboardTabla() {
  try {
    const response = await fetch("/admin/dashboard/obtenerTotalesCursos"); // Asegúrate de que esta ruta coincida con la del backend
    const data = await response.json();
    if (data.status !== "success") {
      console.error(
        "❌ Error en la respuesta del servidor:", data.message 
      );
      return;
    }
    console.log("✅ Datos del dashboard cargados:", data.data);
    actualizarTabla(data.data || []);
  } catch (error) {
    console.error("❌ Error cargando dashboard tabla:", error);
  }
}

// 🔹 Actualiza los cards (contador)
function actualizarContadores(info) {
  document.getElementById("totalEstudiantes").textContent =
    info.total_estudiantes;
  document.getElementById("totalProfesores").textContent = info.total_profesores;
  
  document.getElementById("totalCursos").textContent = info.total_cursos_activos;
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
    $("#example").DataTable({
      data: data,
      columns: [
        { data: "id_curso" },
        { data: "nombre_curso" },
        { data: "ficha" },
        { data: "nombre_profesor" },
        { data: "nombre_profesor" }, // Si quieres la columna 'Lider' igual que 'nombre_profesor'
        { data: "cantidad_estudiantes" }
      ],
      destroy: true
    });
    tablaInicializada = true;
    console.log("✅ DataTable inicializado con:", data);
  } else {
    let table = $("#example").DataTable();
    table.clear();
    table.rows.add(data);
    table.draw();
    console.log("🔄 DataTable actualizado con:", data);
  }
}