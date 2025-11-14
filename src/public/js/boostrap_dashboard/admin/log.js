document.addEventListener("DOMContentLoaded", () => {
  cargarDatosLog();
  
});
let tablaInicializada = false;
async function cargarDatosLog() {
  try {
    const response = await fetch("/general/mostrarLogGeneral");

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
    $("#example22").DataTable({
      data: data,
      columns: [
        { data: "id_usuario" },
        { data: "nombre_completo" },
        { data: "actividad" },
        { data: "fecha" },
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