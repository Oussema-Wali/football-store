<?php
require_once __DIR__ . '/../config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Elite Football Kits</title>
    <link rel="stylesheet" href="/football-store/assets/style.css">
</head>
<body>

<header>Elite Football Kits</header>

<div class="navbar">
    <?php if(isset($_SESSION['user_id'])): ?>
        <a href="/football-store/index.php">Home</a>
        <a href="/football-store/products.php">Products</a>
        <a href="/football-store/profile.php">Profile</a>

        <?php if($_SESSION['role'] == 'admin'): ?>
            <a href="/football-store/admin/dashboard.php">Admin</a>
        <?php endif; ?>

        <a href="/football-store/logout.php">Logout</a>
    <?php else: ?>
        <a href="/football-store/login.php">Login</a>
        <a href="/football-store/register.php">Register</a>
        
    <?php endif; ?>
</div>