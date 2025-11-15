fetch('/public/js/Frases_motivacionales.json')
  .then(response => response.json())
  .then(data => {
    const frases = data.frases_motivacionales;
    const fraseAleatoria = frases[Math.floor(Math.random() * frases.length)];
    document.getElementById('frase').textContent = fraseAleatoria;
  })
  .catch(error => console.error("Error al cargar el JSON:", error));
