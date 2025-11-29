const id_examen = localStorage.getItem("id_evaluacion_id");
async function fetchExamData(id_examen) {
  const response = await fetch("/teacher/evaluations/obtener_examen_estudiante", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id: id_examen }),
  });

  if (!response.ok) {
    // Manejo de error básico
    throw new Error("No se pudo cargar el examen.");
  }
  // Esperamos que el backend devuelva directamente el objeto examData
  $datos = await response.json();
  loadExamData($datos);
  return $datos;
}
// Función para renderizar los datos principales del examen
function loadExamData(data) {
  document.getElementById("exam-title").textContent = data.data.title;
  document.getElementById("teacher-name").textContent = data.data.teacherName;
  document.getElementById("exam-date").textContent = data.data.date;
  document.getElementById("course-name").textContent = data.data.courseName;
  document.getElementById("competence-name").textContent = data.data.competenceName;
  document.getElementById("exam-description").textContent = data.data.description;
  document.getElementById("student-name").textContent = data.data.studentName;
  document.getElementById("exam-grade").textContent = data.data.nota;
  loadQuestions(data.data.questions);
}

// Función para renderizar las preguntas y opciones con letras (a, b, c, ...)
function loadQuestions(questions) {
  const container = document.getElementById("questions-container");
  container.innerHTML = "";
  const letras = "abcdefghijklmnopqrstuvwxyz".split("");

  questions.forEach((question, index) => {
    const questionCard = document.createElement("div");
    questionCard.className = "question-card";
    // Ordinal del estudiante (1-based)
    const studentAnswerIdx = question.studentAnswer - 1;
    let optionsHTML = "";

    question.options.forEach((option, optIndex) => {
      const letra = letras[optIndex] || "?";
      const checked = (studentAnswerIdx === optIndex) ? "checked" : "";
      // Lógica de clases según selección y corrección
      let optionClass = "option";
      // ¿Marcada por el estudiante?
      if (studentAnswerIdx === optIndex) {
        if (option.es_correcta) {
          optionClass += " selected-correct";
        } else {
          optionClass += " selected-wrong";
        }
      } else if (option.es_correcta) {
        // Mostrar como correcta si el estudiante NO selecciona la correcta
        optionClass += " only-correct";
      }
      optionsHTML += `
        <div class="${optionClass}">
          <input type="radio" id="q${question.id}_${letra}" name="question_${question.id}" value="${letra}" disabled ${checked}>
          <label for="q${question.id}_${letra}">${letra.toUpperCase()}. ${option.text}</label>
        </div>
      `;
    });

    questionCard.innerHTML = `
      <div class="question-number">Pregunta ${index + 1}</div>
      <div class="question-text">${question.text}</div>
      ${optionsHTML}
    `;
    container.appendChild(questionCard);
  });
}
// Cargar los datos al iniciar la página
document.addEventListener("DOMContentLoaded", async function () {
  try {
    const examData = await fetchExamData(id_examen);
    loadExamData(examData);
  } catch (e) {
    // Error visual simple
    document.getElementById(
      "questions-container"
    ).innerHTML = `<div class="alert alert-danger">No se pudo cargar el examen.</div>`;
  }
});
