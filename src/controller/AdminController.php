<?php

require_once __DIR__ . '/vendor/autoload.php'; 


class BookController
{
    private $model;

    public function __construct()
    {
        require_once(__DIR__ . "/../model/BookModel.php");
        $this->model = new \Model\BookModel();
    }

    public function store($title, $description, $author, $isbn, $year_edition, $image_url)
    {
        $id = $this->model->insert($title, $description, $author, $isbn, $year_edition, $image_url);

        if ($id !== false) {
            $this->redirectTo("show.php?id=" . $id);
        } else {
            $this->redirectTo("create.php");
        }
    }

    public function show($id)
    {
        $book = $this->model->show($id);

        if ($book !== false) {
            return $book;
        } else {
            $this->redirectTo("index.php");
        }
    }

    public function getBooks()
    {
        $books = $this->model->getBooks();

        return $books ? $books : false;
    }

    public function createForm()
    {
        
        include(__DIR__ . "/../view/create-book-form.php");
    }

    private function redirectTo($location)
    {
        header("Location: $location");
        exit;
    }
}
