<?php require_once 'header.php'; ?>
<?php require_once 'includes/functions.php'; 
$products = readProducts();
$featured = array_slice($products, 0, 6); // Show first 6 on homepage
?>

<!-- Hero Section with Multi‑image Background per Slide -->
<section class="hero">
    <div class="hero-slider">
        <!-- Slide 1 - Home & Living Marbles -->
        <div class="slide active">
            <div class="slide-bg-grid">
                <img src="assets/images/using-marble-samples-lose-yourself-luxuriance-generative-ai_722401-32441.jpg" alt="Marble">
                <img src="assets/images/pexels-stone-dimensions-2159407455-36499164.jpg" alt="Marble">
                <img src="assets/images/pexels-readymade-3847502.jpg" alt="Marble">
                <img src="assets/images/pexels-mikhail-nilov-7828541.jpg" alt="Marble">
            </div>
            <div class="slide-content">
                <h2>Beautiful Marble for Homes and Projects</h2>
                <p>Top-quality marble, granite, onyx, and natural stones — perfect for flooring, walls, kitchens, delivered worldwide.</p>
                <a href="products.php" class="btn-primary">View Collection</a>
            </div>
        </div>

        <!-- Slide 2 - New Arrivals -->
        <div class="slide">
            <div class="slide-bg-grid">
                <img src="assets/images/using-marble-samples-lose-yourself-luxuriance-generative-ai_722401-32441.jpg" alt="New Marble">
                <img src="assets/images/pexels-stone-dimensions-2159407455-36499164.jpg" alt="New Marble">
                <img src="assets/images/pexels-readymade-3847502.jpg" alt="New Marble">
                <img src="assets/images/pexels-mikhail-nilov-7828541.jpg" alt="New Marble">
            </div>
            <div class="slide-content">
                <h2>New Arrival Collection</h2>
                <p>Limited time offers on premium marble varieties. Check out our current deals for bulk orders.</p>
                <a href="products.php" class="btn-primary">Shop Now</a>
            </div>
        </div>

        <!-- Slide 3 - Export Quality -->
        <div class="slide">
            <div class="slide-bg-grid">
                <img src="assets/images/using-marble-samples-lose-yourself-luxuriance-generative-ai_722401-32441.jpg" alt="Export Marble">
                <img src="assets/images/pexels-stone-dimensions-2159407455-36499164.jpg" alt="Export Marble">
                <img src="assets/images/pexels-readymade-3847502.jpg" alt="Export Marble">
                <img src="assets/images/pexels-mikhail-nilov-7828541.jpg" alt="Export Marble">
            </div>
            <div class="slide-content">
                <h2>Export Quality Marble</h2>
                <p>Exporting premium quality marble products worldwide with commitment to excellence.</p>
                <a href="contact.php" class="btn-primary">Contact Us</a>
            </div>
        </div>
    </div>

    <div class="slider-controls">
        <button class="prev-slide"><i class="fas fa-chevron-left"></i></button>
        <button class="next-slide"><i class="fas fa-chevron-right"></i></button>
    </div>
    <div class="slider-dots">
        <span class="dot active"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>
</section>

<!-- Features Section -->
<section class="features">
    <div class="container">
        <h2 class="section-title">Why Choose Us</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-gem"></i></div>
                <h3>Best Quality</h3>
                <p>Sourced from finest quarries worldwide with stringent quality checks</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-shipping-fast"></i></div>
                <h3>Fast Delivery</h3>
                <p>Timely delivery worldwide with secure packaging and tracking</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                <h3>Trusted Warranty</h3>
                <p>Comprehensive warranty on all our products for your peace of mind</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-headset"></i></div>
                <h3>Customer Support</h3>
                <p>24/7 customer support for all your queries and assistance</p>
            </div>
        </div>
    </div>
</section>

<!-- Welcome Section -->
<section class="welcome">
    <div class="container">
        <div class="welcome-content">
            <h2 class="section-title">Welcome to Kamal Afghan Marbles</h2>
            <p>Welcome to Kamal Afghan Marbles, a subsidiary of Total Sales & Services (Pvt) Limited, which was founded to establish a reputation as a leading marble supplier across the globe! We are thrilled to showcase our stunning collection of premium quality marble products, which we are proud to export to countries around the world.</p>
            <p>Our commitment to excellence is evident in every piece of marble we offer. From classic to contemporary, our diverse selection of marble slabs, tiles, and accessories is sure to elevate any interior or exterior space.</p>
            <p>We source our marble from the finest quarries around the world, ensuring that each piece is of the highest quality. At our company, we believe in providing exceptional customer service, and we strive to build long-lasting relationships with our clients.</p>
            <a href="about.php" class="btn-secondary">Learn More About Us</a>
        </div>
        <div class="welcome-image">
            <img src="assets/images/pexels-stone-dimensions-2159407455-36499164.jpg" alt="Marble Showcase">
        </div>
    </div>
