<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/../../../public/css/boostrap_dashboard/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="/../../../public/css/boostrap_dashboard/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="/../../../public/css/boostrap_dashboard/style.css" />
  <title>Crear Mensaje</title>
</head>

<body>
  <!-- navbar -->
  <?php include __DIR__ . '/../components/student/navbar.php'; ?>

  <!-- sidebar -->
  <?php include __DIR__ . '/../components/student/sidebar.php'; ?>




  <main class="mt-5 pt-3">
    <div class="container-fluid">

      <!-- Formulario Nuevo Mensaje -->
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header bg-primary text-white">
              <h5 class="mb-0"><i class="bi bi-envelope-plus me-2"></i>Nuevo Mensaje</h5>
            </div>
            <div class="card-body">
              <form>
                <!-- Destinatario -->
                <div class="mb-3">
                  <label for="tipoDestinatario" class="form-label fw-bold">
                    <i class="bi bi-people me-2"></i>Tipo de Destinatario
                  </label>
                  <select class="form-select" id="tipoDestinatario" required> <!-- Las opciones para buscar el destinario -->
                    <option value="" selected disabled>Selecciona el tipo...</option>
                    <option value="profesor">Profesor</option> <!-- Opciones -->
                    <option value="estudiante">Estudiante</option>
                  </select>
                </div>

                <!-- Seleccionar persona específica -->
                <div class="mb-3">
                  <label for="destinatario" class="form-label fw-bold">
                    <i class="bi bi-person me-2"></i>Destinatario
                  </label>
                  <select class="form-select" id="destinatario" required> <!-- Opciones para buscar a que persona  -->
                    <option value="" selected disabled>Selecciona un destinatario...</option>
                    <option value="1">Prof. María García - Matemáticas</option> <!-- Opciones -->
                  </select>
                </div>

                <!-- Asunto -->
                <div class="mb-3">
                  <label for="asunto" class="form-label fw-bold">
                    <i class="bi bi-pencil me-2"></i>Asunto
                  </label>
                  <input 
                    type="text" 
                    class="form-control" 
                    id="asunto" 
                    placeholder="Escribe el asunto del mensaje..."
                    maxlength="200"
                    required
                  > <!-- escribir el asunto -->
                  <small class="text-muted">Máximo 200 caracteres</small>
                </div>

                <!-- Competencia/Materia (opcional) -->
                <div class="mb-3">
                  <label for="competencia" class="form-label fw-bold">
                    <i class="bi bi-book me-2"></i>Competencia/Materia <span class="text-muted">(Opcional)</span> 
                  </label>
                  <select class="form-select" id="competencia"> <!-- Competencia -->
                    <option value="" selected>Ninguna</option>
                    <option value="matematicas">Matemáticas Avanzadas</option> <!-- Opciones -->
                  </select>
                </div>

                <!-- Mensaje -->
                <div class="mb-3">
                  <label for="mensaje" class="form-label fw-bold">
                    <i class="bi bi-chat-text me-2"></i>Mensaje
                  </label>
                  <textarea 
                    class="form-control" 
                    id="mensaje" 
                    rows="6" 
                    placeholder="Escribe tu mensaje aquí..."
                    maxlength="3000"
                    required
                  ></textarea> <!-- Mensaje -->
                  <small class="text-muted">Máximo 3000 caracteres</small>
                </div>

                <!-- Adjuntar archivo -->
                <div class="mb-4">
                  <label for="archivo" class="form-label fw-bold">
                    <i class="bi bi-paperclip me-2"></i>Adjuntar Documento
                  </label>
                  <input 
                    type="file" 
                    class="form-control" 
                    id="archivo"
                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                  > <!-- Adjuntar algun archivo -->
                  <small class="text-muted">Formatos permitidos: PDF, Word, Imágenes (Máx. 5MB)</small>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-between">
                  <button type="button" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-2"></i>Cancelar
                  </button> <!-- Cancelar el mensaje y devolverlo a los mensajes -->
                  <div>
                    <button type="submit" class="btn btn-success">
                      <i class="bi bi-send me-2"></i>Enviar Mensaje
                    </button> <!-- Enviar el mensaje -->
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>
 

  <script src="./../../public/js/boostrap_dashboard/bootstrap.bundle.min.js"></script>
  <script src="./../../public/js/boostrap_dashboard/script.js"></script>
</body>

</html>