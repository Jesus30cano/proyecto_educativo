<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">

    <!-- Botón móvil para abrir Sidebar -->
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- LOGO -->
    <button class="logo-button d-none d-lg-flex" onclick="window.location.href='<?= $_SERVER['PHP_SELF']; ?>'">
      <img src="/../../../public/img/gchghc.png" alt="Cognia Logo" class="logo-img">
      <div class="logo-tooltip">Cognia</div>
    </button>

    <!-- Título -->
    <span class="navbar-brand ms-2 fw-bold text-uppercase">ADMIN</span>

    <!-- Botón para colapsar parte derecha -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavBar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="topNavBar">

      <!-- BUSCADOR -->
      <form class="d-flex ms-auto my-3 my-lg-0">
        <div class="input-group">
          <input class="form-control" type="search" placeholder="Buscar..." />
          <button class="btn btn-primary" type="submit">
            <i class="bi bi-search"></i>
          </button>
        </div>
      </form>

      <!-- USUARIO -->
      <ul class="navbar-nav ms-3">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#">Perfil</a></li>
            <li><a class="dropdown-item" href="#">Configuración</a></li>
            <li><a class="dropdown-item" href="/general/logout">Cerrar sesión</a></li>
          </ul>
        </li>
      </ul>

    </div>
  </div>
</nav>


<style>
.logo-button {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    border: none;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: visible;
    flex-shrink: 0;
    margin-right: 10px;
}

.logo-button:hover {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 8px 20px rgba(30, 136, 229, 0.4);
}

.logo-button:active {
    transform: scale(0.95);
}

.logo-img {
    width: 32px;
    height: 32px;
    transition: all 0.4s ease;
}

.logo-button:hover .logo-img {
    transform: rotate(-5deg) scale(1.1);
    filter: drop-shadow(0 0 8px rgba(144, 202, 249, 0.6));
}

.logo-tooltip {
    position: absolute;
    bottom: -45px;
    left: 50%;
    transform: translateX(-50%) translateY(10px);
    background: white;
    color: #1E88E5;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    border: 2px solid #90CAF9;
    z-index: 1000;
}

.logo-tooltip::before {
    content: '';
    position: absolute;
    top: -6px;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 0;
    border-left: 6px solid transparent;
    border-right: 6px solid transparent;
    border-bottom: 6px solid #90CAF9;
}

.logo-button:hover .logo-tooltip {
    opacity: 1;
    transform: translateX(-50%) translateY(0);
}



</style>