document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("resetPasswordForm");
  const passwordInput = document.getElementById("password");
  const confirmInput = document.getElementById("confirm_password");
  const submitBtn = form.querySelector(".btn-login");

  form.addEventListener("submit", async function (e) {
    e.preventDefault();

    const password = passwordInput.value.trim();
    const confirm = confirmInput.value.trim();

    // Validaciones
    if (password.length < 6) {
      showToast(
        "La contraseña debe tener al menos 6 caracteres.",
        "#e74c3c",
        3000
      );
      return;
    }
    if (password !== confirm) {
      showToast("Las contraseñas no coinciden.", "#e74c3c", 3000);
      return;
    }

    submitBtn.disabled = true;
    submitBtn.textContent = "CAMBIANDO...";

    try {
      const response = await fetch("/auth/actualizar_contrasena", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ nueva_contrasena: password }),
      });
      const data = await response.json();

      if (response.ok && data.status === "success") {
        showToast(data.message, "#27ae60", 3000);
        setTimeout(() => {
          window.location.href = "/auth/login";
        }, 1800);
      } else {
        showToast(
          data.message || "Error cambiando la contraseña.",
          "#e74c3c",
          3000
        );
        submitBtn.disabled = false;
        submitBtn.textContent = "CAMBIAR CONTRASEÑA";
      }
    } catch (err) {
      showToast("Error de conexión. Intenta de nuevo.", "#e74c3c", 3000);
      submitBtn.disabled = false;
      submitBtn.textContent = "CAMBIAR CONTRASEÑA";
    }
  });
});
