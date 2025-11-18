// Contactos de emergencia del estudiante.
//Esra funcion ayuda a que el usuario pueda añadir mas contactos y llenar su informacion, editar y borrar.

let contadorContactos = 2;

document.getElementById('btnAgregarContacto').addEventListener('click', function() {
  contadorContactos++;
  //Con el boton de añadir crea nuevas listas, la misma informacion personal que alla como ejemplo.
  const nuevoContacto = `
    <hr class="my-4">
    
    <div class="contacto-emergencia">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="mb-0"><i class="bi bi-person-fill-exclamation me-2"></i>Contacto #${contadorContactos}</h6>
        <button class="btn btn-sm btn-outline-danger" onclick="eliminarContacto(this)">
          <i class="bi bi-trash"></i>
        </button>
      </div>
      
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label fw-bold"><i class="bi bi-person me-2"></i>Nombre</label>
            <p class="form-control-plaintext">Sin información</p>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold"><i class="bi bi-person me-2"></i>Apellido</label>
            <p class="form-control-plaintext">Sin información</p>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold"><i class="bi bi-envelope me-2"></i>Email</label>
            <p class="form-control-plaintext">Sin información</p>
          </div>
        </div>

        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label fw-bold"><i class="bi bi-heart me-2"></i>Parentesco</label>
            <p class="form-control-plaintext">Sin información</p>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold"><i class="bi bi-telephone me-2"></i>Teléfono</label>
            <p class="form-control-plaintext">Sin información</p>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold"><i class="bi bi-geo-alt me-2"></i>Dirección</label>
            <p class="form-control-plaintext">Sin información</p>
          </div>
        </div>

        <div class="col-md-12">
          <div class="mb-3">
            <label class="form-label fw-bold"><i class="bi bi-chat-square-text me-2"></i>Observaciones</label>
            <p class="form-control-plaintext">Sin información</p>
          </div>
        </div>
      </div>

      <div class="text-end">
        <button class="btn btn-outline-primary btn-sm">
          <i class="bi bi-pencil me-2"></i>Editar
        </button>
      </div>
    </div>
  `;
  
  document.getElementById('contenedorContactos').insertAdjacentHTML('beforeend', nuevoContacto);
});

// funcion de eliminar la lista
function eliminarContacto(boton) {
  const contacto = boton.closest('.contacto-emergencia');
  const hr = contacto.previousElementSibling;
  
  if (hr && hr.tagName === 'HR') {
    hr.remove();
  }
  
  contacto.remove();
}