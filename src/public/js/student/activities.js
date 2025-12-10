const URL_ACTIVIDADES = "/student/activities/obtenerActividadesPendientes";

let actividadesGlobal = [];

document.addEventListener("DOMContentLoaded", () => {
  cargarActividades();

  const btnBuscar = document.getElementById("btnBuscarActividades");
  if (btnBuscar) {
    btnBuscar.addEventListener("click", aplicarFiltroActividades);
  }

  // Event listener para el botón de enviar actividad en el modal
  configurarEnvioActividad();
});

// =============================
//   CARGA INICIAL DE ACTIVIDADES
// =============================
async function cargarActividades() {
  try {
    const response = await fetch(URL_ACTIVIDADES, {
      method: "GET",
      headers: {
        Accept: "application/json",
      },
    });

    if (!response.ok) {
      mostrarMensajeActividades("Error al comunicarse con el servidor.", true);
      return;
    }

    const result = await response.json();

    if (result.status !== "success") {
      mostrarMensajeActividades(
        result.message || "Error al obtener actividades.",
        true
      );
      return;
    }

    const actividades = result.data || [];
    actividadesGlobal = actividades;
    if (!actividades.length) {
      mostrarMensajeActividades(
        "No tienes actividades asignadas por el momento."
      );
      return;
    }
    llenarSelectCompetencias(actividades);
    renderizarActividades(actividades);
  } catch (err) {
    console.error("Error al cargar actividades:", err);
    mostrarMensajeActividades("Error al cargar actividades.", true);
  }
}

function mostrarMensajeActividades(mensaje, esError = false) {
  const cont = document.getElementById("contenedor-actividades");
  if (!cont) return;

  cont.innerHTML = `
        <div class="col-12">
            <p class="${
              esError ? "text-danger" : "text-muted"
            } mb-0">${mensaje}</p>
        </div>
    `;
}

// =============================
//   FILTRO POR COMPETENCIA
// =============================
function llenarSelectCompetencias(actividades) {
  const select = document.getElementById("selectCompetencia");
  if (!select) return;

  select.innerHTML = `<option value="todas" selected>Todas las Competencias</option>`;

  const competencias = new Set();

  actividades.forEach((act) => {
    if (act.nombre_competencia) {
      competencias.add(act.nombre_competencia);
    }
  });

  competencias.forEach((nombre) => {
    select.innerHTML += `<option value="${nombre}">${nombre}</option>`;
  });
}

function aplicarFiltroActividades() {
  const select = document.getElementById("selectCompetencia");
  if (!select) return;

  const seleccion = select.value;

  let filtradas = actividadesGlobal;

  if (seleccion && seleccion !== "todas") {
    filtradas = actividadesGlobal.filter(
      (act) => act.nombre_competencia === seleccion
    );
  }

  renderizarActividades(filtradas);
}

