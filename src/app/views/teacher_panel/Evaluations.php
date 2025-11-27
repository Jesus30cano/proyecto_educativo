<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Evaluaciones</title>

    <link href="/public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="/public/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <link href="/public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/teacher_courses/evaluations.css">
    <link rel="stylesheet" href="/public/css/toast.css" />

    <!-- carta azul -->
   <link rel="stylesheet" href="/public/css/card.blue.css">
</head>

<body id="page-top">

    <div id="wrapper">
        <!-- sidenav -->
        <?php include __DIR__ . '/../components/teacher/sidenav.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
                <!-- topnav -->
                <?php include __DIR__ . '/../components/teacher/topnav.php'; ?>


                <div class="container-fluid">

                <!-- TITULO -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mt-4 mb-0 text-gray-800">Gestion de Evaluaciones</h1>
                </div>

                    <div class="card shadow-sm border-0">
                        <div class="card-body">

                            <!-- === BOTONES: crear manual / crear con IA === -->
                            <div class="mb-3 d-flex gap-2">
                                <!-- Botón crea el modal MANUAL -->
                                <button class="btn btn-primary" id="btnCrearEvaluacionManual" data-toggle="modal" data-target="#modalEvalManual">
                                    Crear Evaluación
                                </button>

                                <!-- Botón crea el modal IA (separado) -->
                                <button class="btn btn-outline-primary" id="btnCrearEvaluacionIA" data-toggle="modal" data-target="#modalEvalIA">
                                    Crear Evaluación con IA
                                </button>
                            </div>

                            <!-- === TABLA === -->
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-striped table-bordered align-middle w-100">
                                    <thead class="table-header">
                                        <tr>
                                            <th>Título</th>
                                            <th>Ficha</th>
                                            <th>Curso</th>
                                            <th>Competencia</th>
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla-evaluaciones">
                                        <!-- JS inserta evaluaciones -->
                                    </tbody>
                                </table>
                            </div>

                            <p id="sinDatos" class="text-center text-muted mt-3 d-none">
                                No se encontraron evaluaciones registradas.
                            </p>

                        </div>
                    </div>
                </div>

                <!-- ============================
                     MODAL: CREAR EVALUACIÓN (MANUAL)
                     todo EN UN SOLO modal (datos generales + preguntas)
                ============================ -->
                <div class="modal fade" id="modalEvalManual" tabindex="-1">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">Crear Evaluación</h5>
                                <button type="button" class="btn-close"  data-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <form id="form-evaluacion-manual">
                                    <!-- DATOS GENERALES -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Curso</label>
                                            <select class="form-control" name="id_curso" id="man_curso">
                                                <option value="">Seleccionar curso</option>
                                                
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Competencia</label>
                                            <select class="form-control" name="id_competencia" id="man_competencia">
                                                <option value="">Seleccionar competencia</option>
                                                <option value="1">Competencia 1</option>
                                                <option value="2">Competencia 2</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        

                                        <div class="col-md-8 mb-3">
                                            <label class="form-label">Título</label>
                                            <input type="text" class="form-control" name="titulo" id="man_titulo"
                                                placeholder="Título de la evaluación">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Descripción</label>
                                        <textarea class="form-control" name="descripcion" id="man_descripcion" rows="2"
                                            placeholder="Descripción"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Fecha</label>
                                        <input type="date" class="form-control" name="fecha" id="man_fecha"
                                            value="<?= date('Y-m-d') ?>">
                                    </div>

                                    <h5 class="form-section-title mt-4">Preguntas</h5>

                                    <div id="man_contenedor_preguntas">

                                       
                                        
                                        <!-- / EJEMPLO PREGUNTA -->

                                    </div>

                                    <!-- botón agregar otra pregunta -->
                                    <div class="mt-2">
                                        <button type="button" class="btn btn-outline-primary btn-sm btn-add-question" id="aggPreguntaBtn">
                                            + Agregar otra pregunta
                                        </button>
                                    </div>

                                    <!-- guardar -->
                                    <div class="mt-4 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Guardar Evaluación</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================
                     MODAL: CREAR EVALUACIÓN CON IA (separado)
                     datos generales + generar IA dentro del modal
                ============================ -->
                <div class="modal fade" id="modalEvalIA" tabindex="-1">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">Crear Evaluación con IA</h5>
                                <button type="button" class="btn-close" data-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <form id="form-evaluacion-ia">
                                    <!-- DATOS GENERALES (mismos campos) -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Curso</label>
                                            <select class="form-control" name="ia_id_curso" id="ia_curso">
                                                <option value="">Seleccionar curso</option>
                                                
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Competencia</label>
                                            <select class="form-control" name="ia_id_competencia" id="ia_competencia">
                                                <option value="">Seleccionar competencia</option>
                                               
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        

                                        <div class="col-md-8 mb-3">
                                            <label class="form-label">Título</label>
                                            <input type="text" class="form-control" name="ia_titulo" id="ia_titulo"
                                                placeholder="Título de la evaluación">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Descripción</label>
                                        <textarea class="form-control" name="ia_descripcion" id="ia_descripcion"
                                            rows="2" placeholder="Descripción"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Fecha</label>
                                        <input type="date" class="form-control" name="ia_fecha" id="ia_fecha"
                                            value="<?= date('Y-m-d') ?>">
                                    </div>

                                    <!-- Generación IA -->
                                    <h5 class="form-section-title">Generar preguntas con IA</h5>

                                    <div class="mb-3">
                                        <label class="form-label">Instrucciones para IA</label>
                                        <textarea class="form-control" id="ia_instrucciones" rows="3"
                                            placeholder="Describe la temática o el tipo de preguntas"></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Cantidad</label>
                                            <input type="number" class="form-control" id="ia_cantidad" min="1" max="15"
                                                value="5">
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Dificultad</label>
                                            <select class="form-control" id="ia_dificultad">
                                                <option value="">Seleccionar dificultad</option>
                                                <option value="facil">Fácil</option>
                                                <option value="media">Media</option>
                                                <option value="dificil">Difícil</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-3 d-flex align-items-end">
                                            <!-- Este botón disparará la llamada IA (JS) -->
                                            <button type="button" class="btn btn-outline-primary" id="btnGenerarIA">
                                                Generar preguntas IA
                                            </button>
                                        </div>
                                    </div>


                                    <!-- Zona donde aparecerán las preguntas generadas (visual) -->
                                    <div id="ia_preguntas_resultado" class="mt-3">
                                  <!-- preguntas generadas por IA se muestran aquí -->
                                    </div>

                                    <div class="mt-4 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Guardar Evaluación con IA</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- modal ver evaluacion -->
             
                <div class="modal fade" id="modalVerEvaluacion" tabindex="-1">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">Ver Evaluación</h5>
                                <button type="button" class="btn-close" data-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                
                            
                                <h6 class="mb-3">
                                    <i class="bi bi-people me-2"></i>Examenes de Estudiantes
                                </h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="tablaEvaluacionEstudiantes">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 5%">#</th>
                                                <th style="width: 35%">Estudiante</th>
                            
                                                <th style="width: 30%">Calificación</th>
                                                <th style="width: 5%">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyEvaluacionEstudiantes">

                                        </tbody>
                                    </table>

                            </div>
                        </div>
                    </div>
                </div>      
            </div>


                <!-- footer -->
                <?php include __DIR__ . '/../components/footer.php'; ?>
            </div>
        </div>
    </div>

    <script src="/public/vendor/jquery/jquery.min.js"></script>
    <script src="/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/public/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="/public/js/styles/sb-admin-2.min.js"></script>
    <script src="/public/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/public/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/public/js/styles/demo/datatables-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/public/js/toast.js"></script>
 
    <script src="/public/js/teacher/evaluations.js"></script>
    <script src="/public/js/teacher/evaluations_modal.js"></script>
</body>

</html>