document.addEventListener('DOMContentLoaded', function () {
    function equalizeCarouselSlides() {
        const carousel = document.getElementById('heroCarousel');
        if (!carousel) return;

        const items  = carousel.querySelectorAll('.carousel-item');
        const slides = carousel.querySelectorAll('.hero-slide');
        if (!slides.length) return;

        slides.forEach(slide => {
            slide.style.minHeight = '';
        });        
        
        items.forEach(item => {
            item.style.display    = 'block';
            item.style.position   = 'static';
            item.style.visibility = 'hidden';
        });
        
        let maxHeight = 0;
        slides.forEach(slide => {
            maxHeight = Math.max(maxHeight, slide.scrollHeight);
        });
        
        items.forEach(item => {
            item.style.display    = '';
            item.style.position   = '';
            item.style.visibility = '';
        });

        slides.forEach(slide => {
            slide.style.minHeight   = maxHeight + 'px';
            slide.style.display     = 'flex';
            slide.style.alignItems  = 'center';
        });
    }

    equalizeCarouselSlides();
    
    window.addEventListener('resize', equalizeCarouselSlides);
});