// =============================
//   RENDER DE TARJETAS
// =============================
function renderizarActividades(actividades) {
  const contenedor = document.getElementById("contenedor-actividades");
  if (!contenedor) return;

  contenedor.innerHTML = "";

  if (!actividades.length) {
    mostrarMensajeActividades(
      "No tienes actividades asignadas por el momento."
    );
    return;
  }

  actividades.forEach((act) => {
    const idActividad = act.id_actividad;
    const titulo = act.titulo_actividad || act.titulo || "Actividad sin título";
    const descripcion = act.descripcion || "Sin descripción.";
    const fechaEntrega = act.fecha_entrega || null;
    const competencia = act.nombre_competencia || "Competencia no especificada";
    const profesor = act.nombre_profesor || "Profesor no asignado";
    const estadoRaw = (act.estado_entrega || "").toLowerCase();
    const calificacionRaw = act.calificacion || null;

    // Lógica visual según estado
    let textoEstado = "Pendiente";
    let borderClase = "border-warning";
    let headerClase = "bg-warning";
    let badgeClase = "bg-light text-dark";
    let iconoEstado = "bi-exclamation-circle";
    let textoFechaClase = "text-danger";
    let btnDetalles = "bg-warning";

    if (estadoRaw === "calificada") {
      textoEstado = "Calificada";
      borderClase = "border-info";
      headerClase = "bg-info";
      badgeClase = "bg-light text-info";
      iconoEstado = "bi-star-fill";
      textoFechaClase = "text-success";
      btnDetalles = "bg-success";
    } else if (estadoRaw === "entregada") {
      textoEstado = "Entregada";
      borderClase = "border-success";
      headerClase = "bg-success";
      badgeClase = "bg-light text-success";
      iconoEstado = "bi-check-circle";
      textoFechaClase = "text-success";
    }

    const fechaTexto = fechaEntrega ? formatearFecha(fechaEntrega) : null;

    let notaTexto = "";
    if (calificacionRaw) {
      notaTexto = `Estado: ${capitalizar(calificacionRaw)}`; // Aprobado / Reprobado
    }

    const col = document.createElement("div");
    col.className = "col-md-6 mb-3";

    col.innerHTML = `
            <div class="card h-100 ${borderClase} shadow-sm">
                <div class="card-header ${headerClase} text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 font-weight-bold">${titulo}</h6>
                        <span class="badge ${badgeClase}">
                            <i class="bi ${iconoEstado}"></i> ${textoEstado}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-1">
                        <small><i class="bi bi-bookmark me-1"></i>${competencia}</small>
                    </p>
                    <p class="text-muted mb-2">
                        <small><i class="bi bi-person-badge me-1"></i>${profesor}</small>
                    </p>

                    <p class="card-text small">${descripcion}</p>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="${textoFechaClase}">
                            ${
                              fechaTexto
                                ? `<i class="bi bi-calendar-event me-1"></i><small>Vence: ${fechaTexto}</small>`
                                : ""
                            }
                        </span>

                        <button class="btn btn-sm ${btnDetalles} text-white btn-ver-detalles"
                            data-id-actividad="${idActividad}">
                            <i class="bi bi-eye me-1"></i>Ver Detalles
                        </button>
                    </div>

                    ${
                      notaTexto
                        ? `<div class="mt-2 text-end"><small class="text-success"><i class="bi bi-check2-circle me-1"></i>${notaTexto}</small></div>`
                        : ""
                    }
                </div>
            </div>
        `;

    contenedor.appendChild(col);
  });

  // Agregar event listeners a los botones de "Ver Detalles"
  agregarEventListenersDetalles();
}

// =============================
//   EVENT LISTENERS PARA MODALES
// =============================
function agregarEventListenersDetalles() {
  const botones = document.querySelectorAll('.btn-ver-detalles');
  
  botones.forEach(boton => {
    boton.addEventListener('click', function() {
      const idActividad = this.getAttribute('data-id-actividad');
      abrirModalActividad(idActividad);
    });
  });
}

function abrirModalActividad(idActividad) {
  // Buscar la actividad en el array global
  const actividad = actividadesGlobal.find(act => act.id_actividad == idActividad);
  
  if (!actividad) {
    console.error('Actividad no encontrada:', idActividad);
    return;
  }

  // Determinar qué modal abrir según el estado
  const estadoRaw = (actividad.estado_entrega || "").toLowerCase();
  
  let modalId = 'modalActividad1'; // Modal para pendientes
  
  if (estadoRaw === 'calificada' || estadoRaw === 'entregada') {
    modalId = 'modalActividad2'; // Modal para entregadas/calificadas
  }

  // Llenar el modal con los datos de la actividad
  llenarDatosModal(modalId, actividad);
  
  // Abrir el modal usando Bootstrap 4
  $(`#${modalId}`).modal('show');
}

