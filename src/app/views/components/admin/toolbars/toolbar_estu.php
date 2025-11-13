<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/public/css/boostrap_dashboard/admin/styles_modal_estuCR.css" rel="stylesheet" />
    <title>Document</title>
</head>

<body>
    <div class="toolbar">
        <button class="btn btn-success" onclick="openCreateEstudianteModal()">➕ Crear Estudiante</button>
        <button class="btn btn-warning" onclick="openEditEstudianteModal()">✏️ Editar Estudiante</button>
        <button class="btn btn-danger" onclick="openEliminarEstudianteModal()">🗑️ Eliminar Estudiante</button>
    </div>


    <?php include __DIR__ . '/../modales/modal_create_estudiante.php'; ?>

    <script src="/public/js/boostrap_dashboard/admin/modal_create_estu.js"></script>

</body>

</html>