<?php

namespace Model;


use PDO, PDOException;
use Config\Database;

class BookModel
{
    private $pdo;

    public function __construct()
    {
        require_once("c://xampp/htdocs/booknook/config/Database.php");
        $connection = new Database;
        $this->pdo = $connection->connection();
    }

    public function getBooksAndAuthors()
    {
        $statement = $this->pdo->prepare("
        SELECT books.*, authors.*
        FROM booknook.books
        INNER JOIN booknook.authors ON books.author_id = authors.id
    ");
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }

    public function showBooksAndAuthors($id)
    {
        try {
            $bookAndAuthors = $this->getBooksAndAuthors();
            $query = "SELECT *
                FROM booknook.books
                WHERE id = :id
                LIMIT 1";
            $statement = $this->pdo->prepare($query);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            $book = $statement->fetch(PDO::FETCH_ASSOC);
            return [
                'booksAndAuthors' => $bookAndAuthors,
                'book' => $book
            ];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function searchBookAndAuthors($search)
    {
        $statement = $this->pdo->prepare("
        SELECT books.*, authors.*
        FROM booknook.books AS books
        INNER JOIN booknook.authors AS authors ON books.author_id = authors.id
        WHERE books.title LIKE :search OR authors.name LIKE :search
        ");
        $statement->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }
}
