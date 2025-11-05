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

      <div class="row">
        <div class="col-md-12">
          <h4><i class="bi bi-list-task me-2"></i> Datos personales</h4>
          <hr>
        </div>
      </div>


      <!-- Datos Personales -->
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header bg-primary text-white">
              <span><i class="bi bi-person-badge me-2"></i></span> Información Personal
            </div>

            <div class="card-body">
              <div class="row">
                <!-- Columna izquierda -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-person me-2"></i>Nombre Completo</label>
                    <p class="form-control-plaintext">Juan Carlos Pérez García</p>
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-envelope me-2"></i>Email</label>
                    <p class="form-control-plaintext">juan.perez@estudiante.com</p>
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-card-text me-2"></i>Tipo de Documento</label>
                    <p class="form-control-plaintext">Cédula de Ciudadanía</p>
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-hash me-2"></i>No. Documento</label>
                    <p class="form-control-plaintext">1234567890</p>
                  </div>
                </div>

                <!-- Columna derecha -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-calendar-event me-2"></i>Fecha de
                      Nacimiento</label>
                    <p class="form-control-plaintext">15 de Marzo, 2000</p>
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-telephone me-2"></i>Teléfono</label>
                    <p class="form-control-plaintext">+57 300 123 4567</p>
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-geo-alt me-2"></i>Dirección</label>
                    <p class="form-control-plaintext">Calle 123 #45-67, Barranquilla</p>
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-gender-ambiguous me-2"></i>Género</label>
                    <p class="form-control-plaintext">Masculino</p>
                  </div>
                </div>
              </div>

              <hr>

              <div class="row">
                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-clock-history me-2"></i>Fecha de Registro</label>
                    <p class="form-control-plaintext">01 de Febrero, 2024 - 10:30 AM</p>
                  </div>

                  <div class="mb-0">
                    <label class="form-label fw-bold"><i class="bi bi-shield-check me-2"></i>Estado de la Cuenta</label>
                    <p class="form-control-plaintext">
                      <span class="badge bg-success">Activa</span>
                    </p>
                  </div>
                </div>
              </div>

              <div class="text-end mt-3">
                <button class="btn btn-outline-primary">
                  <i class="bi bi-pencil me-2"></i>Editar Información
                </button> <!-- Boton para editar la informacion -->
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <h4><i class="bi bi-list-task me-2"></i> Contacto de emergencias</h4>
          <hr>
        </div>
      </div>

      <!-- Datos de emergencias -->
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header bg-warning text-white">
              <span><i class="bi bi-person-badge me-2"></i></span> Información Personal
            </div>
            <div class="card-body">
              <div class="row">
                <!-- Columna izquierda -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-person me-2"></i>Nombre</label>
                    <p class="form-control-plaintext">Juan Carlos</p>
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-person me-2"></i>Apellido</label>
                    <p class="form-control-plaintext">Perez angulo</p>
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-envelope me-2"></i>Email</label>
                    <p class="form-control-plaintext">juan.perez@estudiante.com</p>
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-person me-2"></i>Observaciones</label>
                    <p class="form-control-plaintext">Es el padre</p>
                  </div>


                </div>

                <!-- Columna derecha -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-calendar-event me-2"></i>Parentesco</label>
                    <p class="form-control-plaintext">Padre</p>
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-telephone me-2"></i>Teléfono</label>
                    <p class="form-control-plaintext">+57 300 123 4567</p>
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-geo-alt me-2"></i>Dirección</label>
                    <p class="form-control-plaintext">Calle 123 #45-67, Barranquilla</p>
                  </div>
                </div>

                <div class="text-end mt-3">
                  <button class="btn btn-outline-primary">
                    <i class="bi bi-pencil me-2"></i>Editar Información
                  </button> <!-- Boton para editar informacion -->
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