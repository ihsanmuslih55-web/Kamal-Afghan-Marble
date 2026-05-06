<?php require_once '../config.php'; require_once '../includes/functions.php';
if (!isset($_SESSION['admin_logged_in'])) { header('Location: login.php'); exit; }
$id = $_GET['id'] ?? 0;
deleteProduct($id);
header('Location: index.php');