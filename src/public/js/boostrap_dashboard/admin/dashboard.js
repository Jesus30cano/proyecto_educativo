document.addEventListener("DOMContentLoaded", () => {
  cargarDatosDashboard();
});

// Función para cargar datos desde el backend
async function cargarDatosDashboard() {
  try {
    const response = await fetch("/admin/dashboard/data"); // Asegúrate de que esta ruta coincida con la del backend

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
        "⚠️ Error en el backend:",
        data.message || "Respuesta no exitosa"
      );
      return;
    }

    actualizarContadores(data.data);
    actualizarTabla(data.data.cursos || []);
  } catch (error) {
    console.error("❌ Error cargando dashboard:", error);
  }
}

// 🔹 Actualiza los cards (contador)
function actualizarContadores(info) {
  document.getElementById("totalEstudiantes").textContent =
    info.totalEstudiantes;
  document.getElementById("totalProfesores").textContent = info.totalProfesores;
  document.getElementById("totalCursos").textContent = info.totalCursos;
}

// 🔹 Inicializamos DataTable una sola vez
let tablaInicializada = false;

function actualizarTabla(lista) {
  if (!tablaInicializada) {
    $("#example").DataTable({ //el nombre example es el id de la tabla, hay que cambiarlo por otro mas adecuado
      data: lista,
      columns: [
        { data: "curso" },
        { data: "nombre" }, // ✅ CORREGIDO (antes nombreCurso)
        { data: "ficha" },
        { data: "profesor" },
        { data: "lider" },
        { data: "estudiantes" }
      ],
      destroy: true // permite recargar en caso de cambios
    });

    tablaInicializada = true;
  } else {
    let table = $("#example").DataTable();
    table.clear();
    table.rows.add(lista);
    table.draw();
  }
}
