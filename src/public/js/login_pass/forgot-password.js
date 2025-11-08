document.addEventListener("DOMContentLoaded", function () {
  const forgotPasswordForm = document.getElementById("forgotPasswordForm");
  const emailInput = document.getElementById("email");
  const submitButton = forgotPasswordForm.querySelector(".btn-login");

  forgotPasswordForm.addEventListener("submit", async function (e) {
    e.preventDefault();

    const email = emailInput.value.trim();

    // Validación básica
    if (!email) {
      showToast("Por favor ingresa tu correo electrónico", "#333", 3000);
      return;
    }

    // Validar formato de email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      showToast("Por favor ingresa un correo electrónico válido", "error");
      return;
    }

    // Deshabilitar botón mientras se procesa
    submitButton.disabled = true;
    submitButton.textContent = "ENVIANDO";

    try {
      const response = await fetch("/auth/restablecer_contrasena", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ email: email }),
      });

      let data;
      try {
        const text = await response.text();
        console.log("📩 Respuesta cruda del servidor:", text);

        
        try {
          data = JSON.parse(text);
        } catch (jsonErr) {
          showToast("Error procesando la respuesta del servidor.", "error");
          console.error("❌ No es JSON válido:", text);
          submitButton.disabled = false;
          submitButton.textContent = "ENVIAR CÓDIGO";
          return;
        }
      } catch (jsonErr) {
        showToast("Error procesando la respuesta del servidor.", "error");
        submitButton.disabled = false;
        submitButton.textContent = "ENVIAR CÓDIGO";
        return;
      }

      // Mostrar todos los errores recibidos
      if (data.errors && Array.isArray(data.errors)) {
        data.errors.forEach((msg) => showToast(msg, "error"));
        submitButton.disabled = false;
        submitButton.textContent = "ENVIAR CÓDIGO";
        return;
      }

      // Muestra el mensaje si existe
      if (data.message) {
        if (response.ok && data.status === "success") {
          showToast(data.message, "#27ae60", 3000);
          setTimeout(() => {
            window.location.href = "/auth/validar_codigo";
          }, 2000);
        } else {
          showToast(data.message,"#e74c3c", 3000);
          submitButton.disabled = false;
          submitButton.textContent = "ENVIAR CÓDIGO";
        }
        return;
      }

    } catch (error) {
      console.error("Error:", error);
      showToast("Error de conexión. Por favor intenta nuevamente.", "#e74c3c", 3000);
      submitButton.disabled = false;
      submitButton.textContent = "ENVIAR CÓDIGO";
    }
  });

  // Validación en tiempo real del email
  emailInput.addEventListener("blur", function () {
    const email = this.value.trim();
    if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      this.style.borderColor = "#e53935";
    } else {
      this.style.borderColor = "#90CAF9";
    }
  });

  emailInput.addEventListener("input", function () {
    this.style.borderColor = "#90CAF9";
  });
});


