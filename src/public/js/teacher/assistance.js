let tablaHistorial = null;


document.addEventListener("DOMContentLoaded", () => {
    // Cargar cursos en ambos selects
    cargarCursosEnSelect("grupoAsistencia");
    cargarCursosEnSelect("selectGrupo");

    // Evento cambio de curso en el modal (para cargar estudiantes)
    const selectGrupoModal = document.getElementById("grupoAsistencia");
    if (selectGrupoModal) {
        selectGrupoModal.addEventListener("change", onChangeCursoAsistencia);
    }

    // Botón guardar asistencia (modal)
    const btnGuardar = document.getElementById("btnGuardarAsistencia");
    if (btnGuardar) {
        btnGuardar.addEventListener("click", guardarAsistenciaDia);
    }

    // Botón buscar asistencias (filtros superiores)
    const btnBuscar = document.getElementById("btnBuscarAsistencias");
    if (btnBuscar) {
        btnBuscar.addEventListener("click", buscarAsistencias);
    }

    // Inicializar DataTable del historial si jQuery / DataTables están disponibles
    if (window.$ && $.fn.DataTable) {
        tablaHistorial = $("#dataTable").DataTable(); // usa la config que ya tienes en datatables-demo.js
    }

    // Delegación de eventos para el botón de editar en la tabla
    const tbodyHistorial = document.querySelector("#dataTable tbody");
    if (tbodyHistorial) {
        tbodyHistorial.addEventListener("click", onClickEditarAsistencia);
    }

    const btnActualizar = document.getElementById("btnActualizarAsistencia");
    if (btnActualizar) {
        btnActualizar.addEventListener("click", actualizarAsistencia);
    }
});

// ======================================================
// CARGAR CURSOS EN CUALQUIER <select> POR ID
// ======================================================
function cargarCursosEnSelect(idSelect) {
    fetch("/teacher/dashboard/obtenerCursosProfesor")
        .then(res => res.json())
        .then(response => {
            const select = document.getElementById(idSelect);
            if (!select) return;

            select.innerHTML = "";

            if (response.status !== "success") {
                select.innerHTML = "<option>No hay cursos disponibles</option>";
                return;
            }

            const cursos = response.data;

            select.innerHTML = '<option value="">Seleccione un curso...</option>';

            cursos.forEach(curso => {
                select.innerHTML += `
                    <option value="${curso.id_curso}">
                        ${curso.curso} - Ficha ${curso.ficha}
                    </option>
                `;
            });
        })
        .catch(err => {
            console.error("Error obteniendo cursos:", err);
            const select = document.getElementById(idSelect);
            if (select) {
                select.innerHTML = "<option>Error cargando cursos</option>";
            }
        });
}

// ======================================================
// MODAL: CUANDO CAMBIA EL CURSO → CARGAR ESTUDIANTES
// ======================================================
function onChangeCursoAsistencia(e) {
    const idCurso = e.target.value;
    const tbody = document.getElementById("tbodyAsistencia");

    if (!idCurso) {
        limpiarTablaAsistencia();
        return;
    }

    fetch(`/teacher/dashboard/obtenerEstudiantesCurso?id_curso=${idCurso}`)
        .then(res => res.json())
        .then(response => {
            if (!tbody) return;

            tbody.innerHTML = "";

            if (response.status !== "success") {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center">
                            No se encontraron estudiantes para este curso
                        </td>
                    </tr>`;
                return;
            }

            const estudiantes = response.data;

            estudiantes.forEach((est, index) => {
                tbody.innerHTML += `
                    <tr data-id-estudiante-curso="${est.id_estudiante_curso}">
                        <td>${index + 1}</td>
                        <td>${est.nombre} ${est.apellido}</td>
                        <td>
                            <select class="form-select form-select-sm estado-asistencia">
                                <option value="presente" selected>✓ Presente</option>
                                <option value="ausente">✗ Ausente</option>
                                <option value="excusa">📄 Excusa</option>
                            </select>
                        </td>
                        <td>
                            <input type="text"
                                   class="form-control form-control-sm observacion"
                                   placeholder="Observaciones...">
                        </td>
                    </tr>
                `;
            });
        })
        .catch(err => {
            console.error("Error obteniendo estudiantes:", err);
            if (tbody) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center">
                            Error cargando estudiantes
                        </td>
                    </tr>`;
            }
        });
}

