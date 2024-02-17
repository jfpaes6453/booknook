<?php

namespace Controller;



use Model\BookModel;

class BookController
{
    private $model;

    public function __construct()
    {
        require_once("c://xampp/htdocs/booknook/src/model/BookModel.php");
        // require_once("src\model\BookModel.php");
        $this->model = new BookModel();
    }
    public function getBooksAndAuthors()
    {
        return ($this->model->getBooksAndAuthors()) ? $this->model->getBooksAndAuthors() : false;
    }
    public function showBooksAndAuthors($id)
    {
        return ($this->model->showBooksAndAuthors($id) != false ? $this->model->showBooksAndAuthors($id) : header("local:index:php"));
    }
    public function searchBookAndAuthors($search)
    {
        return ($this->model->searchBookAndAuthors($search)) ? $this->model->searchBookAndAuthors($search) : false;
    }
}
