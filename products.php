<?php
require_once 'header.php';
require_once 'includes/functions.php';

$category = isset($_GET['category']) ? $_GET['category'] : 'All';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$products = readProducts($category !== 'All' ? $category : null, $search);
$categories = getAllCategories();
array_unshift($categories, 'All');
?>
<div class="container py-5">
    <h1 class="text-center mb-4">Our Marble Products</h1>
    
    <!-- Search & Filter Bar -->
    <div class="row mb-5">
        <div class="col-md-8 mx-auto">
            <form method="GET" class="d-flex flex-wrap gap-2">
                <input type="text" name="search" class="form-control flex-grow-1" placeholder="Search by name..." value="<?= htmlspecialchars($search) ?>">
                <select name="category" class="form-select w-auto">
                    <?php foreach($categories as $cat): ?>
                        <option value="<?= $cat ?>" <?= $category == $cat ? 'selected' : '' ?>><?= $cat ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="products.php" class="btn btn-secondary">Reset</a>
            </form>
        </div>
    </div>
    
    <!-- Products Grid -->
    <div class="row g-4">
        <?php if (empty($products)): ?>
            <div class="col-12 text-center"><p>No products found.</p></div>
        <?php else: ?>
            <?php foreach ($products as $product):
                $firstImg = !empty($product['images']) ? 'assets/images/products/product_' . $product['id'] . '/' . $product['images'][0] : 'https://via.placeholder.com/300x200?text=No+Image';
            ?>
            <div class="col-md-4 col-lg-3">
                <div class="card product-card h-100">
                    <a href="product-detail.php?id=<?= $product['id'] ?>">
                        <img src="<?= $firstImg ?>" class="card-img-top product-img" alt="<?= htmlspecialchars($product['name']) ?>">
                    </a>
                    <div class="card-body">
                        <a href="product-detail.php?id=<?= $product['id'] ?>" class="text-decoration-none text-dark">
                            <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                        </a>
                        <p class="card-text text-muted"><small><?= htmlspecialchars($product['category']) ?></small></p>
                        <p class="card-text text-primary fw-bold">$<?= number_format($product['price'], 2) ?></p>
                        <a href="product-detail.php?id=<?= $product['id'] ?>" class="btn btn-outline-primary w-100">View Details</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<?php require_once 'footer.php'; ?>