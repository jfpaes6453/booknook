<?php

use Controller\BookController;


if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $id = $_GET['id'];
    require_once("c://xampp/htdocs/booknook/src/controller/BookController.php");
    $controller = new BookController();
    $controller->deleteBook($id);

    header("Location: http://localhost/booknook/?msg=ok");
    exit;
}

?>
<div id="myModal<?= $bookData["id"] ?>" class="modal">
    <div class="modal-content w-[28%] bg-[#F2D783] p-[3rem] ">
        <span class="close" id="closeModal<?= $bookData["id"] ?>">&times;</span>
        <div class="flex flex-col items-center">
            <picture>
                <img src="http://localhost/booknook/src/resources/img/img-delete.png" alt="imagen de libro abierto" class="h-[10rem]">
            </picture>
            <h2 class="font-['Nunito Sans'] text-[1.8rem] leading-[1.8rem] font-bold mt-[1rem] w-[80%] text-center">Do you want to delete this book?</h2>
            <p class="my-[1rem] text-[1.3rem] leading-[1.7rem] w-[90%] text-center font-semibold">Are you sure you want to delete this book? This action can’t be undone.</p>
            <a class="text-[1.5rem] font-bold bg-[#F59797] rounded w-[90%] text-center text-[#E41517]" onclick="confirmDelete(<?= $bookData["id"] ?>)">Delete</a>
            <a href="#" class="font-bold text-[1.5rem] mt-[1rem] underline" onclick="closeModal(<?= $bookData["id"] ?>)">Cancel</a>
        </div>
    </div>
</div>
<script>
    function closeModal(id) {
        var modal = document.getElementById("myModal" + id);
        modal.style.display = "none";
    }

    function confirmDelete(id) {
        window.location.href = "http://localhost/booknook/src/view/deleteBook.php?id=" + id;
    }
</script>