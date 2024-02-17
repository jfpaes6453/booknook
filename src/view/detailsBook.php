<?php

use Controller\BookController;

require_once("c://xampp/htdocs/booknook/src/view/components/header.php");
require_once("c://xampp/htdocs/booknook/src/controller/BookController.php");
$data = new BookController();
$book = $data->showBooksAndAuthors($_GET["id"]);
?>
<section>
    <?php
    print_r($book)
    ?>
</section>
<?php
require_once("c://xampp/htdocs/booknook/src/view/components/footer.php");
?>