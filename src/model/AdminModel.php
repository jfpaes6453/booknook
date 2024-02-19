<?php

namespace Model;

class BookModel
{
    private $pdo;

    public function __construct()
    {
        require_once(__DIR__ . "/../config/Database.php");
        $database = new \Config\Database();
        $this->pdo = $database->connection();
    }

    public function insert($title, $description, $author, $isbn, $year_edition, $image_url)
    {
        $sql = "INSERT INTO library_php_mvc.books VALUES (null, :title, :description, :author, :isbn, :year_edition, :image_url)";
        $statement = $this->pdo->prepare($sql);

        $statement->bindParam(":title", $title);
        $statement->bindParam(":description", $description);
        $statement->bindParam(":author", $author);
        $statement->bindParam(":isbn", $isbn);
        $statement->bindParam(":year_edition", $year_edition);
        $statement->bindParam(":image_url", $image_url);

        return $statement->execute() ? $this->pdo->lastInsertId() : false;
    }

    public function show($id)
    {
        $sql = "SELECT * FROM library_php_mvc.books WHERE id = :id LIMIT 1";
        $statement = $this->pdo->prepare($sql);

        $statement->bindParam(":id", $id);

        return $statement->execute() ? $statement->fetch() : false;
    }

    public function getBooks()
    {
        $sql = "SELECT * FROM library_php_mvc.books";
        $statement = $this->pdo->prepare($sql);

        return $statement->execute() ? $statement->fetchAll() : false;
    }
}
