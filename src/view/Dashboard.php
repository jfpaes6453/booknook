<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
    exit();
}

echo "<h1>" . htmlspecialchars($_SESSION['email']) . " logged-in</h1>";

echo '<p><a href="../controller/LogoutController.php">Logout</a></p>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <p>a page that only the admin can access, logout button needs styles</p>
</body>
</html>