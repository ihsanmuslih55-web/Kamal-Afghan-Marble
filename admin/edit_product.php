<?php require_once 'header.php'; require_once '../includes/functions.php';
$id = $_GET['id'] ?? 0;
$product = getProductById($id);
if(!$product) { header('Location: index.php'); exit; }
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    updateProduct($id, $_POST['name'], $_POST['price'], $_POST['category'], $_POST['description'], $product['images']);
    if(!empty($_FILES['new_images']['name'][0])) {
        $new = uploadProductImages($id, $_FILES['new_images']);
        $all = array_merge($product['images'], $new);
        updateProduct($id, $_POST['name'], $_POST['price'], $_POST['category'], $_POST['description'], $all);
    }
    header('Location: index.php'); exit;
}
$categories = ['Grade A', 'Grade B', 'Grade C', 'Grade D', 'Premium', 'Standard'];
?>
<h2>Edit Product</h2>
<form method="POST" enctype="multipart/form-data">
    <div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required></div>
    <div class="mb-3"><label>Price</label><input type="number" step="0.01" name="price" class="form-control" value="<?= $product['price'] ?>" required></div>
    <div class="mb-3">
        <label>Category</label>
        <select name="category" class="form-select" required>
            <?php foreach($categories as $cat): ?>
                <option value="<?= $cat ?>" <?= $product['category'] == $cat ? 'selected' : '' ?>><?= $cat ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3"><label>Description</label><textarea name="description" rows="4" class="form-control"><?= htmlspecialchars($product['description']) ?></textarea></div>
    <div class="mb-3"><label>Existing Images</label><div class="d-flex flex-wrap"><?php foreach($product['images'] as $img): ?><div class="m-2 text-center"><img src="../assets/images/products/product_<?= $id ?>/<?= $img ?>" width="80"><br><a href="delete_image.php?product_id=<?= $id ?>&image=<?= urlencode($img) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</a></div><?php endforeach; ?></div></div>
    <div class="mb-3"><label>Add New Images</label><input type="file" name="new_images[]" class="form-control" multiple accept="image/*"></div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-secondary">Cancel</a>
</form>
<?php require_once 'footer.php'; ?>