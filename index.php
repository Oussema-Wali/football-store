<?php
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'includes/header.php';
?>

<div class="container">
    <h2> Welcome <?php echo $_SESSION['user_name']; ?> ! </h2>
    <p> Browse the latest football kits collection. </p>
</div>

<?php include 'includes/footer.php'; ?>