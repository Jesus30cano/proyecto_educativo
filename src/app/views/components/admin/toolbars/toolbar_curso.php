<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gestión de Usuarios</title>
  <link href="/public/css/boostrap_dashboard/admin/styles_modal_cursoCR.css" rel="stylesheet" />
</head>

<body>

  <div class="toolbar">
    <button class="btn btn-success" onclick="openCreateCursoModal()">➕ Crear Curso</button>
     <button class="btn btn-warning" onclick="openEditCursoModal()">✏️ Editar Curso</button>
  </div>

  <
  <?php include __DIR__ . '/../modales/modal_create_curso.php'; ?>
  <?php include __DIR__ . '/../modales/modal_edit_curso.php'; ?>

  <script src="/public/js/boostrap_dashboard/admin/modal_create_curso.js"></script>
  <script src="/public/js/boostrap_dashboard/admin/modal_edit_curso.js"></script>
</body>
</html>
