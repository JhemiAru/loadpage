{{-- resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Marketing TikTok para Negocios | Crea Videos Virales</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: #1f2937;
            line-height: 1.6;
            overflow-x: hidden;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* Navbar */
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
            background: rgba(255,255,255,0.95);
        }

        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 24px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            font-size: 1.5rem;
            color: #fe2c55;
        }

        .logo img {
            height: 40px;
            width: auto;
        }

        .nav-links {
            display: flex;
            gap: 32px;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: #374151;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #fe2c55;
        }

        .menu-toggle {
            display: none;
            font-size: 24px;
            cursor: pointer;
        }

        /* Hero Section */
        .hero {
            padding: 120px 0 80px;
            background: linear-gradient(135deg, #fff5f7 0%, #ffffff 100%);
        }

        .hero .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            align-items: center;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 24px;
        }

        .highlight {
            color: #fe2c55;
            position: relative;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: #6b7280;
            margin-bottom: 32px;
        }

        .hero-buttons {
            display: flex;
            gap: 16px;
        }

        .btn {
            padding: 12px 32px;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-block;
            cursor: pointer;
        }

        .btn-primary {
            background: #fe2c55;
            color: white;
            box-shadow: 0 4px 14px rgba(254,44,85,0.3);
            border: none;
        }

        .btn-primary:hover {
            background: #e01e45;
            transform: translateY(-2px);
        }

        .btn-outline {
            border: 2px solid #fe2c55;
            color: #fe2c55;
            background: transparent;
        }

        .btn-outline:hover {
            background: #fe2c55;
            color: white;
        }

        .hero-image img {
            width: 100%;
            border-radius: 24px;
            box-shadow: 0 20px 35px -10px rgba(0,0,0,0.1);
        }

        /* Services Section */
        .services {
            padding: 80px 0;
            background: white;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 48px;
        }

        .section-subtitle {
            text-align: center;
            color: #6b7280;
            margin-bottom: 48px;
            font-size: 1.1rem;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 32px;
        }

        .service-card {
            text-align: center;
            padding: 32px 24px;
            background: #f9fafb;
            border-radius: 24px;
            transition: all 0.3s;
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1);
        }

        .service-icon {
            font-size: 48px;
            color: #fe2c55;
            margin-bottom: 20px;
        }

        .service-card h3 {
            font-size: 1.5rem;
            margin-bottom: 12px;
        }

        /* Plans Section */
        .plans {
            padding: 80px 0;
            background: #f9fafb;
        }

        .plans-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 32px;
            margin-top: 32px;
        }

        .plan-card {
            background: white;
            border-radius: 32px;
            padding: 32px 24px;
            position: relative;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .plan-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 35px -10px rgba(0,0,0,0.15);
        }

        .plan-card.featured {
            border: 2px solid #fe2c55;
            transform: scale(1.02);
        }

        .plan-badge {
            position: absolute;
            top: -12px;
            right: 24px;
            background: #fe2c55;
            color: white;
            padding: 4px 16px;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .plan-header {
            text-align: center;
            margin-bottom: 24px;
        }

        .plan-header h3 {
            font-size: 1.8rem;
            margin-bottom: 16px;
        }

        .plan-price {
            font-size: 2.5rem;
            font-weight: 800;
            color: #fe2c55;
        }

        .plan-price span {
            font-size: 1rem;
            font-weight: 400;
            color: #6b7280;
        }

        .plan-description {
            color: #6b7280;
            margin-top: 12px;
        }

        .plan-features ul {
            list-style: none;
            margin: 24px 0;
        }

        .plan-features li {
            padding: 8px 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .plan-features i {
            color: #10b981;
            width: 20px;
        }

        .plan-footer {
            text-align: center;
            margin-top: 24px;
        }

        .plan-img {
            width: 100%;
            border-radius: 16px;
            margin-bottom: 16px;
            max-height: 150px;
            object-fit: cover;
        }

        .btn-plan {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 40px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 1rem;
        }

        .btn-free {
            background: #e5e7eb;
            color: #374151;
        }

        .btn-free:hover {
            background: #d1d5db;
        }

        .btn-monthly {
            background: #fe2c55;
            color: white;
        }

        .btn-monthly:hover {
            background: #e01e45;
        }

        .btn-whatsapp {
            background: #25D366;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-whatsapp:hover {
            background: #128C7E;
        }

        /* Contact Section */
        .contact {
            padding: 80px 0;
            background: white;
        }

        .contact-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            background: #f9fafb;
            border-radius: 32px;
            padding: 48px;
        }

        .contact-info h2 {
            font-size: 2rem;
            margin-bottom: 16px;
        }

        .contact-details {
            margin-top: 32px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 16px 0;
            font-size: 1.1rem;
        }

        .contact-item i {
            font-size: 24px;
            color: #fe2c55;
        }

        .contact-form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .contact-form input,
        .contact-form select,
        .contact-form textarea {
            padding: 12px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            font-family: inherit;
            font-size: 1rem;
        }

        .btn-submit {
            background: #fe2c55;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 40px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-submit:hover {
            background: #e01e45;
        }

        .form-message {
            margin-top: 12px;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
        }

        .form-message.success {
            background: #d1fae5;
            color: #065f46;
        }

        .form-message.error {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Footer */
        .footer {
            background: #1f2937;
            color: white;
            padding: 48px 0 24px;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 24px;
            margin-bottom: 32px;
        }

        .footer-logo h3 {
            font-size: 1.5rem;
            margin-bottom: 8px;
        }

        .footer-links {
            display: flex;
            gap: 24px;
        }

        .footer-links a {
            color: #9ca3af;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: #fe2c55;
        }

        .footer-social {
            display: flex;
            gap: 16px;
        }

        .footer-social a {
            color: #9ca3af;
            font-size: 1.5rem;
            transition: color 0.3s;
        }

        .footer-social a:hover {
            color: #fe2c55;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 24px;
            border-top: 1px solid #374151;
            color: #9ca3af;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
                position: absolute;
                top: 70px;
                left: 0;
                right: 0;
                background: white;
                flex-direction: column;
                padding: 24px;
                text-align: center;
                box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            }
            
            .nav-links.active {
                display: flex;
            }
            
            .menu-toggle {
                display: block;
            }
            
            .hero .container {
                grid-template-columns: 1fr;
                text-align: center;
            }
            
            .hero-buttons {
                justify-content: center;
            }
            
            .contact-wrapper {
                grid-template-columns: 1fr;
                padding: 24px;
            }
            
            .footer-content {
                flex-direction: column;
                text-align: center;
            }
            
            .plan-card.featured {
                transform: scale(1);
            }
            
            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

    <!-- Header / Navegación -->
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <img src="{{ asset('img/logoFacebol.svg') }}" alt="Logo" onerror="this.src='https://via.placeholder.com/50x50'">
                <span>FaceBol SRL</span>
            </div>
            <ul class="nav-links">
                <li><a href="#inicio">Inicio</a></li>
                <li><a href="#planes">Planes</a></li>
                <li><a href="#contacto">Contacto</a></li>
            </ul>
            <div class="menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="inicio" class="hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">
                    Haz crecer tu negocio con <span class="highlight">TikTok</span>
                </h1>
                <p class="hero-subtitle">
                    Creamos videos profesionales que generan ventas. Especialistas en marketing para pequeños y medianos negocios.
                </p>
                <div class="hero-buttons">
                    <a href="#planes" class="btn btn-primary">Ver Planes</a>
                    <a href="#contacto" class="btn btn-outline">Contactar Ahora</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="{{ asset('img/lila.webp') }}" alt="Marketing TikTok" onerror="this.src='https://via.placeholder.com/500x400'">
            </div>
        </div>
    </section>

    <!-- Sección de Servicios -->
    <section class="services">
        <div class="container">
            <h2 class="section-title">¿Qué hacemos por ti?</h2>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fab fa-tiktok"></i>
                    </div>
                    <h3>Videos para TikTok</h3>
                    <p>Contenido viral, edits rápidos, tendencias y hooks que atrapan desde el segundo 1.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fab fa-facebook"></i>
                    </div>
                    <h3>Publicaciones Facebook</h3>
                    <p>Posts optimizados con copywriting persuasivo y diseños que convierten.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Estrategia Marketing</h3>
                    <p>Te asesoramos para que tu contenido llegue a más clientes potenciales.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Planes de Marketing -->
    <section id="planes" class="plans">
        <div class="container">
            <h2 class="section-title">Planes de Marketing <span class="highlight">TikTok + Facebook</span></h2>
            <p class="section-subtitle">Elige el plan que mejor se adapte a tu negocio</p>
            
            <div class="plans-grid">
                <!-- Plan Gratuito -->
                <div class="plan-card plan-free">
                    <div class="plan-badge">MÁS POPULAR</div>
                    <div class="plan-header">
                        <h3>Plan Gratuito</h3>
                        <div class="plan-price">$0 <span>Bs 0</span></div>
                        <p class="plan-description">Ideal para empezar sin inversión</p>
                    </div>
                    <div class="plan-features">
                        <ul>
                            <li><i class="fas fa-check-circle"></i> 1 video para TikTok</li>
                            <li><i class="fas fa-check-circle"></i> 1 publicación en Facebook</li>
                            <li><i class="fas fa-check-circle"></i> Publicidad gratuita inicial</li>
                            <li><i class="fas fa-clock"></i> Entrega: 5 días hábiles</li>
                        </ul>
                    </div>
                    <div class="plan-footer">
                        <img src="{{ asset('img/img2.jpg') }}" alt="Plan gratuito" class="plan-img" onerror="this.style.display='none'">
                        <button class="btn-plan btn-free">Obtener Gratis</button>
                    </div>
                </div>

                <!-- Plan Mensual -->
                <div class="plan-card plan-monthly featured">
                    <div class="plan-badge">RECOMENDADO</div>
                    <div class="plan-header">
                        <h3>Plan Mensual</h3>
                        <div class="plan-price">300 <span>Bs/mes</span></div>
                        <p class="plan-description">Para negocios que quieren crecer constante</p>
                    </div>
                    <div class="plan-features">
                        <ul>
                            <li><i class="fas fa-check-circle"></i> 2 videos para TikTok</li>
                            <li><i class="fas fa-check-circle"></i> 2 publicaciones en Facebook</li>
                            <li><i class="fas fa-check-circle"></i> Asesoría básica incluida</li>
                            <li><i class="fas fa-chart-simple"></i> Reporte de rendimiento</li>
                        </ul>
                    </div>
                    <div class="plan-footer">
                        <img src="{{ asset('img/lila.webp') }}" alt="Plan mensual" class="plan-img" onerror="this.style.display='none'">
                        <button class="btn-plan btn-monthly">Contratar por 300 Bs</button>
                    </div>
                </div>

                <!-- Plan Empresarial -->
                <div class="plan-card plan-enterprise">
                    <div class="plan-header">
                        <h3>Plan Empresarial</h3>
                        <div class="plan-price">Personalizado</div>
                        <p class="plan-description">Solución completa para empresas</p>
                    </div>
                    <div class="plan-features">
                        <ul>
                            <li><i class="fas fa-check-circle"></i> Videos ilimitados bajo demanda</li>
                            <li><i class="fas fa-check-circle"></i> Gestión completa de redes</li>
                            <li><i class="fas fa-check-circle"></i> Estrategia personalizada</li>
                            <li><i class="fas fa-headset"></i> Atención 24/7 dedicada</li>
                        </ul>
                    </div>
                    <div class="plan-footer">
                        <button class="btn-plan btn-whatsapp" id="btnWhatsappEnterprise">
                            <i class="fab fa-whatsapp"></i> Contactar por WhatsApp
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Contacto -->
    <section id="contacto" class="contact">
        <div class="container">
            <div class="contact-wrapper">
                <div class="contact-info">
                    <h2>¿Listo para viralizar tu negocio?</h2>
                    <p>Contáctanos y te asesoramos sin compromiso. Respondemos en menos de 24 horas.</p>
                    <div class="contact-details">
                        <div class="contact-item">
                            <i class="fab fa-whatsapp"></i>
                            <span>+591 702665870</span>
                        </div>
                        <div class="contact-item">
                            <i class="far fa-envelope"></i>
                            <span>info@viraltik.bo</span>
                        </div>
                        <div class="contact-item">
                            <i class="fab fa-tiktok"></i>
                            <span>@viraltik_bolivia</span>
                        </div>
                    </div>
                </div>
                <form class="contact-form" id="contactForm">
                    @csrf
                    <input type="text" placeholder="Tu nombre" id="nombre" required>
                    <input type="email" placeholder="Tu email" id="email" required>
                    <input type="tel" placeholder="WhatsApp (opcional)" id="telefono">
                    <select id="planInteres">
                        <option value="">Selecciona un plan</option>
                        <option value="gratuito">Plan Gratuito</option>
                        <option value="mensual">Plan Mensual - 300 Bs</option>
                        <option value="empresarial">Plan Empresarial</option>
                    </select>
                    <textarea rows="4" placeholder="Cuéntanos sobre tu negocio..." id="mensaje"></textarea>
                    <button type="submit" class="btn-submit">Enviar mensaje</button>
                    <div id="formMessage" class="form-message"></div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <h3>ViralTik</h3>
                    <p>Marketing que conecta con tu audiencia</p>
                </div>
                <div class="footer-links">
                    <a href="#inicio">Inicio</a>
                    <a href="#planes">Planes</a>
                    <a href="#contacto">Contacto</a>
                </div>
                <div class="footer-social">
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 ViralTik - Todos los derechos reservados. El Alto, Bolivia</p>
            </div>
        </div>
    </footer>

    <script>
        // Menú móvil toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.querySelector('.menu-toggle');
            const navLinks = document.querySelector('.nav-links');
            
            if (menuToggle) {
                menuToggle.addEventListener('click', function() {
                    navLinks.classList.toggle('active');
                });
            }
            
            // Cerrar menú al hacer click en un enlace
            const links = document.querySelectorAll('.nav-links a');
            links.forEach(link => {
                link.addEventListener('click', () => {
                    navLinks.classList.remove('active');
                });
            });
            
            // Botón WhatsApp para plan empresarial
            const whatsappBtn = document.getElementById('btnWhatsappEnterprise');
            if (whatsappBtn) {
                whatsappBtn.addEventListener('click', function() {
                    const phone = '591702665870';
                    const message = encodeURIComponent('Hola, estoy interesado en el Plan Empresarial de Marketing TikTok. Me gustaría recibir más información.');
                    window.open(`https://wa.me/${phone}?text=${message}`, '_blank');
                });
            }
            
            // Botones de planes gratuitos y mensuales (simulación)
            const btnFree = document.querySelector('.btn-free');
            if (btnFree) {
                btnFree.addEventListener('click', function() {
                    showFormMessage('Plan Gratuito seleccionado. Completa el formulario para recibir tu video gratuito.', 'success');
                    document.getElementById('planInteres').value = 'gratuito';
                    document.getElementById('contactForm').scrollIntoView({ behavior: 'smooth' });
                });
            }
            
            const btnMonthly = document.querySelector('.btn-monthly');
            if (btnMonthly) {
                btnMonthly.addEventListener('click', function() {
                    showFormMessage('Plan Mensual por 300 Bs. Completa el formulario y te contactaremos.', 'success');
                    document.getElementById('planInteres').value = 'mensual';
                    document.getElementById('contactForm').scrollIntoView({ behavior: 'smooth' });
                });
            }
            
            // Manejo del formulario de contacto
            const contactForm = document.getElementById('contactForm');
            if (contactForm) {
                contactForm.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    
                    const nombre = document.getElementById('nombre').value;
                    const email = document.getElementById('email').value;
                    const telefono = document.getElementById('telefono').value;
                    const planInteres = document.getElementById('planInteres').value;
                    const mensaje = document.getElementById('mensaje').value;
                    
                    if (!nombre || !email) {
                        showFormMessage('Por favor completa tu nombre y email.', 'error');
                        return;
                    }
                    
                    const submitBtn = contactForm.querySelector('.btn-submit');
                    const originalText = submitBtn.textContent;
                    submitBtn.textContent = 'Enviando...';
                    submitBtn.disabled = true;
                    
                    // Simular envío (aquí puedes conectar con backend real)
                    setTimeout(() => {
                        console.log('Formulario enviado:', { nombre, email, telefono, planInteres, mensaje });
                        showFormMessage('¡Mensaje enviado con éxito! Te contactaremos pronto.', 'success');
                        contactForm.reset();
                        submitBtn.textContent = originalText;
                        submitBtn.disabled = false;
                        
                        // Opcional: redirigir a WhatsApp si es plan empresarial
                        if (planInteres === 'empresarial') {
                            const phone = '591702665870';
                            const msg = encodeURIComponent(`Hola, soy ${nombre}. Estoy interesado en el Plan Empresarial. ${mensaje}`);
                            window.open(`https://wa.me/${phone}?text=${msg}`, '_blank');
                        }
                    }, 1000);
                });
            }
            
            function showFormMessage(msg, type) {
                const messageDiv = document.getElementById('formMessage');
                if (messageDiv) {
                    messageDiv.textContent = msg;
                    messageDiv.className = `form-message ${type}`;
                    setTimeout(() => {
                        messageDiv.textContent = '';
                        messageDiv.className = 'form-message';
                    }, 5000);
                }
            }
            
            // Smooth scroll para los enlaces internos
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        e.preventDefault();
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>