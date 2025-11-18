// Cargar instructores por API y llenar combo
async function cargarInstructores(comboId, selectedId = "") {
  try {
    const res = await fetch("/admin/course/obtenerInstructoresDisponibles");
    const lista = await res.json();
    const select = document.getElementById(comboId);
    select.innerHTML = '<option value="">Selecciona instructor...</option>';
    if (Array.isArray(lista.data)) {
      lista.data.forEach((instr) => {
        const option = document.createElement("option");
        option.value = instr.id_usuario;
        option.innerText = instr.nombre_completo;
        if (selectedId && selectedId == instr.id_usuario)
          option.selected = true;
        select.appendChild(option);
      });
    }
  } catch (err) {
    showToast("No se pudo cargar instructores.", "#e74c3c", 4000);
  }
}

// Abrir modal de creación de curso
function openCreateCursoModal() {
  document.getElementById("create_curso_id").value = "";
  document.getElementById("create_ficha").value = "";
  document.getElementById("create_nombre_combo").value = "";
  document.getElementById("create_fecha_inicio").value = "";
  document.getElementById("create_fecha_fin").value = "";
  cargarInstructores("create_instructor_combo");
  document.getElementById("create_curso").style.display = "block";
}

// Abrir modal de edición de curso
function openEditCursoModal() {
  document.getElementById("edit_curso_id").value = "";
  document.getElementById("edit_ficha").value = "";
  document.getElementById("edit_nombre_combo").value = "";
  document.getElementById("edit_fecha_inicio").value = "";
  document.getElementById("edit_fecha_fin").value = "";
  cargarInstructores("edit_instructor_combo");
  document.getElementById("edit_curso").style.display = "block";
}

// Abrir modal de desactivación de curso
function openEliminarCursoModal() {
  document.getElementById("desactivar_ficha").value = "";
  document.getElementById("desactivar_mensaje").value = "";
  document.getElementById("desactivar_curso_modal").style.display = "block";
}

// Buscar curso por ficha vía API y llenar campos en el modal editar
async function buscarCursoPorFicha() {
  const ficha = document.getElementById("edit_ficha").value.trim();
  if (ficha === "") {
    showToast("Por favor, ingresa la ficha del curso para buscar.", "#e74c3c", 4000);
    return;
  }

  try {
    const res = await fetch("/admin/course/mostrarCurso", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ ficha: ficha }),
    });
    const curso = await res.json();

    // Suponiendo estructura: { id_curso, ficha, nombre_curso, fecha_inicio, fecha_fin, instructor_lider }
    if (curso && curso.data && curso.data.id_curso) {
      document.getElementById("edit_curso_id").value = curso.data.id_curso;
      document.getElementById("edit_nombre_combo").value = curso.data.nombre_curso;
      document.getElementById("edit_fecha_inicio").value = curso.data.fecha_inicio;
      document.getElementById("edit_fecha_fin").value = curso.data.fecha_fin;
      await cargarInstructores(
        "edit_instructor_combo",
        curso.data.instructor_lider
      );
      showToast("Curso encontrado y campos llenados.", "#27ae60", 4000);
    } else {
      showToast("No se encontró el curso con esa ficha.", "#e74c3c", 4000);
    }
  } catch (error) {
    showToast("Error buscando el curso.", "#e74c3c", 4000);
  }
}

// Cerrar modal por ID
function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) modal.style.display = "none";
}

// Cerrar modales al hacer clic fuera de ellos
window.onclick = function (event) {
  if (event.target === document.getElementById("create_curso"))
    closeModal("create_curso");
  if (event.target === document.getElementById("edit_curso"))
    closeModal("edit_curso");
};

// Editar curso mediante API
async function editarCurso2() {
  const curso_id = document.getElementById("edit_curso_id").value.trim();
  const ficha = document.getElementById("edit_ficha").value.trim();
  const nombre = document.getElementById("edit_nombre_combo").value;
  const fecha_inicio = document.getElementById("edit_fecha_inicio").value;
  const fecha_fin = document.getElementById("edit_fecha_fin").value;
  const instructor_lider = document.getElementById(
    "edit_instructor_combo"
  ).value;
  const data = {
    id_curso: curso_id,
    ficha,
    nombre_curso: nombre,
    id_profesor_lider: instructor_lider,
    fecha_inicio,
    fecha_fin
  };

  try {
    const res = await fetch("/admin/course/editarCurso", {
      method: "POST",
      body: JSON.stringify(data),
      headers: {
        "Content-Type": "application/json"
      },
    });

    const result = await res.json();
    if (result.status === "success") {
      showToast("Curso editado exitosamente.", "#27ae60", 4000);
      closeModal("edit_curso");
      cargarDatosDashboardTabla();
    } else {
      showToast(result.mensaje, "#e74c3c", 4000);
    }
  } catch (error) {
    showToast("Falla del servidor.", "#e74c3c", 4000);
  }
}

// Registrar evento submit para editar curso
function editarCurso() {
  const form = document.getElementById("editCursoForm");
  if(form){
    form.addEventListener("submit", async function (e) {
      e.preventDefault();
      await editarCurso2();
    });
  }
}
editarCurso();

// Crear curso mediante API
async function crearCurso2() {
  const ficha = document.getElementById("create_ficha").value.trim();
  const nombre = document.getElementById("create_nombre_combo").value;
  const fecha_inicio = document.getElementById("create_fecha_inicio").value;
  const fecha_fin = document.getElementById("create_fecha_fin").value;
  const instructor_lider = document.getElementById(
    "create_instructor_combo"
  ).value;
  const data = {
    ficha,
    nombre_curso: nombre,
    id_profesor_lider: instructor_lider,
    fecha_inicio,
    fecha_fin
  };
  try {
    const res = await fetch("/admin/course/crearCurso", {
      method: "POST",
      body: JSON.stringify(data),
      headers: {
        "Content-Type": "application/json"
      },
    });

    const result = await res.json();
    if (result.status === "success") {
      showToast("Curso creado exitosamente.", "#27ae60", 4000);
      closeModal("create_curso");
      cargarDatosDashboardTabla();
    } else {
      showToast(result.mensaje, "#e74c3c", 4000);
    }
  } catch (error) {
    showToast("Falla del servidor.", "#e74c3c", 4000);
  }
}

// Registrar evento submit para crear curso
function crearCurso() {
  const form = document.getElementById("createCursoForm");
  if(form){
    form.addEventListener("submit", async function (e) {
      e.preventDefault();
      await crearCurso2();
    });
  }
}
crearCurso();

// Desactivar curso mediante API
async function desactivarCurso2() {
  const ficha = document.getElementById("desactivar_ficha").value.trim();
  const mensaje = document.getElementById("desactivar_mensaje").value.trim();
  const data = {
    ficha,
    mensaje
  };
  try {
    const res = await fetch("/admin/course/desactivarCurso", {
      method: "POST",
      body: JSON.stringify(data),
      headers: {
        "Content-Type": "application/json"
      },
    });
    const result = await res.json();
    if (result.status === "success") {
      showToast("Curso desactivado exitosamente.", "#27ae60", 4000);
      closeModal("desactivar_curso_modal");
      cargarDatosDashboardTabla();
    } else {
      showToast(result.mensaje, "#e74c3c", 4000);
    }
  } catch (error) {
    showToast("Falla del servidor.", "#e74c3c", 4000);
  }
}

// Registrar evento submit para desactivar curso
function desactivarCurso() {
  const form = document.getElementById("desactivarCursoForm");
  if(form){
    form.addEventListener("submit", async function (e) {
      e.preventDefault();
      await desactivarCurso2();
    });
  }
}
desactivarCurso();