/**
 * Sistema de Notificaciones del Profesor
 * Maneja la carga, visualización y gestión de notificaciones
 */

let notificacionesGlobal = [];

document.addEventListener("DOMContentLoaded", () => {
  cargarNotificaciones();
  
  // Actualizar notificaciones cada 60 segundos
  setInterval(() => {
    cargarNotificaciones();
  }, 60000);
});

/**
 * Carga las notificaciones desde el servidor
 */
async function cargarNotificaciones() {
  try {
    const response = await fetch("/teacher/notifications/obtenerNotificacionesPorUsuario", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
    });

    if (!response.ok) {
      throw new Error("Error al cargar notificaciones");
    }

    const data = await response.json();

    if (data.status === "success") {
      notificacionesGlobal = data.data || [];
      renderizarNotificaciones();
      actualizarContador();
    } else {
      console.error("Error:", data.message);
    }
  } catch (error) {
    console.error("❌ Error al cargar notificaciones:", error);
  }
}

/**
 * Renderiza las notificaciones en el dropdown y el modal
 */
function renderizarNotificaciones() {
  renderizarDropdown();
  renderizarModal();
}

/**
 * Renderiza las notificaciones en el dropdown (últimas 3)
 */
function renderizarDropdown() {
  const dropdownContainer = document.getElementById("notificaciones-dropdown");
  
  if (!dropdownContainer) {
    return;
  }

  // Limpiar contenido existente excepto el encabezado
  const header = dropdownContainer.querySelector(".dropdown-header");
  dropdownContainer.innerHTML = "";
  if (header) {
    dropdownContainer.appendChild(header);
  } else {
    dropdownContainer.innerHTML = `
      <h6 class="dropdown-header blue-claro text-white">
        Notificaciones
      </h6>
    `;
  }

  // Mostrar últimas 3 notificaciones no leídas o las más recientes
  const notificacionesMostrar = notificacionesGlobal.slice(0, 3);

  if (notificacionesMostrar.length === 0) {
    dropdownContainer.innerHTML += `
      <div class="dropdown-item text-center text-muted py-3">
        <i class="fas fa-check-circle mr-2"></i>
        No tienes notificaciones nuevas
      </div>
    `;
  } else {
    notificacionesMostrar.forEach((notif) => {
      const notifElement = crearElementoNotificacionDropdown(notif);
      dropdownContainer.appendChild(notifElement);
    });
  }

  // Agregar enlace para ver más notificaciones
  const verMasLink = document.createElement("a");
  verMasLink.className = "dropdown-item text-center text-gray-900";
  verMasLink.href = "#";
  verMasLink.setAttribute("data-toggle", "modal");
  verMasLink.setAttribute("data-target", "#modalMostrarNotificaciones");
  verMasLink.textContent = "Mostrar más notificaciones";
  dropdownContainer.appendChild(verMasLink);
}

/**
 * Crea un elemento de notificación para el dropdown
 */
function crearElementoNotificacionDropdown(notif) {
  const link = document.createElement("a");
  link.className = "dropdown-item d-flex align-items-center";
  link.href = "#";
  link.style.cursor = "pointer";
  
  // Si no está leída, agregar fondo especial
  if (!notif.leida) {
    link.style.backgroundColor = "#f0f8ff";
  }

  const iconColor = obtenerColorIcono(notif.tipo);
  const icono = obtenerIcono(notif.tipo);

  link.innerHTML = `
    <div class="mr-3">
      <div class="icon-circle ${iconColor}">
        <i class="${icono} text-white"></i>
      </div>
    </div>
    <div>
      <div class="font-weight-bold" style="color: ${obtenerColorTexto(notif.tipo)}">
        ${notif.titulo}
      </div>
      <div class="small text-gray-800">${formatearFecha(notif.fecha_envio)}</div>
      <span class="text-truncate" style="max-width: 250px; display: inline-block;">
        ${notif.mensaje}
      </span>
    </div>
  `;

  // Marcar como leída al hacer clic
  link.addEventListener("click", (e) => {
    e.preventDefault();
    if (!notif.leida) {
      marcarComoLeida(notif.id_notificacion);
    }
  });

  return link;
}

/**
 * Renderiza todas las notificaciones en el modal
 */
function renderizarModal() {
  const modalContainer = document.getElementById("notificaciones-modal-body");
  
  if (!modalContainer) {
    return;
  }

  modalContainer.innerHTML = "";

  if (notificacionesGlobal.length === 0) {
    modalContainer.innerHTML = `
      <div class="text-center text-muted py-5">
        <i class="fas fa-bell-slash fa-3x mb-3" style="opacity: 0.3;"></i>
        <p class="h5">No tienes notificaciones</p>
      </div>
    `;
    return;
  }

  notificacionesGlobal.forEach((notif) => {
    const notifElement = crearElementoNotificacionModal(notif);
    modalContainer.appendChild(notifElement);
  });
}

/**
 * Crea un elemento de notificación para el modal
 */
