<?php
session_start();

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');        // Change if needed
define('DB_PASS', '');            // Your MySQL password
define('DB_NAME', 'Kamal_Afghan_Marble');

// Admin credentials
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'admin123');

// Paths
define('PRODUCT_IMAGES_DIR', __DIR__ . '/assets/images/products/');

if (!file_exists(PRODUCT_IMAGES_DIR)) mkdir(PRODUCT_IMAGES_DIR, 0755, true);

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

?>