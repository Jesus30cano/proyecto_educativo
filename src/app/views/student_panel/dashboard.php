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
    <title>Contenido Principal</title>
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
                <p class="mb-0">Este es tu apartado principal</p>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <h4>Contenido principal</h4>
            <hr>
          </div>
        </div>

        <!-- Calendario. esto lo puse como diseño, podria tener color unos dias que avisen alguna actividad o evaluacion. si desean se puede borrar -->
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card h-100">
              <div class="card-header">
                <span class="me-2"><i class="bi bi-calendar3"></i></span>
                Calendario
              </div>
              <div class="card-body">
                <div id="calendar"></div> <!-- El calendario es manejado por un script en js -->
              </div>
            </div>
          </div>
        </div>

          <div class="row">
          <div class="col-md-12">
            <h4>Calificaciones recientes</h4>
            <hr>
          </div>
        </div>

          <!-- NUEVO-->
          <!-- Tabla de datos. calificaciones recientes del estudiante sin importar que competencia es -->
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <span><i class="bi bi-table me-2"></i></span> Calificaciones recientes del estudiante
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
                                    </tbody>
                                    <!-- aqui estaba el tfoot (lo mismo del thead, pero, abajo)-->
                                </table>
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