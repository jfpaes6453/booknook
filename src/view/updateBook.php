<?php

use Controller\BookController;

require_once("c://xampp/htdocs/booknook/src/controller/BookController.php");
$data = new BookController();
$id = $_GET["id"];
$bookImage = $data->showBooksAndAuthors($_POST['id']);
$newBookImage = $_FILES['image']['tmp_name'];

if (!$newBookImage) {
    $image = $bookImage['image'];
} else {
    $image = file_get_contents($_FILES['image']['tmp_name']);
}

$data->editBook($id, $newData, $image);
