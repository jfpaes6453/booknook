<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<form class="max-w-md mx-auto p-5 bg-white rounded shadow-lg" action="../controller/AdminController.php" method="POST" enctype="multipart/form-data">
    <h2 class="text-2xl text-center text-warning mb-5">Create Book</h2>
    
    <div class="mb-4">
        <label for="title" class="block text-sm font-medium text-gray-600">Title</label>
        <input type="text" required name="title" class="mt-1 p-2 w-full border rounded-md" id="title" aria-describedby="title">
    </div>
    
    <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-gray-600">Description</label>
        <textarea class="mt-1 p-2 w-full border rounded-md" name="description" placeholder="Add a description, max. 800 characters..." id="description" maxlength="800"></textarea>
    </div>
    
    <div class="mb-4">
        <label for="author" class="block text-sm font-medium text-gray-600">Author</label>
        <input type="text" required name="author" class="mt-1 p-2 w-full border rounded-md" id="author" aria-describedby="author">
    </div>
    
    <div class="mb-4">
        <label for="isbn" class="block text-sm font-medium text-gray-600">ISBN</label>
        <input type="text" required name="isbn" class="mt-1 p-2 w-full border rounded-md" id="isbn" aria-describedby="isbn" maxlength="19">
    </div>
    
    <div class="mb-4">
        <label for="year_edition" class="block text-sm font-medium text-gray-600">Year</label>
        <input type="text" required name="year_edition" class="mt-1 p-2 w-full border rounded-md" id="year_edition" aria-describedby="year_edition" maxlength="4">
    </div>

    <div class="mb-4">
        <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
        <label for="image_url" class="block text-sm font-medium text-gray-600">Image</label>
        <input type="file" required name="image_url" class="mt-1 p-2 w-full border rounded-md" id="image_url">
    </div>

    <div class="flex justify-between">
        <button class="bg-dark text-white p-2 rounded-md hover:bg-gray-800" type="submit">Create</button>
        <a class="bg-warning text-dark p-2 rounded-md hover:bg-yellow-600" href="../book/index.php">Cancel</a>
    </div>
</form>



</body>
</html>