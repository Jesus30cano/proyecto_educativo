const id_user = localStorage.getItem("id_user");

document.addEventListener("DOMContentLoaded", () => {
    mostarDatosPersonales();
    mostarDatosEmergencia();
});
async function mostarDatosPersonales () {
    try {
    const response = await fetch("/general/mostrarDatosPersonales",{
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ id_user })
    });
    const data = await response.json();

    if (data.status !== "success") {
        console.error(
        "❌ Error en la respuesta del servidor1:", data.message 
        );
        return;
    }

    console.log("✅ Datos del perfil cargados:", data.data);
    mostarDatosPerfil(data.data);
    } catch (error) {
        console.error("❌ Error cargando perfil:", error);
    }
  
}

async function mostarDatosEmergencia () {

    try {
    const response = await fetch("/general/mostrarDatosEmergencia",{
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ id_user })
    });
    const data = await response.json();
    if (data.status !== "success") {
        console.error(
        "❌ Error en la respuesta del servidor2:", data.message
        );
        return;
    }

    console.log("✅ Datos de emergencia cargados:", data.data);
    mostarDatosEmergencia2(data.data);
    }
    catch (error) {
        console.error("❌ Error cargando datos de emergencia:", error);
    }
    
}

function mostarDatosPerfil(data) {
    document.getElementById("nombre").textContent = data.nombre;
    document.getElementById("apellido").textContent = data.apellido;
    document.getElementById("correo").textContent = data.email;
    document.getElementById("tipo_documento").textContent = data.tipo_documento;
    document.getElementById("numero_documento").textContent = data.documento;
    document.getElementById("fecha_nacimiento").textContent = data.fecha_nacimiento;
    document.getElementById("telefono").textContent = data.telefono;
    document.getElementById("direccion").textContent = data.direccion;
    document.getElementById("genero").textContent = data.genero;

}
function mostarDatosEmergencia2(data) {
    document.getElementById("emergencia_nombre").textContent = data.nombre;
    document.getElementById("emergencia_apellido").textContent = data.apellido;
    document.getElementById("emergencia_telefono").textContent = data.telefono;
    document.getElementById("emergencia_parentesco").textContent = data.parentesco;
    document.getElementById("emergencia_direccion").textContent = data.direccion;
    document.getElementById("emergencia_correo").textContent = data.correo;
    document.getElementById("emergencia_observaciones").textContent = data.observaciones;
}   