// modal_create_estu.js - VERSIÓN CORREGIDA

// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    // Referencias a elementos del DOM
    const modal = document.getElementById('create_estudi');
    const openModalBtn = document.getElementById('openModalBtn');
    const studentForm = document.getElementById('studentForm');
    
    // Verificar que los elementos existen antes de agregar event listeners
    if (openModalBtn) {
        openModalBtn.addEventListener('click', function() {
            openModal('create_estudi');
        });
    }

    if (modal) {
        // Cerrar modal al hacer clic fuera del contenido
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                closeModal('create_estudi');
            }
        });
    }

    if (studentForm) {
        // Manejo del envío del formulario
        studentForm.addEventListener('submit', function(event) {
            event.preventDefault();
            handleFormSubmit();
        });
    }
});

// Función para abrir el modal
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'block';
        // Limpiar formulario y errores al abrir
        if (document.getElementById('studentForm')) {
            document.getElementById('studentForm').reset();
        }
        clearErrors();
    } else {
        console.error('Modal no encontrado:', modalId);
    }
}

// Función para cerrar el modal
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'none';
    }
}

// Función alternativa para compatibilidad con onclick
function openCreateEstudianteModal() {
    openModal('create_estudi');
}

// Función para limpiar mensajes de error
function clearErrors() {
    const errorElements = document.querySelectorAll('.error');
    errorElements.forEach(element => {
        element.textContent = '';
    });
}

// Resto de tus funciones (validateForm, showError, etc.)
function handleFormSubmit() {
    const formData = new FormData(document.getElementById('studentForm'));
    
    if (validateForm(formData)) {
        alert('Estudiante creado exitosamente');
        closeModal('create_estudi');
    }
}

function validateForm(formData) {
    // Tu lógica de validación aquí
    return true;
}