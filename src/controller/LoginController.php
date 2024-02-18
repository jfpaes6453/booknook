<?php

require_once __DIR__ . '/../../vendor/autoload.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

require_once __DIR__ . '/../../config/Database.php'; 
require_once __DIR__ . '/../model/UserModel.php'; 

use Config\Database;

$db = new Database();
$conn = $db->connection();

$userModel = new UserModel($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $user = $userModel->authenticateUser($email, $password);

    if ($user !== false) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        header("Location: ../view/Dashboard.php");
        exit();
    } else {
        $_SESSION['error'] = 'Invalid email or password.';
        include __DIR__ . '/../view/Login.php'; 
        exit();
    }
} else {
    header("Location: ../../index.php");
    exit();
}
?>
