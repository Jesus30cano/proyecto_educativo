<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/public/css/admin/styles_modal_estuCR.css" rel="stylesheet" />
    <title>Document</title>
</head>

<body>
    <div class="toolbar">
        <button class="btn btn-success" onclick="openCrearCompetenciaModal()">➕ Crear Competencia</button>
        <button class="btn btn-warning" onclick="openEditCompetenciaModal()">✏️ Editar Competencia</button>
        <button class="btn btn-danger" onclick="openBorrarCompetenciaModal()">🗑️ Eliminar Competencia</button>
    </div>


    <?php include __DIR__ . '/../modales/modal_create_compe.php'; ?>
    <?php include __DIR__ . '/../modales/modal_editar_compe.php'; ?>
    <?php include __DIR__ . '/../modales/modal_borrar_compe.php'; ?>

    <script src="/public/js/admin/modal_create_compe.js"></script>
    <script src="/public/js/admin/modal_edit_compe.js"></script>
    <script src="/public/js/admin/modal_borrar_compe.js"></script>

</body>

</html>