<nav class="navbar">
    <div class="nav-content">
        <div class="nav-top">
            <div class="left-section">
                <button class="logo-button" onclick="window.location.href='<?= $_SERVER['PHP_SELF']; ?>'">
                    <img src="../../../public/img/icon_cognia.png" alt="Cognia Logo" class="logo-img">
                    <div class="logo-tooltip">Cognia</div>
                </button>
                <h2 class="nav-title">Cognia</h2>
            </div>

            <div class="search-container">
                <div class="search-icon">
                    🔍
                </div>
                <input type="text" placeholder="Buscar..." class="search-input">
            </div>

            <div class="user-menu-wrapper">
                <button class="user-button" onclick="toggleUserMenu()">
                    <div class="user-avatar">👤</div>
                </button>

                <div class="dropdown" id="userDropdown">
                    <div class="dropdown-header">
                        <p>Administrador</p>
                        <p>admin@escuela.com</p>
                    </div>
                    <button class="dropdown-button">Configurar perfil</button>
                    <button class="dropdown-button">Cerrar sesión</button>
                </div>
            </div>
        </div>
    </div>
</nav>