// ======================================================
// MODAL: LIMPIAR TABLA SI NO HAY CURSO SELECCIONADO
// ======================================================
function limpiarTablaAsistencia() {
    const tbody = document.getElementById("tbodyAsistencia");
    if (!tbody) return;

    tbody.innerHTML = `
        <tr>
            <td colspan="4" class="text-center">
                Seleccione un curso para listar los estudiantes
            </td>
        </tr>`;
}

// ======================================================
// MODAL: GUARDAR ASISTENCIA DEL DÍA
// ======================================================
function guardarAsistenciaDia() {
    const idCurso = document.getElementById("grupoAsistencia").value;
    const filas = document.querySelectorAll("#tbodyAsistencia tr");

    if (!idCurso) {
        alert("Debe seleccionar un curso.");
        return;
    }

    if (!filas.length) {
        alert("No hay estudiantes para registrar asistencia.");
        return;
    }

    const asistencias = [];

    filas.forEach(row => {
        const idEstudianteCurso = row.getAttribute("data-id-estudiante-curso");
        const selEstado = row.querySelector(".estado-asistencia");
        const inputObs = row.querySelector(".observacion");

        // Ignorar filas de mensaje sin data-id-estudiante-curso
        if (!idEstudianteCurso || !selEstado) return;

        const observacionTexto = inputObs ? inputObs.value.trim() : "";

        asistencias.push({
            id_estudiante_curso: parseInt(idEstudianteCurso, 10),
            estado: selEstado.value,
            observaciones: observacionTexto === "" ? null : observacionTexto
        });
    });

    fetch("/teacher/dashboard/registrarAsistenciaDia", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            id_curso: parseInt(idCurso, 10),
            asistencias: asistencias
        })
    })
        .then(async res => {
            const raw = await res.text();
            console.log("STATUS registrarAsistenciaDia:", res.status);
            console.log("RAW registrarAsistenciaDia:", raw);

            let data;
            try {
                data = JSON.parse(raw);
            } catch (e) {
                alert("Respuesta no válida del servidor al registrar asistencia. Ver consola.");
                return;
            }

            if (data.status === "success") {
                alert("Asistencia guardada correctamente");
                // Aquí podrías recargar el historial automáticamente llamando buscarAsistencias()
            } else {
                alert("Error del servidor: " + data.message);
            }
        })
        .catch(err => {
            console.error(err);
            alert("Error de comunicación al registrar la asistencia.");
        });
}

