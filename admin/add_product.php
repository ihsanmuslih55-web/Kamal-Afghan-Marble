<?php require_once 'header.php'; require_once '../includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = addProduct($_POST['name'], $_POST['price'], $_POST['category'], $_POST['description']);
    if (!empty($_FILES['images']['name'][0])) {
        $uploaded = uploadProductImages($id, $_FILES['images']);
        updateProduct($id, $_POST['name'], $_POST['price'], $_POST['category'], $_POST['description'], $uploaded);
    }
    header('Location: index.php'); exit;
}
$categories = ['Grade A', 'Grade B', 'Grade C', 'Grade D', 'Premium', 'Standard'];
?>
<h2>Add Product</h2>
<form method="POST" enctype="multipart/form-data">
    <div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control" required></div>
    <div class="mb-3"><label>Price ($)</label><input type="number" step="0.01" name="price" class="form-control" required></div>
    <div class="mb-3">
        <label>Category</label>
        <select name="category" class="form-select" required>
            <option value="">Select Category</option>
            <?php foreach($categories as $cat): ?>
                <option value="<?= $cat ?>"><?= $cat ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3"><label>Description</label><textarea name="description" rows="4" class="form-control"></textarea></div>
    <div class="mb-3"><label>Images (multiple)</label><input type="file" name="images[]" class="form-control" multiple accept="image/*"></div>
    <button type="submit" class="btn btn-primary">Add</button>
    <a href="index.php" class="btn btn-secondary">Cancel</a>
</form>
<?php require_once 'footer.php'; ?>