document.addEventListener("DOMContentLoaded", () => {
  // Elementos DOM principales
  const tablaBody = document.getElementById("tabla-evaluaciones");
  const sinDatos = document.getElementById("sinDatos");

  let evaluaciones = [];
  let evaluacionActual = null;

  cargarEvaluaciones();

  function renderTabla(lista) {
    // 1. Si DataTable está inicializado, destrúyelo primero
    if ($.fn.DataTable.isDataTable("#dataTable")) {
      $("#dataTable").DataTable().destroy();
    }

    tablaBody.innerHTML = "";

    if (lista.length === 0) {
      sinDatos.classList.remove("d-none");
      return;
    }
    sinDatos.classList.add("d-none");

    lista.forEach((ev) => {
      const fila = document.createElement("tr");
      fila.setAttribute("data-id", ev.id_evaluacion);
      fila.innerHTML = `
        <td>${ev.titulo}</td>
        <td>${ev.ficha || "-"}</td>
        <td>${ev.nombre_curso}</td>
        <td>${ev.nombre_competencia}</td>
        <td>${ev.fecha}</td>
        <td>${ev.estado ? "Activo" : "Inactivo"}</td>
        <td>
          <button class="btn btn-sm btn-outline-primary btn-ver" data-id="${
            ev.id_evaluacion
          }" title="Ver entregas">
            <i class="bi bi-eye"></i>
          </button>
          <button class="btn btn-sm btn-outline-warning ms-1 btn-editar" data-id="${
            ev.id_evaluacion
          }" title="Editar evaluación">
            <i class="bi bi-pencil"></i>
          </button>
          <button class="btn btn-sm btn-outline-danger ms-1 btn-eliminar" data-id="${
            ev.id_evaluacion
          }" title="Eliminar evaluación">
            <i class="bi bi-trash"></i>
          </button>
        </td>
      `;
      tablaBody.appendChild(fila);
    });

    // 2. Siempre inicializa DataTable después de pintar las filas
    $("#dataTable").DataTable({
      pageLength: 10,
      lengthMenu: [10, 25, 50, 100],
      searching: true,
      ordering: true,
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
      },
    });

    // Engancha los eventos a botones
    tablaBody.querySelectorAll(".btn-ver").forEach((btn) => {
      btn.addEventListener("click", () => {
        const id = btn.dataset.id;
        const evaluacion = evaluaciones.find((ev) => ev.id_evaluacion == id);
        evaluacionActual = evaluacion;
        abrirModalEntregasEvaluacion(evaluacion);
      });
    });

    tablaBody.querySelectorAll(".btn-editar").forEach((btn) => {
      btn.addEventListener("click", () => {
        const id = btn.dataset.id;
        const evaluacion = evaluaciones.find((ev) => ev.id_evaluacion == id);
        evaluacionActual = evaluacion;
        abrirModalEditarEvaluacion(evaluacion);
      });
    });

    tablaBody.querySelectorAll(".btn-eliminar").forEach((btn) => {
      btn.addEventListener("click", () => {
        const id = btn.dataset.id;
        eliminarEvaluacion(id);
      });
    });
  }

  // Resto igual…

  // 🔃 Obtiene las evaluaciones por fetch y llama a renderTabla
  async function cargarEvaluaciones() {
    try {
      const res = await fetch("/teacher/evaluations/obtener_evaluaciones");
      const json = await res.json();
      evaluaciones = json.data || [];
      renderTabla(evaluaciones);
    } catch (err) {
      console.error("Error al cargar evaluaciones:", err);
      sinDatos.classList.remove("d-none");
    }
  }

  // 👁️ Abre el modal de entregas de la evaluación
  function abrirModalEntregasEvaluacion(evaluacion) {
    // Aquí llamas tu modal para ver entregas, ejemplo:
    // setea datos, refresca tabla de entregas y muestra el modal correspondiente
    // modalEntregasEvaluacion.show();
    localStorage.setItem("id_evaluacion", evaluacion.id_evaluacion);
    window.open("/teacher/evaluations/ver_examen", "_blank");
    showToast("Abriendo examen...", "#3ce783ff", 3000);
  }

  // 📝 Abre el modal para editar la evaluación
  function abrirModalEditarEvaluacion(evaluacion) {
    // Setea datos actuales y abre el modal de edición
    // modalEvaluacion.show();
    alert(
      "Función para editar evaluación (implementar modal) " +
        evaluacion.id_evaluacion
    );
  }

  // ❌ Eliminar la evaluación
  async function eliminarEvaluacion(id) {
    if (!confirm("¿Estás seguro de que deseas eliminar esta evaluación?"))
      return;
    try {
      const res = await fetch(
        `/teacher/evaluations/eliminar_evaluacion?id=${id}`,
        { method: "DELETE" }
      );
      const json = await res.json();
      if (json.status === "success") {
        // Recargar después de eliminar
        cargarEvaluaciones();
      } else {
        alert("No se pudo eliminar la evaluación");
      }
    } catch (err) {
      console.error("Error al eliminar evaluacion:", err);
      alert("Error inesperado al eliminar");
    }
  }
});
