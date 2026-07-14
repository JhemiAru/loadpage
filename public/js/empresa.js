document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('searchInput');
    const suggestions = document.getElementById('suggestions');
    let debounceTimer;

    input.addEventListener('input', function () {
        clearTimeout(debounceTimer);
        const q = this.value.trim();
        if (q.length < 2) {
            hideSuggestions();
            return;
        }
        debounceTimer = setTimeout(() => fetchSuggestions(q), 280);
    });

    async function fetchSuggestions(q) {
        try {
            const res = await fetch(`/empresa/data?query=${encodeURIComponent(q)}`);
            const data = await res.json();
            renderSuggestions(data, q);
        } catch (e) {
            hideSuggestions();
        }
    }

    function renderSuggestions(data, q) {
        if (!data.length) {
            hideSuggestions();
            return;
        }

        suggestions.innerHTML = data.map(item => {
            const img = item.imagen
                ? `<img src="/imagen/empresas/${item.imagen}" class="suggestion-img" alt="${item.nombre}">`
                : `<div class="suggestion-img-placeholder"><i class="fas fa-store"></i></div>`;

            const meta = [item.categoria, item.ciudad].filter(Boolean).join(' · ');
            const desc = item.descuento ? `<span class="suggestion-desc">${escapeHtml(item.descuento)}</span>` : '';

            return `
                <a href="/empresa/${item.slug}" class="suggestion-item">
                    ${img}
                    <div class="suggestion-info">
                        <div class="suggestion-nombre">${highlight(escapeHtml(item.nombre), q)}</div>
                        ${meta ? `<div class="suggestion-meta">${escapeHtml(meta)}</div>` : ''}
                    </div>
                    ${desc}
                </a>`;
        }).join('');

        suggestions.style.display = 'block';
    }

    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function highlight(text, q) {
        const re = new RegExp(`(${q.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
        return text.replace(re, '<mark style="background:#fff3cd;border-radius:3px;padding:0 2px">$1</mark>');
    }

    function hideSuggestions() {
        suggestions.style.display = 'none';
        suggestions.innerHTML = '';
    }

    document.addEventListener('click', function(e) {
        if (!e.target.closest('.search-wrap')) {
            hideSuggestions();
        }
    });

    input.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideSuggestions();
        }
    });
});