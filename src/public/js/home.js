// Smooth scrolling para los enlaces de navegación
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Navbar transparente al hacer scroll
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.style.background = 'rgba(30, 136, 229, 0.95)';
    } else {
        navbar.style.background = '#1E88E5';
    }
});

// Animación para las cards cuando aparecen en viewport
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Aplicar animación a todas las cards
document.querySelectorAll('.card, .service-item').forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(20px)';
    card.style.transition = 'all 0.6s ease-out';
    observer.observe(card);
});

// Funcionalidad del botón Login (puedes personalizarlo)
document.querySelector('.btn-login').addEventListener('click', function() {
    
    // Aquí puedes agregar la redirección a tu página de login
     window.location.href = 'auth/login';
});

// Botones del hero
document.querySelectorAll('.hero-buttons button').forEach(button => {
    button.addEventListener('click', function() {
        if (this.classList.contains('btn-primary')) {
            alert('Comenzando el registro...');
        } else {
            document.querySelector('#about').scrollIntoView({ behavior: 'smooth' });
        }
    });
});
