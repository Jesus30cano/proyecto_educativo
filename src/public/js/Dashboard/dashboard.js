function toggleUserMenu() {
    const dropdown = document.getElementById('userDropdown');
    dropdown.classList.toggle('show');
}

function changeTab(tab) {
    const params = new URLSearchParams(window.location.search);
    params.set('tab', tab);
    window.location.search = params.toString();
}

function changeSection(section) {
    const params = new URLSearchParams(window.location.search);
    params.set('section', section);
    window.location.search = params.toString();
}

document.addEventListener('click', (event) => {
    const userMenu = document.querySelector('.user-menu-wrapper');
    const dropdown = document.getElementById('userDropdown');
    if (!userMenu.contains(event.target)) dropdown.classList.remove('show');
});


/* En los Dashboard al pasar el maouse o presionar suceden estos eventos como abrir un menu, cambiar de pestaña, etc... */