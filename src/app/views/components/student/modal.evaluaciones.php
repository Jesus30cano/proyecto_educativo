<!-- Modal Evaluación 1 - DISPONIBLE -->
<div class="modal fade" id="modalEvaluacion1" tabindex="-1" aria-labelledby="modalEvaluacion1Label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header blue-claro text-white">
        <h5 class="modal-title" id="modalEvaluacion1Label">
          <i class="bi bi-clipboard-check me-2"></i>Evaluación de Matemáticas
        </h5>  <!-- Nombre de la ebaluacion -->
        <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button> <!-- Boton de cerrar el modal -->
      </div>
      <div class="modal-body">
        <div class="alert alert-info">
          <i class="bi bi-info-circle-fill me-2"></i>
          <strong>Evaluación Disponible</strong> - Puedes iniciarla en cualquier momento antes de la fecha límite.
        </div> <!-- El String dice si la evaluacion esta disponible o no -->

        <div class="mb-3">
          <h6 class="text-primary"><i class="bi bi-bookmark me-2"></i>Competencia:</h6>
          <p>Cálculo Diferencial</p> <!-- Competencia -->
        </div>

        <div class="mb-3">
          <h6 class="text-primary"><i class="bi bi-card-text me-2"></i>Descripción:</h6>
          <p>Evaluación sobre derivadas, límites y continuidad de funciones. Incluye ejercicios teóricos y prácticos
            sobre aplicaciones del cálculo diferencial.</p> <!-- Descripcion de la evaluacion -->
        </div> 

        <div class="row mb-3">
          <div class="col-md-6">
            <h6 class="text-primary"><i class="bi bi-list-ol me-2"></i>Número de Preguntas:</h6>
            <p class="text-warning fw-bold">15 preguntas</p> <!-- Numero de preguntas. lo pueden quitar si no esta en la base de datos -->
          </div>
        </div>

        <div class="mb-3">
          <h6 class="text-primary"><i class="bi bi-calendar-event me-2"></i>Fecha Límite:</h6>
          <p class="text-danger fw-bold">10 de Noviembre, 2024</p> <!-- Fecha limite de la evaluacion -->
        </div>

        <div class="alert alert-warning">
          <i class="bi bi-exclamation-triangle-fill me-2"></i>
          <strong>Importante:</strong> Una vez iniciada la evaluación, el tiempo comenzará a correr automáticamente y no
          podrás pausarla.
        </div> <!-- El strong y el texto avisa sobre la evaluacion, se puede quedar asi o quitarse. -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="bi bi-x-circle me-1"></i>Cancelar
        </button> <!-- Boton de cancelar -->
        <button type="button" class="btn btn-success">
          <i class="bi bi-play-circle me-1"></i>Iniciar Evaluación
        </button> <!-- Boton de iniciar la evaluacion -->
      </div>
    </div>
  </div>
</div>

<!-- Modal Evaluación 2 - cuando esta INACTIVA o no disponible lo demas explicado de arriba es lo mismo de aqui -->
<div class="modal fade" id="modalEvaluacion2" tabindex="-1" aria-labelledby="modalEvaluacion2Label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-secondary text-white">
        <h5 class="modal-title" id="modalEvaluacion2Label">
          <i class="bi bi-clipboard-x me-2"></i>Evaluación de Física
        </h5> 
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger">
          <i class="bi bi-x-circle-fill me-2"></i>
          <strong>Evaluación Inactiva</strong> - Esta evaluación ya no está disponible porque venció la fecha límite.
        </div> <!-- El strong avisa que ya no esta disponible este examen -->

        <div class="mb-3">
          <h6 class="text-primary"><i class="bi bi-bookmark me-2"></i>Competencia:</h6>
          <p>Cinemática</p>
        </div>

        <div class="mb-3">
          <h6 class="text-primary"><i class="bi bi-card-text me-2"></i>Descripción:</h6>
          <p>Evaluación sobre movimiento rectilíneo, velocidad y aceleración. Incluía análisis de gráficas y resolución
            de problemas.</p>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <h6 class="text-muted"><i class="bi bi-list-ol me-2"></i>Número de Preguntas:</h6>
            <p class="text-muted">18 preguntas</p>
          </div>
        </div>

        <div class="mb-3">
          <h6 class="text-danger"><i class="bi bi-calendar-x me-2"></i>Fecha Limite:</h6>
          <p class="text-danger fw-bold">08 de Noviembre, 2024</p>
        </div>

        <div class="alert alert-secondary">
          <i class="bi bi-info-circle me-2"></i>
          <strong>Nota:</strong> Contacta a tu profesor si necesitas más información sobre esta evaluación.
        </div> <!-- Aviso de la nota -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="bi bi-x-circle me-1"></i>Cerrar
        </button> <!-- Boton de cerrar modal -->
      </div>
    </div>
  </div>
</div>

