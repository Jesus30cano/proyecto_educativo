<!-- Modal: Más Notificaciones -->
<div class="modal fade" id="modalMostrarNotificaciones" tabindex="-1" aria-labelledby="modalMostrarNotificacionesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-notif-custom">

            <!-- Header -->
            <div class="modal-header header-notif-custom">
                <h5 class="modal-title mb-0 titulo-notif-custom" id="modalMostrarNotificacionesLabel">
                    <i class="fas fa-bell me-2"></i> Notificaciones
                </h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body body-notif-custom" id="notificaciones-modal-body">
                <!-- Las notificaciones se cargarán dinámicamente desde JavaScript -->
                <div class="text-center text-muted py-5">
                    <i class="fas fa-spinner fa-spin fa-3x mb-3" style="opacity: 0.3;"></i>
                    <p class="h5">Cargando notificaciones...</p>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer footer-notif-custom">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Cerrar
                </button>
            </div>

        </div>
    </div>
</div>

<style>
/* Modal personalizado */
.modal-notif-custom {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0,0,0,0.15);
}

/* Header personalizado con fondo azul claro */
.header-notif-custom {
    background: linear-gradient(135deg, #4A90E2 0%, #357ABD 100%);
    color: white;
    border-bottom: none !important;
    padding: 20px 25px;
}

.header-notif-custom::after {
    display: none !important;
}

.titulo-notif-custom {
    color: white !important;
    font-weight: 600;
    font-size: 1.3rem;
    border: none !important;
}

.header-notif-custom .btn-close {
    filter: brightness(0) invert(1);
    opacity: 0.9;
}

.header-notif-custom .btn-close:hover {
    opacity: 1;
}

/* Body del modal */
.body-notif-custom {
    padding: 25px;
    background-color: #f8f9fa;
}

/* Tarjetas de notificación */
.card-notif {
    border-radius: 12px;
    padding: 18px;
    border: 2px solid;
    box-shadow: 0 3px 8px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    background-color: white;
}

.card-notif:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.12);
}

.card-notif.bg-primary-light {
    border-color: #4A90E2;
}

.card-notif.bg-success-light {
    border-color: #4CAF50;
}

.card-notif.bg-warning-light {
    border-color: #f6c23e;
}

.card-notif.bg-danger-light {
    border-color: #e74a3b;
}

.card-notif.bg-info-light {
    border-color: #36b9cc;
}

/* Círculo de ícono */
.card-notif .icon-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}

/* Footer personalizado */
.footer-notif-custom {
    background-color: #f8f9fa;
    border-top: 1px solid #dee2e6;
    padding: 15px 25px;
}

.footer-notif-custom .btn {
    border-radius: 8px;
    padding: 8px 20px;
    font-weight: 500;
}
</style>