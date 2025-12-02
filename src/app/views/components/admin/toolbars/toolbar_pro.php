<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gestión de Usuarios</title>
  <link href="/public/css/admin/styles_modal_profeCR.css" rel="stylesheet" />

</head>

<body>

  <div class="toolbar mb-4">
    <button class="btn btn-success btn-modern" onclick="openCreateModal()">
      <i class="fas fa-plus-circle mr-2"></i>Crear profesor
    </button>
    <button class="btn btn-warning btn-modern" onclick="openEditProfesorModal()">
      <i class="fas fa-edit mr-2"></i>Editar Profesor
    </button>
    <button class="btn btn-danger btn-modern" onclick="openEliminarProfesorModal()">
      <i class="fas fa-user-times mr-2"></i>Desactivar Profesor
    </button>
  </div>


<?php include __DIR__ . '/../modales/modal_create_pro.php'; ?>
<?php include __DIR__ . '/../modales/modal_edit_pro.php'; ?>
<?php include __DIR__ . '/../modales/modal_borrar_pro.php'; ?>



  <script src="/public/js/admin/modal_create_pro.js"></script>
  <script src="/public/js/admin/modal_edit_pro.js"></script>
  <script src="/public/js/admin/modal_borrar_pro.js"></script>
</body>
</html>