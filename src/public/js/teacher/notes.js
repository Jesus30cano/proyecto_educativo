document.addEventListener("DOMContentLoaded", () => {
  const selectFicha = document.getElementById("selectCurso"); // reutilizamos el mismo select pero ahora es ficha
  const selectCompetencia = document.getElementById("selectCompetencia");
  const btnBuscarNotas = document.getElementById("btnBuscarNotas");
  const contenedorCompetencias = document.getElementById(
    "contenedorCompetencias"
  );
  const listaEstudiantes = document.getElementById("listaEstudiantes");
  const btnGuardarNotas = document.getElementById("btnGuardarNotas");

  const modalNotas = new bootstrap.Modal(document.getElementById("modalNotas"));

  let fichas = [];
  let competencias = [];
  let estudiantes = [];
  let competenciaSeleccionada = null;

  // 🔄 Cargar fichas al iniciar
  (async () => {
    try {
      const res = await fetch("/teacher/notes/obtener_fichas");
      const json = await res.json();
      fichas = json.data || [];

      fichas.forEach((f) => {
        const opt = document.createElement("option");
        opt.value = f.id;
        opt.textContent = `${f.ficha} - ${f.curso}`; // ficha única + nombre curso
        selectFicha.appendChild(opt);
      });
    } catch (err) {
      console.error("Error al cargar fichas:", err);
      showToast("❌ Error al cargar fichas.", "#d9534f");
    }
  })();

  // 📌 Al seleccionar ficha, cargar competencias
  selectFicha.addEventListener("change", async () => {
    const fichaId = selectFicha.value;
    selectCompetencia.innerHTML = `<option value="">Seleccione una competencia...</option>`;
    selectCompetencia.disabled = true;

    if (!fichaId) return;

    try {
      const res = await fetch(
        `/teacher/notes/obtener_competencias?ficha=${fichaId}`
      );
      const json = await res.json();
      competencias = json.data || [];

      competencias.forEach((comp) => {
        const opt = document.createElement("option");
        opt.value = comp.id;
        opt.textContent = comp.nombre;
        selectCompetencia.appendChild(opt);
      });

      selectCompetencia.disabled = false;
    } catch (err) {
      console.error("Error al cargar competencias:", err);
      showToast("❌ Error al cargar competencias.", "#d9534f");
    }
  });

  // 🔎 Buscar competencias y mostrar tarjetas
  btnBuscarNotas.addEventListener("click", () => {
    const fichaId = selectFicha.value;
    const compId = selectCompetencia.value;

    if (!fichaId || !compId) {
      showToast("⚠️ Seleccione ficha y competencia.", "#d9534f");
      return;
    }

    const comp = competencias.find((c) => c.id == compId);
    competenciaSeleccionada = comp;

    contenedorCompetencias.innerHTML = `
      <div class="card card-blue mb-3">
        <div class="card-body">
          <h5 class="card-title fw-bold">${comp.nombre}</h5>
          <p class="card-text">Competencia de la ficha seleccionada.</p>
          <button class="btn btn-primary btn-sm btn-ver-estudiantes">
            <i class="bi bi-people-fill me-2"></i>Ver estudiantes
          </button>
        </div>
      </div>
    `;

    contenedorCompetencias
      .querySelector(".btn-ver-estudiantes")
      .addEventListener("click", () => {
        abrirModalNotas(comp.id, fichaId);
      });
  });

  // 👁️ Abrir modal de estudiantes
  async function abrirModalNotas(compId, fichaId) {
    listaEstudiantes.innerHTML = "";

    try {
      const res = await fetch(
        `/teacher/notes/obtener_estudiantes?ficha=${fichaId}&competencia=${compId}`
      );
      const json = await res.json();
      estudiantes = json.data || [];

      if (estudiantes.length === 0) {
        listaEstudiantes.innerHTML = `<tr><td colspan="3" class="text-center">No hay estudiantes registrados.</td></tr>`;
      } else {
        estudiantes.forEach((e) => {
          const fila = document.createElement("tr");
          fila.innerHTML = `
            <td>${e.nombre}</td>
            <td>${e.estado || "Pendiente"}</td>
            <td>
              <select class="form-control form-control-sm nota-estudiante" data-id="${
                e.id
              }">
                <option value="">Seleccione nota...</option>
                <option value="Aprobado" ${
                  e.nota === "Aprobado" ? "selected" : ""
                }>Aprobado</option>
                <option value="No aprobado" ${
                  e.nota === "No aprobado" ? "selected" : ""
                }>No aprobado</option>
              </select>
            </td>
          `;
          listaEstudiantes.appendChild(fila);
        });
      }

      modalNotas.show();
    } catch (err) {
      console.error("Error al cargar estudiantes:", err);
      showToast("❌ Error al cargar estudiantes.", "#d9534f");
    }
  }

  // 💾 Guardar notas
  btnGuardarNotas.addEventListener("click", async () => {
    const notas = [];
    listaEstudiantes.querySelectorAll(".nota-estudiante").forEach((sel) => {
      notas.push({
        id: sel.dataset.id,
        nota: sel.value,
      });
    });

    try {
      const res = await fetch("/teacher/notes/guardar_notas", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          competencia: competenciaSeleccionada.id,
          notas,
        }),
      });

      const json = await res.json();
      if (json.status === "success") {
        showToast("✅ Notas guardadas correctamente.", "#5cb85c");
        modalNotas.hide();
      } else {
        showToast("❌ No se pudieron guardar las notas.", "#d9534f");
      }
    } catch (err) {
      console.error("Error al guardar notas:", err);
      showToast("❌ Error inesperado al guardar.", "#d9534f");
    }
  });
});
