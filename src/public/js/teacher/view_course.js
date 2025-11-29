document.addEventListener("DOMContentLoaded", () => {
  const cursoHeader = document.getElementById("cursoHeader");
  const listaCompetencias = document.getElementById("listaCompetencias");
  const sinCompetencias = document.getElementById("sinCompetencias");

  const modal = new bootstrap.Modal(
    document.getElementById("modalCrearActividad")
  );
  const form = document.getElementById("formCrearActividad");

  const cursoInput = document.getElementById("cursoHidden");
  const competenciaInput = document.getElementById("competenciaHidden");
  const profesorInput = document.getElementById("profesorHidden");
  const mensaje = document.getElementById("mensajeModal");

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

  // Renderizar tarjetas de competencias
  listaCompetencias.innerHTML = competenciasData
    .map(
      (c) => `
      <div class="competencia-card shadow-sm" data-id="${c.id}">
        <h5 class="title">${c.nombre}</h5>
        <p class="desc">${c.descripcion}</p>
        <p class="info"><strong>Actividades:</strong> <span class="contador">${c.actividades}</span></p>
        <div class="btn-group-actions">
          <button class="btn btn-outline-primary btn-ver" data-id="${c.id}">Ver Actividades</button>
          <button class="btn btn-primary btn-crear" data-id="${c.id}">Crear Actividad</button>
        </div>
      </div>
    `
    )
    .join("");

  // Abrir modal al hacer clic en "Crear Actividad"
  listaCompetencias.querySelectorAll(".btn-crear").forEach((btn) => {
    btn.addEventListener("click", () => {
      const competenciaId = btn.dataset.id;
      competenciaInput.value = competenciaId;
      cursoInput.value = cursoData.id;
      profesorInput.value = profesorInput.value || "";
      form.reset();
      mensaje.innerHTML = "";
      modal.show();
    });
  });

  // Enviar formulario por fetch
  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    mensaje.innerHTML = "";
    for (const pair of formData.entries()) {
    }

    try {
      const res = await fetch("/teacher/activity/crear_actividad", {
        method: "POST",
        body: formData,
      });

      const json = await res.json();
      if (json.status === "success") {
        mensaje.innerHTML = `<div class="alert alert-success">${json.message}</div>`;
        form.reset();

        // 🔄 Actualizar contador de actividades en la tarjeta correspondiente
        const competenciaId = competenciaInput.value;
        const index = competenciasData.findIndex((c) => c.id == competenciaId);
        if (index !== -1) {
          competenciasData[index].actividades += 1;

          const tarjeta = listaCompetencias.querySelector(
            `.competencia-card[data-id="${competenciaId}"]`
          );
          const contador = tarjeta.querySelector(".contador");
          contador.textContent = competenciasData[index].actividades;
        }

        setTimeout(() => {
          modal.hide();
          mensaje.innerHTML = "";
        }, 1500);
      } else {
        const errores =
          json.errors?.map((e) => `<li>${e}</li>`).join("") ||
          `<li>${json.message}</li>`;
        mensaje.innerHTML = `
          <div class="alert alert-danger">
            <strong>Errores:</strong>
            <ul class="mb-0">${errores}</ul>
          </div>
        `;
      }
    } catch (err) {
      console.error("Error al crear actividad:", err);
      mensaje.innerHTML = `
        <div class="alert alert-danger">
          ❌ Error inesperado. Verifica tu conexión o consulta al equipo técnico.
        </div>
      `;
    }
  });

  // Navegación segura a vista de actividades sin mostrar ID
  listaCompetencias.querySelectorAll(".btn-ver").forEach((btn) => {
    btn.addEventListener("click", async () => {
      const competenciaId = btn.dataset.id;
      const id_curso = cursoData.id;

      try {
        const res = await fetch("/teacher/activity/seleccionar", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ id: competenciaId, id_curso: id_curso }),
        });

        const json = await res.json();
        if (json.status === "success") {
          window.location.href = "/teacher/activity/competencia";
        } else {
          alert("❌ No tienes permiso para ver esta competencia.");
        }
      } catch (err) {
        console.error("Error al seleccionar competencia:", err);
        alert("❌ Error al intentar abrir las actividades.");
      }
    });
  });
});
