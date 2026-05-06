<?php require_once '../config.php'; require_once '../includes/functions.php';
if (!isset($_SESSION['admin_logged_in'])) { header('Location: login.php'); exit; }
$product_id = $_GET['product_id'] ?? 0;
$image = $_GET['image'] ?? '';
if ($product_id && $image) deleteImageFile($product_id, $image);
header('Location: edit_product.php?id=' . $product_id);