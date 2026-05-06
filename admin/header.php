<?php require_once '../config.php'; require_once 'auth.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Admin Panel</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"><link rel="stylesheet" href="../assets/css/style.css"></head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container"><span class="navbar-brand">Kamal Marble Admin</span>
        <div><a href="index.php" class="btn btn-outline-light btn-sm">Dashboard</a> <a href="add_product.php" class="btn btn-outline-light btn-sm">Add Product</a> <a href="logout.php" class="btn btn-danger btn-sm">Logout</a></div>
    </div>
</nav>
<div class="container my-4">