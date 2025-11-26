<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gestión de Usuarios</title>
  <link href="/public/css/admin/styles_modal_profeCR.css" rel="stylesheet" />

</head>

<body>

  <div class="toolbar mb-3"> 

 
    <button class="btn btn-warning" onclick="openEditUsuarioModal()">✏️ Editar Usuario</button>

  </div>


<?php include __DIR__ . '/../modales/modal_Usu.php'; ?>



  <script src="/public/js/admin/modal_Usu.js"></script>

</body>
</html>