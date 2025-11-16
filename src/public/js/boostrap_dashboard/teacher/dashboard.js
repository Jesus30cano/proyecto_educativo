document.addEventListener("DOMContentLoaded", () => {
  cargarTotales();
  cargarCursos();
  cargarActividadesPendientes();
});

/* ================================
   1) CARGAR TOTAL DE CARDS
================================ */
async function cargarTotales() {
  try {
    const response = await fetch("/teacher/dashboard/obtenerResumenProfesor");

    const contentType = response.headers.get("content-type") || "";
    if (!contentType.includes("application/json")) {
      console.error("⚠️ Respuesta no JSON:", await response.text());
      return;
    }

    const data = await response.json();
    if (data.status !== "success") {
      console.warn("⚠ Error en totales:", data.message);
      return;
    }
    console.log("✅ Totales cargados:", data.data);
    document.getElementById("totalCursos").textContent =
      data.data.total_cursos ?? 0;
    document.getElementById("totalPendientes").textContent =
      data.data.total_competencias ?? 0;
  } catch (error) {
    console.error("❌ Error cargando totales:", error);
  }
}

/* ================================
   2) CARGAR TABLA DE CURSOS
================================ */
let tablaCursosIniciada = false;

async function cargarCursos() {
  try {
    const response = await fetch("/teacher/dashboard/obtenerCursosProfesor");

    const contentType = response.headers.get("content-type") || "";
    if (!contentType.includes("application/json")) {
      console.error("⚠️ Respuesta no JSON:", await response.text());
      return;
    }

    const data = await response.json();
    if (data.status !== "success") {
      console.warn("⚠ Error cargando cursos:", data.message);
      return;
    }

    if (!tablaCursosIniciada) {
      $("#tablaCursos").DataTable({
        data: data.data,
        columns: [{ data: "curso" }, { data: "ficha" }, { data: "competencia" }],
        pageLength: 5,
        destroy: true,
      });
      tablaCursosIniciada = true;
    } else {
      const tabla = $("#tablaCursos").DataTable();
      tabla.clear().rows.add(data.data).draw();
    }
  } catch (error) {
    console.error("❌ Error cargando cursos:", error);
  }
}

/* ============================================
   3) CARGAR TABLA ACTIVIDADES PENDIENTES
=============================================== */
let tablaActividadesIniciada = false;

async function cargarActividadesPendientes() {
  try {
    const response = await fetch("/teacher/dashboard/obtenerActividadesPendientes");

    const contentType = response.headers.get("content-type") || "";
    if (!contentType.includes("application/json")) {
      console.error("⚠️ Respuesta no JSON:", await response.text());
      return;
    }

    const data = await response.json();
    if (data.status !== "success") {
      console.warn("⚠ Error cargando actividades:", data.message);
      return;
    }

    if (!tablaActividadesIniciada) {
      $("#tablaActividades").DataTable({
        data: data.data,
        columns: [
          { data: "ficha" },
          { data: "nombre_curso" },
          { data: "nombre_competencia" },
          { data: "titulo_actividad" },
          { data: "fecha_entrega" },
        ],
        pageLength: 5,
        destroy: true,
      });
      tablaActividadesIniciada = true;
    } else {
      const tabla = $("#tablaActividades").DataTable();
      tabla.clear().rows.add(data.data).draw();
    }
  } catch (error) {
    console.error("❌ Error cargando actividades pendientes:", error);
  }
}
