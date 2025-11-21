

const URL_ACTIVIDADES = '/student/activities/obtenerActividadesPendientes';


let actividadesGlobal = [];

document.addEventListener('DOMContentLoaded', () => {
    cargarActividades();

    const btnBuscar = document.getElementById('btnBuscarActividades');
    if (btnBuscar) {
        btnBuscar.addEventListener('click', aplicarFiltroActividades);
    }
});

// =============================
//   CARGA INICIAL DE ACTIVIDADES
// =============================
async function cargarActividades() {
    try {
        const response = await fetch(URL_ACTIVIDADES, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        });

        if (!response.ok) {
            mostrarMensajeActividades('Error al comunicarse con el servidor.', true);
            return;
        }

        const result = await response.json();

        if (result.status !== 'success') {
            mostrarMensajeActividades(result.message || 'Error al obtener actividades.', true);
            return;
        }

        const actividades = result.data || [];
        actividadesGlobal = actividades;

        llenarSelectCompetencias(actividades);
        renderizarActividades(actividades);

    } catch (err) {
        console.error('Error al cargar actividades:', err);
        mostrarMensajeActividades('Error al cargar actividades.', true);
    }
}

function mostrarMensajeActividades(mensaje, esError = false) {
    const cont = document.getElementById('contenedor-actividades');
    if (!cont) return;
x
    cont.innerHTML = `
        <div class="col-12">
            <p class="${esError ? 'text-danger' : 'text-muted'} mb-0">${mensaje}</p>
        </div>
    `;
}

// =============================
//   FILTRO POR COMPETENCIA
// =============================
function llenarSelectCompetencias(actividades) {
    const select = document.getElementById('selectCompetencia');
    if (!select) return;


    select.innerHTML = `<option value="todas" selected>Todas las Competencias</option>`;

    const competencias = new Set();

    actividades.forEach(act => {
        
        if (act.nombre_competencia) {
            competencias.add(act.nombre_competencia);
        }
    });

    competencias.forEach(nombre => {
        select.innerHTML += `<option value="${nombre}">${nombre}</option>`;
    });
}

function aplicarFiltroActividades() {
    const select = document.getElementById('selectCompetencia');
    if (!select) return;

    const seleccion = select.value;

    let filtradas = actividadesGlobal;

    if (seleccion && seleccion !== 'todas') {
        filtradas = actividadesGlobal.filter(act =>
            act.nombre_competencia === seleccion
        );
    }

    renderizarActividades(filtradas);
}

// =============================
//   RENDER DE TARJETAS
// =============================
function renderizarActividades(actividades) {
    const contenedor = document.getElementById('contenedor-actividades');
    if (!contenedor) return;

    contenedor.innerHTML = '';

    if (!actividades.length) {
        mostrarMensajeActividades('No tienes actividades asignadas por el momento.');
        return;
    }

    actividades.forEach(act => {
        
        const idActividad     = act.id_actividad;
        const titulo          = act.titulo_actividad || act.titulo || 'Actividad sin título';
        const descripcion     = act.descripcion || 'Sin descripción.';
        const fechaEntrega    = act.fecha_entrega || null;
        const competencia     = act.nombre_competencia || 'Competencia no especificada';
        const profesor        = act.nombre_profesor || 'Profesor no asignado';
        const estadoRaw       = (act.estado_entrega || '').toLowerCase(); 
        const calificacionRaw = act.calificacion || null;                 

        // Lógica visual según estado
        let textoEstado  = 'Pendiente';
        let borderClase  = 'border-warning';
        let headerClase  = 'bg-warning';
        let badgeClase   = 'bg-light text-dark';
        let iconoEstado  = 'bi-exclamation-circle';
        let textoFechaClase = 'text-danger';

        if (estadoRaw === 'calificada') {
            textoEstado      = 'Calificada';
            borderClase      = 'border-info';
            headerClase      = 'bg-info';
            badgeClase       = 'bg-light text-info';
            iconoEstado      = 'bi-star-fill';
            textoFechaClase  = 'text-success';
        } else if (estadoRaw === 'entregada') {
            textoEstado      = 'Entregada';
            borderClase      = 'border-success';
            headerClase      = 'bg-success';
            badgeClase       = 'bg-light text-success';
            iconoEstado      = 'bi-check-circle';
            textoFechaClase  = 'text-success';
        }

        const fechaTexto = fechaEntrega ? formatearFecha(fechaEntrega) : null;

        let notaTexto = '';
        if (calificacionRaw) {
            notaTexto = `Estado: ${capitalizar(calificacionRaw)}`; // Aprobado / Reprobado
        }

        const col = document.createElement('div');
        col.className = 'col-md-6 mb-3';

        col.innerHTML = `
            <div class="card h-100 ${borderClase} shadow-sm">
                <div class="card-header ${headerClase} text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">${titulo}</h6>
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
                                    : ''
                            }
                        </span>

                        <button class="btn btn-sm btn-primary btn-ver-detalles"
                            data-id-actividad="${idActividad}">
                            <i class="bi bi-eye me-1"></i>Ver Detalles
                        </button>
                    </div>

                    ${
                        notaTexto
                            ? `<div class="mt-2 text-end"><small class="text-success"><i class="bi bi-check2-circle me-1"></i>${notaTexto}</small></div>`
                            : ''
                    }
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
    if (!fechaISO) return '';

    const fecha = new Date(fechaISO);
    if (isNaN(fecha.getTime())) {
        return fechaISO;
    }

    const opciones = { year: 'numeric', month: 'short', day: '2-digit' };
    return fecha.toLocaleDateString('es-ES', opciones);
}

function capitalizar(texto) {
    if (!texto) return '';
    texto = String(texto).toLowerCase();
    return texto.charAt(0).toUpperCase() + texto.slice(1);
}