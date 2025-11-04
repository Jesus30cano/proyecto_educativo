async function login() {
  const tipo_documento = document.getElementById("tipo_documento").value;
  const documentNumber = document.getElementById("document").value;
  const password = document.getElementById("password").value;

  const formData = new FormData();
  formData.append("tipo_documento", tipo_documento);
  formData.append("document", documentNumber);
  formData.append("password", password);

  try {
    const response = await fetch("/auth/login", {
      method: "POST",
      body: formData,
    });

    // Validar que la respuesta sea JSON
    const text = await response.text();
    let data;
    try {
      data = JSON.parse(text);
    } catch (e) {
      console.error("Respuesta no es JSON:", text);
      alert("Error interno. El servidor no devolvió una respuesta válida.");
      return;
    }

    if (data.status === "success") {
      alert(data.message);
      localStorage.setItem("id_user", data.id_user);
      localStorage.setItem("usuario", data.usuario);
      localStorage.setItem("rol", data.rol);
      window.location.href = data.redirect || "/home";
    } else if (data.status === "error") {
      if (data.errors && Array.isArray(data.errors)) {
        alert("Errores encontrados:\n\n" + data.errors.join("\n"));
      } else {
        alert(data.message || "Credenciales inválidas.");
      }
    } else {
      alert("Ocurrió un error inesperado.");
    }

  } catch (error) {
    console.error("Error de conexión o JSON inválido:", error);
    alert("Error de conexión. Por favor, intenta de nuevo.");
  }
}

function setupFormSubmission() {
  const form = document.getElementById("loginForm");
  if (form) {
    form.addEventListener("submit", async function (e) {
      e.preventDefault();
      await login();
    });
  }
}

setupFormSubmission();
