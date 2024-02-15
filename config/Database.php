<?php

namespace BookNook;

use PDO;
use PDOException;
use Exception;

class Database
{
    private $pdo;
    private $isConnected = false;

    private function connect()
    {
        if ($this->isConnected) {
            return;
        }

        $dotenv = parse_ini_file(__DIR__ . '/../.env');

        $dsn = sprintf(
            "mysql:host=%s;dbname=%s;charset=utf8mb4",
            $dotenv['DB_HOST'] ?? 'localhost',
            $dotenv['DB_NAME'] ?? ''
        );

        try {
            $this->pdo = new PDO(
                $dsn,
                $dotenv['DB_USER'] ?? '',
                $dotenv['DB_PASSWORD'] ?? '',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
            $this->isConnected = true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Unable to connect to the booknook database.");
        }
    }

    public function getConnection()
    {
        $this->connect();
        return $this->pdo;
    }
}
