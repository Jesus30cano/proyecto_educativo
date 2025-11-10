<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gestión de Usuarios</title>
  <link href="/public/css/boostrap_dashboard/admin/styles_modal_profeCR.css" rel="stylesheet" />

</head>

<body>

  <div class="toolbar">
    <button class="btn btn-success" onclick="openCreateModal()">➕ Crear profesor</button>
    <button class="btn btn-warning" onclick="openEditProfesorModal()">✏️ Editar Profesor</button>
  </div>

<?php include __DIR__ . '/../modales/modal_create_pro.php'; ?>
<?php include __DIR__ . '/../modales/modal_edit_pro.php'; ?>


  <script src="/public/js/boostrap_dashboard/admin/modal_create_pro.js"></script>
  <script src="/public/js/boostrap_dashboard/admin/modal_edit_pro.js"></script>
</body>
</html>