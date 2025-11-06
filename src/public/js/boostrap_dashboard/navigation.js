document.addEventListener("DOMContentLoaded", () => {
  // Capturar los enlaces del sidebar que tienen data-view
  document.querySelectorAll(".load-view").forEach(link => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      
      const view = this.getAttribute("data-view");

      // Cambiar contenido sin recargar la página
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
