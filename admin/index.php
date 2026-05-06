<?php 
require_once 'header.php'; 
require_once '../includes/functions.php'; 

// Get filter values from URL
$searchName = isset($_GET['search_name']) ? trim($_GET['search_name']) : '';
$category   = isset($_GET['category']) ? $_GET['category'] : 'All';
$minPrice   = isset($_GET['min_price']) ? trim($_GET['min_price']) : '';
$maxPrice   = isset($_GET['max_price']) ? trim($_GET['max_price']) : '';

// Get filtered products using the dedicated admin search function
$products = searchProductsAdmin($searchName, $category, $minPrice, $maxPrice);
$allCategories = getAllCategories();
array_unshift($allCategories, 'All');
?>

<h2>Manage Products</h2>
<a href="add_product.php" class="btn btn-primary mb-3">Add New Product</a>

<!-- Search / Filter Form -->
<div class="card mb-4">
    <div class="card-header bg-light">
        <strong>Search & Filter Products</strong>
    </div>
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Product Name</label>
                <input type="text" name="search_name" class="form-control" placeholder="Search by name..." value="<?= htmlspecialchars($searchName) ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label">Category</label>
                <select name="category" class="form-select">
                    <?php foreach($allCategories as $cat): ?>
                        <option value="<?= $cat ?>" <?= $category == $cat ? 'selected' : '' ?>><?= $cat ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Min Price ($)</label>
                <input type="number" step="0.01" name="min_price" class="form-control" placeholder="Min" value="<?= htmlspecialchars($minPrice) ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label">Max Price ($)</label>
                <input type="number" step="0.01" name="max_price" class="form-control" placeholder="Max" value="<?= htmlspecialchars($maxPrice) ?>">
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary flex-fill">Filter</button>
                <a href="index.php" class="btn btn-secondary btn-sm">Reset Filters</a>
            </div>
        </form>
    </div>
</div>

<!-- Products Table -->
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Images Count</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($products)): ?>
                <tr><td colspan="7" class="text-center">No products found matching your criteria.</td></tr>
            <?php else: ?>
                <?php foreach($products as $p): 
                    $firstImage = !empty($p['images']) && is_array($p['images']) && count($p['images']) > 0 
                        ? '../assets/images/products/product_' . $p['id'] . '/' . $p['images'][0] 
                        : 'https://via.placeholder.com/50?text=No+Image';
                ?>
                <tr>
                    <td><?= (int)$p['id'] ?></td>
                    <td><img src="<?= $firstImage ?>" width="50" height="50" style="object-fit:cover; border-radius:4px;"></td>
                    <td><?= htmlspecialchars($p['name']) ?></td>
                    <td><?= htmlspecialchars($p['category'] ?? 'Uncategorized') ?></td>
                    <td>
                        <?php if (!empty($p['price']) && $p['price'] > 0): ?>
                            $<?= number_format($p['price'], 2) ?>
                        <?php else: ?>
                            <span class="text-muted">Price on request</span>
                        <?php endif; ?>
                    </td>
                    <td><?= is_array($p['images']) ? count($p['images']) : 0 ?></td>
                    <td>
                        <a href="edit_product.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="delete_product.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once 'footer.php'; ?>