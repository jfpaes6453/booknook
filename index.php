<?php

use Controller\BookController;

require_once __DIR__ . '/vendor/autoload.php';
require_once("src/view/head/header.php");
require_once("c://xampp/htdocs/booknook/src/controller/BookController.php");

$data = new BookController;
$itemsPerPage = 8;
$totalBooks = $data->getTotalBooks();
$totalPages = ceil($totalBooks / $itemsPerPage);
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$booksData = $data->getBooksAndAuthors($currentPage, $itemsPerPage);
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
    <form method="GET" action="/booknook/src/view/searchBook.php" class="w-full  h-[6rem]  flex justify-center items-center relative" onsubmit="return validateForm()">
        <img src="http://localhost/booknook/src/resources/img/icon-search.svg" alt="icon search" class="h-[1.5rem] absolute left-[36%]" required>
        <input type="text" id="search" name="search" placeholder="Search for a book..." class="w-[30%] h-[3rem]  text-[1.2rem] pl-[3rem] focus:outline-none">
    </form>
</section>
<section class="flex flex-col items-center py-[4rem] px-24">
    <div class="flex flex-col items-center mb-[3rem]">
        <h2 class="font-['Nunito Sans'] text-[1.5rem] font-bold">ALL BOOKS</h2>
        <span class="pt-[0.5rem] border-b-4 border-[#FF621E] w-[05rem] block"></span>
    </div>
    <?php if (isset($_GET["msg"])) : ?>
        <div id="successModal" class="modal block">
            <div class="modal-content w-[25%] h-[32rem] bg-[#F2D783] p-[3rem] ">
                <span class="close" onclick="closeModal()">&times;</span>
                <div class="flex flex-col items-center h-full justify-center">
                    <picture>
                        <img src="http://localhost/booknook/src/resources/img/img-success.png" alt="imagen de libro abierto" class="h-[8rem]">
                    </picture>
                    <h2 class="font-['Nunito Sans'] text-[1.5rem] leading-[1.8rem] font-bold mt-[2rem] w-[100%] text-center">The book successfully deleted</h2>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php require_once("src/view/searchBook.php"); ?>
    <div class="flex gap-[3rem] flex-wrap justify-center px-24" id="result-bookss">
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
                            <a href="src/view/editBook.php?id=<?= $bookData['id'] ?>" class="basis-[43%] bg-[#FED78C] rounded text-center py-[0.3rem] text-[1rem] text-[#686868] font-bold hover:bg-[#ffc24c] hover:text-white transition-all delay-[0.2s] ease-in-out">Edit</a>
                            <a href="src/view/detailsBook.php?id=<?= $bookData["id"] ?>" class="basis-[43%] bg-[#F4C496] rounded text-center py-[0.3rem] text-[1rem] text-[#686868] font-bold hover:bg-[#f2aa65] hover:text-white transition-all ease-in-out">Read more...</a>
                            <a class="basis-[12%] cursor-pointer" id="openModalBtn<?= $bookData["id"] ?>">
                                <img src="http://localhost/booknook/src/resources/img/icon-delete.svg" alt="icon delete">
                            </a>
                        </div>
                        <?php require("src/view/deleteBook.php"); ?>
                    </div>
                </div>
            <?php endforeach; ?>
    </div>
    </div>
    <?php if ($totalPages > 1) : ?>
        <div class="flex justify-center mt-[5rem] mb-[3rem]">
            <ul class="flex">
                <li class="mr-8">
                    <?php if ($currentPage > 1) : ?>
                        <div class="flex items-center">
                            <img src="http://localhost/booknook/src/resources/img/icon-previus.svg" alt="icon previus" class="h-[1.5rem]">
                            <a href="?page=<?php echo $currentPage - 1; ?>" class="block px-4 py-2 font-['Nunito Sans'] text-[1rem] font-bold text-[#FF621E] hover:text-[#FF621E]">Previous</a>
                        </div>
                    <?php else : ?>
                        <div class="flex items-center gap-[0.5rem]">
                            <img src="http://localhost/booknook/src/resources/img/icon-previus.svg" alt="icon previus" class="h-[1.5rem] filter grayscale-[1]">
                            <span class="block pr-4 py-2 font-['Nunito Sans'] text-[1rem] font-bold text-[#696974]">Previous</span>
                        </div>
                    <?php endif; ?>
                </li>

                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="<?php echo $i === $currentPage ? 'font-bold' : ''; ?>">
                        <a href="?page=<?php echo $i; ?>" class="block px-[0.7rem] py-1 font-['Nunito Sans'] text-[1rem] font-bold  <?php echo $i === $currentPage ? 'bg-[#FF621E] rounded-full text-white' : 'hover:text-[#FF621E]'; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <li class="ml-8">
                    <?php if ($currentPage < $totalPages) : ?>
                        <div class="flex items-center gap-[0.5rem] hover:text-[#FF621E] filter  brightness-[0] hover:filter-none">
                            <a href="?page=<?php echo $currentPage + 1; ?>" class="block pl-4 py-2 font-['Nunito Sans'] text-[1rem] font-bold ">Next</a>
                            <img src="http://localhost/booknook/src/resources/img/icon-next.svg" alt="icon next" class="h-[1.5rem]  ">
                        </div>

                    <?php else : ?>
                        <div class="flex items-center gap-[0.5rem] hover:text-[#FF621E] filter  brightness-[0] hover:filter-none">
                            <span class="block pl-4 py-2 font-['Nunito Sans'] text-[1rem] font-bold">Next</span>
                            <img src="http://localhost/booknook/src/resources/img/icon-next.svg" alt="icon next" class="h-[1.5rem]">

                        </div>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    <?php endif; ?>
</section>
<?php else : ?>
    <h3 class="text-center txt-books text-warning p-4">No books yet</h3>
<?php endif; ?>
<?php
require_once("src/view/head/footer.php");
?>
<script>
    function validateForm() {
        var searchInput = document.getElementById('search');
        if (searchInput.value.trim() === '') {
            alert('Please enter a search term.');
            return false;
        }
        return true;
    }
</script>
<script>
    <?php foreach ($booksData as $bookData) : ?>
        var openModalBtn<?= $bookData["id"] ?> = document.getElementById("openModalBtn<?= $bookData["id"] ?>");
        var modal<?= $bookData["id"] ?> = document.getElementById("myModal<?= $bookData["id"] ?>");
        var closeModal<?= $bookData["id"] ?> = document.getElementById("closeModal<?= $bookData["id"] ?>");

        openModalBtn<?= $bookData["id"] ?>.addEventListener("click", function(event) {
            event.preventDefault();
            modal<?= $bookData["id"] ?>.style.display = "block";
        });

        closeModal<?= $bookData["id"] ?>.addEventListener("click", function() {
            modal<?= $bookData["id"] ?>.style.display = "none";
        });

        window.addEventListener("click", function(event) {
            if (event.target == modal<?= $bookData["id"] ?>) {
                modal<?= $bookData["id"] ?>.style.display = "none";
            }
        });
    <?php endforeach; ?>

    function closeModal() {
        var modal = document.getElementById("successModal");
        modal.style.display = "none";
        window.location.href = "http://localhost/booknook/";
    }
</script>
<script src="./node_modules/flowbite/dist/flowbite.min.js"></script>
</body>

</html>