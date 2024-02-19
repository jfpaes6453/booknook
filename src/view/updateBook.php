<?php

use Controller\BookController;

require_once("c://xampp/htdocs/booknook/src/controller/BookController.php");
$data = new BookController();
$id = $_POST["id"];


$newData = [];
$newData["title"] = $_POST["title"];
$newData["author_name"] = $_POST["author_name"];
$newData["author_last_name"] = $_POST["last_name"];
$newData["genre"] = $_POST["genre"];
$newData["description"] = $_POST["description"];
$newData["isbn"] = $_POST["isbn"];




$bookImage = $data->showBooksAndAuthors($_POST['id']);
$newBookImage = $_FILES['image']['tmp_name'];

if (!$newBookImage) {
    $image = $bookImage['image'];
} else {
    $image = file_get_contents($_FILES['image']['tmp_name']);
}

$data->editBook($id, $newData, $image);
