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
  <title>Mensajeria</title>
</head>

<body>
  <!-- navbar -->
      <?php include __DIR__ . '/../components/student/navbar.php'; ?>

    <!-- sidebar -->
      <?php include __DIR__ . '/../components/student/sidebar.php'; ?>


  <main class="mt-5 pt-3">
    <div class="container-fluid">

      <!-- Bienvenida al estudiante -->
      <div class="row">
        <div class="col-md-12 mb-4">
          <div class="card bg-primary text-white">
            <div class="card-body">
              <h3 class="mb-2"><i class="bi me-2"></i>Session de Mensajeria</h3>
            </div>
          </div>
        </div>
      </div>

      <hr>


      <!-- Mensajeria - cambios aqui -->
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <div>
                <span><i class="bi bi-chat-dots me-2"></i></span> Mensajes
              </div>
              <button class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle me-1"></i>Nuevo Mensaje
              </button> <!-- Boton para enviar un nuevo mensaje -->
            </div>
            <div class="card-body">

              <!-- Alerta de mensajes no leídos -->
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>¡Atención!</strong> Tienes 3 mensajes sin leer. <!-- Alerta de mensajes enviados -->
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <!-- Boton para cerrar las notificaciones -->
              </div>

              <div class="list-group">

                <!-- Mensaje 1 -->
                <a href="#" class="list-group-item list-group-item-action">
                  <div class="d-flex w-100 justify-content-between">
                    <h6 class="mb-1">
                      <i class="bi bi-person-circle me-2"></i>Prof. Ana López
                    </h6> <!-- Nombre del quien envio el mensaje -->
                    <small class="text-muted">2 días</small> <!-- Dias que han pasado del mensaje -->
                  </div>
                  <p class="mb-1">Material de apoyo para el próximo examen en la plataforma.</p>
                  <!-- Descripcion del mensaje -->
                  <small class="text-muted">Base de Datos</small> <!-- Titulo del envio -->
                </a>

                <!-- Mensaje 2  lo mismo explicado de arriba -->
                <a href="#" class="list-group-item list-group-item-action">
                  <div class="d-flex w-100 justify-content-between">
                    <h6 class="mb-1">
                      <i class="bi bi-person-circle me-2"></i>Prof. Roberto Díaz
                    </h6>
                    <small class="text-muted">3 días</small>
                  </div>
                  <p class="mb-1">Excelente trabajo en tu última evaluación. ¡Sigue así!</p>
                  <small class="text-muted">Redes y Comunicaciones</small>
                </a>
              </div>

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