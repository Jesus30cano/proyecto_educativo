<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <!-- archivos del css y diseño -->

  <!-- Fuentes personalizadas para esta plantilla -->
  <link href="/public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
  <!-- Estilos personalizados para esta plantilla-->
  <link href="/public/css/styles2.css" rel="stylesheet">
  <!-- Estilos personalizados para esta página -->
  <link href="/public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/public/css/teacher_courses/dashboard.css">
  <link rel="stylesheet" href="/public/css/teacher_courses/view_course.css">
  <title>Cursos</title>

</head>

<body id="page-top">
  <!-- esto inicia todo el contenido -->
  <div id="wrapper">
    <!-- sidenav -->
    <?php include __DIR__ . '/../components/teacher/sidenav.php'; ?>


    <!-- contenido del contenido -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- inicia el contenido principal -->
      <div id="content">
        <!-- topnav -->
        <?php include __DIR__ . '/../components/teacher/topnav.php'; ?>


        <!-- Contenido de la página de inicio -->
        <div class="container-fluid">


          <!-- 🔵 ENCABEZADO DINÁMICO DEL CURSO -->
          <div id="cursoHeader" class="curso-header mb-5 p-4 shadow-sm rounded">
            <!-- JS inserta nombre y ficha -->
          </div>

          <!-- 🟦 TÍTULO -->
          <h4 class="fw-bold mb-3">Competencias del Curso</h4>

          <!-- 🟦 CONTENEDOR DE COMPETENCIAS -->
          <div id="listaCompetencias" class="competencias-container">
            <!-- JS inserta tarjetas -->
          </div>

          <!-- 📌 SIN COMPETENCIAS -->
          <p id="sinCompetencias" class="text-muted text-center mt-4 d-none">
            No hay competencias registradas aún.
          </p>

          <!-- 🔙 BOTÓN VOLVER ABAJO -->
          <div class="mt-5">
            <a href="/teacher/course" class="btn btn-secondary px-4 py-2" style="border-radius: 10px; margin 25px;">
              <i class="bi bi-arrow-left-short"></i> Volver
            </a>
          </div>

        </div>
        </main>

        <!-- 📝 MODAL CREAR ACTIVIDAD -->
        <div class="modal fade" id="modalCrearActividad" tabindex="-1" aria-labelledby="modalCrearActividadLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <form id="formCrearActividad" enctype="multipart/form-data">

                <div class="modal-header">
                  <h5 class="modal-title fw-bold" id="modalCrearActividadLabel">Crear Nueva Actividad</h5>
                  <button type="button" class="btn-close" data-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                  <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required>
                  </div>

                  <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                  </div>

                  <div class="mb-3">
                    <label for="fecha_entrega" class="form-label">Fecha de entrega</label>
                    <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" required>
                  </div>

                  <div class="mb-3">
                    <label for="archivo" class="form-label">Archivo</label>
                    <input type="file" class="form-control" id="archivo" name="archivo">
                  </div>

                  <!-- Hidden -->
                  <input type="hidden" name="curso" id="cursoHidden">
                  <input type="hidden" name="competencia" id="competenciaHidden">
                  <input type="hidden" name="profesor" id="profesorHidden" value="<?= $_SESSION['user_id'] ?? '' ?>">

                  <div id="mensajeModal" class="mt-2"></div>
                </div>

                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Guardar Actividad</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>

              </form>
            </div>
          </div>
        </div>




      </div>
      <!-- footer -->
    <?php include __DIR__ . '/../components/footer.php'; ?>

    </div>
  </div>

  </div>
  </div>

  <!-- scroll -->
  <?php include __DIR__ . '/../components/scroll.topnav.php'; ?>

  <!-- PASO VARIABLES A JS -->
  <script>
    const cursoData = <?= json_encode($curso) ?>;
    const competenciasData = <?= json_encode($competencias) ?>;
  </script>


  <!-- apartado de script, BOOSTRAP -->
  <!-- Bootstrap core JavaScript-->
  <script src="/public/vendor/jquery/jquery.min.js"></script>
  <script src="/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/public/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/public/js/styles/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="/public/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="/public/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="/public/js/styles/demo/datatables-demo.js"></script>

  <!-- script de funcionalidad -->
  <script src="/public/js/teacher/view_course.js"></script>

</body>
</html>