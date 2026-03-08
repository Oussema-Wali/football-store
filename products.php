<?php
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buy'])) {

    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];

    $stmt = $pdo->prepare("INSERT INTO orders (user_id, product_id) VALUES (?, ?)");
    $stmt->execute([$user_id, $product_id]);

    $success = "Order confirmed successfully!";
}

$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll();

include 'includes/header.php';
?>

<?php if (isset($success)): ?>
    <p style="color:green; text-align:center;"><?php echo $success; ?></p>
<?php endif; ?>

<div class="container">

    <?php if (count($products) == 0): ?>
        <p>No products available.</p>
    <?php else: ?>

        <?php foreach ($products as $product): ?>
            <div class="product">
                <img src="assets/images/<?php echo $product['image']; ?>" alt="">
                <div class="product-info">
                    <h3><?php echo $product['club_name']; ?></h3>
                    <p><?php echo $product['kit_type']; ?></p>
                    <p class="price">$<?php echo $product['price']; ?></p>

                    <form method="POST" style="margin-top:10px;">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit" name="buy">Buy Now</button>
                    </form>

                </div>
            </div>
        <?php endforeach; ?>

    <?php endif; ?>

</div>

<?php include 'includes/footer.php'; ?>