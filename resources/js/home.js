
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