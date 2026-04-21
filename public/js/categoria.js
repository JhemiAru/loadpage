document.addEventListener('DOMContentLoaded', function () {

    const grid      = document.getElementById('categoriaGrid');
    const toggleBtn = document.getElementById('btnToggleCategorias');
    const toggleIcon = document.getElementById('toggleIcon');
    const toggleText = document.getElementById('toggleText');

    if (!grid || !toggleBtn) return;

    const items = Array.from(grid.querySelectorAll('.cat-item'));
    let expanded = false;

    function setupGrid() {
        items.forEach(item => item.style.display = '');
        toggleBtn.style.display = 'none';
        grid.offsetHeight;

        if (items.length === 0) return;
        const firstTop = items[0].offsetTop;
        const cols = items.filter(i => i.offsetTop === firstTop).length;
        const maxVisible = cols * 2 - 1;
        if (items.length <= cols * 2) {
            toggleBtn.style.display = 'none';
            return;
        }
        if (!expanded) {
            items.forEach((item, i) => {
                item.style.display = i < maxVisible ? '' : 'none';
            });
            toggleBtn.style.display = '';
            toggleText.textContent = 'Ver más';
            toggleIcon.className = 'fas fa-plus';
        } else {
            items.forEach(item => item.style.display = '');
            toggleBtn.style.display = '';
            toggleText.textContent = 'Ver menos';
            toggleIcon.className = 'fas fa-minus';
        }
    }

    toggleBtn.addEventListener('click', function () {
        expanded = !expanded;
        setupGrid();
        if (!expanded) {
            grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });

    setupGrid();
    window.addEventListener('resize', setupGrid);
});