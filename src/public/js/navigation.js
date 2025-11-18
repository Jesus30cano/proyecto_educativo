document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".load-view").forEach(link => {
    link.addEventListener("click", function(e) {
      e.preventDefault();

      const href = this.getAttribute("href");
      const view = this.getAttribute("data-view");

      // Si la ruta es tipo "/admin/teacher/index" (o cualquier ruta absoluta)
      // Redirige la página, NO carga por AJAX
      if (href.startsWith("/admin/") || href.startsWith("/auth/")) {
        window.location.href = href;
        return;
      }

      // Si la ruta es relativa para views, usa AJAX para cargar solo el contenido
      fetch(`views/${view}.php`)
        .then(response => response.text())
        .then(html => {
          document.querySelector("#content-area").innerHTML = html;
        })
        .catch(err => {
          document.querySelector("#content-area").innerHTML = `
            <div class="alert alert-danger">Error cargando contenido: ${view}</div>`;
        });

      // Marcar como activa la opción seleccionada
      document.querySelectorAll('.nav-link').forEach(item => item.classList.remove('active'));
      this.classList.add('active');
    });
  });
});