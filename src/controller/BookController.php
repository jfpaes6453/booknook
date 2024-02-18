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
        $this->model = new BookModel;
    }
    public function getBooksAndAuthors($currentPage, $itemsPerPage)
    {
        return ($this->model->getBooksAndAuthors($currentPage, $itemsPerPage)) ? $this->model->getBooksAndAuthors($currentPage, $itemsPerPage) : false;
    }
    public function showBooksAndAuthors($id, $currentPage, $itemsPerPage)
    {
        return ($this->model->showBooksAndAuthors($id, $currentPage, $itemsPerPage) != false ? $this->model->showBooksAndAuthors($id, $currentPage, $itemsPerPage) : header("local:index:php"));
    }
    public function searchBookAndAuthors($search)
    {
        return ($this->model->searchBookAndAuthors($search)) ? $this->model->searchBookAndAuthors($search) : false;
    }
    public function getTotalBooks()
    {
        return ($this->model->getTotalBooks() ? $this->model->getTotalBooks() : false);
    }
}
