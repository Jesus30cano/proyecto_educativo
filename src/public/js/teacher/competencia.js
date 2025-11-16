document.addEventListener("DOMContentLoaded", async () => {
  const titulo = document.getElementById("tituloCompetencia");
  const descripcion = document.getElementById("descripcionCompetencia");
  const container = document.getElementById("actividadesContainer");
  const sinActividades = document.getElementById("sinActividades");

  const filtroDesde = document.getElementById("filtroDesde");
  const filtroHasta = document.getElementById("filtroHasta");
  const btnFiltrarFechas = document.getElementById("btnFiltrarFechas");

  const modal = new bootstrap.Modal(
    document.getElementById("modalEditarActividad")
  );
  const form = document.getElementById("formEditarActividad");
  const mensaje = document.getElementById("mensajeEdicion");

  let actividades = [];

  // Cargar competencia
  try {
    const resComp = await fetch(
      `/teacher/activity/obtener_competencia?id=${competenciaId}`
    );
    const jsonComp = await resComp.json();
    if (jsonComp.status === "success") {
      titulo.textContent = jsonComp.data.nombre;
      descripcion.textContent = jsonComp.data.descripcion;
    }
  } catch (err) {
    console.error("Error al cargar competencia:", err);
  }

  // Cargar actividades
  try {
    const resAct = await fetch(
      `/teacher/activity/obtener_actividades?competencia=${competenciaId}&curso=${cursoId}&profesor=${profesorId}`
    );
    const jsonAct = await resAct.json()
    if (jsonAct.status === "success") {
      actividades = jsonAct.data || [];
    } else {
      console.error("Error al cargar actividades:", jsonAct.message);
    }
  } catch (err) {
    console.error("Error al cargar actividades:", err);
  }

  if (actividades.length === 0) {
    sinActividades.classList.remove("d-none");
  } else {
    renderActividades();
  }

  // Filtro por fecha
  btnFiltrarFechas.addEventListener("click", () => {
    const desde = filtroDesde.value;
    const hasta = filtroHasta.value;

    const filtradas = actividades.filter((a) => {
      const fecha = new Date(a.fecha_entrega);
      return (
        (!desde || fecha >= new Date(desde)) &&
        (!hasta || fecha <= new Date(hasta))
      );
    });

    if (filtradas.length === 0) {
      container.innerHTML = "";
      sinActividades.classList.remove("d-none");
    } else {
      sinActividades.classList.add("d-none");
      renderActividades(filtradas);
    }
  });

  // Renderizar actividades
  function renderActividades(lista = actividades) {
    container.innerHTML = lista
      .map(
        (a) => `
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">${a.titulo}</h5>
            <p class="card-text">${a.descripcion}</p>
            <p class="card-text text-muted"><strong>Entrega:</strong> ${
              a.fecha_entrega
            }</p>
            ${
              a.archivo
                ? `<a href="/${a.archivo}" target="_blank" class="btn btn-outline-secondary btn-sm">Ver Archivo</a>`
                : ""
            }
            <div class="mt-3 d-flex gap-2">
              <button class="btn btn-outline-primary btn-sm btn-editar" data-id="${
                a.id
              }">Editar</button>
              <button class="btn btn-outline-danger btn-sm btn-eliminar" data-id="${
                a.id
              }">Eliminar</button>
            </div>
          </div>
        </div>
      </div>
    `
      )
      .join("");

    // Botón editar
    container.querySelectorAll(".btn-editar").forEach((btn) => { 
      btn.addEventListener("click", () => {
        const act = actividades.find((a) => a.id == btn.dataset.id);
        document.getElementById("editId").value = act.id;
        document.getElementById("editTitulo").value = act.titulo;
        document.getElementById("editDescripcion").value = act.descripcion;
        document.getElementById("editFecha").value = act.fecha_entrega;
        mensaje.innerHTML = "";
        modal.show();
      });
    });

    container.querySelectorAll(".btn-eliminar").forEach((btn) => {
  btn.addEventListener("click", () => {
    const id = btn.dataset.id;

    // Mostrar la caja de confirmación personalizada
    const confirmacion = document.getElementById("confirmacion");
    confirmacion.style.display = "block";

    // Si el usuario acepta
    const btnSi = document.getElementById("btnSiEliminar");
    const btnNo = document.getElementById("btnNoEliminar");

    // Elimina cualquier listener anterior
    btnSi.replaceWith(btnSi.cloneNode(true));
    btnNo.replaceWith(btnNo.cloneNode(true));
    const nuevoBtnSi = document.getElementById("btnSiEliminar");
    const nuevoBtnNo = document.getElementById("btnNoEliminar");

    nuevoBtnSi.addEventListener("click", () => {
      console.log("Eliminando actividad con ID:", id);
      // Aquí se hace la petición al backend igual que antes
      fetch("/teacher/activity/eliminar_actividad", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id: id })
      })
      .then(res => res.json())
      .then(json => {
        console.log("Respuesta del servidor:", json);
        if (json.status === "success") {
          actividades = actividades.filter((a) => a.id != id);
          renderActividades();
          mensaje.innerHTML = `<div class="alert alert-success">${json.message}</div>`;
          console.log("Actividad eliminada correctamente");
        } else {
          console.log("Error al eliminar actividad:", json.message);
          mensaje.innerHTML = `<div class="alert alert-danger">${json.message}</div>`;
        }
        confirmacion.style.display = "none";
      })
      .catch(err => {
        mensaje.innerHTML = `<div class="alert alert-danger">Error al eliminarr: ${err.message}</div>`;
        confirmacion.style.display = "none";
      });
    });

    // Cancelar
    nuevoBtnNo.addEventListener("click", () => {
      confirmacion.style.display = "none";
    });
  });
});
  }

  // Guardar edición
  form.addEventListener("submit", (e) => {
    e.preventDefault();
    const id = document.getElementById("editId").value;
    const titulo = document.getElementById("editTitulo").value.trim();
    const descripcion = document.getElementById("editDescripcion").value.trim();
    const fecha = document.getElementById("editFecha").value;

    if (!titulo || !fecha) {
      mensaje.innerHTML = `<div class="alert alert-danger">Título y fecha son obligatorios.</div>`;
      return;
    } 

    const actividadEditada = {
    id: id,
    titulo: titulo,
    descripcion: descripcion,
    fecha_entrega: fecha
  };
    fetch('/teacher/activity/editar_actividad', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(actividadEditada)
  })
  .then(response => {
    if (!response.ok) throw new Error("Error al editar actividad");
    
    return response.json();
  })
  .then(data => {
    modal.hide();
    mensaje.innerHTML = `<div class="alert alert-success">Actividad editada correctamente.</div>`;
    // Actualizar actividad en la lista
    const index = actividades.findIndex(a => a.id == id);
    if (index !== -1) {
      actividades[index].titulo = titulo;
      actividades[index].descripcion = descripcion;
      actividades[index].fecha_entrega = fecha;
      renderActividades();
    }
  })
  .catch(error => {
    mensaje.innerHTML = `<div class="alert alert-danger">${error.message}</div>`;
  });
  });
});
