document.addEventListener("DOMContentLoaded", async () => {
  const contenedor = document.getElementById("contenedorCursos");

  try {
    const response = await fetch("/teacher/course/obtenerCursosProfesor");
    const result = await response.json();

    if (result.status !== "success") return;

    contenedor.innerHTML = result.data
      .map((curso) => `
        <div class="course-card" onclick="window.location='/teacher/course/ver/${curso.id_curso}'">
          <div class="course-icon">
            <i class="bi bi-journal-richtext"></i>
          </div>

          <h5 class="course-title">${curso.nombre_curso}</h5>

          <p class="course-info"><strong>Ficha:</strong> ${curso.ficha ?? 'No definida'}</p>
          <p class="course-info"><strong>Estado:</strong> ${curso.estado ?? 'Activo'}</p>

          <button class="btn btn-primary">
            Ver Curso
          </button>
        </div>
      `)
      .join("");

  } catch (error) {
    console.error("Error al cargar cursos:", error);
  }
});
