<?php
require '../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $club = $_POST['club_name'];
    $kit = $_POST['kit_type'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $stmt = $pdo->prepare("UPDATE products
                           SET club_name=?, kit_type=?, price=?, description=?, image=?
                           WHERE id=?");
    $stmt->execute([$club, $kit, $price, $description, $image, $id]);

    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
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
            <h2>Edit Product</h2>

            <form method="POST">
                <input type="text" name="club_name" value="<?php echo $product['club_name']; ?>" required><br><br>
                <input type="text" name="kit_type" value="<?php echo $product['kit_type']; ?>" required><br><br>
                <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required><br><br>
                <textarea name="description"><?php echo $product['description']; ?></textarea><br><br>
                <input type="text" name="image" value="<?php echo $product['image']; ?>"><br><br>
                <button type="submit">Update Product</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>