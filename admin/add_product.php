<?php
require '../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $club = $_POST['club_name'];
    $kit = $_POST['kit_type'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $stmt = $pdo->prepare("INSERT INTO products (club_name, kit_type, price, description, image)
                           VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$club, $kit, $price, $description, $image]);

    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet" href="/football-store/assets/style.css">
</head>
<body>

<header>Admin Panel</header>

<div class="navbar">
    <a href="dashboard.php">Dashboard</a>
    <a href="../logout.php">Logout</a>
</div>

<div class="container">
    <div class="product">
        <div class="product-info">
            <h2>Add Product</h2>

            <form method="POST">
                <input type="text" name="club_name" placeholder="Club Name" required><br><br>
                <input type="text" name="kit_type" placeholder="Kit Type" required><br><br>
                <input type="number" step="0.01" name="price" placeholder="Price" required><br><br>
                <textarea name="description" placeholder="Description"></textarea><br><br>
                <input type="text" name="image" placeholder="Image file name (ex: madrid.jpg)"><br><br>
                <button type="submit">Add Product</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>