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
  <title>Perfil</title>
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
              <h3 class="mb-2"><i class="bi bi-emoji-smile me-2"></i>Session de perfil Estudiante</h3>
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
                    <label class="form-label fw-bold"><i class="bi bi-person me-2"></i>Nombre </label>
                    <p class="form-control-plaintext">Juan Carlos</p> <!-- Nombre -->
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-person me-2"></i>Apellidos </label>
                    <p class="form-control-plaintext">Pérez García</p> <!-- Apellido -->
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-envelope me-2"></i>Email</label>
                    <p class="form-control-plaintext">juan.perez@estudiante.com</p> <!-- Correo  -->
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-card-text me-2"></i>Tipo de Documento</label>
                    <p class="form-control-plaintext">Cédula de Ciudadanía</p> <!-- tipo de Documento -->
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-hash me-2"></i>No. Documento</label>
                    <p class="form-control-plaintext">1234567890</p> <!-- Numero de documento  -->
                  </div>
                </div>

                <!-- Columna derecha -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-calendar-event me-2"></i>Fecha de
                      Nacimiento</label>
                    <p class="form-control-plaintext">15 de Marzo, 2000</p> <!-- Fecha de nacimiento -->
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-telephone me-2"></i>Teléfono</label>
                    <p class="form-control-plaintext">300 123 4567</p> <!-- Numero de telefono -->
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-geo-alt me-2"></i>Dirección</label>
                    <p class="form-control-plaintext">Calle 123 #45-67, Barranquilla</p> <!-- Direccion -->
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-person me-2"></i>Género</label>
                    <p class="form-control-plaintext">Masculino</p> <!-- Genero -->
                  </div>
                </div>
              </div>

              <hr>

              <div class="row">
                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label fw-bold"><i class="bi bi-clock-history me-2"></i>Fecha de Registro</label>
                    <p class="form-control-plaintext">01 de Febrero, 2024</p> <!-- Fecha de registro -->
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
                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditarPersonal">
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
            <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
              <span><i class="bi bi-exclamation-triangle me-2"></i>Contactos de Emergencia</span>
              <button class="btn btn-sm btn-light" id="btnAgregarContacto">
                <i class="bi bi-plus-circle me-1"></i>Agregar Contacto
              </button> <!-- Boton que agrega los contactos de emergencias -->
            </div>
            <div class="card-body" id="contenedorContactos">

              <!-- Contacto 1 -->
              <div class="contacto-emergencia">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h6 class="mb-0"><i class="bi bi-person-fill-exclamation me-2"></i>Contacto #1</h6>
                  <button class="btn btn-sm btn-outline-danger" onclick="eliminarContacto(this)">
                    <i class="bi bi-trash"></i>
                  </button> <!-- Boton que elimina los contactos (el codigo se encuentra en contactos.js) -->
                </div>

                <div class="row">
                  <!-- Columna izquierda -->
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label fw-bold"><i class="bi bi-person me-2"></i>Nombre</label>
                      <p class="form-control-plaintext">Juan Carlos</p>
                      <!-- los parrafos estara la informacion del estudiante. asi sera en todos los demas abajo -->
                    </div>

                    <div class="mb-3">
                      <label class="form-label fw-bold"><i class="bi bi-person me-2"></i>Apellido</label>
                      <p class="form-control-plaintext">Pérez Angulo</p>
                    </div>

                    <div class="mb-3">
                      <label class="form-label fw-bold"><i class="bi bi-envelope me-2"></i>Email</label>
                      <p class="form-control-plaintext">juan.perez@correo.com</p>
                    </div>
                  </div>

                  <!-- Columna derecha -->
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label fw-bold"><i class="bi bi-heart me-2"></i>Parentesco</label>
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

                  <div class="col-md-12">
                    <div class="mb-3">
                      <label class="form-label fw-bold"><i class="bi bi-chat-square-text me-2"></i>Observaciones</label>
                      <p class="form-control-plaintext">Es el padre. Contactar en caso de emergencia médica.</p>
                    </div>
                  </div>
                </div>

                <div class="text-end">
                  <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#modalEditarContacto">
                    <i class="bi bi-pencil me-2"></i>Editar
                  </button> <!-- Boton para la edicion de los usuarios (no tiene funcionalidad en el js)-->
                </div>
              </div>

              <!-- Modal -->
              <?php include __DIR__ . '/../components/student/modal.editInformacion.php'; ?>


            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="./../../public/js/boostrap_dashboard/student/script.contactos.js"></script>
  <script src="./../../public/js/boostrap_dashboard/bootstrap.bundle.min.js"></script>
  <script src="./../../public/js/boostrap_dashboard/script.js"></script>
</body>

</html>