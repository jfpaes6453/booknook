<?php

use Controller\BookController;

require_once __DIR__ . '/vendor/autoload.php';
require_once("c://xampp/htdocs/booknook/src/controller/BookController.php");
$data = new BookController;
$booksData = $data->getBooksAndAuthors();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./src/resources/css/base.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>
    <?php if ($booksData) : ?>
        <section>
            <?php foreach ($booksData as $bookData) : ?>
                <div>
                    <picture>
                        <img src="data:image/jpg; base64, <?= base64_encode($bookData['image']) ?>" alt="<?= $bookData["title"] ?>" class="w-[10rem] h-[40rem]">
                    </picture>
                    <div>
                        <h5><?= strtoupper("{$bookData['name']} {$bookData['last_name']}") ?></h5>
                        <h5><?= $bookData["title"] ?></h5>
                        <p>ISBN: <?= $bookData["isbn"] ?></p>
                    </div>
                    <div>
                        <a href="">Edit</a>
                        <a href="src/view/detailsBook.php?id=<?= $bookData["id"] ?>">Read more...</a>
                        <a href=""></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>
    z
</body>

</html>