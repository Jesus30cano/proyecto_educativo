<nav class="navbar navbar-dark bg-dark fixed-top shadow-sm">
  <div class="container-fluid d-flex align-items-center">

    <!-- Botón Sidebar (zona táctil más grande) -->
    <button class="btn btn-dark p-2 me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar"
      aria-controls="sidebar">
      <i class="bi bi-list fs-4"></i>
    </button>

    <!-- Nombre del panel -->
    <a class="navbar-brand fw-bold text-uppercase" href="/teacher/dashboard">
      Cognia Docente
    </a>

    <!-- Dropdown de usuario -->
    <div class="dropdown ms-auto">
      <a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" href="#" id="dropdownUser"
        data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-person-circle fs-4"></i>
      </a>

      <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="dropdownUser">
        <li><a class="dropdown-item" href="/teacher/profile">Perfil</a></li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item text-danger" href="/auth/logout">Cerrar Sesión</a></li>
      </ul>
    </div>

  </div>
</nav>
