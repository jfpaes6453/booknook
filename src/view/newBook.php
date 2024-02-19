<?php

use Controller\BookController;

require_once("c://xampp/htdocs/booknook/src/controller/BookController.php");
$data = new BookController();

$newData = [];
$newData["title"] = $_POST["title"];
$newData["author_name"] = $_POST["author_name"];
$newData["author_last_name"] = $_POST["last_name"];
$newData["genre"] = $_POST["genre"];
$newData["description"] = $_POST["description"];
$newData["isbn"] = $_POST["isbn"];






$image = file_get_contents($_FILES['image']['tmp_name']);


$data->insertBook($newData, $image);
