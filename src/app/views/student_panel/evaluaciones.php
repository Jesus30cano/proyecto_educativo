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
  <title>Evaluaciones</title>
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
              <h3 class="mb-2"><i class="bi me-2"></i>Session de Evaluaciones</h3>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Columna principal de evaluaciones -->
        <div class="col-12">

          <!-- Filtro de evaluaciones -->
          <div class="card mb-4">
            <div class="card-header bg-light">
              <h5 class="mb-0"><i class="bi bi-funnel me-2"></i>Filtrar Evaluaciones</h5>
            </div>
            <div class="card-body">
              <div class="row align-items-end">
                <div class="col-md-5 mb-3 mb-md-0">
                  <label for="selectComp" class="form-label fw-bold">Por Competencias:</label>
                  <select class="form-select" id="selectCompetenia"> <!-- Opcion de las competencias -->
                    <option value="todos" selected>Todos las competencias</option>
                    <option value="matematicas">Matemáticas Avanzadas</option> <!-- Opciones -->
                  </select>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                  <label for="selectEstado" class="form-label fw-bold">Por Estado:</label>
                  <select class="form-select" id="selectEstado">
                    <!-- Estado de la evaluacion (inactiva o disponibles) -->
                    <option value="todos" selected>Todos</option>
                    <option value="disponibles">Disponibles</option> <!-- Opciones -->
                    <option value="inactivas">Inactivas</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <button class="btn btn-primary w-100">
                    <i class="bi bi-search me-2"></i>Buscar
                  </button> <!-- Boton para filtrar las buquedas seleccionadas -->
                </div>
              </div>
            </div>
          </div>

          <!-- Título de sección -->
          <h4 class="mb-3"><i class="bi bi-clipboard-check me-2"></i>Evaluaciones</h4>
          <hr>

          <!-- Grid de tarjetas de evaluaciones -->
          <div class="row">

            <!-- Evaluación 1 - DISPONIBLE -->
            <div class="col-md-6 mb-3">
              <div class="card h-100 border-primary shadow-sm">
                <div class="card-header bg-primary text-white">
                  <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Evaluación de Matemáticas</h6> <!-- Nombre de la competencia -->
                    <span class="badge bg-success">
                      <i class="bi bi-check-circle"></i> Disponible
                    </span> <!-- Estado de la evaluacion -->
                  </div>
                </div>
                <div class="card-body">
                  <p class="text-muted mb-2"><small><i class="bi bi-bookmark me-1"></i>Cálculo Diferencial</small></p>
                  <!-- Nombre de la evaluacion -->
                  <p class="card-text small">Evaluación sobre derivadas, límites y continuidad de funciones.</p>
                  <!-- Descripcion de la evaluacion -->
                  <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                      <span class="badge bg-info me-1"><i class="bi bi-clock"></i> 60 min</span>
                      <!-- Minutos de la evaluacion -->
                      <span class="badge bg-warning text-dark"><i class="bi bi-list-ol"></i> 15 preg.</span>
                      <!-- Preguntas en la evaluacion -->
                    </div>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalEvaluacion1">
                      <i class="bi bi-eye me-1"></i>Ver
                    </button>
                    <!-- Ver la evaluacion y aqui muesra el modal y lo llama con esto data-bs-target="#modalEvaluacion1 desde su ID del modal -->
                  </div>
                  <p class="text-muted mb-0 mt-2"><small><i class="bi bi-calendar3 me-1"></i>Fecha límite: 10 Nov
                      2024</small></p> <!-- fecha de la evaluacion -->
                </div>
              </div>
            </div>

            <!-- Evaluación 2 - cuando esta INACTIVA lleva casi lo mismo de arriba comentado -->
            <div class="col-md-6 mb-3">
              <div class="card h-100 border-secondary shadow-sm">
                <div class="card-header bg-secondary text-white">
                  <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Evaluación de Física</h6>
                    <span class="badge bg-danger">
                      <i class="bi bi-x-circle"></i> Inactiva
                    </span> <!-- Estado de la evaluacion -->
                  </div>
                </div>
                <div class="card-body">
                  <p class="text-muted mb-2"><small><i class="bi bi-bookmark me-1"></i>Cinemática</small></p>
                  <p class="card-text small">Evaluación sobre movimiento rectilíneo, velocidad y aceleración.</p>
                  <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                      <span class="badge bg-secondary me-1"><i class="bi bi-clock"></i> 50 min</span>
                      <span class="badge bg-secondary"><i class="bi bi-list-ol"></i> 18 preg.</span>
                    </div>
                    <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#modalEvaluacion2">
                      <i class="bi bi-eye me-1"></i>Ver
                    </button>
                  </div>
                  <p class="text-muted mb-0 mt-2"><small><i class="bi bi-calendar-x me-1"></i>Venció: 08 Nov
                      2024</small></p>
                </div>
              </div>
            </div>

            <!-- Evaluación 3 - FINALIZADA lo mismo comentado -->
            <div class="col-md-6 mb-3">
              <div class="card h-100 border-success shadow-sm">
                <div class="card-header bg-success text-white">
                  <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Evaluación de Redes</h6>
                    <span class="badge bg-light text-success">
                      <i class="bi bi-check-circle-fill"></i> Finalizada
                    </span> <!-- Estado de la evaluacion -->
                  </div>
                </div>
                <div class="card-body">
                  <p class="text-muted mb-2"><small><i class="bi bi-bookmark me-1"></i>Protocolos TCP/IP</small></p>
                  <p class="card-text small">Evaluación sobre arquitectura de redes y modelos OSI.</p>
                  <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                      <span class="badge bg-success"><i class="bi bi-star-fill"></i> Nota: 4.5/5.0</span>
                      <!-- Nota de la evaluacion -->
                    </div>
                  </div>
                  <p class="text-muted mb-0 mt-2"><small><i class="bi bi-calendar-check me-1"></i>Finalizada: 05 Nov
                      2024</small></p> <!-- Finalizaicon de la evaluacion -->
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

    </div>
  </main>


  <!-- se llama al modal de las evalauciones -->
  <?php include __DIR__ . '/../components/student/modal.evaluaciones.php'; ?>

  <script src="./../../public/js/boostrap_dashboard/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
  <script src="./../../public/js/boostrap_dashboard/jquery-3.5.1.js"></script>
  <script src="./../../public/js/boostrap_dashboard/jquery.dataTables.min.js"></script>
  <script src="./../../public/js/boostrap_dashboard/dataTables.bootstrap5.min.js"></script>
  <script src="./../../public/js/boostrap_dashboard/script.js"></script>
  <script src="./../../public/js/boostrap_dashboard/student/script.calendar.js"></script>

</body>

</html>