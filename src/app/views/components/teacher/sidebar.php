<?php
$currentRoute = $_SERVER['REQUEST_URI'];
?>
<div class="offcanvas offcanvas-start sidebar-nav bg-dark" id="sidebar">
  <div class="offcanvas-body p-0">
    <nav class="navbar-dark">
      <ul class="navbar-nav">
        <li>
          <hr class="dropdown-divider bg-light">
          </hr>
        </li>

        <li>
          <a href="/teacher/dashboard"
            class="nav-link px-3 <?= ($currentRoute == '/teacher/dashboard') ? 'active' : '' ?>">
            <i class="bi bi-speedometer2 me-2"></i>Inicio
          </a>
        </li>

        <li>
          <hr class="dropdown-divider bg-light">
          </hr>
        </li>

        <li>
          <a href="/teacher/course/index"
            class="nav-link px-3 <?= (strpos($currentRoute, '/teacher/course') !== false) ? 'active' : '' ?>">
            <i class="bi bi-journal-bookmark me-2"></i>Mis Cursos
          </a>
        </li>

        <li>
          <a href="/teacher/activity/index"
            class="nav-link px-3 <?= (strpos($currentRoute, '/teacher/activity') !== false) ? 'active' : '' ?>">
            <i class="bi bi-clipboard-check me-2"></i>Actividades
          </a>
        </li>

        <li>
          <a href="/teacher/evaluations/index"
            class="nav-link px-3 <?= (strpos($currentRoute, '/teacher/evaluations') !== false) ? 'active' : '' ?>">
            <i class="bi bi-pencil-square me-2"></i>Evaluaciones
          </a>
        </li>

        <li>
          <a href="/teacher/assistance"
            class="nav-link px-3 <?= (strpos($currentRoute, '/teacher/assistances') !== false) ? 'active' : '' ?>">
            <i class="bi bi-check2-square me-2"></i>Asistencia
          </a>
        </li>

      </ul>
    </nav>
  </div>
</div>