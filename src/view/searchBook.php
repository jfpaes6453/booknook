<?php

use Controller\BookController;

require_once("c://xampp/htdocs/booknook/src/view/head/header.php");
require_once("c://xampp/htdocs/booknook/src/controller/BookController.php");
$data = new BookController;
$bookSearch = null;
$searchQuery = isset($_GET["search"]) ? $_GET["search"] : null;

if (isset($_GET["search"])) {
    $bookSearch = $data->searchBookAndAuthors($_GET["search"]);
}
?>
<?php if (isset($bookSearch)) : ?>
    <section class="flex flex-col items-center py-[4rem] px-24">
        <div class="flex flex-col items-center mb-[3rem] w-full">
            <div class="w-full flex pt-[2rem] items-center gap-[0.6rem] justify-center">
                <h2 class="font-['Nunito Sans'] text-[1.5rem] font-bold">Search Results: </h2>
                <p class="font-['Nunito Sans'] text-[1.2rem] font-bold"> You searched for <span class="text-[#FF621E] text-[1.5rem]">"<?php echo htmlspecialchars($searchQuery); ?>"</span></p>
            </div>
            <span class="pt-[0.5rem] border-b-4 border-[#FF621E] w-[05rem] block"></span>
            <div class="w-full">
                <a href="http://localhost/booknook/index.php" class="w-[60%] font-['Nunito Sans'] text-[1.2rem] font-bold hover:text-[#FF621E] "><- Back home</a>
            </div>
        </div>
    <?php endif; ?>
    <div class="flex gap-[3rem] flex-wrap justify-center w-full" id="result-books">
        <?php if ($bookSearch !== false && $bookSearch !== null) : ?>
            <?php foreach ($bookSearch as $bookData) : ?>
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
<?php elseif (isset($bookSearch)) : ?>
    <div class="flex flex-col justify-center w-full items-center pt-[4rem]">
        <img src="http://localhost/booknook/src/resources/img/icon-error-search.png" alt="icon error buscador" class="w-[5rem]">
        <h3 class="text-center text-[1.2rem] p-4">"Oops! Apologies, we couldn't find any results for your search. How about trying another title or author?"</h3>
    </div>
<?php endif; ?>
    </section>