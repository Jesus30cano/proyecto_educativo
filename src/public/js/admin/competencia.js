document.addEventListener("DOMContentLoaded", () => {
  cargarDatosCard();
  cargarDatosTabla();
});

// Función para cargar datos desde el backend
async function cargarDatosCard() {
  try {
    const response = await fetch("/admin/competencias/obtenerTotalesCompetencias"); // Asegúrate de que esta ruta coincida con la del backend

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
    console.log(data);

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
    const response = await fetch("/admin/competencias/obtenerCompetencias"); // Asegúrate de que esta ruta coincida con la del backend
    const data = await response.json();
    if (data.status !== "success") {
      console.error("❌ Error en la respuesta del servidor:", data.message);
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
    console.log(info);
  document.getElementById("total_competencias").textContent =
    info.total_competencias;
  document.getElementById("competencias_activas").textContent =
    info.total_activas;

  document.getElementById("competencias_inactivas").textContent =
    info.total_inactivas;
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
        { data: "id_competencia" },
        { data: "codigo" },
        { data: "nombre" },
        { data: "descripcion" },
        { data: "nombre_profesor" },
        { data: "estado",
          render: function(data, type, row) {
            return data ? "Inactiva" : "Activa";
          }
        },
        
      ],
      destroy: true,
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
      },
    });
    tablaInicializada = true;
    console.log("✅ DataTable inicializado con:", data);
  } else {
    let table = $("#dataTable").DataTable();
    table.clear();
    table.rows.add(data);
    table.draw();
    console.log("🔄 DataTable actualizado con:", data);
  }
}
