document.addEventListener("DOMContentLoaded", function () {
  const verifyCodeForm = document.getElementById("verifyCodeForm");
  const codeInputs = document.querySelectorAll(".code-input");
  const submitButton = verifyCodeForm.querySelector(".btn-login");

  codeInputs.forEach((input, index) => {
    input.addEventListener("input", function (e) {
      this.value = this.value.replace(/[^0-9]/g, "");
      if (this.value.length === 1 && index < codeInputs.length - 1) {
        codeInputs[index + 1].focus();
      }
    });
    input.addEventListener("keydown", function (e) {
      if (e.key === "Backspace" && !this.value && index > 0) {
        codeInputs[index - 1].focus();
      }
    });
    input.addEventListener("paste", function (e) {
      e.preventDefault();
      const pastedData = e.clipboardData.getData("text").replace(/[^0-9]/g, "");
      for (
        let i = 0;
        i < pastedData.length && index + i < codeInputs.length;
        i++
      ) {
        codeInputs[index + i].value = pastedData[i];
      }
      const lastFilledIndex = Math.min(
        index + pastedData.length,
        codeInputs.length - 1
      );
      codeInputs[lastFilledIndex].focus();
    });
  });

  verifyCodeForm.addEventListener("submit", async function (e) {
    e.preventDefault();
    const code = Array.from(codeInputs)
      .map((input) => input.value)
      .join("");
    if (code.length !== 6) {
      showToast("Por favor ingresa el código completo", "#e74c3c", 3000);
      return;
    }

    submitButton.disabled = true;
    submitButton.textContent = "VERIFICANDO...";

    try {
      const response = await fetch("/auth/validar_codigo", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ code }),
      });

      const data = await response.json();

      if (data.status === "success") {
        showToast(data.message, "#27ae60", 3000);
        setTimeout(() => {
          window.location.href = "/auth/actualizar_contrasena";
        }, 1500);
      } else {
        showToast(data.message, "#e74c3c", 3000);
        codeInputs.forEach((input) => (input.value = ""));
        codeInputs[0].focus();
        submitButton.disabled = false;
        submitButton.textContent = "VERIFICAR CÓDIGO";
      }
    } catch (error) {
      console.error("Error:", error);
      showToast(
        "Error de conexión. Por favor intenta nuevamente.",
        "#e74c3c",
        3000
      );
      submitButton.disabled = false;
      submitButton.textContent = "VERIFICAR CÓDIGO";
    }
  });

  codeInputs[0].focus();
});
