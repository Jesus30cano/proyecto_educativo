<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cognia - Sistema de Gestión Académico Integral</title>
    <meta name="description" content="Plataforma educativa moderna para gestión académica integral">
    <link rel="stylesheet" href="../../public/css/home-modern.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Navegación -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <div class="nav-content">
                <div class="logo">
                    <img src="../../public/img/logo.png" alt="Cognia Logo">
                    <span class="logo-text">Cognia</span>
                </div>
                <div class="hamburger" id="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <ul class="nav-links" id="navLinks">
                    <li><a href="#home" class="nav-link-item">Inicio</a></li>
                    <li><a href="#about" class="nav-link-item">Nosotros</a></li>
                    <li><a href="#services" class="nav-link-item">Servicios</a></li>
                    <li><a href="#features" class="nav-link-item">Características</a></li>
                    <li><a href="#contact" class="nav-link-item">Contacto</a></li>
                </ul>
                <a href="/auth/login" class="btn-login"><i class="fas fa-sign-in-alt"></i> Acceder</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-text" data-aos="fade-right">
                    <div class="badge-premium">
                        <i class="fas fa-star"></i> Plataforma Educativa Premium
                    </div>
                    <h1 class="hero-title">
                        Gestión Educativa
                        <span class="gradient-text">Inteligente</span>
                    </h1>
                    <p class="hero-description">
                        Transforma la administración académica con tecnología de vanguardia. 
                        Simplifica procesos, potencia el aprendizaje y conecta toda tu comunidad educativa.
                    </p>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <h3><span class="counter" data-target="1000">0</span>+</h3>
                            <p>Estudiantes</p>
                        </div>
                        <div class="stat-item">
                            <h3><span class="counter" data-target="150">0</span>+</h3>
                            <p>Docentes</p>
                        </div>
                        <div class="stat-item">
                            <h3><span class="counter" data-target="50">0</span>+</h3>
                            <p>Cursos</p>
                        </div>
                    </div>
                    <div class="hero-buttons">
                        <a href="/auth/login" class="btn-primary">
                            <i class="fas fa-rocket"></i> Comenzar Ahora
                        </a>
                        <a href="#about" class="btn-secondary">
                            <i class="fas fa-play-circle"></i> Ver Demo
                        </a>
                    </div>
                </div>
                <div class="hero-image" data-aos="fade-left">
                    <div class="floating-shapes">
                        <div class="shape shape-1"></div>
                        <div class="shape shape-2"></div>
                        <div class="shape shape-3"></div>
                        <div class="shape shape-4"></div>
                    </div>
                    <div class="hero-img-wrapper">
                        <img src="../../public/img/imagen_mujer.png" alt="Estudiante" class="hero-img">
                        <div class="floating-card card-1">
                            <i class="fas fa-chart-line"></i>
                            <span>+95% Satisfacción</span>
                        </div>
                        <div class="floating-card card-2">
                            <i class="fas fa-users"></i>
                            <span>1,200+ Usuarios</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-badge">¿Por qué Cognia?</span>
                <h2 class="section-title">La Plataforma Educativa Más <span class="gradient-text">Completa</span></h2>
                <p class="section-description">
                    Diseñada por educadores, para educadores. Cognia integra todas las herramientas 
                    que necesitas para una gestión académica eficiente y moderna.
                </p>
            </div>
            <div class="cards-grid">
                <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-icon-wrapper blue">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3>Gestión Integral</h3>
                    <p>Administra cursos, estudiantes, profesores y calificaciones desde una sola plataforma centralizada y fácil de usar.</p>
                    <a href="#" class="card-link">Conocer más <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-icon-wrapper green">
                        <i class="fas fa-cloud"></i>
                    </div>
                    <h3>100% en la Nube</h3>
                    <p>Accede desde cualquier dispositivo, en cualquier momento. Tu información siempre disponible y sincronizada.</p>
                    <a href="#" class="card-link">Conocer más <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-icon-wrapper purple">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h3>Analytics Avanzado</h3>
                    <p>Genera reportes inteligentes y visualiza métricas en tiempo real para tomar decisiones basadas en datos.</p>
                    <a href="#" class="card-link">Conocer más <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="card-icon-wrapper orange">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Seguridad Garantizada</h3>
                    <p>Encriptación de extremo a extremo, backups automáticos y cumplimiento con estándares internacionales.</p>
                    <a href="#" class="card-link">Conocer más <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-badge">Servicios</span>
                <h2 class="section-title">Todo lo que Necesitas en <span class="gradient-text">Un Solo Lugar</span></h2>
            </div>
            <div class="services-grid">
                <div class="service-card" data-aos="flip-left" data-aos-delay="100">
                    <div class="service-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3>Gestión de Estudiantes</h3>
                    <p>Perfiles completos, historial académico, asistencia, documentos y seguimiento personalizado del progreso estudiantil.</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Inscripciones automatizadas</li>
                        <li><i class="fas fa-check"></i> Historial académico completo</li>
                        <li><i class="fas fa-check"></i> Control de asistencia</li>
                    </ul>
                </div>
                <div class="service-card" data-aos="flip-left" data-aos-delay="200">
                    <div class="service-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3>Gestión de Profesores</h3>
                    <p>Horarios inteligentes, asignación de materias, carga académica y gestión de recursos docentes optimizada.</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Horarios personalizados</li>
                        <li><i class="fas fa-check"></i> Carga académica equilibrada</li>
                        <li><i class="fas fa-check"></i> Evaluación del desempeño</li>
                    </ul>
                </div>
                <div class="service-card" data-aos="flip-left" data-aos-delay="300">
                    <div class="service-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <h3>Control de Calificaciones</h3>
                    <p>Registro automático de notas, cálculos precisos, boletines digitales y análisis de rendimiento académico.</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Cálculo automático de promedios</li>
                        <li><i class="fas fa-check"></i> Boletines digitales</li>
                        <li><i class="fas fa-check"></i> Reportes de rendimiento</li>
                    </ul>
                </div>
                <div class="service-card" data-aos="flip-left" data-aos-delay="400">
                    <div class="service-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3>Comunicación Integrada</h3>
                    <p>Notificaciones instantáneas, mensajería interna, circulares digitales y portal para padres de familia.</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Chat en tiempo real</li>
                        <li><i class="fas fa-check"></i> Notificaciones push</li>
                        <li><i class="fas fa-check"></i> Portal de padres</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features">
        <div class="container">
            <div class="features-content">
                <div class="features-image" data-aos="fade-right">
                    <div class="image-wrapper">
                        <div class="image-frame">
                            <i class="fas fa-laptop-code fa-10x"></i>
                        </div>
                    </div>
                </div>
                <div class="features-text" data-aos="fade-left">
                    <span class="section-badge">Características</span>
                    <h2 class="section-title">Potencia tu <span class="gradient-text">Gestión Educativa</span></h2>
                    <div class="feature-list">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <div class="feature-content">
                                <h4>Responsive Design</h4>
                                <p>Diseño adaptable a todos los dispositivos móviles y tablets.</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <div class="feature-content">
                                <h4>Rendimiento Óptimo</h4>
                                <p>Carga rápida y respuesta instantánea en todas las operaciones.</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-sync-alt"></i>
                            </div>
                            <div class="feature-content">
                                <h4>Sincronización Automática</h4>
                                <p>Todos los datos se actualizan en tiempo real automáticamente.</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-headset"></i>
                            </div>
                            <div class="feature-content">
                                <h4>Soporte 24/7</h4>
                                <p>Equipo técnico disponible para ayudarte en todo momento.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content" data-aos="zoom-in">
                <h2>¿Listo para Transformar tu Institución?</h2>
                <p>Únete a cientos de instituciones que ya están revolucionando su gestión educativa</p>
                <div class="cta-buttons">
                    <a href="/auth/login" class="btn-cta-primary">
                        <i class="fas fa-rocket"></i> Comenzar Gratis
                    </a>
                    <a href="#contact" class="btn-cta-secondary">
                        <i class="fas fa-phone"></i> Contactar Ventas
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="footer-logo">
                        <img src="../../public/img/logo.png" alt="Cognia Logo">
                        <span>Cognia</span>
                    </div>
                    <p class="footer-description">Sistema de gestión académico líder en innovación educativa. Transformamos la forma en que las instituciones gestionan su información.</p>
                    <div class="social-links">
                        <a href="#" class="social-link" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h3>Enlaces Rápidos</h3>
                    <ul class="footer-links">
                        <li><a href="#home"><i class="fas fa-chevron-right"></i> Inicio</a></li>
                        <li><a href="#about"><i class="fas fa-chevron-right"></i> Nosotros</a></li>
                        <li><a href="#services"><i class="fas fa-chevron-right"></i> Servicios</a></li>
                        <li><a href="#features"><i class="fas fa-chevron-right"></i> Características</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Servicios</h3>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Gestión Estudiantil</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Gestión Docente</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Calificaciones</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Reportes</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Contacto</h3>
                    <ul class="footer-contact">
                        <li>
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:info@cognia.com">info@cognia.com</a>
                        </li>
                        <li>
                            <i class="fas fa-phone"></i>
                            <a href="tel:+573001234567">+57 300 123 4567</a>
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Barranquilla, Colombia</span>
                        </li>
                        <li>
                            <i class="fas fa-clock"></i>
                            <span>Lun - Vie: 8:00 AM - 6:00 PM</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-divider"></div>
            
            <div class="footer-bottom">
                <p>&copy; 2025 Cognia. Todos los derechos reservados.</p>
                <div class="footer-bottom-links">
                    <a href="#">Política de Privacidad</a>
                    <span>|</span>
                    <a href="#">Términos de Servicio</a>
                    <span>|</span>
                    <a href="#">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="scroll-to-top" aria-label="Volver arriba">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });
    </script>
    <script src="../../public/js/home.js"></script>
</body>
</html>