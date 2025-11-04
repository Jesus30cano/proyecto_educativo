<aside class="sidebar">
    <?php
    $sections = [
        'estudiantes' => ['👥', 'bx bx-group'], 
        'calificaciones' => ['📚', 'bx bx-book-content'], 
        'asistencias' => ['🕒', 'bx bx-time-five'], 
        'evaluaciones' => ['📜', 'bx bx-certification'], 
        'personalizacion' => ['🎨', 'bx bx-palette']
    ];

    foreach ($sections as $key => $data):
        $isActive = $activeSection === $key ? 'active' : '';
        [$emoji, $iconClass] = $data;
    ?>
        <button class="sidebar-button <?= $isActive; ?>" onclick="changeSection('<?= $key; ?>')">
            <i class='<?= $iconClass; ?>'></i>
            <?= ucfirst($key); ?>
        </button>
    <?php endforeach; ?>
</aside>
