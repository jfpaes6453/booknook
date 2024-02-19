<?php

use Controller\BookController;

require_once("c://xampp/htdocs/booknook/src/view/head/header.php");
require_once("c://xampp/htdocs/booknook/src/controller/BookController.php");
$data = new BookController();
$data = new BookController();
$id = $_GET["id"];
$bookEdit = $data->showBooksAndAuthors($id);
?>


<section class="flex flex-col items-center justify-center min-h-screen px-4 py-12">
    <div class="w-[55%] shadow-lg shadow-gray-500 py-10 px-12 border-[1.5rem] border-[#FEBD01]">
        <h2 class="text-3xl font-extrabold mb-2">Modify information</h2>
        <p class="text-yellow-500 mb-8 text-[1rem]">The fields marked with * are required.</p>
        <form action="http://localhost/booknook/src/view/updateBook.php" method="POST" enctype="multipart/form-data" class="w-full">
            <input type="hidden" name="id" value="<?= $bookEdit['id'] ?>">
            <div class="mb-4">
                <label class="block text-gray-700 text-[1.2rem] font-bold mb-2" for="title">
                    Title: <span class="text-red-500">*</span>
                </label>
                <input class="h-[3rem] text-[1rem] shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" name="title" value="<?= $bookEdit['title'] ?>" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-[1.2rem] font-bold mb-2" for="author">
                    Author Name: <span class="text-red-500">*</span>
                </label>
                <input class="h-[3rem] text-[1rem] shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="author_name" type="text" name="author_name" value="<?= "{$bookEdit['name']}" ?>" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-[1.2rem] font-bold mb-2" for="author">
                    Author Lastname: <span class="text-red-500">*</span>
                </label>
                <input class="h-[3rem] text-[1rem] shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="last_name" type="text" name="last_name" value="<?= "{$bookEdit['last_name']}" ?>" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-[1.2rem] font-bold mb-2" for="author">
                    Genre: <span class="text-red-500">*</span>
                </label>
                <input class="h-[3rem] text-[1rem] shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="genre" type="text" name="genre" value="<?= $bookEdit["genre"] ?>" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-[1.2rem] font-bold mb-2" for="description">
                    Description: <span class="text-red-500">*</span>
                </label>
                <textarea class="text-[1rem] shadow appearance-none border rounded w-full h-48 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" maxlength="800" required><?= $bookEdit['description'] ?></textarea>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-[1.2rem] font-bold mb-2" for="isbn">
                    ISBN: <span class="text-red-500">*</span>
                </label>
                <input maxlength="15" class="h-[3rem] text-[1rem] shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="isbn" type="text" name="isbn" value="<?= $bookEdit["isbn"] ?>" required>
            </div>
            <div class="mb-6">
                <div class="mb-6">
                    <div class="mb-[1rem] flex gap-[1rem]">
                        <div>
                            <label class="block text-gray-700 text-[1.2rem] font-bold mb-2" for="image">
                                Upload an image:
                            </label>
                            <input type="file" id="image" name="image" class="text-[1rem]">
                        </div>
                        <img src="data:image/jpg; base64, <?= base64_encode($bookEdit['image']) ?>" alt="<?= $bookEdit["title"] ?>" class=" h-[5rem]">
                    </div>
                </div>
                <div class="flex gap-[1rem] mt-[3rem]">
                    <button class="cursor-pointer hover:text-white bg-[#FED78C] hover:bg-yellow-400 text-[#716C6C] font-bold text-[1rem] py-2 px-8  focus:outline-none focus:shadow-outline" type="submit">
                        Send
                    </button>
                    <a href="http://localhost/booknook/index.php" class="bg-[#F4C496] hover:bg-orange-400 text-[#716C6C] font-bold text-[1rem] py-2 px-8  focus:outline-none focus:shadow-outline hover:text-white" type="reset">
                        Cancel
                    </a>
                </div>
            </div>
        </form>

    </div>

</section>

<?php
require_once("c://xampp/htdocs/booknook/src/view/head/footer.php");
?>