function llenarDatosModal(modalId, actividad) {
  const modal = document.getElementById(modalId);
  if (!modal) return;

  const titulo = actividad.titulo_actividad || actividad.titulo || "Sin título";
  const competencia = actividad.nombre_competencia || "No especificada";
  const descripcion = actividad.descripcion || "Sin descripción";
  const fechaEntrega = actividad.fecha_entrega ? formatearFechaCompleta(actividad.fecha_entrega) : "No especificada";
  const calificacion = actividad.calificacion || null;
  const observaciones = actividad.observaciones || "Sin observaciones del profesor.";
  const rutaArchivoActividad = actividad.ruta_archivo_actividad || null;
  const rutaArchivoEntrega = actividad.ruta_archivo_entrega || null;

  // Actualizar título del modal
  const tituloElement = modal.querySelector('.modal-title');
  if (tituloElement) {
    const icono = modalId === 'modalActividad2' ? 'bi-file-earmark-check' : 'bi-file-earmark-text';
    tituloElement.innerHTML = `<i class="bi ${icono} me-2"></i>${titulo}`;
  }

  // Para el modal de actividad PENDIENTE (modalActividad1)
  if (modalId === 'modalActividad1') {
    // Actualizar competencia
    const competenciaP = modal.querySelector('.mb-3:nth-child(1) p');
    if (competenciaP) competenciaP.textContent = competencia;

    // Actualizar descripción
    const descripcionP = modal.querySelector('.mb-3:nth-child(2) p');
    if (descripcionP) descripcionP.textContent = descripcion;

    // Actualizar fecha de entrega
    const fechaP = modal.querySelector('.text-danger.fw-bold');
    if (fechaP) fechaP.textContent = fechaEntrega;

    // Actualizar enlace de descarga del documento de instrucciones
    const linkDescarga = modal.querySelector('a.btn-outline-primary');
    if (linkDescarga) {
      if (rutaArchivoActividad) {
        linkDescarga.href = rutaArchivoActividad;
        linkDescarga.style.display = '';
        linkDescarga.setAttribute('download', '');
        linkDescarga.setAttribute('target', '_blank');
      } else {
        linkDescarga.style.display = 'none';
      }
    }

    // Guardar ID de actividad en el botón de enviar
    const btnEnviar = modal.querySelector('.btn-success');
    if (btnEnviar) {
      btnEnviar.setAttribute('data-id-actividad', actividad.id_actividad);
    }
  }

  // Para el modal de actividad ENTREGADA/CALIFICADA (modalActividad2)
  if (modalId === 'modalActividad2') {
    // Actualizar competencia
    const competenciaP = modal.querySelector('.mb-3:nth-child(2) p');
    if (competenciaP) competenciaP.textContent = competencia;

    // Actualizar descripción
    const descripcionP = modal.querySelector('.mb-3:nth-child(3) p');
    if (descripcionP) descripcionP.textContent = descripcion;

    // Actualizar fecha de entrega
    const fechaP = modal.querySelector('.mb-3:nth-child(4) p');
    if (fechaP) fechaP.textContent = fechaEntrega;

    // Actualizar calificación
    if (calificacion) {
      const resultadoH4 = modal.querySelector('h4.text-success, h4.text-danger');
      if (resultadoH4) {
        const esAprobado = calificacion.toLowerCase() === 'aprobado';
        resultadoH4.className = esAprobado ? 'text-success' : 'text-danger';
        resultadoH4.textContent = capitalizar(calificacion);
      }
    }

    // Actualizar observaciones del profesor
    const observacionesDiv = modal.querySelector('.alert.alert-info');
    if (observacionesDiv) {
      observacionesDiv.textContent = observaciones;
    }

    // Actualizar enlaces de descarga
    const linkInstrucciones = modal.querySelector('a.btn-outline-primary');
    if (linkInstrucciones) {
      if (rutaArchivoActividad) {
        linkInstrucciones.href = rutaArchivoActividad;
        linkInstrucciones.style.display = '';
        linkInstrucciones.setAttribute('download', '');
        linkInstrucciones.setAttribute('target', '_blank');
      } else {
        linkInstrucciones.style.display = 'none';
      }
    }

    const linkEntrega = modal.querySelector('a.btn-outline-success');
    if (linkEntrega) {
      if (rutaArchivoEntrega) {
        linkEntrega.href = rutaArchivoEntrega;
        linkEntrega.style.display = '';
        linkEntrega.setAttribute('download', '');
        linkEntrega.setAttribute('target', '_blank');
      } else {
        linkEntrega.style.display = 'none';
      }
    }
  }
}

