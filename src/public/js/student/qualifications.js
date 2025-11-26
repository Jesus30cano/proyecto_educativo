const URL_CALIFICACIONES =
  "/student/qualifications/obtenerCalificacionesPorEstudiante";

// Guardamos todas las calificaciones para poder filtrar
let calificacionesGlobal = [];

document.addEventListener("DOMContentLoaded", function () {
  cargarCalificaciones();

  // Botón "Aplicar filtro"
  const btnFiltro = document.getElementById("btnAplicarFiltro");
  if (btnFiltro) {
    btnFiltro.addEventListener("click", aplicarFiltroCompetencia);
  }
});

// =============================
//   CARGA INICIAL DE DATOS
// =============================
async function cargarCalificaciones() {
  try {
    const response = await fetch(URL_CALIFICACIONES, {
      method: "GET",
      headers: {
        Accept: "application/json",
      },
    });

    if (!response.ok) {
      mostrarErrorEnPantalla("Error al comunicarse con el servidor.");
      return;
    }

    const result = await response.json();

    if (result.status !== "success") {
      mostrarErrorEnPantalla(
        result.message || "Error al obtener calificaciones."
      );
      return;
    }

    const calificaciones = result.data || [];
    calificacionesGlobal = calificaciones;

    // Render general (todas las competencias)
    renderizarCompetencias(calificaciones);
    renderizarTabla(calificaciones);
    llenarSelectCompetencias(calificaciones);
  } catch (error) {
    console.error("Error al cargar calificaciones:", error);
    mostrarErrorEnPantalla("Error al cargar calificaciones.");
  }
}

function mostrarErrorEnPantalla(mensaje) {
  const cont = document.getElementById("lista-competencias");
  if (cont) {
    cont.innerHTML = `<p class="text-danger mb-0">${mensaje}</p>`;
  }
}

// =============================
//   FILTRO POR COMPETENCIA
// =============================
function llenarSelectCompetencias(calificaciones) {
  const select = document.getElementById("selectCompetencia");
  if (!select) return;

  // Siempre dejamos la opción "todas" al inicio
  select.innerHTML = `<option value="todas" selected>Todas las Competencias</option>`;

  const competenciasSet = new Set();

  calificaciones.forEach((item) => {
    if (item.nombre_competencia) {
      competenciasSet.add(item.nombre_competencia);
    }
  });

  competenciasSet.forEach((nombre) => {
    // value = nombre tal cual para comparar fácil
    select.innerHTML += `<option value="${nombre}">${nombre}</option>`;
  });
}

function aplicarFiltroCompetencia() {
  const select = document.getElementById("selectCompetencia");
  if (!select) return;

  const seleccion = select.value;

  let filtradas = calificacionesGlobal;

  if (seleccion && seleccion !== "todas") {
    filtradas = calificacionesGlobal.filter(
      (item) => item.nombre_competencia === seleccion
    );
  }

  // Render solo con las filtradas
  renderizarCompetencias(filtradas);
  renderizarTabla(filtradas);
}

// ======================================================
//   LISTA DE APROBACIÓN DE COMPETENCIAS (tarjetas verdes,
//   rojas y amarillas de la columna izquierda)
// ======================================================

