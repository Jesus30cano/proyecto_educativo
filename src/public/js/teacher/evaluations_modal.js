document.addEventListener("DOMContentLoaded", () => {
  const ia_cantidad = document.getElementById("ia_cantidad");
  ia_cantidad.addEventListener("input", () => {
    let val = parseInt(ia_cantidad.value);
    if (isNaN(val) || val < 1) val = 1;
    if (val > 15) val = 15;
    ia_cantidad.value = val;
  });
  const evaluacionModal = new bootstrap.Modal(
    document.getElementById("modalEvalManual")
  );
  const evaluacionModalIA = new bootstrap.Modal(
    document.getElementById("modalEvalIA")
  );
function limpiarRepetidosSelect(selectElem) {
  const encontrados = new Set();
  // Recorre de atrás hacia adelante
  for (let i = selectElem.options.length - 1; i >= 0; i--) {
    const opt = selectElem.options[i];
    // No eliminar la opción placeholder (value vacío)
    if (opt.value !== "" && encontrados.has(opt.value)) {
      selectElem.remove(i);
    } else {
      encontrados.add(opt.value);
    }
  }
}
  const btnCrearManual = document.getElementById("btnCrearEvaluacionManual");
  btnCrearManual.addEventListener("click", () => {
    document.getElementById("man_titulo").value = "";
    document.getElementById("man_descripcion").value = "";
    document.getElementById("man_fecha").value = "";
    document.getElementById("man_contenedor_preguntas").innerHTML = "";
    cargarComboBox("man_curso", "", "man_competencia", "");
  });

  const btnCrearIA = document.getElementById("btnCrearEvaluacionIA");
  btnCrearIA.addEventListener("click", () => {
    document.getElementById("ia_titulo").value = "";
    document.getElementById("ia_descripcion").value = "";
    document.getElementById("ia_fecha").value = "";
    document.getElementById("ia_cantidad").value = "5";
    document.getElementById("ia_preguntas_resultado").innerHTML = "";
    cargarComboBox("ia_curso", "", "ia_competencia", "");
  });
  async function cargarComboBox(
    comboId1,
    selectedId1 = "",
    comboId2,
    selectedId2 = ""
  ) {
    try {
      const res = await fetch("/teacher/course/obtenerCursosProfesor");
      const data = await res.json();
      const comboCurso = document.getElementById(comboId1);
      const comboCompetencia = document.getElementById(comboId2);
      comboCurso.innerHTML = '<option value="">Seleccionar curso</option>';
      comboCompetencia.innerHTML =
        '<option value="">Seleccionar competencia</option>';
      if (Array.isArray(data.data)) {
        data.data.forEach((curso) => {
          const optionCurso = document.createElement("option");
          const optionCompetencia = document.createElement("option");
          optionCurso.value = curso.id_curso;
          optionCompetencia.value = curso.id_competencia;
          optionCurso.innerText = curso.curso;
          optionCompetencia.innerText = curso.competencia;
          if (selectedId1 && selectedId1 == curso.id_curso)
            optionCurso.selected = true;
          if (selectedId2 && selectedId2 == curso.id_competencia)
            optionCompetencia.selected = true;
          comboCurso.appendChild(optionCurso);
          comboCompetencia.appendChild(optionCompetencia);
          limpiarRepetidosSelect(comboCurso);
          limpiarRepetidosSelect(comboCompetencia);
        });
        limpiarRepetidosSelect(comboCurso);
        limpiarRepetidosSelect(comboCompetencia);
      }
    } catch (error) {
      console.error("Error al cargar los cursos:", error);
    }
  }
  const aggPreguntaBtn = document.getElementById("aggPreguntaBtn");
  aggPreguntaBtn.addEventListener("click", () => {
    agregarPregunta();
  });

  function agregarPregunta() {
    const contenedor = document.getElementById("man_contenedor_preguntas");
    const preguntaCard = document.createElement("div");
    preguntaCard.classList.add(
      "pregunta-card",
      "question",
      "position-relative"
    );

    // Opciones iniciales (A, B, C, D)
    const opcionLabels = ["A", "B", "C", "D"];
    let opcionesHtml = "";
    opcionLabels.forEach((label, idx) => {
      opcionesHtml += `
      <div class="opcion d-flex align-items-center gap-2 position-relative">
        <span class="fw-bold me-2">${label}.</span>
        <input type="radio" name="" value="${idx}" style="margin-right:8px;">
        <input type="text" class="form-control mb-2 opcion-texto" placeholder="Texto de opción...">
        <span class="delete-option" style="cursor:pointer;">✖</span>
      </div>
    `;
    });

    preguntaCard.innerHTML = `
    <span class="delete-question" style="cursor:pointer;position:absolute;top:5px;right:10px;font-size:20px;">✖</span>
    <label class="fw-bold pregunta-label"></label>
    <input type="text" class="form-control mb-3" placeholder="Escribe la pregunta">
    <div class="opciones-list">
      ${opcionesHtml}
    </div>
  `;

    // Evento para eliminar la pregunta
    preguntaCard
      .querySelector(".delete-question")
      .addEventListener("click", function () {
        contenedor.removeChild(preguntaCard);
        renumerarPreguntas();
      });

    // Evento para eliminar opciones (manteniendo al menos una)
    const opcionesDiv = preguntaCard.querySelector(".opciones-list");
    opcionesDiv.querySelectorAll(".delete-option").forEach((delBtn, idx) => {
      delBtn.addEventListener("click", function () {
        const todasOpciones = opcionesDiv.querySelectorAll(".opcion");
        if (todasOpciones.length > 1) {
          // Siempre mínimo una opción
          opcionesDiv.removeChild(delBtn.parentElement);
          renumerarOpciones(preguntaCard);
        }
      });
    });

    // Evento para cambiar colores al seleccionar una opción
    opcionesDiv
      .querySelectorAll('input[type="radio"]')
      .forEach((radio, idx) => {
        radio.addEventListener("change", function () {
          const radios = opcionesDiv.querySelectorAll('input[type="radio"]');
          radios.forEach((r, i) => {
            const div = r.closest(".opcion");
            if (r.checked) {
              div.style.background = "#5cb85c"; // Verde
            } else {
              div.style.background = "#d9534f"; // Rojo
            }
          });
        });
      });

    contenedor.appendChild(preguntaCard);
    renumerarPreguntas();
  }

  function renumerarPreguntas() {
    const contenedor = document.getElementById("man_contenedor_preguntas");
    const cards = contenedor.querySelectorAll(".pregunta-card");
    cards.forEach((card, i) => {
      card.querySelector(".pregunta-label").textContent = "Pregunta " + (i + 1);
      card.querySelectorAll('input[type="radio"]').forEach((input, j) => {
        input.name = "m" + (i + 1); // El grupo cambia según la pregunta
      });
      renumerarOpciones(card);
    });
  }

  function renumerarOpciones(card) {
    const opcionLabels = ["A", "B", "C", "D", "E", "F", "G", "H"];
    const opciones = card.querySelectorAll(".opcion");
    opciones.forEach((opcion, idx) => {
      const letraSpan = opcion.querySelector(".fw-bold");
      if (letraSpan) letraSpan.textContent = opcionLabels[idx] + ".";
    });
  }
  const fomGuardarEvalManual = document.getElementById(
    "form-evaluacion-manual"
  );
  fomGuardarEvalManual.addEventListener("submit", async (e) => {
    e.preventDefault();
    const id_curso = document.getElementById("man_curso").value;
    const id_competencia = document.getElementById("man_competencia").value;
    if (!id_curso || !id_competencia) {
      showToast("Por favor selecciona curso y competencia.", "#e74c3c", 3000);
      return;
    }

    const data = {
      id_curso: document.getElementById("man_curso").value,
      id_competencia: document.getElementById("man_competencia").value,
      titulo: document.getElementById("man_titulo").value,
      descripcion: document.getElementById("man_descripcion").value,
      fecha: document.getElementById("man_fecha").value,
      questions: [],
    };

    // Recorrer cada pregunta
    const preguntaCards = document.querySelectorAll(
      "#man_contenedor_preguntas .pregunta-card"
    );
    if (preguntaCards.length === 0) {
      showToast("Agrega al menos una pregunta.", "#e74c3c", 3000);
      return;
    }
    preguntaCards.forEach((card) => {
      const preguntaText = card.querySelector(
        'input[type="text"]:not(.opcion-texto)'
      ).value;
      const opcionesDivs = card.querySelectorAll(".opcion");
      const opciones = [];

      opcionesDivs.forEach((opcionDiv) => {
        const opcionText = opcionDiv.querySelector(".opcion-texto").value;
        const radio = opcionDiv.querySelector('input[type="radio"]');
        const isCorrect = radio.checked;
        opciones.push({
          text: opcionText,
          correct: isCorrect,
        });
      });

      data.questions.push({
        text: preguntaText,
        opciones: opciones,
      });
    });

    // Ya tienes tu data JSON:

    // Ejemplo de envío usando fetch (ajusta la URL y método según tu backend)

    try {
      const response = await fetch("/teacher/evaluations/guardar_evaluacion", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
      });
      const result = await response.json();
      // Notifica usuario o redirige, etc
      if (result.status === "success") {
        showToast(result.message, "#3ce783ff", 3000);
        // Cierra modal, recarga tabla, etc
        document.getElementById("man_titulo").value = "";
        document.getElementById("man_descripcion").value = "";
        document.getElementById("man_fecha").value = "";
        document.getElementById("man_contenedor_preguntas").innerHTML = "";
        cargarComboBox("man_curso", "", "man_competencia", "");
      } else {
        showToast(result.message, "#e74c3c", 3000);
      }
    } catch (err) {
      alert("Error al guardar!" + err);
    }
  });

  const aggPreguntaIABtn = document.getElementById("btnGenerarIA");
  aggPreguntaIABtn.addEventListener("click", async () => {
    const cantidad = document.getElementById("ia_cantidad").value;
    const id_competencia = document.getElementById("ia_competencia").value;
    const id_curso = document.getElementById("ia_curso").value;
    const descripcion = document.getElementById("ia_descripcion").value;
    const titulo = document.getElementById("ia_titulo").value;
    const fecha = document.getElementById("ia_fecha").value;
    const instrucciones = document.getElementById("ia_instrucciones").value;
    const dificultad = document.getElementById("ia_dificultad").value;
    const data = {
      id_curso,
      id_competencia,
      titulo,
      descripcion,
      fecha,
      cantidad,
      instrucciones,
      dificultad,
    };

    if (
      !cantidad ||
      !id_competencia ||
      !id_curso ||
      !descripcion ||
      !titulo ||
      !fecha
    ) {
      showToast(
        "Por favor completa todos los campos requeridos.",
        "#e74c3c",
        3000
      );
      return;
    }

    const contenedorResultados = document.getElementById(
      "ia_preguntas_resultado"
    );
    contenedorResultados.innerHTML = `<div class="text-center mb-3"><span>Generando preguntas...</span></div>`;

    try {
      const response = await fetch(
        "/teacher/evaluations/generar_preguntas_ia",
        {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(data),
        }
      );
      const result = await response.json();
      console.log("Resultado IA:", result);

      if (
        !result.questions ||
        !Array.isArray(result.questions) ||
        result.questions.length === 0
      ) {
        contenedorResultados.innerHTML = `<div class="text-danger text-center">No se generaron preguntas.</div>`;
        return;
      }

      // Pintar preguntas generadas
      let html = "";
      result.questions.forEach((q, i) => {
        html += `
                <div class="pregunta-card question ia-generated mb-4" data-ia="true">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <label class="fw-bold mb-0">Pregunta generada por IA</label>
                        <span class="badge-ia">IA: respuesta marcada</span>
                    </div>
                    <input type="text" class="form-control mb-3" value="${
                      q.text
                    }" disabled>
                    ${q.opciones
                      .map(
                        (op, j) => `
                        <div class="opcion">
                            <input type="radio" id="ia_q${i}o${j}" name="ia_q${i}" value="${j}"
                              ${op.correct ? "checked" : ""}
                              data-ia-correct="${op.correct}"
                              disabled>
                            <label for="ia_q${i}o${j}">${op.text}</label>
                        </div>
                    `
                      )
                      .join("")}
                </div>
            `;
      });

      contenedorResultados.innerHTML = html;
    } catch (err) {
      contenedorResultados.innerHTML = `<div class="text-center text-danger">Error al generar preguntas.</div>`;
      alert("Error al generar preguntas! " + err);
    }
  });
  const formEvalIA = document.getElementById("form-evaluacion-ia");

  formEvalIA.addEventListener("submit", async (e) => {
    e.preventDefault();
    // Aquí puedes manejar el envío del formulario de evaluación IA
    const id_curso = document.getElementById("ia_curso").value;
    const id_competencia = document.getElementById("ia_competencia").value;
    if (!id_curso || !id_competencia) {
      showToast("Por favor selecciona curso y competencia.", "#e74c3c", 3000);
      return;
    }

    const data = {
      id_curso: document.getElementById("ia_curso").value,
      id_competencia: document.getElementById("ia_competencia").value,
      titulo: document.getElementById("ia_titulo").value,
      descripcion: document.getElementById("ia_descripcion").value,
      fecha: document.getElementById("ia_fecha").value,
      questions: [],
    };
    const preguntasCards = document.querySelectorAll(
      "#ia_preguntas_resultado .pregunta-card.ia-generated"
    );
    if (preguntasCards.length === 0) {
      showToast("No hay preguntas generadas para guardar.", "#e74c3c", 3000);
      return;
    }
    preguntasCards.forEach((card) => {
      const preguntaText = card.querySelector('input[type="text"]').value;
      const opcionesDivs = card.querySelectorAll(".opcion");
      const opciones = [];
      opcionesDivs.forEach((opcionDiv) => {
        const opcionText = opcionDiv.querySelector("label").innerText;
        const radio = opcionDiv.querySelector('input[type="radio"]');
        const isCorrect = radio.getAttribute("data-ia-correct") === "true";
        opciones.push({
          text: opcionText,
          correct: isCorrect,
        });
      });

      data.questions.push({
        text: preguntaText,
        opciones: opciones,
      });
    });

    try {
      const response = await fetch("/teacher/evaluations/guardar_evaluacion", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
      });
      const result = await response.json();
      if (result.status === "success") {
        showToast(result.message, "#3ce783ff", 3000);
        document.getElementById("ia_titulo").value = "";
        document.getElementById("ia_descripcion").value = "";
        document.getElementById("ia_fecha").value = "";
        document.getElementById("ia_preguntas_resultado").innerHTML = "";
        cargarComboBox("ia_curso", "", "ia_competencia", "");
        document.getElementById("ia_cantidad").value = "5";
        document.getElementById("ia_instrucciones").value = "";
        document.getElementById("ia_dificultad").value = "seleccionar";
      } else {
        showToast("Error al guardar la evaluación IA", "#ff4c4c", 3000);
      }
    } catch (error) {
      showToast("Error al guardar la evaluación IA2", "#ff4c4c", 3000);
      console.error("Error al guardar la evaluación IA:", error);
    }
  });


});
