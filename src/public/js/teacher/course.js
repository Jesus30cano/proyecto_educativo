document.addEventListener("DOMContentLoaded", async () => {
  const contenedor = document.getElementById("contenedorCursos");
  const buscador = document.getElementById("buscarCurso");
  const sinResultados = document.getElementById("sinResultados");

  function renderCursos(lista) {
    if (!lista || lista.length === 0) {
      contenedor.innerHTML = "";
      if (sinResultados) sinResultados.style.display = "block";
      return;
    }

    if (sinResultados) sinResultados.style.display = "none";

    contenedor.innerHTML = lista
      .map((curso) => {
        const id = curso.id_curso ?? "";
        console.log("Renderizando curso:", curso.id_curso, curso.curso);
        const nombre = curso.curso ?? "Sin nombre";
        const ficha = curso.ficha ?? "Sin ficha";
        const estado = curso.ficha_activa ? "Activo" : "Inactivo";

        return `
          <div class="course-card" role="button" tabindex="0" data-id="${id}">
            <div class="course-icon">
              <i class="bi bi-journal-richtext"></i>
            </div>
            <h5 class="course-title">${nombre}</h5>
            <p class="course-info"><strong>Ficha:</strong> ${ficha}</p>
            <p class="course-info"><strong>Estado:</strong> ${estado}</p>
            <button class="btn btn-primary btn-sm mt-3 w-100">Ver Curso</button>
          </div>
        `;
      })
      .join("");

    // Delegación de eventos para navegación segura sin mostrar el ID
    contenedor.querySelectorAll(".course-card").forEach((card) => {
      const navegar = async () => {
        const id = card.dataset.id;
        try {
          const res = await fetch("/teacher/course/seleccionar", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id }),
          });

          const json = await res.json();
          if (json.status === "success") {
            window.location.href = "/teacher/course/ver";
          } else {
            alert("No tienes permiso para ver este curso.");
          }
        } catch (err) {
          console.error("Error al seleccionar curso:", err);
          alert("Hubo un problema al intentar abrir el curso.");
        }
      };

      card.addEventListener("click", navegar);
      card.addEventListener("keypress", (e) => {
        if (e.key === "Enter") navegar();
      });
    });
  }

  let cursos = [];

  try {
    const res = await fetch("/teacher/course/obtenerCursosProfesorSinRepetir", {
      cache: "no-store",
    });
    const json = await res.json();
    console.log("Cursos obtenidos:", json);

    cursos = json.data || [];
  } catch (err) {
    console.error("Error al obtener cursos:", err);
  }

  renderCursos(cursos);

  if (!buscador) return;

  let timeoutId = null;

  buscador.addEventListener("input", () => {
    clearTimeout(timeoutId);
    timeoutId = setTimeout(() => {
      const valor = buscador.value.toLowerCase().trim();

      if (valor === "") {
        renderCursos(cursos);
        return;
      }

      const filtrados = cursos.filter((c) => {
        const ficha = c.ficha ? String(c.ficha).toLowerCase() : "";
        const nombre = c.nombre_curso ? c.nombre_curso.toLowerCase() : "";
        return ficha.includes(valor) || nombre.includes(valor);
      });

      renderCursos(filtrados);
    }, 120);
  });
});
