
document.addEventListener("DOMContentLoaded", () => {
  cargarNombre();
  
});
async function cargarNombre() {
  try {
    const response = await fetch("/general/mostrarDatosPersonales",{
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ id_user: localStorage.getItem("id_user") })
    }); // Asegúrate de que esta ruta coincida con la del backend
    const data = await response.json();
    if (data.status !== "success") {
      console.error(
        "❌ Error en la respuesta del servidor:", data.message 
      );
      return;
    }
    const nombre = data.data.nombre + " " + data.data.apellido;
    document.getElementById("nombre_usuario").textContent = nombre;
  } catch (error) {
    console.error("❌ Error al cargar el nombre:", error);
  }
}
