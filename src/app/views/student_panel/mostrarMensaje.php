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
    <title>Ver Mensaje</title>
</head>

<body>
    <!-- navbar -->
    <?php include __DIR__ . '/../components/student/navbar.php'; ?>

    <!-- sidebar -->
    <?php include __DIR__ . '/../components/student/sidebar.php'; ?>


    <main class="mt-5 pt-3">
        <div class="container-fluid">

          <!-- Mensaje enviado -->
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0"><i class="bi bi-chat-text-fill me-2"></i>Asunto: Consulta sobre Tarea 3</h5> <!-- Asunto del mensaje  -->
                        </div>
                        
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                                <div>
                                    <h6 class="mb-1 fw-bold">
                                        <i class="bi bi-person-circle me-2"></i>De: Juan Pérez
                                    </h6> <!-- Persona quiem envio el mensaje -->
                                    <p class="text-muted mb-0">
                                        <i class="bi bi-envelope me-2"></i>Correo: juan.perez@dominio.edu
                                    </p> <!-- Correo -->
                                </div>
                                <div class="text-end">
                                    <p class="mb-0 fw-bold text-muted">
                                        <i class="bi bi-calendar me-2"></i>Fecha: 15 de Noviembre de 2025
                                    </p> <!-- fecha de envio -->
                                    <p class="mb-0 fw-bold text-muted">
                                        <i class="bi bi-clock me-2"></i>Hora: 10:30 AM
                                    </p> <!-- hora de envio -->
                                </div>
                            </div>

                            <div class="mb-4">
                                <p>Espero que este mensaje le encuentre bien. ¿Podría, por favor, revisar la lógica de mi planteamiento?</p>
                                <p>Juan Pérez</p>

                                <!-- Esto es un mensaje de ejemplo-->
                            </div>

                            <div class="mb-4 pt-3 border-top">
                                <h6 class="fw-bold mb-3"><i class="bi bi-paperclip me-2"></i>Archivos Adjuntos (2)</h6> <!-- Algun archivo enviado -->
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <span><i class="bi bi-file-earmark-text me-2"></i>Tarea_3_Juan_Perez.pdf</span>
                                        <i class="bi bi-download"></i> <!-- Ldocumento enviado de ejemplo -->
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <span><i class="bi bi-image me-2"></i>Grafica_ejercicio_5.jpg</span>
                                        <i class="bi bi-download"></i> <!--lo mismo -->
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <a href="inbox.php" class="btn btn-outline-secondary me-2">
                                    <i class="bi bi-arrow-left me-2"></i>Volver a la Bandeja
                                </a> <!-- regresar a la bandeja (mensajeria) -->
                                <button type="button" class="btn btn-info text-white">
                                    <i class="bi bi-reply-fill me-2"></i>Responder
                                </button> <!-- Responder y aqui deberia entrar a crearMensaje -->
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