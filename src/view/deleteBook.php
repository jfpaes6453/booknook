<?php

use Controller\BookController;

require_once("c://xampp/htdocs/booknook/src/controller/BookController.php");
$data = new BookController();
$book = $data->deleteBook($_GET["id"]);
