<?php
$currentRoute = $_SERVER['REQUEST_URI'];
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/teacher/dashboard">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">COGNIA<sup></sup></div>
    </a>

    <!-- Heading -->
    <div class="sidebar-heading">
        Contenido principal
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a href="/teacher/dashboard"
            class="nav-link px-3 <?= ($currentRoute == '/teacher/dashboard') ? 'active' : '' ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Inicio</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Navegación
    </div>

    <!-- Nav Item - Calificaciones -->
    <li class="nav-item">
        <a href="/teacher/course"
            class="nav-link px-3 <?= (strpos($currentRoute, '/teacher/course') !== false) ? 'active' : '' ?>">
            <i class="fas fa-fw fa-star"></i>
            <span>Mis Cursos </span>
        </a>
    </li>

    <!-- Nav Item - Actividades -->
    <li class="nav-item">
        <a href="/teacher/activity"
            class="nav-link px-3 <?= (strpos($currentRoute, '/teacher/activity') !== false) ? 'active' : '' ?>">
            <i class="fas fa-fw fa-tasks"></i>
            <span>Actividades</span>
        </a>
    </li>

    <!-- Nav Item - Evaluaciones -->
    <li class="nav-item">
        <a href="/teacher/evaluations"
            class="nav-link px-3 <?= (strpos($currentRoute, '/teacher/evaluations') !== false) ? 'active' : '' ?>">
            <i class="fas fa-fw fa-tasks"></i>
            <span>Evaluaciones</span>
        </a>
    </li>

    <!-- Nav Item - Asistencias-->
    <li class="nav-item">
         <a href="/teacher/assistance"
            class="nav-link px-3 <?= (strpos($currentRoute, '/teacher/assistances') !== false) ? 'active' : '' ?>">
            <i class="fas fa-fw fa-tasks"></i>
            <span>Asistencias</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Personal
    </div>

    <!-- Nav Item - Perfil -->
    <li class="nav-item">
        <a class="nav-link" href="/teacher/profile">
            <i class="fas fa-fw fa-user"></i>
            <span>Perfil</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->