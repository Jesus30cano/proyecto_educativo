<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="/../../../public/css/boostrap_dashboard/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="/../../../public/css/boostrap_dashboard/style.css" />
  <title>Estudiante</title>
</head>

<body>
  <!-- offcanvas -->
  <?php include __DIR__ . '/../components/student/navbar.php'; ?>
  <!-- offcanvas -->

  <!-- top navigation bar -->
  <?php include __DIR__ . '/../components/student/sidebar.php'; ?>
  <!-- top navigation bar -->


  <main class="mt-5 pt-3">
    <div class="container-fluid">

      <!-- Bienvenida al estudiante -->
      <div class="row">
        <div class="col-md-12 mb-4">
          <div class="card bg-primary text-white">
            <div class="card-body">
              <h3 class="mb-2"><i class="bi bi-emoji-smile me-2"></i>¡Bienvenido de nuevo, Estudiante!</h3>
              <p class="mb-0">Tienes (Aqui numero de evaluaciones) evaluaciones pendientes esta semana.</p>
            </div>
          </div>
        </div>
      </div>


      <!-- Mensajeria -->
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-chat-dots me-2"></i></span> Mensajes
            </div>
            <div class="card-body">
              <div class="list-group">

                <!-- Mensaje 1 -->
                <a href="#" class="list-group-item list-group-item-action">
                  <div class="d-flex w-100 justify-content-between">
                    <h6 class="mb-1"><i class="bi bi-person-circle me-2"></i>Prof. María García</h6>
                    <!-- nombre del profesor y u admin (los admin solimplemente peuden poner administrador-->
                    <small class="text-muted">Hace 3 horas</small> <!-- Fecha de entrega del mensaje-->
                  </div>
                  <p class="mb-1">Recordatorio: La entrega del proyecto final es el viernes.</p> <!-- Descripcion -->
                  <small class="text-muted">Competencia</small> <!-- Competencia (si gustan) -->
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