<?php

use Controller\BookController;

require_once("c://xampp/htdocs/booknook/src/view/head/header.php");
require_once("c://xampp/htdocs/booknook/src/controller/BookController.php");
$data = new BookController();
$id = $_GET["id"];
$book = $data->showBooksAndAuthors($id);
?>
<section class="relative">
    <section class=" flex px-[12rem] pt-[8rem] h-[58rem]" style="background-image: url('http://localhost/booknook/src/resources/img/bg-left.png'), url('http://localhost/booknook/src/resources/img/bg-rigth.png'); background-size: contain; background-repeat:no-repeat, no-repeat; background-position: left, right; ">
        <div class="basis-[45%]">
            <img src="data:image/jpg; base64,<?= base64_encode($book['image_details']) ?>" class="w-full]" alt="<?= $book["title"] ?>">
        </div>
        <div class="basis-[55%]">
            <h1 class="text-[2rem] font-bold mt-[4rem]"><?= $book["title"] ?></h1>
            <p class="text-[1.1rem] font-semibold mb-[1rem]">ISBN <?= $book["isbn"] ?> | Genders:<?= $book["genre"] ?> </p>
            <p class="text-[1.1rem] font-semibold mb-[1.5rem] ">By: <span class="text-[1.1rem] underline"><?= "{$book['name']} {$book['last_name']}" ?></span> </p>
            <h4 class="text-[1.1rem] font-bold mb-[1.5rem] text-[#FF621E] inline-block border-b-[0.2rem] border-[#FF621E] leading-[2rem]">DESCRIPTION</h4>
            <p class="text-[1rem]"><?= $book["description"] ?></p>
        </div>
    </section>
    <div class="absolute bottom-0 w-full">
        <?php
        require_once("c://xampp/htdocs/booknook/src/view/head/footer.php");
        ?>
    </div>
</section>