document.querySelectorAll('.modal').forEach(modalEl => {
    modalEl.addEventListener('show.bs.modal', function() {
        this.style.zIndex = '1055';
    });
});

document.querySelectorAll('.btn-leer, .img-wrapper').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const targetId = this.getAttribute('data-bs-target');
        if(targetId) {
            const modalElement = document.querySelector(targetId);
            if(modalElement) {
                document.querySelectorAll('.modal.show').forEach(openModal => {
                    let instance = bootstrap.Modal.getInstance(openModal);
                    if(instance) instance.hide();
                });        
                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                if(modalInstance) {
                    modalInstance.show();
                } else {
                    new bootstrap.Modal(modalElement, {
                        backdrop: 'static',
                        keyboard: true
                    }).show();
                }
            }
        }
    });
});