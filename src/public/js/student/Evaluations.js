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

  // Agregar event listeners a los botones de detalles
  agregarEventosDetalles();
}

// Función para agregar eventos a los botones de detalles
function agregarEventosDetalles() {
  const botonesDetalles = document.querySelectorAll('.btn-detalles-evaluacion');
  
  botonesDetalles.forEach(boton => {
    boton.addEventListener('click', function() {
      const idEvaluacion = this.getAttribute('data-id-evaluacion');
      abrirModalEvaluacion(idEvaluacion);
    });
  });
}

// Función para abrir el modal con los detalles de la evaluación
function abrirModalEvaluacion(idEvaluacion) {
  const evaluacion = evaluacionesGlobal.find(ev => ev.id_evaluacion == idEvaluacion);
  
  if (!evaluacion) {
    console.error('Evaluación no encontrada:', idEvaluacion);
    return;
  }

  // Llenar el modal con los datos de la evaluación
  const titulo = evaluacion.titulo_evaluacion || evaluacion.titulo || "Evaluación sin título";
  const descripcion = evaluacion.descripcion || "Sin descripción.";
  const fechaLimite = evaluacion.fecha_limite || evaluacion.fecha || null;
  const competencia = evaluacion.nombre_competencia || "Competencia no especificada";
  const activa = evaluacion.activa === true || evaluacion.activa === "t";
  const estadoRaw = (evaluacion.estado || "").toLowerCase();
  const numeroPreguntas = evaluacion.numero_preguntas || evaluacion.preguntas || "No especificado";
  
  // Determinar si está disponible o inactiva
  const esDisponible = estadoRaw === "disponible" && activa;
  
  // Actualizar el contenido del modal
  const modalLabel = document.getElementById('modalEvaluacion1Label');
  const modalBody = document.querySelector('#modalEvaluacion1 .modal-body');
  const modalHeader = document.querySelector('#modalEvaluacion1 .modal-header');
  const modalFooter = document.querySelector('#modalEvaluacion1 .modal-footer');
  
  if (!modalLabel || !modalBody || !modalHeader || !modalFooter) {
    console.error('No se encontraron elementos del modal');
    return;
  }

  // Actualizar título
  modalLabel.innerHTML = `<i class="fas fa-clipboard-check mr-2"></i>${titulo}`;
  
  // Actualizar clase del header
  modalHeader.className = esDisponible ? 'modal-header blue-claro text-white' : 'modal-header bg-secondary text-white';
  
  // Actualizar body
  const fechaTexto = fechaLimite ? formatearFecha(fechaLimite) : 'No especificada';
  
  if (esDisponible) {
    modalBody.innerHTML = `
      <div class="alert alert-info">
        <i class="fas fa-info-circle mr-2"></i>
        <strong>Evaluación Disponible</strong> - Puedes iniciarla en cualquier momento antes de la fecha límite.
      </div>

      <div class="mb-3">
        <h6 class="text-primary"><i class="fas fa-bookmark mr-2"></i>Competencia:</h6>
        <p>${competencia}</p>
      </div>

      <div class="mb-3">
        <h6 class="text-primary"><i class="fas fa-card-text mr-2"></i>Descripción:</h6>
        <p>${descripcion}</p>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <h6 class="text-primary"><i class="fas fa-list-ol mr-2"></i>Número de Preguntas:</h6>
          <p class="text-warning font-weight-bold">${numeroPreguntas} preguntas</p>
        </div>
      </div>

      <div class="mb-3">
        <h6 class="text-primary"><i class="fas fa-calendar-event mr-2"></i>Fecha Límite:</h6>
        <p class="text-danger font-weight-bold">${fechaTexto}</p>
      </div>

      <div class="alert alert-warning">
        <i class="fas fa-exclamation-triangle mr-2"></i>
        <strong>Importante:</strong> Una vez iniciada la evaluación, el tiempo comenzará a correr automáticamente y no podrás pausarla.
      </div>
    `;
    
    modalFooter.innerHTML = `
      <button type="button" class="btn btn-secondary" data-dismiss="modal">
        <i class="fas fa-times-circle mr-1"></i>Cancelar
      </button>
      <button type="button" class="btn btn-success">
        <i class="fas fa-play-circle mr-1"></i>Iniciar Evaluación
      </button>
    `;
  } else {
    modalBody.innerHTML = `
      <div class="alert alert-danger">
        <i class="fas fa-times-circle mr-2"></i>
        <strong>Evaluación Inactiva</strong> - Esta evaluación ya no está disponible porque venció la fecha límite.
      </div>

      <div class="mb-3">
        <h6 class="text-primary"><i class="fas fa-bookmark mr-2"></i>Competencia:</h6>
        <p>${competencia}</p>
      </div>

      <div class="mb-3">
        <h6 class="text-primary"><i class="fas fa-card-text mr-2"></i>Descripción:</h6>
        <p>${descripcion}</p>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <h6 class="text-muted"><i class="fas fa-list-ol mr-2"></i>Número de Preguntas:</h6>
          <p class="text-muted">${numeroPreguntas} preguntas</p>
        </div>
      </div>

      <div class="mb-3">
        <h6 class="text-danger"><i class="fas fa-calendar-x mr-2"></i>Fecha Límite:</h6>
        <p class="text-danger font-weight-bold">${fechaTexto}</p>
      </div>

      <div class="alert alert-secondary">
        <i class="fas fa-info-circle mr-2"></i>
        <strong>Nota:</strong> Contacta a tu profesor si necesitas más información sobre esta evaluación.
      </div>
    `;
    
    modalFooter.innerHTML = `
      <button type="button" class="btn btn-secondary" data-dismiss="modal">
        <i class="fas fa-times-circle mr-1"></i>Cerrar
      </button>
    `;
  }
  
  // Abrir el modal
  $('#modalEvaluacion1').modal('show');
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
