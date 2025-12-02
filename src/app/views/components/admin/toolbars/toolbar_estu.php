<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/public/css/admin/styles_modal_estuCR.css" rel="stylesheet" />
    <title>Document</title>
</head>

<body>
    <div class="toolbar mb-4">
        <button class="btn btn-success btn-modern" onclick="openCreateEstudianteModal()">
          <i class="fas fa-plus-circle mr-2"></i>Crear Estudiante
        </button>
        <button class="btn btn-warning btn-modern" onclick="openEditEstudianteModal()">
          <i class="fas fa-edit mr-2"></i>Editar Estudiante
        </button>
        <button class="btn btn-danger btn-modern" onclick="openEliminarEstudianteModal()">
          <i class="fas fa-user-times mr-2"></i>Desactivar Estudiante
        </button>
    </div>


    <?php include __DIR__ . '/../modales/modal_create_estudiante.php'; ?>
    <?php include __DIR__ . '/../modales/modal_editar_estu.php'; ?>
    <?php include __DIR__ . '/../modales/modal_borrar_estu.php'; ?>

    <script src="/public/js/admin/modal_create_estu.js"></script>
    <script src="/public/js/admin/modal_edit_estu.js"></script>
    <script src="/public/js/admin/modal_borrar_estu.js"></script>

</body>

</html>