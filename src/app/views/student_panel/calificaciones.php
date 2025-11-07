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
    <title>Calificaciones</title>
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
                            <h3 class="mb-2"><i class="bi me-2"></i>Session de Calificaciones</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Título para la sección de calificaciones -->
            <div class="row">
                <div class="col-md-12">
                    <h4>Calificaciones y Resumen</h4>
                    <hr>
                </div>
            </div>


            <!-- ************************************ -->
            <!-- * FILA SUPERIOR: Gráfico y Resumen * -->
            <!-- ************************************ -->
            <div class="row">
                <!-- COLUMNA IZQUIERDA: GRÁFICO (7 de 12 unidades) -->
                <div class="col-md-7 mb-3">
                    <div class="card h-100">
                        <div class="card-header">
                            <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                            Promedio de Calificaciones por competencias
                        </div>
                        <div class="card-body">
                            <canvas id="gradeChart" class="chart" width="400" height="200"></canvas>
                            <!-- He añadido un ID al canvas para que puedas inicializar, osea el grafico el js script.graphics -->
                        </div>
                    </div>
                </div>


                <!-- COLUMNA DERECHA: PROMEDIO GENERAL (5 de 12 unidades) -->
                <div class="col-md-5 mb-3">
                    <div class="card h-100">
                        <div class="card-header bg-success text-white">
                            <span class="me-2"><i class="bi bi-award"></i></span>
                            Resumen Académico
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <h5 class="text-muted mb-2">Promedio del estudiante</h5>
                                <!-- Aquí colocamos el promedio -->
                                <h1 class="display-3 text-success fw-bold">4.2</h1> <!-- Promedio de notas -->
                                <p class="text-muted mb-0">de 5.0</p> <!-- Nota Maxima -->
                            </div>

                            <div class="mb-4">
                                <h5 class="text-muted mb-2">Promedio del Curso</h5>
                                <!-- Aquí colocamos el promedio -->
                                <h1 class="display-3 text-success fw-bold">3.2</h1> <!-- Promedio del curso -->
                                <p class="text-muted mb-0">de 5.0</p> <!-- Nota Maxima -->
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN DE FILA SUPERIOR -->


            <!-- ************************************* -->
            <!-- * FILA INFERIOR: Título y Lista/Tabla * -->
            <!-- ************************************* -->

            <!-- Título para la lista -->
            <div class="row mt-3">
                <div class="col-md-12">
                    <h4>Lista de Calificaciones</h4>
                    <hr>
                </div>
            </div>


            <!-- NUEVO Filtro de Competencias -->
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <span><i class="bi bi-filter me-2"></i></span> Filtrar Calificaciones por Competencia
                        </div>
                        <div class="card-body">
                            <div class="row align-items-end">
                                <div class="col-md-8 mb-3 mb-md-0">
                                    <label for="selectCompetencia" class="form-label fw-bold">Selecciona una
                                        competencia:</label>
                                    <select class="form-select form-select-lg" id="selectCompetencia">
                                        <option value="todas" selected>Todas las Competencias</option>
                                        <option value="matematicas">Matemáticas</option>
                                        <option value="programacion">Programación</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary w-100">
                                        <i class="bi bi-funnel me-2"></i>Aplicar Filtro
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de datos -->
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <span><i class="bi bi-table me-2"></i></span> Calificaciones
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped data-table" style="width: 100%">
                                    <thead>
                                        <tr> <!-- datos que mostrara la tabla. el js de esto ya esta modificado para que trabaje con los datos -->
                                            <th>Profesor</th>
                                            <th>Competencia</th>
                                            <th>Evaluacion</th>
                                            <th>Fecha Evaluacion</th>
                                            <th>nota de calificacion</th>
                                            <th>Observacion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Aqui se ingresan los datos en el tr (esto es un ejemplo)-->
                                        <tr>
                                            <td>hola</td>
                                            <td>Sistema</td>
                                            <td>Tarea</td>
                                            <td>2025-01-01</td>
                                            <td>5.0</td>
                                            <td>AAAAAAAAAAAAAAAAA</td>
                                        </tr>
                                        <tr> <!-- Segundo dato-->
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>2024-01-01</td>
                                            <td>60</td>
                                            <td>AAAAAAAAAAAAAAAAA</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Profesor</th>
                                            <th>Competencia</th>
                                            <th>Evaluacion</th>
                                            <th>Fecha Evaluacion</th>
                                            <th>nota de calificacion</th>
                                            <th>Observacion</th>
                                        </tr>
                                    </tfoot>
                                </table>
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