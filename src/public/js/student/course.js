document.addEventListener("DOMContentLoaded", async () => {
  const contenedor = document.getElementById("contenedorCursosEST");
  const buscador = document.getElementById("buscarCursoEST");
  const sinResultados = document.getElementById("sinResultadosEST");

  function renderCompetencias(lista) {
    if (!lista || lista.length === 0) {
      contenedor.innerHTML = "";
      if (sinResultados) sinResultados.classList.remove("d-none");
      return;
    }

    if (sinResultados) sinResultados.classList.add("d-none");

    contenedor.innerHTML = lista
      .map((comp) => {
        const id = comp.id_competencia ?? "";
        const codigo = comp.codigo ?? "Sin código";
        const nombre = comp.nombre ?? "Sin nombre";
        const profesor = comp.profesor ?? "Sin asignar";
        const descripcion = comp.descripcion ?? "Sin descripción";
        const descripcionCorta = descripcion.length > 80 
          ? descripcion.substring(0, 80) + "..." 
          : descripcion;

        return `
          <div class="course-card" data-id="${id}">
            <div class="course-icon">
              <i class="fas fa-award"></i>
            </div>
            <h5 class="course-title">${codigo}</h5>
            <p class="course-info mb-2"><strong>${nombre}</strong></p>
            <p class="course-info text-muted small mb-2">${descripcionCorta}</p>
            <p class="course-info"><strong>Profesor:</strong> ${profesor}</p>
            <button class="btn btn-primary btn-sm w-100 btn-ver-detalle mt-2">Ver detalles</button>
          </div>
        `;
      })
      .join("");

    // Delegación de eventos para ver detalles de competencia
    contenedor.querySelectorAll(".btn-ver-detalle").forEach((btn) => {
      btn.addEventListener("click", async (e) => {
        e.preventDefault();
        const card = e.target.closest(".course-card");
        const id = card.dataset.id;
        
        try {
          const res = await fetch("/student/course/seleccionar", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id }),
          });

          const json = await res.json();
          if (json.status === "success") {
            window.location.href = "/student/activities";
          } else {
            alert("No se pudo seleccionar la competencia.");
          }
        } catch (err) {
          console.error("Error al seleccionar competencia:", err);
          alert("Hubo un problema al intentar abrir los detalles.");
        }
      });
    });
  }

  let competencias = [];

  try {
    const res = await fetch("/student/course/obtenerCompetenciasPorEstudiante", {
      cache: "no-store",
    });
    const json = await res.json();

    if (json.status === "success") {
      competencias = json.data || [];
    } else {
      console.error("Error en la respuesta:", json.message);
    }
  } catch (err) {
    console.error("Error al obtener competencias:", err);
  }

  renderCompetencias(competencias);

  if (!buscador) return;

  let timeoutId = null;

  buscador.addEventListener("input", () => {
    clearTimeout(timeoutId);
    timeoutId = setTimeout(() => {
      const valor = buscador.value.toLowerCase().trim();

      if (valor === "") {
        renderCompetencias(competencias);
        return;
      }

      const filtrados = competencias.filter((c) => {
        const codigo = c.codigo ? c.codigo.toLowerCase() : "";
        const nombre = c.nombre ? c.nombre.toLowerCase() : "";
        const descripcion = c.descripcion ? c.descripcion.toLowerCase() : "";
        return codigo.includes(valor) || nombre.includes(valor) || descripcion.includes(valor);
      });

      renderCompetencias(filtrados);
    }, 120);
  });
});
