<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/../../../public/css/boostrap_dashboard/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="/../../../public/css/boostrap_dashboard/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="/../../../public/css/boostrap_dashboard/style.css" />
    <title>Estudiante</title>
  </head>
  <body>
    <!-- Navbar -->
      <?php include __DIR__ . '/../components/student/navbar.php'; ?>


    <!-- Sidebar -->
      <?php include __DIR__ . '/../components/student/sidebar.php'; ?>

    <main class="mt-5 pt-3">
      <div class="container-fluid">

        <!-- Bienvenida al estudiante -->
        <div class="row">
          <div class="col-md-12 mb-4">
            <div class="card bg-primary text-white">
              <div class="card-body">
                <h3 class="mb-2"><i class="bi bi-emoji-smile me-2"></i>¡Bienvenido de nuevo, Estudiante!</h3>
                <p class="mb-0">Tienes (Aqui numero de evaluaciones) evaluaciones pendientes.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <h4>Contenido principal</h4>
          </div>
        </div>

        <!-- Calendario -->
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card h-100">
              <div class="card-header">
                <span class="me-2"><i class="bi bi-calendar3"></i></span>
                Calendario
              </div>
              <div class="card-body">
                <div id="calendar"></div> <!-- El calendario es manejado por un script en js (no tiene nada). esto es solo el diseño del calendario-->
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <h4>Mensajeria</h4>
          </div>
        </div>

        <!-- Mensajería -->
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-chat-dots me-2"></i></span> Mensajes Recientes
              </div>
              <div class="card-body">
                <div class="list-group">

                  <!-- Mensaje 1 -->
                  <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                      <h6 class="mb-1"><i class="bi bi-person-circle me-2"></i>Prof. María García</h6> <!-- nombre profesor u admin -->
                      <small class="text-muted">Hace 3 horas</small> <!-- fecha -->
                    </div>
                    <p class="mb-1">Recordatorio: La entrega del proyecto final es el viernes.</p> <!-- descripcion -->
                    <small class="text-muted">Matemáticas Avanzadas</small> <!-- competencia -->
                  </a>

                
                <div class="text-center mt-3">
                  <button class="btn btn-primary">
                    <i class="bi bi-envelope me-2"></i>Ver todos los mensajes
                  </button> <!-- lo debe llevar al php de mensajeria -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    
    <script src="./../../public/js/boostrap_dashboard/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./../../public/js/boostrap_dashboard/jquery-3.5.1.js"></script>
    <script src="./../../public/js/boostrap_dashboard/jquery.dataTables.min.js"></script>
    <script src="./../../public/js/boostrap_dashboard/dataTables.bootstrap5.min.js"></script>
    <script src="./../../public/js/boostrap_dashboard/script.js"></script>
    <script src="./../../public/js/boostrap_dashboard/student/script.calendar.js"></script>
  </body>
</html>