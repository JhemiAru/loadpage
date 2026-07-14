document.addEventListener('DOMContentLoaded', function () {

    const navbar = document.querySelector('.navbar');
    const collapse = document.querySelector('.navbar-collapse');
    const navbarToggler = document.querySelector('.navbar-toggler');

    if (collapse) {
        collapse.addEventListener('show.bs.collapse', () => {
            navbar.classList.add('menu-open');
        });

        collapse.addEventListener('hidden.bs.collapse', () => {
            navbar.classList.remove('menu-open');
        });
    }
    function closeMenuOnOutsideClick(e) {
        if (window.innerWidth >= 992) return;
        const isMenuOpen = collapse.classList.contains('show');
        if (isMenuOpen) {
            const isClickInsideMenu = collapse.contains(e.target);
            const isClickOnToggler = navbarToggler && navbarToggler.contains(e.target);
            if (!isClickInsideMenu && !isClickOnToggler) {
                const bsCollapse = bootstrap.Collapse.getInstance(collapse);
                if (bsCollapse) {
                    bsCollapse.hide();
                } else {
                    collapse.classList.remove('show');
                    navbar.classList.remove('menu-open');
                }
            }
        }
    }

    document.addEventListener('click', closeMenuOnOutsideClick);

    let scrollTimeout;
    window.addEventListener('scroll', function() {
        if (window.innerWidth < 992 && collapse && collapse.classList.contains('show')) {
            if (scrollTimeout) clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => {
                const bsCollapse = bootstrap.Collapse.getInstance(collapse);
                if (bsCollapse) {
                    bsCollapse.hide();
                }
            }, 100);
        }
    });

    function updateNavbar() {
        const navbar = document.getElementById('mainNavbar');
        if (!navbar) return;

        if (window.scrollY > 1) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }

    window.addEventListener('scroll', updateNavbar);
    window.addEventListener('load', updateNavbar);

    if (collapse) {
        const navLinks = collapse.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                if (window.innerWidth < 992) {
                    const parentDropdown = this.closest('.dropdown');
                    const parentSubmenu = this.closest('.dropdown-submenu');
                    if (!parentDropdown || (parentSubmenu && window.innerWidth < 992)) {
                        const bsCollapse = bootstrap.Collapse.getInstance(collapse);
                        if (bsCollapse) {
                            setTimeout(() => {
                                bsCollapse.hide();
                            }, 100);
                        }
                    }
                }
            });
        });
    }

    document.querySelectorAll('.dropdown-submenu > a').forEach(el => {
        el.addEventListener('click', function (e) {
            if (window.innerWidth >= 992) return;
            e.preventDefault();
            e.stopPropagation();

            const next = this.nextElementSibling;
            if (!next) return;

            const isOpen = next.classList.contains('show');

            document.querySelectorAll('.dropdown-submenu .dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });

            if (!isOpen) {
                next.classList.add('show');
            }
        });
    });

    document.querySelectorAll('.dropdown').forEach(dropdown => {
        dropdown.addEventListener('hide.bs.dropdown', function () {
            this.querySelectorAll('.dropdown-submenu .dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
        });
    });

    document.addEventListener('click', function (e) {
        if (window.innerWidth >= 992) return;
        if (!e.target.closest('.dropdown-submenu')) {
            document.querySelectorAll('.dropdown-submenu .dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
        }
    });

    document.querySelectorAll('.dropdown-submenu').forEach(dropdown => {
        dropdown.addEventListener('mouseenter', function () {
            if (window.innerWidth < 992) return;
            this.classList.add('show');
            this.querySelector('.dropdown-menu').classList.add('show');
        });

        dropdown.addEventListener('mouseleave', function () {
            if (window.innerWidth < 992) return;
            this.classList.remove('show');
            this.querySelector('.dropdown-menu').classList.remove('show');
        });
    });

    if (collapse) {
        collapse.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
});

document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordInput = document.getElementById('ms-form-pass');
    const eyeIcon = document.getElementById('eyeIcon');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }
});