function renderizarCompetencias(calificaciones) {
  const contenedor = document.getElementById("lista-competencias");
  if (!contenedor) {
    console.warn("No se encontró el contenedor #lista-competencias");
    return;
  }

  contenedor.innerHTML = "";

  // Agrupamos por nombre_competencia
  const porCompetencia = {};

  calificaciones.forEach((item) => {
    const nombre = item.nombre_competencia || "Sin nombre";
    const calificacion = (item.calificacion || "").toLowerCase(); // 'aprobado', 'reprobado' o ''

    if (!porCompetencia[nombre]) {
      porCompetencia[nombre] = {
        nombre,
        tieneAprobado: false,
        tieneReprobado: false,
        tienePendiente: false,
      };
    }

    if (calificacion === "aprobado") {
      porCompetencia[nombre].tieneAprobado = true;
    } else if (calificacion === "reprobado") {
      porCompetencia[nombre].tieneReprobado = true;
    } else {
      porCompetencia[nombre].tienePendiente = true;
    }
  });

  let countAprobadas = 0;
  let countNoAprobadas = 0;
  let countPendientes = 0;

  // Crear una card por competencia
  Object.values(porCompetencia).forEach((comp) => {
    let bordeClase = "";
    let badgeClase = "";
    let textoBadge = "";

    // Regla de prioridad:
    // - Si hay alguna reprobada -> No aprobado
    // - Si no hay reprobadas y sí hay aprobadas -> Aprobado
    // - Si solo hay pendientes -> Pendiente
    if (comp.tieneReprobado) {
      bordeClase = "border-left-danger";
      badgeClase = "badge badge-danger text-white";
      textoBadge = "No aprobado";
      countNoAprobadas++;
    } else if (comp.tieneAprobado) {
      bordeClase = "border-left-success";
      badgeClase = "badge badge-success text-white";
      textoBadge = "Aprobado";
      countAprobadas++;
    } else {
      bordeClase = "border-left-warning";
      badgeClase = "badge badge-warning text-white";
      textoBadge = "Pendiente";
      countPendientes++;
    }

    const card = document.createElement("div");
    card.className = `card mb-3 shadow-sm ${bordeClase}`;
    card.innerHTML = `
            <div class="card-body d-flex justify-content-between align-items-center">
                <span>${comp.nombre}</span>
                <span class="${badgeClase}" style="font-size: 0.9rem; padding: 0.6rem 1.2rem;">
                    ${textoBadge}
                </span>
            </div>
        `;

    contenedor.appendChild(card);
  });

  // Si el estudiante aún no tiene actividades / competencias
  if (Object.keys(porCompetencia).length === 0) {
    contenedor.innerHTML =
      '<p class="text-muted mb-0">No hay competencias registradas.</p>';
  }

  // Actualizar contadores de la columna derecha
  const spanAprobadas = document.getElementById("count-aprobadas");
  const spanNoAprobadas = document.getElementById("count-no-aprobadas");
  const spanPendientes = document.getElementById("count-pendientes");

  if (spanAprobadas) spanAprobadas.textContent = countAprobadas;
  if (spanNoAprobadas) spanNoAprobadas.textContent = countNoAprobadas;
  if (spanPendientes) spanPendientes.textContent = countPendientes;
}

// =======================================
//      TABLA DETALLADA DE CALIFICACIONES
// =======================================

function renderizarTabla(calificaciones) {
  const tbody = document.getElementById("tbody-calificaciones");
  if (!tbody) {
    console.warn("No se encontró el tbody #tbody-calificaciones");
    return;
  }

  tbody.innerHTML = "";

  calificaciones.forEach((item) => {
    // Mapeo directo según la función obtener_calificaciones_por_estudiante
    const competencia = item.nombre_competencia || "N/D";
    const tituloActividad = item.titulo_actividad || "N/D";
    const fechaEntrega = item.fecha_entrega
      ? formatearFecha(item.fecha_entrega)
      : "N/D";
    const calificacion = item.calificacion || ""; // 'aprobado' / 'reprobado' / null
    const estado = item.estado || ""; // 'Sin entregar', etc.

    // No tienes profesor en esta función, así que dejamos N/D o lo ajustas luego en SQL
    const profesor = "N/D";

    // Badge según calificación
    let badgeClase = "badge badge-secondary";
    if ((calificacion || "").toLowerCase() === "aprobado") {
      badgeClase = "badge badge-success";
    } else if ((calificacion || "").toLowerCase() === "reprobado") {
      badgeClase = "badge badge-danger";
    }

    const tr = document.createElement("tr");
    tr.innerHTML = `
            <td>${profesor}</td>
            <td>${competencia}</td>
            <td>${tituloActividad}</td>
            <td>${fechaEntrega}</td>
            <td>
                ${
                  calificacion
                    ? `<span class="${badgeClase} text-white text-capitalize">${calificacion}</span>`
                    : "-"
                }
            </td>
            <td>${estado}</td>
        `;

    tbody.appendChild(tr);
  });

  // Integración con DataTables si ya está cargado
  if (window.jQuery && $.fn.DataTable && $("#dataTable").length > 0) {
    const yaInicializada = $.fn.DataTable.isDataTable("#dataTable");

    if (yaInicializada) {
      const tabla = $("#dataTable").DataTable();
      tabla.rows().invalidate().draw();
    } else {
      $("#dataTable").DataTable();
    }
  }
}

// =========================
//     FUNCIONES AUXILIARES
// =========================

function formatearFecha(fechaISO) {
  // fechaISO vendrá como '2025-01-01T00:00:00' o similar
  const fecha = new Date(fechaISO);
  if (isNaN(fecha.getTime())) {
    return fechaISO; // si no se puede parsear, se devuelve tal cual
  }

  const anio = fecha.getFullYear();
  const mes = String(fecha.getMonth() + 1).padStart(2, "0");
  const dia = String(fecha.getDate()).padStart(2, "0");

  return `${anio}-${mes}-${dia}`;
}
