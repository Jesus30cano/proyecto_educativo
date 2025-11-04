<div class="action-bar">
    <div class="action-bar-content">
        <button class="tab-button <?= $activeTab === 'inicio' ? 'active' : ''; ?>" onclick="changeTab('inicio')">
            <i class='bx bx-home'></i> Inicio
        </button>
        <button class="tab-button <?= $activeTab === 'horario' ? 'active' : ''; ?>" onclick="changeTab('horario')">
            <i class='bx bx-time-five'></i> Horario
        </button>
        <button class="tab-button <?= $activeTab === 'tareas' ? 'active' : ''; ?>" onclick="changeTab('tareas')">
            <i class='bx bx-list-check'></i> Tareas
        </button>
    </div>
</div>
