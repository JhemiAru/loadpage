document.addEventListener('DOMContentLoaded', function () {            
    const alerts = document.querySelectorAll('.panel-alert');

    alerts.forEach(function (alert) {
        const closeBtn = alert.querySelector('.close-alert-btn');
        if (closeBtn) {
            closeBtn.addEventListener('click', function () {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500); 
            });
        }

        setTimeout(function () {
            if (alert) {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500); 
            }
        }, 5000); 
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('panelSidebar');
    const mobileToggle = document.getElementById('mobileMenuToggle');
    const sidebarClose = document.getElementById('sidebarCloseMobile');
    const overlay = document.getElementById('sidebarOverlay');

    function isMobile() {
        return window.innerWidth < 768;
    }

    function openSidebar() {
        if (isMobile()) {
            sidebar.classList.add('mobile-open');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }
    
    function closeSidebar() {
        if (isMobile()) {
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    }
    
    function toggleSidebar() {
        if (sidebar.classList.contains('mobile-open')) {
            closeSidebar();
        } else {
            openSidebar();
        }
    }
    
    if (mobileToggle) {
        mobileToggle.addEventListener('click', toggleSidebar);
    }
    
    if (sidebarClose) {
        sidebarClose.addEventListener('click', closeSidebar);
    }
    
    if (overlay) {
        overlay.addEventListener('click', closeSidebar);
    }
    
    window.addEventListener('resize', function() {
        if (!isMobile() && sidebar.classList.contains('mobile-open')) {
            closeSidebar();
        }
    });
    
    const sidebarLinks = document.querySelectorAll('.sidebar-link');
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (isMobile()) {
                setTimeout(closeSidebar, 150);
            }
        });
    });
});