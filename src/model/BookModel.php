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
    public function editBook($id, $newData, $image)
    {
        echo $id;
        var_dump($newData);
        try {
            $this->pdo->beginTransaction();

            $authorQuery = "UPDATE booknook.authors a SET a.name = :name, a.last_name = :last_name  WHERE a.id = $id";
            $authorStatement = $this->pdo->prepare($authorQuery);
            $authorStatement->bindParam(':name', $newData['author_name']);
            $authorStatement->bindParam(':last_name', $newData['author_last_name']);
            $authorStatement->execute();

            // actualizar libros

            $bookQuery = "UPDATE booknook.books b SET b.title = :title, b.description = :description, b.genre = :genre, b.isbn = :isbn b.image = :image WHERE author_id = $id";
            $bookStatement = $this->pdo->prepare($bookQuery);
            $bookStatement->bindParam(':title', $newData['title']);
            $bookStatement->bindParam(':description', $newData['description']);
            $bookStatement->bindParam(':genre', $newData['genre']);
            $bookStatement->bindParam(':isbn', $newData['isbn']);
            $bookStatement->bindParam(":image", $image);
            $bookStatement->execute();

            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function insertBook($newData, $image)
    {

        try {
            $this->pdo->beginTransaction();
            $authorQuery = "INSERT INTO booknook.authors (name, last_name) VALUES (:name, :last_name)";
            $authorStatement = $this->pdo->prepare($authorQuery);
            $authorStatement->bindParam(':name', $newData['author_name']);
            $authorStatement->bindParam(':last_name', $newData['author_last_name']);
            $authorStatement->execute();
            $authorId = $this->pdo->lastInsertId();

            // actualizar libros
            $bookQuery = "INSERT INTO booknook.books (title, description, author_id, genre, isbn, image) VALUES (:title, :description, :author_id, :genre, :isbn, :image)";
            $bookStatement = $this->pdo->prepare($bookQuery);
            $bookStatement->bindParam(':title', $newData['title']);
            $bookStatement->bindParam(':author_id', $authorId);
            $bookStatement->bindParam(':description', $newData['description']);
            $bookStatement->bindParam(':genre', $newData['genre']);
            $bookStatement->bindParam(':isbn', $newData['isbn']);
            $bookStatement->bindParam(':image', $image);
            $bookStatement->execute();
            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