function crearElementoNotificacionModal(notif) {
  const card = document.createElement("div");
  const colorClass = obtenerColorClase(notif.tipo);
  card.className = `card-notif ${colorClass} mb-3`;
  
  // Si no está leída, agregar borde más marcado
  if (!notif.leida) {
    card.style.borderWidth = "3px";
    card.style.backgroundColor = "#f0f8ff";
  }

  const iconColor = obtenerColorIcono(notif.tipo);
  const icono = obtenerIcono(notif.tipo);

  card.innerHTML = `
    <div class="d-flex align-items-start">
      <div class="mr-3">
        <div class="icon-circle ${iconColor}">
          <i class="${icono} text-white"></i>
        </div>
      </div>
      <div class="flex-grow-1">
        <div class="d-flex justify-content-between align-items-start">
          <div class="font-weight-bold" style="color: ${obtenerColorTexto(notif.tipo)}">
            ${notif.titulo}
            ${!notif.leida ? '<span class="badge badge-primary ml-2">Nueva</span>' : ''}
          </div>
          ${!notif.leida ? `
            <button class="btn btn-sm btn-outline-primary" onclick="marcarComoLeida(${notif.id_notificacion})">
              <i class="fas fa-check"></i> Marcar como leída
            </button>
          ` : ''}
        </div>
        <div class="small text-muted mb-2">
          <i class="far fa-clock mr-1"></i>${formatearFecha(notif.fecha_envio)}
        </div>
        <div class="text-dark">${notif.mensaje}</div>
      </div>
    </div>
  `;

  return card;
}

/**
 * Actualiza el contador de notificaciones no leídas
 */
function actualizarContador() {
  const contador = document.querySelector("#alertsDropdown .badge-counter");
  
  if (!contador) {
    return;
  }

  const noLeidas = notificacionesGlobal.filter((n) => !n.leida).length;

  if (noLeidas === 0) {
    contador.style.display = "none";
  } else {
    contador.style.display = "inline-block";
    contador.textContent = noLeidas > 9 ? "9+" : noLeidas;
  }
}

/**
 * Marca una notificación como leída
 */
async function marcarComoLeida(id_notificacion) {
  try {
    const response = await fetch("/teacher/notifications/marcarNotificacionLeida", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ id_notificacion }),
    });

    const data = await response.json();

    if (data.status === "success") {
      // Actualizar el estado local
      const notif = notificacionesGlobal.find(
        (n) => n.id_notificacion === id_notificacion
      );
      if (notif) {
        notif.leida = true;
      }
      
      // Re-renderizar
      renderizarNotificaciones();
      actualizarContador();
    } else {
      console.error("Error al marcar notificación:", data.message);
    }
  } catch (error) {
    console.error("❌ Error al marcar notificación como leída:", error);
  }
}

/**
 * Obtiene el color del icono según el tipo de notificación
 */
function obtenerColorIcono(tipo) {
  const colores = {
    aviso: "bg-primary",
    recordatorio: "bg-warning",
    alerta: "bg-danger",
    informacion: "bg-info",
    exito: "bg-success",
  };
  return colores[tipo.toLowerCase()] || "bg-primary";
}

/**
 * Obtiene el icono según el tipo de notificación
 */
function obtenerIcono(tipo) {
  const iconos = {
    aviso: "fas fa-bullhorn",
    recordatorio: "fas fa-clock",
    alerta: "fas fa-exclamation-triangle",
    informacion: "fas fa-info-circle",
    exito: "fas fa-check-circle",
  };
  return iconos[tipo.toLowerCase()] || "fas fa-bell";
}

/**
 * Obtiene el color del texto según el tipo
 */
function obtenerColorTexto(tipo) {
  const colores = {
    aviso: "#4e73df",
    recordatorio: "#f6c23e",
    alerta: "#e74a3b",
    informacion: "#36b9cc",
    exito: "#1cc88a",
  };
  return colores[tipo.toLowerCase()] || "#4e73df";
}

/**
 * Obtiene la clase de color para el card según el tipo
 */
function obtenerColorClase(tipo) {
  const clases = {
    aviso: "bg-primary-light",
    recordatorio: "bg-warning-light",
    alerta: "bg-danger-light",
    informacion: "bg-info-light",
    exito: "bg-success-light",
  };
  return clases[tipo.toLowerCase()] || "bg-primary-light";
}

/**
 * Formatea una fecha para mostrarla de forma amigable
 */
function formatearFecha(fecha) {
  const date = new Date(fecha);
  const hoy = new Date();
  const ayer = new Date(hoy);
  ayer.setDate(ayer.getDate() - 1);

  // Resetear las horas para comparar solo fechas
  const dateStr = date.toDateString();
  const hoyStr = hoy.toDateString();
  const ayerStr = ayer.toDateString();

  if (dateStr === hoyStr) {
    return `Hoy, ${date.toLocaleTimeString("es-ES", {
      hour: "2-digit",
      minute: "2-digit",
    })}`;
  } else if (dateStr === ayerStr) {
    return `Ayer, ${date.toLocaleTimeString("es-ES", {
      hour: "2-digit",
      minute: "2-digit",
    })}`;
  } else {
    return date.toLocaleDateString("es-ES", {
      day: "2-digit",
      month: "short",
      year: "numeric",
    });
  }
}
