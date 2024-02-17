<?php

use Controller\BookController;

require_once __DIR__ . '/vendor/autoload.php';
require_once("src/view/components/header.php");
require_once("c://xampp/htdocs/booknook/src/controller/BookController.php");

$data = new BookController;
$booksData = $data->getBooksAndAuthors();
$bookSearch = null;

if (isset($_GET["search"])) {
    $bookSearch = $data->searchBookAndAuthors($_GET["search"]);
}
?>
<section class="bg-[url('./src/resources/img/banner-2.svg')] bg-no-repeat bg-bottom bg-cover w-full h-[25rem] flex items-center">
    <div class="text-center basis-[70%]">
        <h1 class="font-['Nunito Sans'] text-[3rem] font-bold leading-[3rem]">Welcome to Booknook.</h1>
        <p class="font-['Nunito Sans'] text-[1.5rem] font-bold">your ultimate virtual library haven.</p>
    </div>
    <div class="basis-[30%]"></div>
</section>
<section class="bg-[#838383] w-full">
    <label for="search"></label>
    <form method="GET" action="index.php" class="w-full  h-[6rem]  flex justify-center items-center relative">
        <img src="http://localhost/booknook/src/resources/img/icon-search.svg" alt="icon search" class="h-[1.5rem] absolute left-[36%]">
        <input type="text" id="search" name="search" placeholder="Search for a book..." class="w-[30%] h-[3rem]  text-[1.2rem] pl-[3rem] focus:outline-none">
    </form>

</section>
<?php if ($bookSearch !== false && $bookSearch !== null) : ?>
    <section class="flex flex-col items-center py-[4rem] px-24">
        <?php foreach ($bookSearch as $bookData) : ?>
            <?php print_r($bookData) ?>
        <?php endforeach; ?>
    </section>
<?php endif; ?>
<section class="flex flex-col items-center py-[4rem] px-24">
    <div class="flex flex-col items-center mb-[3rem]">
        <h2 class="font-['Nunito Sans'] text-[1.5rem] font-bold">ALL BOOKS</h2>
        <span class="pt-[0.5rem] border-b-4 border-[#FF621E] w-[05rem] block"></span>
    </div>
    <div class="flex gap-[3rem] flex-wrap justify-center" id="result-books">
        <?php if ($booksData !== false && $bookSearch == null) : ?>
            <?php foreach ($booksData as $bookData) : ?>
                <div class="basis-[22%]">
                    <picture>
                        <img src="data:image/jpg; base64, <?= base64_encode($bookData['image']) ?>" alt="<?= $bookData["title"] ?>" class=" h-[28rem]">
                    </picture>
                    <div class="flex flex-col items-center pt-[1rem]">
                        <h5 class="text-[1.1rem] font-bold"><?= strtoupper("{$bookData['name']} {$bookData['last_name']}") ?></h5>
                        <h5 class="text-[1.1rem] font-bold text-[#FF621E]"><?= $bookData["title"] ?></h5>
                        <p class="text-[1rem] font-semibold">ISBN: <?= $bookData["isbn"] ?></p>
                        <div class="w-full pt-[1rem] px-[0.5rem] flex gap-[0.8rem] items-center">
                            <a href="" class="basis-[43%] bg-[#FED78C] rounded text-center py-[0.3rem] text-[1rem] text-[#686868] font-bold hover:bg-[#ffc24c] hover:text-white transition-all delay-[0.2s] ease-in-out">Edit</a>
                            <a href="src/view/detailsBook.php?id=<?= $bookData["id"] ?>" class="basis-[43%] bg-[#F4C496] rounded text-center py-[0.3rem] text-[1rem] text-[#686868] font-bold hover:bg-[#f2aa65] hover:text-white transition-all ease-in-out">Read more...</a>
                            <a href="" class="basis-[12%]">
                                <img src="http://localhost/booknook/src/resources/img/icon-delete.svg" alt="icon delete">
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
    </div>
<?php else : ?>
    <h3 class="text-center txt-books text-warning p-4">There is not books</h3>
</section>
<?php endif; ?>
</body>

</html>