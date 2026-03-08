<?php
require '../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

include '../includes/header.php';
?>

<div class="container">
    <h2>Admin Dashboard</h2>

    <a href="add_product.php"><button>Add Product</button></a>
    <a href="dashboard.php?view=products"><button>Manage Products</button></a>

    <hr>

<?php
if (isset($_GET['view']) && $_GET['view'] == "products") {

    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll();

    foreach ($products as $product) {
        echo "<div class='product'>";
        echo "<div class='product-info'>";
        echo "<h3>".$product['club_name']."</h3>";
        echo "<p>".$product['kit_type']."</p>";
        echo "<p class='price'>$".$product['price']."</p>";
        echo "<a href='edit_product.php?id=".$product['id']."'>Edit</a> | ";
        echo "<a href='delete_product.php?id=".$product['id']."'>Delete</a>";
        echo "</div></div>";
    }
}
?>

</div>

<?php include '../includes/footer.php'; ?>