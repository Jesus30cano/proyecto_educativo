<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
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
                        <p class="mb-0">Esta es la session de actividades. actividades creadas por profesores son mostradas aqui</p>
                    </div>
                </div>
            </div>
        </div>

            <!-- Titulo -->
            <div class="row">
                <div class="col-md-12">
                    <h4><i class="bi bi-list-task me-2"></i> Mis Actividades Asignadas</h4>
                    <hr>
                </div>
            </div>

            <div class="card mb-4 shadow-sm border-warning">
                <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        Diseño de Diagramas UML (Patrones de Diseño) <!-- titulo de la actividad-->
                    </h5>
                    <span class="badge bg-light text-dark fs-6">
                        <i class="bi bi-exclamation-diamond me-1"></i> <!-- estado de actividad -->
                        PENDIENTE
                    </span>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-8">
                            <p class="mb-2"><strong>Competencia:</strong> Desarrollo de Software Seguro</p> <!-- competencia -->
                            <p class="mb-1"><strong>Descripción:</strong> Desarollar un software seguro </p> <!-- descripcion -->

                            <div class="d-flex align-items-center mt-3">
                                <a href="#" target="_blank" class="btn btn-outline-primary btn-sm me-3"> <!-- documento de intruccion del profesor -->
                                    <i class="bi bi-file-earmark-arrow-down me-1"></i> Instrucciones (PDF/DOCX)
                                </a>
                                </div>

                            <hr class="mt-4">

                            <h6 class="mt-3 text-primary"><i class="bi bi-cloud-upload me-1"></i> Enviar Mi Archivo</h6>
                            <form action="#" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id_actividad" value="101">

                                <div class="input-group mb-3">
                                    <input class="form-control form-control-sm" type="file" name="archivo_entrega"
                                        required> <!-- subir archivo estudiante -->
                                    <button class="btn btn-success btn-sm" type="submit">
                                        <i class="bi bi-upload"></i> Subir <!-- subir entrega del archivo -->
                                    </button>
                                </div>
                            </form>

                        </div>

                        <!-- fecha de entrega -->
                        <div class="col-md-4 border-start text-center">
                            <div class="card bg-light p-4">
                                <p class="mb-0 text-muted fw-bold"><i class="bi bi-calendar-check me-1"></i> FECHA LÍMITE</p>
                                <h1 class="display-4 fw-bold text-danger mb-0">
                                    15
                                </h1>
                                <p class="lead mb-0 text-dark">
                                    Noviembre 2025
                                </p>
                                <p class="text-muted mt-1 mb-0" style="font-size: 0.9rem;">Día de la semana: Miércoles</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Lo mismo, pero, cuando el trabajo esta enviado -->
            <div class="card mb-4 shadow-sm border-success">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        Informe de Penetración de Sistemas
                    </h5>
                    <span class="badge bg-light text-success fs-6">
                        <i class="bi bi-check-circle me-1"></i>
                        ENTREGADA
                    </span>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-8">
                            <p class="mb-2"><strong>Competencia:</strong> Seguridad Informática Avanzada</p>
                            <p class="mb-1"><strong>Descripción:</strong> crear un informe</p>

                            <div class="alert alert-success py-2 d-inline-block">
                                Calificación Obtenida: <strong>4.8 / 5.0</strong> <!-- nota del estudiante -->
                            </div>

                            <div class="d-flex align-items-center mt-3">
                                <a href="#" target="_blank" class="btn btn-outline-primary btn-sm me-3">
                                    <i class="bi bi-file-earmark-arrow-down me-1"></i> Instrucciones (PDF/DOCX)
                                </a>

                                <a href="#" class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-eye me-1"></i> Ver mi archivo <!-- ver documento enviado del estudiante -->
                                </a>
                            </div>

                            <hr class="mt-4">

                            <p class="mb-1"><strong><Obj>Observaciones</Obj>:</strong>Ni modo</p> <!-- observacion del profesor-->
                            <p class="text-success mt-3"><i class="bi bi-check-all me-1"></i> ¡Entrega registrada y calificada!</p>
                            

                        </div>

                        <div class="col-md-4 border-start text-center">
                            <div class="card bg-light p-4">
                                <p class="mb-0 text-muted fw-bold"><i class="bi bi-calendar-check me-1"></i> FECHA LÍMITE</p>
                                <h1 class="display-4 fw-bold text-success mb-0">
                                    28
                                </h1>
                                <p class="lead mb-0 text-dark">
                                    Noviembre 2025
                                </p>
                                <p class="text-muted mt-1 mb-0" style="font-size: 0.9rem;">Día de la semana: Jueves</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="mb-5"></div>

        </div>
    </main>

    <script src="./../../public/js/boostrap_dashboard/bootstrap.bundle.min.js"></script>
</body>

</html>