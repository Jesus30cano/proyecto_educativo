<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
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

        <!-- Evaluaciones Disponibles -->
        <div class="row">
          <div class="col-md-12 mb-4">
            <h4><i class="bi bi-clipboard-check me-2"></i>Evaluaciones Disponibles</h4>
            <hr>
          </div>
        </div>

        <div class="row">

          <!-- Evaluación 1 -->
          <div class="col-md-6 col-lg-4 mb-3">
            <div class="card h-100">
              <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>Evaluación de Matemáticas</h5> <!-- Titulo Evaluacion-->
              </div>
              <div class="card-body">
                <p class="text-muted mb-2"><strong>Curso:</strong> Matemáticas Avanzadas</p> <!-- Curso-->
                <p class="text-muted mb-2"><strong>Competencia:</strong> Cálculo Diferencial</p> <!-- Competencias -->
                <p class="mb-3">Evaluación sobre derivadas, límites y continuidad de funciones.</p> <!-- Desripcion -->
                
                <div class="mb-2">
                  <span class="badge bg-info"><i class="bi bi-clock me-1"></i>60 minutos</span> <!-- Tiempo de la evaluacion -->
                  <span class="badge bg-warning text-dark"><i class="bi bi-list-ol me-1"></i>15 preguntas</span> <!-- Preguntas en la evaluacion-->
                </div>
                 
                <p class="text-muted mb-0"><small><i class="bi bi-calendar3 me-1"></i>Fecha: 10 de Noviembre, 2024</small></p> <!-- Fecha limite o entregan si gustan-->
              </div>
              <div class="card-footer">
                <div class="d-grid">
                  <button class="btn btn-success">
                    <i class="bi bi-play-circle me-2"></i>Iniciar Evaluación <!-- Inicio de la evaluacion-->
                  </button>
                </div>
              </div>
            </div>
          </div>


          <!-- Evaluación 2 - Inactiva. lo mismo pero mostrandose terminado o que no se pueda realizar -->
          <div class="col-md-6 col-lg-4 mb-3">
            <div class="card h-100 border-secondary">
              <div class="card-header bg-secondary text-white">
                <h5 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>Evaluación de Física</h5>
              </div>
              <div class="card-body">
                <p class="text-muted mb-2"><strong>Curso:</strong> Física Mecánica</p>
                <p class="text-muted mb-2"><strong>Competencia:</strong> Cinemática</p>
                <p class="mb-3">Evaluación sobre movimiento rectilíneo, velocidad y aceleración.</p>
                
                <div class="mb-2">
                  <span class="badge bg-info"><i class="bi bi-clock me-1"></i>50 minutos</span>
                  <span class="badge bg-warning text-dark"><i class="bi bi-list-ol me-1"></i>18 preguntas</span>
                  <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Inactiva</span> <!-- estado de la evaluacion-->
                </div>
                
                <p class="text-muted mb-0"><small><i class="bi bi-calendar3 me-1"></i>Fecha: 08 de Noviembre, 2024</small></p>
              </div>
              <div class="card-footer">
                <div class="d-grid">
                  <button class="btn btn-secondary" disabled> <!-- cuando ya no es posible hacer la evaluacion -->
                    <i class="bi bi-lock me-2"></i>No Disponible
                  </button>
                </div>
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