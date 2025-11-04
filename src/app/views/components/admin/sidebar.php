<aside class="sidebar">
    <?php
    $sections = [
        'profesores' => ['👥', 'bx bx-group'], 
        'estudiantes' => ['👥', 'bx bx-group'], 
        'cursos' => ['📚', 'bx bx-book-content'], 
        'asistencias' => ['🕒', 'bx bx-time-five'], 
        'certificados' => ['📜', 'bx bx-certification'], 
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
