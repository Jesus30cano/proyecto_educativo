document.addEventListener("DOMContentLoaded", () => {
  const tablaBody = document.getElementById("tablaActividades").querySelector("tbody");
  const sinDatos = document.getElementById("sinDatos");

  const modalSeguimiento = new bootstrap.Modal(document.getElementById("modalSeguimiento"));
  const tituloActividadModal = document.getElementById("tituloActividadModal");
  const infoActividad = document.getElementById("infoActividad");
  const tablaEntregas = document.getElementById("tablaEntregas").querySelector("tbody");
  const sinEntregas = document.getElementById("sinEntregas");

  const modalCalificar = new bootstrap.Modal(document.getElementById("modalCalificar"));
  const idEntregaCalificar = document.getElementById("idEntregaCalificar");
  const selectCalificacion = document.getElementById("selectCalificacion");
  const btnGuardarCalificacion = document.getElementById("btnGuardarCalificacion");

  let actividades = [];

  // 🔄 Cargar actividades globales del docente
  (async () => {
    try {
      const res = await fetch("/teacher/activity/obtener_actividades_globales");
      const json = await res.json();
      actividades = json.data || [];
      renderTabla(actividades);
    } catch (err) {
      console.error("Error al cargar actividades globales:", err);
      sinDatos.classList.remove("d-none");
      showToast("❌ Error al cargar actividades.", "#d9534f");
    }
  })();

  // 🧩 Renderizar tabla principal con DataTables
  function renderTabla(lista) {
    tablaBody.innerHTML = "";

    if (lista.length === 0) {
      sinDatos.classList.remove("d-none");
      return;
    }

    sinDatos.classList.add("d-none");

    lista.forEach((a) => {
      const estadoGeneral = a.estado_general 
        ? a.estado_general 
        : `${a.entregados || 0} entregas / ${(a.total_estudiantes || 0)} estudiantes`;

      const fila = document.createElement("tr");
      fila.setAttribute("data-id", a.id);
      fila.innerHTML = `
        <td>${a.titulo}</td>
        <td>${a.curso}</td>
        <td>${a.ficha || "—"}</td>
        <td>${a.competencia}</td>
        <td>${a.fecha_entrega}</td>
        <td class="estado-general">${estadoGeneral}</td>
        <td>
          <button class="btn btn-sm btn-outline-primary btn-seguimiento" data-id="${a.id}">Ver entregas</button>
        </td>
      `;
      tablaBody.appendChild(fila);
    });

    if (!$.fn.DataTable.isDataTable("#tablaActividades")) {
      $("#tablaActividades").DataTable({
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        searching: true,
        ordering: true,
        language: {
          url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
        }
      });
    }

    tablaBody.querySelectorAll(".btn-seguimiento").forEach(btn => {
      btn.addEventListener("click", () => {
        const actividadId = btn.dataset.id;
        const actividad = actividades.find(a => a.id == actividadId);
        abrirModalSeguimiento(actividad);
      });
    });
  }

  // 👁️ Abrir modal de seguimiento
  async function abrirModalSeguimiento(actividad) {
    tituloActividadModal.textContent = actividad.titulo;
    infoActividad.innerHTML = `
      <p><strong>Curso:</strong> ${actividad.curso}</p>
      <p><strong>Ficha:</strong> ${actividad.ficha || "—"}</p>
      <p><strong>Competencia:</strong> ${actividad.competencia}</p>
      <p><strong>Fecha límite:</strong> ${actividad.fecha_entrega}</p>
    `;

    tablaEntregas.innerHTML = "";
    sinEntregas.classList.add("d-none");

    try {
      const res = await fetch(`/teacher/activity/entregas?id=${actividad.id}`);
      const json = await res.json();

      if (json.status === "success" && json.data.length > 0) {
        const totalEstudiantes = actividad.total_estudiantes || json.data.length;
        const entregados = json.data.filter(e => e.estado === "Entregado").length;
        const pendientes = totalEstudiantes - entregados;

        infoActividad.innerHTML += `
          <div class="alert alert-info mt-3">
            <strong>Resumen:</strong> ${entregados} entregas registradas, ${pendientes} pendientes, total ${totalEstudiantes} estudiantes.
          </div>
        `;

        const nuevoEstado = `${entregados} entregas / ${totalEstudiantes} estudiantes`;
        const filaTabla = tablaBody.querySelector(`tr[data-id="${actividad.id}"] .estado-general`);
        if (filaTabla) filaTabla.textContent = nuevoEstado;
        actividad.estado_general = nuevoEstado;

        json.data.forEach((e) => {
          const fila = document.createElement("tr");
          fila.innerHTML = `
            <td>${e.estudiante}</td>
            <td>${e.estado}</td>
            <td>${e.fecha_entrega || "—"}</td>
            <td>${e.archivo ? `<a href="/${e.archivo}" target="_blank">Ver</a>` : "—"}</td>
            <td>${e.calificacion || "Sin calificar"}</td>
            <td>
              <button class="btn btn-sm btn-outline-success btn-calificar" data-id="${e.id}" data-actividad="${actividad.id}">Calificar</button>
            </td>
          `;
          tablaEntregas.appendChild(fila);
        });

        tablaEntregas.querySelectorAll(".btn-calificar").forEach(btn => {
          btn.addEventListener("click", () => {
            idEntregaCalificar.value = btn.dataset.id;
            selectCalificacion.value = "";
            btnGuardarCalificacion.dataset.actividad = btn.dataset.actividad;
            modalCalificar.show();
          });
        });

      } else {
        sinEntregas.classList.remove("d-none");
        showToast("⚠️ No hay entregas registradas.", "#0275d8");
      }

    } catch (err) {
      console.error("Error al cargar entregas:", err);
      sinEntregas.classList.remove("d-none");
      showToast("❌ Error al cargar entregas.", "#d9534f");
    }

    modalSeguimiento.show();
  }

  // 📝 Guardar calificación
  btnGuardarCalificacion.addEventListener("click", async () => {
    const id = idEntregaCalificar.value;
    const calificacion = selectCalificacion.value;
    const actividadId = btnGuardarCalificacion.dataset.actividad;

    if (!calificacion) {
      showToast("⚠️ Debes seleccionar una calificación.", "#d9534f");
      return;
    }

    try {
      const res = await fetch("/teacher/activity/calificar_entrega", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id, calificacion })
      });

      const json = await res.json();
      if (json.status === "success") {
        modalCalificar.hide();
        showToast("✅ Calificación guardada correctamente.", "#5cb85c");
        abrirModalSeguimiento(actividades.find(a => a.id == actividadId));
      } else {
        showToast("❌ No se pudo guardar la calificación.", "#d9534f");
      }

    } catch (err) {
      console.error("Error al calificar:", err);
      showToast("❌ Error inesperado al guardar.", "#d9534f");
    }
  });
});
