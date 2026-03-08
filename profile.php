<?php
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];

    // Update name & email
    $update = $pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
    $update->execute([$name, $email, $user_id]);

    $_SESSION['user_name'] = $name;

    // PASSWORD CHANGE SECTION
    if (!empty($_POST['current_password']) && !empty($_POST['new_password'])) {

        if (password_verify($_POST['current_password'], $user['password'])) {

            $newPasswordHash = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

            $passUpdate = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $passUpdate->execute([$newPasswordHash, $user_id]);

            $message = "Password updated successfully.";
        } else {
            $message = "Current password is incorrect.";
        }
    }

    header("Location: profile.php");
    exit();
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="/football-store/assets/style.css">
</head>

<body>

    <header>Elite Football Kits</header>

    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="products.php">Products</a>
        <a href="profile.php">Profile</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="container">
        <div class="product">
            <div class="product-info">
                <h2>My Profile</h2>

                <form method="POST">
                    <input type="text" name="name" value="<?php echo $user['name']; ?>" required><br><br>
                    <input type="email" name="email" value="<?php echo $user['email']; ?>" required><br><br>

                    <h3>Change Password</h3>

                    <input type="password" name="current_password" placeholder="Current Password"><br><br>
                    <input type="password" name="new_password" placeholder="New Password"><br><br>

                    <button type="submit">Update Profile</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>