// =========================
//     FUNCIONES AUXILIARES
// =========================
function formatearFecha(fechaISO) {
  if (!fechaISO) return "";

  const fecha = new Date(fechaISO);
  if (isNaN(fecha.getTime())) {
    return fechaISO;
  }

  const opciones = { year: "numeric", month: "short", day: "2-digit" };
  return fecha.toLocaleDateString("es-ES", opciones);
}

function formatearFechaCompleta(fechaISO) {
  if (!fechaISO) return "";

  const fecha = new Date(fechaISO);
  if (isNaN(fecha.getTime())) {
    return fechaISO;
  }

  const opciones = { 
    year: "numeric", 
    month: "long", 
    day: "numeric",
    weekday: "long"
  };
  return fecha.toLocaleDateString("es-ES", opciones);
}

function capitalizar(texto) {
  if (!texto) return "";
  texto = String(texto).toLowerCase();
  return texto.charAt(0).toUpperCase() + texto.slice(1);
}

// =============================
//   ENVÍO DE ACTIVIDADES
// =============================
function configurarEnvioActividad() {
  // Delegación de eventos para el botón de enviar en modalActividad1
  $(document).on('click', '#modalActividad1 .btn-success', function() {
    const idActividad = $(this).data('id-actividad');
    if (idActividad) {
      enviarActividad(idActividad);
    }
  });
}

async function enviarActividad(idActividad) {
  const modal = document.getElementById('modalActividad1');
  const inputArchivo = modal.querySelector('#archivoEntrega1');
  const textareaDescripcion = modal.querySelector('#descripcionEntrega1');

  // Validar que se haya seleccionado un archivo
  if (!inputArchivo.files || !inputArchivo.files[0]) {
    mostrarToast('Por favor, selecciona un archivo para entregar.', 'warning');
    return;
  }

  const archivo = inputArchivo.files[0];
  const descripcion = textareaDescripcion.value.trim();

  // Validar tamaño del archivo (máx 10MB)
  const maxSize = 10 * 1024 * 1024;
  if (archivo.size > maxSize) {
    mostrarToast('El archivo supera el tamaño máximo permitido (10MB).', 'error');
    return;
  }

  // Crear FormData para enviar el archivo
  const formData = new FormData();
  formData.append('archivo', archivo);
  formData.append('id_actividad', idActividad);
  formData.append('descripcion', descripcion);

  try {
    // Deshabilitar botón mientras se procesa
    const btnEnviar = modal.querySelector('.btn-success');
    const textoOriginal = btnEnviar.innerHTML;
    btnEnviar.disabled = true;
    btnEnviar.innerHTML = '<i class="bi bi-hourglass-split me-1"></i>Enviando...';

    const response = await fetch('/student/activities/subirArchivoActividad', {
      method: 'POST',
      body: formData
    });

    const result = await response.json();

    if (result.status === 'success') {
      mostrarToast('Actividad entregada correctamente.', 'success');
      
      // Cerrar modal
      $('#modalActividad1').modal('hide');
      
      // Recargar actividades
      await cargarActividades();
      
      // Limpiar formulario
      inputArchivo.value = '';
      textareaDescripcion.value = '';
    } else {
      mostrarToast(result.message || 'Error al entregar la actividad.', 'error');
    }

    // Restaurar botón
    btnEnviar.disabled = false;
    btnEnviar.innerHTML = textoOriginal;

  } catch (error) {
    console.error('Error al enviar actividad:', error);
    mostrarToast('Error al procesar la entrega.', 'error');
    
    // Restaurar botón en caso de error
    const btnEnviar = modal.querySelector('.btn-success');
    btnEnviar.disabled = false;
    btnEnviar.innerHTML = '<i class="bi bi-send me-1"></i>Enviar Actividad';
  }
}

// Función auxiliar para mostrar notificaciones
function mostrarToast(mensaje, tipo = 'info') {
  // Si existe una función global de toast, usarla
  if (typeof showToast === 'function') {
    showToast(mensaje, tipo);
    return;
  }

  // Fallback: usar alert simple
  const iconos = {
    success: '✓',
    error: '✗',
    warning: '⚠',
    info: 'ℹ'
  };
  
  alert(`${iconos[tipo] || ''} ${mensaje}`);
}
