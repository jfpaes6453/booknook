<?php

use Controller\BookController;

require_once("c://xampp/htdocs/booknook/src/view/head/header.php");
require_once("c://xampp/htdocs/booknook/src/controller/BookController.php");
$data = new BookController();

$id = $_GET['id'];

$book = $data->showBooksAndAuthors($id, 1, 1)['book'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newData = [
        'title' => $_POST['title'],
        'author_id' => $_POST['author_id'],
    ];
    $data->editBook($id, $newData);

    header('Location: /detailsBook.php?id=' . $id);
    exit;
}

?>

<section class="flex flex-col items-center justify-center min-h-screen px-4 py-12">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Modify information</h2>
    <p class="text-yellow-500 mb-8">The fields marked with * are required.</p>
    <form method="POST" class="w-full max-w-md">
        <div class="mb-4">
            <label class="block text-gray-700 text-lg font-bold mb-2" for="title">
                Title: <span class="text-red-500">*</span>
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-lg font-bold mb-2" for="author">
                Author: <span class="text-red-500">*</span>
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="author_name" type="text" name="author" value="<?php echo htmlspecialchars($book['author_name']); ?>" required>
        </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-lg font-bold mb-2" for="description">
                Description: <span class="text-red-500">*</span>
            </label>
            <textarea class="shadow appearance-none border rounded w-full h-48 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" required><?php echo htmlspecialchars($book['description']); ?></textarea>
        </div>


        <div class="mb-4">
            <label class="block text-gray-700 text-lg font-bold mb-2" for="genre">
                Genre: <span class="text-red-500">*</span>
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="genre" type="text" name="genre" value="<?php echo htmlspecialchars($book['genre']); ?>" required>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-lg font-bold mb-2" for="isbn">
                ISBN: <span class="text-red-500">*</span>
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="isbn" type="text" name="isbn" value="<?php echo htmlspecialchars($book['isbn']); ?>" required>
        </div>
        <div class="mb-6">

            <div class="mb-6">
                <label class="block text-gray-700 text-lg font-bold mb-2" for="image">
                    Upload an image:
                </label>
                <input type="file" id="image" name="image">
            </div>
            <div class="flex justify-start mt-6">
                <a href="#" class="bg-yellow-300 hover:bg-yellow-400 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-10" type="submit">
                    Send
                </a>
                <a href="#" class="bg-orange-300 hover:bg-orange-400 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="reset">
                    Cancel
                </a>
            </div>
        </div>
    </form>
</section>

<?php
require_once("c://xampp/htdocs/booknook/src/view/head/footer.php");
?>