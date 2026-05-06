<?php
require_once 'header.php';
require_once 'includes/functions.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$product = getProductById($id);

if (!$product) {
    echo '<div class="container py-5"><div class="alert alert-danger">Product not found.</div></div>';
    require_once 'footer.php';
    exit;
}

$images = $product['images'];
$mainImg = !empty($images) ? $images[0] : 'placeholder.jpg';
$imageBase = 'assets/images/products/product_' . $product['id'] . '/';
$fullImages = array_map(fn($img) => $imageBase . $img, $images);
?>

<div class="container py-5">
    <div class="row">
        <!-- Left: Gallery -->
        <div class="col-md-6">
            <!-- Main clickable image -->
            <img id="mainProductImage" src="<?= $imageBase . $mainImg ?>" 
                 class="img-fluid rounded shadow mb-3" 
                 alt="<?= htmlspecialchars($product['name']) ?>"
                 style="cursor: pointer; width: 100%; object-fit: cover;"
                 data-bs-toggle="modal" data-bs-target="#productGalleryModal">
            
            <!-- Thumbnails row -->
            <div class="d-flex gap-2 flex-wrap mt-3" id="thumbnailRow">
                <?php foreach ($images as $idx => $img): ?>
                    <img src="<?= $imageBase . $img ?>" 
                         class="gallery-thumb" 
                         data-full="<?= $imageBase . $img ?>" 
                         style="width: 80px; height: 80px; object-fit: cover; cursor: pointer; border: 2px solid <?= $idx === 0 ? '#c19a6b' : '#ddd' ?>; border-radius: 8px;">
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Right: Product Info -->
        <div class="col-md-6">
            <h1><?= htmlspecialchars($product['name']) ?></h1>
            <h3 class="text-primary">$<?= number_format($product['price'], 2) ?></h3>
            <div class="mt-4">
                <h5>Description</h5>
                <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
            </div>
            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#productGalleryModal">
                <i class="fas fa-expand"></i> View Full Gallery
            </button>
        </div>
    </div>
</div>

<!-- Modal Gallery (Bootstrap 5) -->
<div class="modal fade" id="productGalleryModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-header border-0">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" style="max-height: 70vh; cursor: pointer; transition: transform 0.2s;">
                <div class="mt-3">
                    <button id="prevImage" class="btn btn-light me-2"><i class="fas fa-chevron-left"></i> Prev</button>
                    <button id="nextImage" class="btn btn-light">Next <i class="fas fa-chevron-right"></i></button>
                </div>
                <div id="modalThumbnails" class="d-flex justify-content-center flex-wrap mt-3"></div>
            </div>
        </div>
    </div>
</div>

<script>
// Inline script to ensure gallery works without external gallery.js issues
(function() {
    // Thumbnail click switching
    const thumbs = document.querySelectorAll('.gallery-thumb');
    const mainImg = document.getElementById('mainProductImage');
    if (thumbs.length && mainImg) {
        thumbs.forEach(thumb => {
            thumb.addEventListener('click', function(e) {
                e.stopPropagation();
                const full = this.getAttribute('data-full');
                mainImg.src = full;
                thumbs.forEach(t => t.style.borderColor = '#ddd');
                this.style.borderColor = '#c19a6b';
            });
        });
    }

    // Modal logic
    const modalEl = document.getElementById('productGalleryModal');
    if (modalEl) {
        let images = <?= json_encode($fullImages) ?>;
        let currentIndex = 0;
        const modalImg = document.getElementById('modalImage');
        const prevBtn = document.getElementById('prevImage');
        const nextBtn = document.getElementById('nextImage');
        const modalThumbs = document.getElementById('modalThumbnails');

        function updateModalImage() {
            if (images.length) {
                modalImg.src = images[currentIndex];
                // Zoom reset when changing image
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

        modalEl.addEventListener('show.bs.modal', function() {
            // Find current main image index
            const currentMain = mainImg ? mainImg.src : '';
            currentIndex = images.findIndex(img => img === currentMain);
            if (currentIndex === -1) currentIndex = 0;
            buildModalThumbs();
            updateModalImage();
        });

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
        let zoomed = false;
        if (modalImg) {
            modalImg.addEventListener('click', function(e) {
                e.stopPropagation();
                zoomed = !zoomed;
                this.style.transform = zoomed ? 'scale(1.8)' : 'scale(1)';
                this.style.cursor = zoomed ? 'zoom-out' : 'zoom-in';
            });
        }
    }
})();
</script>

<?php require_once 'footer.php'; ?>