// ======================================================
// FILTRO SUPERIOR: BUSCAR ASISTENCIAS Y ACTUALIZAR HISTORIAL
// ======================================================
function buscarAsistencias() {
    if (!tablaHistorial) {
        console.error("DataTable del historial no está inicializado.");
        return;
    }

    const selectGrupoFiltro = document.getElementById("selectGrupo");
    const inputFecha = document.getElementById("fecha");

    const idCurso = selectGrupoFiltro ? selectGrupoFiltro.value : "";
    const fecha = inputFecha ? inputFecha.value : "";

    const params = new URLSearchParams();

    if (idCurso && idCurso !== "todos") {
        params.append("id_curso", idCurso);
    }

    if (fecha) {
        params.append("fecha", fecha); // input date → YYYY-MM-DD
    }

    fetch(`/teacher/dashboard/obtenerAsistencias?${params.toString()}`)
        .then(res => res.json())
        .then(response => {
            tablaHistorial.clear();

            if (response.status !== "success") {
                tablaHistorial.draw();
                alert(response.message || "No se pudieron obtener las asistencias.");
                return;
            }

            const asistencias = response.data;

            asistencias.forEach(item => {
                const nombreCompleto = `${item.nombre} ${item.apellido}`;
                const grupo = `${item.nombre_curso} - Ficha ${item.ficha}`;

                const fechaObj = new Date(item.fecha);
                const fechaFormateada = fechaObj.toLocaleDateString("es-ES", {
                    day: "2-digit",
                    month: "short",
                    year: "numeric"
                });

                let estadoHtml;
                switch (item.estado) {
                    case "presente":
                        estadoHtml = '<span class="badge bg-success"><i class="bi bi-check-circle"></i> Presente</span>';
                        break;
                    case "ausente":
                        estadoHtml = '<span class="badge bg-danger"><i class="bi bi-x-circle"></i> Ausente</span>';
                        break;
                    case "excusa":
                    default:
                        estadoHtml = '<span class="badge bg-warning text-dark"><i class="bi bi-file-earmark-text"></i> Excusa</span>';
                        break;
                }

                const observaciones = item.observaciones ? item.observaciones : "-";

                const accionesHtml = `
            <button class="btn btn-primary btn-sm shadow-sm btn-editar-asistencia"
                title="Editar"
                data-toggle="modal" data-target="#modalEditarAsistencia"
                data-id-asistencia="${item.id_asistencia}"
                data-estudiante="${nombreCompleto}"
                data-fecha="${item.fecha}" 
                data-estado="${item.estado}"
                data-observaciones="${item.observaciones ? item.observaciones.replace(/"/g, '&quot;') : ''}">
                <i class="bi bi-pencil"></i>
            </button>
                `;

                tablaHistorial.row.add([
                    item.id_asistencia,
                    nombreCompleto,
                    grupo,
                    fechaFormateada,
                    estadoHtml,
                    observaciones,
                    accionesHtml
                ]);
            });

            tablaHistorial.draw();
        })
        .catch(err => {
            console.error("Error obteniendo asistencias:", err);
            alert("Error al cargar las asistencias.");
        });


}

// ======================================================
// CLIC EN LÁPIZ → LLENAR MODAL
// ======================================================
function onClickEditarAsistencia(e) {
    const btn = e.target.closest(".btn-editar-asistencia");
    if (!btn) return;

    const idAsistencia = btn.dataset.idAsistencia;
    const estudiante = btn.dataset.estudiante;
    const fecha = btn.dataset.fecha;        // viene YYYY-MM-DD
    const estado = btn.dataset.estado;
    const observaciones = btn.dataset.observaciones || "";

    document.getElementById("editIdAsistencia").value = idAsistencia;
    document.getElementById("editEstudiante").value = estudiante;
    document.getElementById("editFecha").value = fecha;
    document.getElementById("editEstado").value = estado;
    document.getElementById("editObservaciones").value = observaciones;
}

// ======================================================
// CLICK EN ACTUALIZAR → GUARDAR CAMBIOS EN EL SERVIDOR
// ======================================================
function actualizarAsistencia() {
    const idAsistencia = document.getElementById("editIdAsistencia").value;
    const estado = document.getElementById("editEstado").value;
    const obsTexto = document.getElementById("editObservaciones").value.trim();

    if (!idAsistencia) {
        alert("No se encontró la asistencia a editar.");
        return;
    }

    const payload = {
        id_asistencia: parseInt(idAsistencia, 10),
        estado: estado,
        observaciones: obsTexto === "" ? null : obsTexto
    };

    fetch("/teacher/dashboard/actualizarAsistencia", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(payload)
    })
        .then(async res => {
            const raw = await res.text();
            console.log("STATUS actualizarAsistencia:", res.status);
            console.log("RAW actualizarAsistencia:", raw);

            let data;
            try {
                data = JSON.parse(raw);
            } catch (e) {
                alert("Respuesta no válida del servidor al actualizar. Ver consola.");
                return;
            }

            if (data.status === "success") {
                alert("Asistencia actualizada correctamente.");
                // Cerrar modal 
                if (window.$) {
                    $("#modalEditarAsistencia").modal("hide");
                }
                // Refrescar historial con los filtros actuales
                if (typeof buscarAsistencias === "function") {
                    buscarAsistencias();
                }
            } else {
                alert("Error al actualizar: " + data.message);
            }
        })
        .catch(err => {
            console.error("Error en actualizarAsistencia:", err);
            alert("Error de comunicación al actualizar la asistencia.");
        });

}
