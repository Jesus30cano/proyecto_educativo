//  Apartado de Evaluaciones - Estudiante
// ----------------------------------------------------

// Endpoint que devuelve las evaluaciones del estudiante
const URL_EVALUACIONES =
  "/student/evaluations/obtenerEvaluacionesPorEstudiante";

let evaluacionesGlobal = [];

document.addEventListener("DOMContentLoaded", () => {
  cargarEvaluaciones();

  const btnBuscar = document.getElementById("btnBuscarEvaluaciones");
  if (btnBuscar) {
    btnBuscar.addEventListener("click", aplicarFiltroEvaluaciones);
  }
});

async function cargarEvaluaciones() {
  try {
    const response = await fetch(URL_EVALUACIONES, {
      method: "GET",
      headers: {
        Accept: "application/json",
      },
    });

    if (!response.ok) {
      mostrarMensajeEvaluaciones("Error al comunicarse con el servidor.", true);
      return;
    }

    const result = await response.json();

    if (result.status !== "success") {
      mostrarMensajeEvaluaciones(
        result.message || "Error al obtener evaluaciones.",
        true
      );
      return;
    }

    const evaluaciones = result.data || [];
    evaluacionesGlobal = evaluaciones;

    llenarSelectCompetencias(evaluaciones);
    renderizarEvaluaciones(evaluaciones);
  } catch (err) {
    console.error("Error al cargar evaluaciones:", err);
    mostrarMensajeEvaluaciones("Error al cargar evaluaciones.", true);
  }
}

function mostrarMensajeEvaluaciones(mensaje, esError = false) {
  const cont = document.getElementById("contenedor-evaluaciones");
  if (!cont) return;

  cont.innerHTML = `
        <div class="col-12">
            <p class="${
              esError ? "text-danger" : "text-muted"
            } mb-0">${mensaje}</p>
        </div>
    `;
}

function llenarSelectCompetencias(evaluaciones) {
  const select = document.getElementById("selectCompetencia");
  if (!select) return;

  select.innerHTML = `<option value="todas" selected>Todas las competencias</option>`;

  const competencias = new Set();

  evaluaciones.forEach((ev) => {
    if (ev.nombre_competencia) {
      competencias.add(ev.nombre_competencia);
    }
  });

  competencias.forEach((nombre) => {
    select.innerHTML += `<option value="${nombre}">${nombre}</option>`;
  });
}

function aplicarFiltroEvaluaciones() {
  const selectComp = document.getElementById("selectCompetencia");
  const selectEstado = document.getElementById("selectEstado");

  if (!selectComp || !selectEstado) return;

  const filtroComp = selectComp.value;
  const filtroEstado = selectEstado.value; // 'todos', 'disponibles', 'inactivas'

  let filtradas = evaluacionesGlobal;

  // Filtro por competencia
  if (filtroComp && filtroComp !== "todas") {
    filtradas = filtradas.filter((ev) => ev.nombre_competencia === filtroComp);
  }

  // Filtro por estado
  if (filtroEstado && filtroEstado !== "todos") {
    filtradas = filtradas.filter((ev) => {
      const estado = (ev.estado || "").toLowerCase(); // disponible / inactiva / finalizada
      if (filtroEstado === "disponibles") {
        return estado === "disponible";
      } else if (filtroEstado === "inactivas") {
        return estado === "inactiva";
      }
      // si agregas 'finalizadas', etc., lo manejas aquí
      return true;
    });
  }

  renderizarEvaluaciones(filtradas);
}

function renderizarEvaluaciones(evaluaciones) {
  const contenedor = document.getElementById("contenedor-evaluaciones");
  if (!contenedor) return;

  contenedor.innerHTML = "";

  if (!evaluaciones.length) {
    mostrarMensajeEvaluaciones("No hay evaluaciones para mostrar.");
    return;
  }

  evaluaciones.forEach((ev) => {
    const idEvaluacion = ev.id_evaluacion;
    const titulo = ev.titulo_evaluacion || ev.titulo || "Evaluación sin título";
    const descripcion = ev.descripcion || "Sin descripción.";
    const fechaLimite = ev.fecha_limite || ev.fecha || null;
    const competencia = ev.nombre_competencia || "Competencia no especificada";
    const activa = ev.activa === true || ev.activa === "t";
    const estadoRaw = (ev.estado || "").toLowerCase();
    const nota = ev.nota || ev.calificacion || null;

    // Definir colores/badges según estado
    let badgeTexto = "Disponible";
    let badgeClase = "badge-success";
    let headerClase = "bg-warning";
    let iconoBadge = "fas fa-check-circle";
    let btnDetalles = "bg-warning";
    let notaDetalles = "badge-secondary";

    if (nota && nota.toLowerCase() === "aprobado") {
      notaDetalles = "badge-success";
    } else if (nota && nota.toLowerCase() === "reprobado") {
      notaDetalles = "badge-danger";
    }

    if (estadoRaw === "inactiva" || !activa) {
      badgeTexto = "Inactiva";
      badgeClase = "badge-danger";
      headerClase = "bg-secondary";
      iconoBadge = "fas fa-times-circle";
    } else if (estadoRaw === "finalizada") {
      badgeTexto = "Finalizada";
      badgeClase = "badge-light text-success";
      headerClase = "bg-success";
      iconoBadge = "fas fa-check-circle";
      btnDetalles = "bg-success";
    }

    const fechaTexto = fechaLimite ? formatearFecha(fechaLimite) : null;

    const col = document.createElement("div");
    col.className = "col-md-6 mb-4";

    col.innerHTML = `
            <div class="card shadow h-100">
                <div class="card-header py-3 ${headerClase} text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 font-weight-bold">${titulo}</h6>
                        <span class="badge ${badgeClase}">
                            <i class="${iconoBadge}"></i> ${badgeTexto}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-2">
                        <small><i class="fas fa-bookmark mr-1"></i>${competencia}</small>
                    </p>
                    <p class="card-text small">${descripcion}</p>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <button class="btn btn-sm ${btnDetalles} text-white btn-detalles-evaluacion"
                            data-id-evaluacion="${idEvaluacion}">
                            <i class="fas fa-eye mr-1"></i>Detalles
                        </button>
                        ${
                          nota
                            ? `<span class="badge ${notaDetalles}">
                                       <i class="fas fa-star"></i> Nota: ${nota}
                                   </span>`
                            : ""
                        }
                    </div>

                    <p class="text-muted mb-0 mt-2">
                        ${
                          fechaTexto
                            ? `<small><i class="far fa-calendar-alt mr-1"></i>Fecha límite: ${fechaTexto}</small>`
                            : ""
                        }
                    </p>
                </div>
            </div>
        `;

    contenedor.appendChild(col);
  });
}

// =========================
//     FUNCIONES AUXILIARES
// =========================
function formatearFecha(fechaISO) {
  if (!fechaISO) return "";

  const fecha = new Date(fechaISO);
  if (isNaN(fecha.getTime())) {
    return fechaISO; // si no se puede parsear, se devuelve tal cual
  }

  const opciones = { year: "numeric", month: "short", day: "2-digit" };
  return fecha.toLocaleDateString("es-ES", opciones);
}
