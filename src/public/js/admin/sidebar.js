document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll('a.load-view').forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault(); // Evita la navegación por defecto
      window.location.href = this.getAttribute("href");
    });
  });
});