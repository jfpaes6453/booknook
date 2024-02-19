<?php

namespace Config;

require_once __DIR__ . '/../vendor/autoload.php';


use PDO;
use PDOException;
use Dotenv\Dotenv;

class Database
{
    private $host;
    private $dbname;
    private $user;
    private $password;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        $this->host = $_ENV['DB_HOST'];
        $this->dbname = $_ENV['DB_NAME'];
        $this->user = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];
    }

    public function connection()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
            $pdo = new PDO($dsn, $this->user, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