</section>

<!-- Applications Section -->
<section class="applications">
    <div class="container">
        <h2 class="section-title">What We Do with Stones?</h2>
        <div class="applications-grid">
            <div class="app-card">
                <div class="app-icon"><i class="fas fa-industry"></i></div>
                <h3>Workshops & Studios</h3>
                <p>Strong and smooth surfaces — great for heavy work and creative spaces.</p>
            </div>
            <div class="app-card">
                <div class="app-icon"><i class="fas fa-layer-group"></i></div>
                <h3>Floors</h3>
                <p>Marble floors give a clean and beautiful look that lasts for years.</p>
            </div>
            <div class="app-card">
                <div class="app-icon"><i class="fas fa-border-all"></i></div>
                <h3>Walls</h3>
                <p>Marble walls add luxury and shine to both homes and offices.</p>
            </div>
        </div>
    </div>
</section>

<!-- Products Preview (Dynamic from JSON) -->
<section class="products-preview">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Our Products</h2>
            <p>Kamal Afghan Marbles is a leading marble supplier in Afghanistan, dealing in a wide range of Afghani marble, onyx, and marble stone products. Each piece is carefully customized to meet your design requirements.</p>
        </div>
        <div class="products-grid" id="productsGrid">
            <?php if(empty($featured)): ?>
                <p class="text-center">No products available yet. Check back soon!</p>
            <?php else: ?>
                <?php foreach($featured as $product):
                    $firstImg = !empty($product['images']) ? 'assets/images/products/product_' . $product['id'] . '/' . $product['images'][0] : 'https://via.placeholder.com/300x200?text=No+Image';
                ?>
                <div class="product-card">
                    <div class="product-img">
                        <img src="<?= $firstImg ?>" alt="<?= $product['name'] ?>">
                    </div>
                    <div class="product-info">
                        <h3><?= $product['name'] ?></h3>
                        <p><?= substr($product['description'], 0, 80) ?>...</p>
                        <div class="product-price">$<?= number_format($product['price'], 2) ?></div>
                        <a href="product-detail.php?id=<?= $product['id'] ?>" class="btn-primary" style="margin-top:10px; display:inline-block;">View Details</a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="text-center">
            <a href="products.php" class="btn-primary">View All Products</a>
        </div>
    </div>
</section>

<!-- Clients Section -->
<section class="clients">
    <div class="container">
        <h2 class="section-title">Our Clients</h2>
        <div class="clients-slider">
            <div class="client-logo"><img src="assets/images/7.JPG" alt="Client 1"></div>
            <div class="client-logo"><img src="assets/images/IMG_6642.JPG" alt="Client 2"></div>
            <div class="client-logo"><img src="assets/images/IMG_6693.JPG" alt="Client 3"></div>
            <div class="client-logo"><img src="assets/images/6.JPG" alt="Client 4"></div>
            <div class="client-logo"><img src="assets/images/IMG_6635.JPG" alt="Client 5"></div>
        </div>
    </div>
</section>

<!-- Newsletter -->
<section class="newsletter">
    <div class="container">
        <div class="newsletter-content">
            <h2>Subscribe to Fresh Newsletter</h2>
            <p>Get updates on new arrivals, exclusive offers, and marble trends</p>
            <form id="newsletterForm">
                <input type="email" placeholder="Enter your email address" required>
                <button type="submit" class="btn-primary">Subscribe</button>
            </form>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq">
    <div class="container">
        <h2 class="section-title">Frequently Asked Questions</h2>
        <div class="faq-container">
            <div class="faq-item">
                <div class="faq-question">
                    <h3>What types of marble do you offer?</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>We offer a wide range of marble including Afghani marble, Italian marble, onyx, granite, and natural stones in various colors, patterns, and finishes suitable for flooring, countertops, and wall cladding.</p>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Do you provide international shipping?</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Yes, we export our premium marble products worldwide with secure packaging and reliable logistics partners to ensure safe and timely delivery.</p>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Can I get customized marble designs?</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Absolutely! We specialize in customizing marble pieces according to your design requirements, dimensions, and finish preferences.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'footer.php'; ?>