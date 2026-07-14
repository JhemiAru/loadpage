document.addEventListener('DOMContentLoaded', function () {
    const isMobile = window.matchMedia('(max-width: 992px)').matches;
    
    if (isMobile) {
        document.querySelectorAll('.flip-container').forEach(container => {
            const flipInner = container.querySelector('.flip-inner');
            
            container.addEventListener('click', function(e) {
                if (e.target.closest('a')) {
                    return;
                }
                document.querySelectorAll('.flip-inner.flipped').forEach(other => {
                    if (other !== flipInner) {
                        other.classList.remove('flipped');
                    }
                });
                
                flipInner.classList.toggle('flipped');
            });
        });
    }
});