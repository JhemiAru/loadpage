document.addEventListener('DOMContentLoaded', function () {

    const navbar = document.querySelector('.navbar');
    const collapse = document.querySelector('.navbar-collapse');

    collapse.addEventListener('show.bs.collapse', () => {
        navbar.classList.add('menu-open');
    });

    collapse.addEventListener('hidden.bs.collapse', () => {
        navbar.classList.remove('menu-open');
    });

    function updateNavbar() {
        const navbar = document.getElementById('mainNavbar');

        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }

    window.addEventListener('scroll', updateNavbar);
    window.addEventListener('load', updateNavbar);

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
});