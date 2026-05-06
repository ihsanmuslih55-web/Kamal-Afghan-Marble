// Product Gallery: Thumbnails + Modal with Zoom & Navigation
document.addEventListener('DOMContentLoaded', function() {
    // 1. Thumbnail click changes main image
    const thumbs = document.querySelectorAll('.gallery-thumb');
    const mainImg = document.getElementById('mainProductImage');
    
    if (thumbs.length && mainImg) {
        thumbs.forEach(thumb => {
            thumb.addEventListener('click', function(e) {
                e.stopPropagation(); // prevent modal from opening when clicking thumb
                const full = this.getAttribute('data-full');
                if (full) mainImg.src = full;
                thumbs.forEach(t => t.style.borderColor = 'transparent');
                this.style.borderColor = '#c19a6b';
            });
        });
    }

    // 2. Modal gallery logic
    const modalElem = document.getElementById('productGalleryModal');
    if (modalElem) {
        let currentIndex = 0;
        let images = [];
        const modalImg = document.getElementById('modalImage');
        const prevBtn = document.getElementById('prevImage');
        const nextBtn = document.getElementById('nextImage');
        const modalThumbs = document.getElementById('modalThumbnails');
        
        // Get images from data attribute
        const imagesData = modalElem.getAttribute('data-images');
        if (imagesData) {
            images = JSON.parse(imagesData);
        }
        
        function updateModalImage() {
            if (images.length) {
                modalImg.src = images[currentIndex];
                // Reset zoom when changing image
                modalImg.style.transform = 'scale(1)';
                // Highlight active thumbnail in modal
                document.querySelectorAll('.modal-thumb').forEach((thumb, i) => {
                    thumb.style.border = i === currentIndex ? '3px solid #c19a6b' : '2px solid #ddd';
                });
            }
        }
        
        function buildModalThumbs() {
            if (!modalThumbs) return;
            modalThumbs.innerHTML = '';
            images.forEach((img, idx) => {
                const thumb = document.createElement('img');
                thumb.src = img;
                thumb.classList.add('modal-thumb');
                thumb.style.width = '60px';
                thumb.style.height = '60px';
                thumb.style.objectFit = 'cover';
                thumb.style.cursor = 'pointer';
                thumb.style.border = '2px solid #ddd';
                thumb.style.margin = '5px';
                thumb.style.borderRadius = '4px';
                thumb.addEventListener('click', (e) => {
                    e.stopPropagation();
                    currentIndex = idx;
                    updateModalImage();
                });
                modalThumbs.appendChild(thumb);
            });
        }
        
        // When modal opens
        modalElem.addEventListener('show.bs.modal', function() {
            // Find current main image index
            const currentMainSrc = mainImg ? mainImg.src : '';
            currentIndex = images.findIndex(img => img === currentMainSrc);
            if (currentIndex === -1) currentIndex = 0;
            buildModalThumbs();
            updateModalImage();
        });
        
        // Next/Prev buttons
        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                if (images.length) {
                    currentIndex = (currentIndex - 1 + images.length) % images.length;
                    updateModalImage();
                }
            });
        }
        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                if (images.length) {
                    currentIndex = (currentIndex + 1) % images.length;
                    updateModalImage();
                }
            });
        }
        
        // Zoom on click inside modal
        if (modalImg) {
            let zoomed = false;
            modalImg.addEventListener('click', function(e) {
                e.stopPropagation();
                zoomed = !zoomed;
                this.style.transform = zoomed ? 'scale(1.8)' : 'scale(1)';
                this.style.transition = 'transform 0.2s';
                this.style.cursor = zoomed ? 'zoom-out' : 'zoom-in';
            });
        }
    }
});