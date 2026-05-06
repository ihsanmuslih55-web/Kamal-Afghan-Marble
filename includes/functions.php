<?php
require_once __DIR__ . '/../config.php';

// ---------- Read products (frontend) ----------
function readProducts($category = null, $search = null) {
    global $pdo;
    $sql = "SELECT p.*, GROUP_CONCAT(pi.image_name) as images 
            FROM products p 
            LEFT JOIN product_images pi ON p.id = pi.product_id 
            WHERE 1=1";
    $params = [];
    if ($category && $category !== 'All') {
        $sql .= " AND p.category = ?";
        $params[] = $category;
    }
    if ($search) {
        $sql .= " AND p.name LIKE ?";
        $params[] = "%$search%";
    }
    $sql .= " GROUP BY p.id ORDER BY p.id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($products as &$product) {
        $product['images'] = $product['images'] ? explode(',', $product['images']) : [];
    }
    return $products;
}

// ---------- Admin search with price range ----------
function searchProductsAdmin($searchName = '', $category = '', $minPrice = '', $maxPrice = '') {
    global $pdo;
    $sql = "SELECT p.*, GROUP_CONCAT(pi.image_name) as images 
            FROM products p 
            LEFT JOIN product_images pi ON p.id = pi.product_id 
            WHERE 1=1";
    $params = [];
    
    if (!empty($searchName)) {
        $sql .= " AND p.name LIKE ?";
        $params[] = "%$searchName%";
    }
    if (!empty($category) && $category !== 'All') {
        $sql .= " AND p.category = ?";
        $params[] = $category;
    }
    if ($minPrice !== '' && is_numeric($minPrice)) {
        $sql .= " AND p.price >= ?";
        $params[] = (float)$minPrice;
    }
    if ($maxPrice !== '' && is_numeric($maxPrice)) {
        $sql .= " AND p.price <= ?";
        $params[] = (float)$maxPrice;
    }
    
    $sql .= " GROUP BY p.id ORDER BY p.id DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($products as &$product) {
        $product['images'] = $product['images'] ? explode(',', $product['images']) : [];
    }
    return $products;
}

// ---------- CRUD functions (unchanged) ----------
function getProductById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($product) {
        $stmt2 = $pdo->prepare("SELECT image_name FROM product_images WHERE product_id = ?");
        $stmt2->execute([$id]);
        $product['images'] = $stmt2->fetchAll(PDO::FETCH_COLUMN);
    }
    return $product;
}

function addProduct($name, $price, $category, $description, $images = []) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO products (name, price, category, description) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $price, $category, $description]);
    $productId = $pdo->lastInsertId();
    $dir = PRODUCT_IMAGES_DIR . 'product_' . $productId;
    if (!file_exists($dir)) mkdir($dir, 0755, true);
    foreach ($images as $img) {
        $stmt2 = $pdo->prepare("INSERT INTO product_images (product_id, image_name) VALUES (?, ?)");
        $stmt2->execute([$productId, $img]);
    }
    return $productId;
}

function updateProduct($id, $name, $price, $category, $description, $images = null) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE products SET name=?, price=?, category=?, description=? WHERE id=?");
    $stmt->execute([$name, $price, $category, $description, $id]);
    if ($images !== null) {
        $stmt2 = $pdo->prepare("SELECT image_name FROM product_images WHERE product_id = ?");
        $stmt2->execute([$id]);
        $old = $stmt2->fetchAll(PDO::FETCH_COLUMN);
        foreach ($old as $img) {
            @unlink(PRODUCT_IMAGES_DIR . 'product_' . $id . '/' . $img);
        }
        $stmt3 = $pdo->prepare("DELETE FROM product_images WHERE product_id = ?");
        $stmt3->execute([$id]);
        foreach ($images as $img) {
            $stmt4 = $pdo->prepare("INSERT INTO product_images (product_id, image_name) VALUES (?, ?)");
            $stmt4->execute([$id, $img]);
        }
    }
}

function deleteProduct($id) {
    global $pdo;
    $dir = PRODUCT_IMAGES_DIR . 'product_' . $id;
    if (is_dir($dir)) {
        array_map('unlink', glob("$dir/*.*"));
        rmdir($dir);
    }
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
}

function uploadProductImages($productId, $files) {
    $uploaded = [];
    $targetDir = PRODUCT_IMAGES_DIR . 'product_' . $productId . '/';
    if (!file_exists($targetDir)) mkdir($targetDir, 0755, true);
    foreach ($files['tmp_name'] as $key => $tmpName) {
        if ($files['error'][$key] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($files['name'][$key], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (in_array($ext, $allowed)) {
                $newName = time() . '_' . uniqid() . '.' . $ext;
                if (move_uploaded_file($tmpName, $targetDir . $newName)) {
                    $uploaded[] = $newName;
                }
            }
        }
    }
    return $uploaded;
}

function deleteImageFile($productId, $imageName) {
    $path = PRODUCT_IMAGES_DIR . 'product_' . $productId . '/' . $imageName;
    if (file_exists($path)) {
        unlink($path);
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM product_images WHERE product_id = ? AND image_name = ?");
        $stmt->execute([$productId, $imageName]);
        return true;
    }
    return false;
}

function getProductImages($productId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT image_name FROM product_images WHERE product_id = ?");
    $stmt->execute([$productId]);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

function getAllCategories() {
    global $pdo;
    $stmt = $pdo->query("SELECT DISTINCT category FROM products ORDER BY category");
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}
?>