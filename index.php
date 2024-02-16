<?php

require_once 'vendor/autoload.php';

use Config\Database;

$database = new Database();

$connection = $database->connection();

if ($connection instanceof PDO) {
    echo "Connect.";
    
} else {
    echo "Error: " . $connection;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="./src/css/styles.css" rel="stylesheet"> -->
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>
    <h1 class="bg-black">hola</h1>

</body>

</html>