<?php

use Controller\BookController;

require_once __DIR__ . '/vendor/autoload.php';
require_once("src/view/components/header.php");
require_once("c://xampp/htdocs/booknook/src/controller/BookController.php");
$data = new BookController;
$booksData = $data->getBooksAndAuthors();
?>
<section class="bg-[url('./src/resources/img/banner-2.svg')] bg-no-repeat bg-bottom bg-cover w-full h-[25rem] flex items-center">
    <div class="text-center basis-[70%]">
        <h1 class="font-['Nunito Sans'] text-[3.5rem] font-bold leading-[3rem]">Welcome to Booknook.</h1>
        <p class="font-['Nunito Sans'] text-[2.2rem] font-bold">your ultimate virtual library haven.</p>
    </div>
    <div class="basis-[30%]"></div>
</section>
<?php if ($booksData) : ?>
    <section class="flex flex-col items-center py-[4rem] px-24">
        <div class="flex flex-col items-center mb-[3rem]">
            <h2 class="font-['Nunito Sans'] text-[1.5rem] font-bold">ALL BOOKS</h2>
            <span class="pt-[0.5rem] border-b-4 border-[#FF621E] w-[05rem] block"></span>
        </div>
        <div class="flex gap-[3rem] flex-wrap justify-center">
            <?php foreach ($booksData as $bookData) : ?>
                <div class="basis-[22%]">
                    <picture>
                        <img src="data:image/jpg; base64, <?= base64_encode($bookData['image']) ?>" alt="<?= $bookData["title"] ?>" class=" h-[28rem]">
                    </picture>
                    <div class="flex flex-col items-center pt-[1rem]">
                        <h5 class="text-[1.1rem] font-bold"><?= strtoupper("{$bookData['name']} {$bookData['last_name']}") ?></h5>
                        <h5 class="text-[1.1rem] font-bold text-[#FF621E]"><?= $bookData["title"] ?></h5>
                        <p class="text-[1rem] font-semibold">ISBN: <?= $bookData["isbn"] ?></p>
                        <div class="w-full pt-[1rem] px-[0.5rem] flex gap-[1rem] items-center">
                            <a href="" class="basis-[43%] bg-[#FED78C] rounded text-center py-[0.3rem] text-[1rem] text-[#686868] font-bold">Edit</a>
                            <a href="src/view/detailsBook.php?id=<?= $bookData["id"] ?>" class="basis-[43%] bg-[#F4C496] rounded text-center py-[0.3rem] text-[1rem] text-[#686868] font-bold">Read more...</a>
                            <a href="" class="basis-[14%]">
                                <img src="http://localhost/booknook/src/resources/img/icon-delete.svg" alt="icon delete">
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>
</body>

</html>