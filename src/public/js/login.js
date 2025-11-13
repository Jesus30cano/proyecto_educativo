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
      showToast("Error interno. El servidor no devolvió una respuesta válida.", "#e74c3c", 4000);
      return;
    }

    if (data.status === "success") {
      showToast(data.message, "#27ae60", 3000);
      localStorage.setItem("id_user", data.id_user);
      localStorage.setItem("usuario", data.usuario);
      localStorage.setItem("rol", data.rol);
      
      // Redirigir después de mostrar el toast
      setTimeout(() => {
        window.location.href = data.redirect || "/home";
      }, 1500);
    } else if (data.status === "error") {
      if (data.errors && Array.isArray(data.errors)) {
        // Usar el toast con array de mensajes
        showToast(data.errors, "#e74c3c", 5000);
      } else {
        showToast(data.message || "Credenciales inválidas.", "#e74c3c", 4000);
      }
    } else {
      showToast("Ocurrió un error inesperado.", "#e74c3c", 4000);
    }

  } catch (error) {
    console.error("Error de conexión o JSON inválido:", error);
    showToast("Error de conexión. Por favor, intenta de nuevo.", "#e74c3c", 4000);
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
// Espera a que el DOM esté completamente cargado antes de ejecutar el código
document.addEventListener('DOMContentLoaded', function() {
  /**
   * Esta función elimina cualquier carácter que no sea número del input del documento.
   * Así el usuario solo podrá escribir dígitos, ya sea al tipear o al pegar desde el portapapeles.
   */
  function soloNumeros(event) {
    // Reemplaza cualquier carácter que no sea un dígito por una cadena vacía
    event.target.value = event.target.value.replace(/\D/g, '');
  }

  // Obtiene el campo de documento por su id
  const documentoInput = document.getElementById('document');
  if (documentoInput) {
    // Asigna el filtro cada vez que el usuario interactúe con el campo
    documentoInput.addEventListener('input', soloNumeros);
  }
});