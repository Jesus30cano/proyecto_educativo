const id_examen = localStorage.getItem("id_evaluacion");

// Función para cargar los datos del examen desde el backend
async function fetchExamData(id_examen) {
  const response = await fetch("/teacher/evaluations/obtener_examen", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id: id_examen })
  });

  if (!response.ok) {
    // Manejo de error básico
    throw new Error("No se pudo cargar el examen.");
  }
  // Esperamos que el backend devuelva directamente el objeto examData
  $datos = await response.json();
  console.log('Datos del examen recibidos:', $datos);
  loadExamData($datos);
    return $datos;
}

// Función para renderizar los datos principales del examen
function loadExamData(data) {
  // Asume que el backend regresa todos estos campos correctamente
  
  document.getElementById("exam-title").textContent = data.data.title;
  
  document.getElementById("teacher-name").textContent = data.data.teacherName;
  document.getElementById("exam-date").textContent = data.data.date;
  document.getElementById("course-name").textContent = data.data.courseName;
  document.getElementById("competence-name").textContent = data.data.competenceName;
  document.getElementById("exam-description").textContent = data.data.description;
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

    let optionsHTML = "";
    question.options.forEach((option, optIndex) => {
      const letra = letras[optIndex] || "?";
      optionsHTML += `
        <div class="option">
          <input type="radio" id="q${question.id}_${letra}" name="question_${question.id}" value="${letra}">
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
  } catch(e) {
    // Error visual simple
    document.getElementById("questions-container").innerHTML = `<div class="alert alert-danger">No se pudo cargar el examen.</div>`;
  }
});