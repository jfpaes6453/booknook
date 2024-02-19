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

    public function getBooksAndAuthors($currentPage, $itemsPerPage)
    {
        $offset = ($currentPage - 1) * $itemsPerPage;
        $statement = $this->pdo->prepare("
        SELECT books.*, authors.*
        FROM booknook.books
        INNER JOIN booknook.authors ON books.author_id = authors.id
        LIMIT :offset, :itemsPerPage
    ");
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->bindValue(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }

    public function showBooksAndAuthors($id, $currentPage = null, $itemsPerPage = null)
    {
        try {
            $query = "
            SELECT books.*, authors.*
            FROM booknook.books
            INNER JOIN booknook.authors ON books.author_id = authors.id
            WHERE books.id = :id
            LIMIT 1 ";

            if ($currentPage !== null && $itemsPerPage !== null) {
                $query .= " OFFSET :offset LIMIT :limit";
            }

            $statement = $this->pdo->prepare($query);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);

            if ($currentPage !== null && $itemsPerPage !== null) {
                $offset = ($currentPage - 1) * $itemsPerPage;
                $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
                $statement->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
            }

            $statement->execute();
            $book = $statement->fetch(PDO::FETCH_ASSOC);

            return $book;
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
        WHERE LOWER(books.title) LIKE LOWER(:search) OR LOWER(authors.name) LIKE LOWER(:search)
        ");
        $statement->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }
    public function getTotalBooks()
    {
        $statement = $this->pdo->prepare("SELECT COUNT(*) as total FROM books");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function deleteBook($id)
    {
        $statement = $this->pdo->prepare("DELETE FROM booknook.books WHERE id = :id");
        $statement->bindParam(":id", $id);
        return ($statement->execute()) ? true : false;
    }
    public function editBook($id, $newData)
{
    try {
        $query = "UPDATE booknook.books b JOIN booknook.authors a ON a.name = :author_name SET b.title = :title, b.author_id = a.id, b.description = :description, b.genre = :genre, b.isbn = :isbn WHERE b.id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':title', $newData['title']);
        $statement->bindParam(':name', $newData['name']);
        $statement->bindParam(':description', $newData['description']);
        $statement->bindParam(':genre', $newData['genre']);
        $statement->bindParam(':isbn', $newData['isbn']);
        $statement->bindParam(':id', $id);
        return ($statement->execute()) ? true : false;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

}
