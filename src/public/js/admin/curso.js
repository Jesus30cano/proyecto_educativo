document.addEventListener("DOMContentLoaded", () => {
  cargarDatosDashboardTabla();
});
async function cargarDatosDashboardTabla() {
  try {
    const response = await fetch("/admin/dashboard/obtenerTotalesCursos"); // Asegúrate de que esta ruta coincida con la del backend
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
        { data: "ficha" },
        { data: "nombre_curso" },
        { data: "nombre_profesor" },
        { data: "fecha_inicio" },
        { data: "fecha_fin" },
        { data: "cantidad_estudiantes" },
        {
          data: "ficha_activa",
          render: function (data, type, row) {
            return data ? "activa" : "inactiva";
          },
        },
      ],
      destroy: true,
      language: {
        url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
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
