document.addEventListener("DOMContentLoaded", () => {
  const cursoHeader = document.getElementById("cursoHeader");
  const listaCompetencias = document.getElementById("listaCompetencias");
  const sinCompetencias = document.getElementById("sinCompetencias");

  if (!cursoData || !competenciasData) {
    cursoHeader.innerHTML = `<p class="text-danger">No se pudo cargar la información del curso.</p>`;
    return;
  }

  cursoHeader.innerHTML = `
    <h2 class="mb-1 fw-bold">${cursoData.nombre}</h2>
    <p class="text-muted mb-0"><strong>Ficha:</strong> ${cursoData.ficha}</p>
  `;

  if (competenciasData.length === 0) {
    sinCompetencias.classList.remove("d-none");
    return;
  }

  listaCompetencias.innerHTML = competenciasData
    .map(
      (c) => `
        <div class="competencia-card shadow-sm">
          <h5 class="title">${c.nombre}</h5>
          <p class="desc">${c.descripcion}</p>
          <p class="info"><strong>Actividades:</strong> ${c.actividades}</p>

          <div class="btn-group-actions">
            <a href="/teacher/actividades/competencia/${c.id}" class="btn btn-outline-primary">Ver Actividades</a>
            <a href="/teacher/actividades/nueva/${c.id}" class="btn btn-primary">Crear Actividad</a>
          </div>
        </div>
      `
    )
    .join("");
});
