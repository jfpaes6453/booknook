<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../vendor/autoload.php';
require_once("c://xampp/htdocs/booknook/src/model/UserModel.php");

use Model\UserModel;

$userModel = new UserModel();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $user = $userModel->authenticateUser($email, $password);

    if ($user !== false) {
        // El usuario se autenticó correctamente, establecer variables de sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];

        // Redirigir al usuario a la página principal
        header("Location: /booknook/index.php");
        exit();
    } else {
        // Credenciales inválidas, mostrar mensaje de error y volver a la página de inicio de sesión
        $_SESSION['error'] = 'Invalid email or password.';
        header("Location: /booknook/index.php");
        exit();
    }
} else {
    // Redirigir a la página de inicio si se intenta acceder directamente a este script sin enviar datos de formulario
    header("Location: /booknook/index.php");
    exit();
}
